$(document).ready(function() {
  let courseChoice;
  let teacherChoice;
  let roomChoice;
  let courseOptions = '';
  let teacherOptions = '';
  let roomOptions = '';

  loadCourse();
  loadTeacher();
  loadRoom();

  $('#submitSection').click(function () {
      if ($('#sectionCode').val() === '' || $('#sectionSY').val() === '') {
          Swal.fire({ icon: 'warning', title: 'Incomplete Fields', text: 'Please fill in all required fields.', confirmButtonText: 'OK' });
          return;
      }
      saveSection();
  });

  $('#back').click(function() {
    window.location.href = 'teacher-reg';
  });

  $('#next').click(function() {
    window.location.href = 'section-reg';
  });

  $('#addCourse').click(function() {
    let courseItem = `
    <div class="course-item mb-3">
      <div class="row g-3 align-items-end course-item-row">
        <div class="col-md-3">
            <select class = "course-select">
              ${courseOptions}
            </select>
        </div>
        <div class="col-md-5">
            <select class = "teacher-select" disabled>
              ${teacherOptions}
            </select>
        </div>
        <div class="col-md-3">
            <select class = "room-select" disabled>
              ${roomOptions}
            </select>
        </div>
        <div class="col-md-1 d-flex">
          <button class="btn w-100 btn-outline-danger remove-course d-flex justify-content-center align-items-center"
                  type="button"
                  >
              <i class="ri-close-line"></i>
          </button>
        </div>
      </div>
    </div>
    `;

    $('#courseList').append(courseItem);

    const newSelect = $('#courseList .course-select').last()[0];
    const teacherSelect = $('.teacher-select').last()[0];
    const roomSelect = $('.room-select').last()[0];

    new Choices(newSelect, {
      placeholderValue: 'Select course',
      searchPlaceholderValue: 'Search...',
      itemSelectText: '',
    });
    const teacherInstance = new Choices(teacherSelect, {
      placeholderValue: 'Select a teacher',
      itemSelectText: '',
      searchPlaceholderValue: 'Search...'
    });
    
    const roomInstance = new Choices(roomSelect, {
      placeholderValue: 'Select room',
      itemSelectText: '',
      searchPlaceholderValue: 'Search...',
      noChoicesText: ''
    });
    $(teacherSelect).data('choices', teacherInstance);
    $(roomSelect).data('choices', roomInstance);
  });

  $(document).on('click', '.remove-course', function() {
    $(this).closest('.course-item').remove();
  });

  $(document).on('change', '.course-select', function () {
      const row             = $(this).closest('.course-item');
      const courseID        = this.value;
      const teacherSelect   = row.find('.teacher-select')[0];
      const roomSelect      = row.find('.room-select')[0];
      const teacherInstance = $(teacherSelect).data('choices');
      const roomInstance    = $(roomSelect).data('choices');

      // Fetch teachers filtered by courseID
      $.ajax({
          url: 'ajax/teacher-list.ajax.php',
          method: 'POST',
          data: { courseID: courseID },
          dataType: 'json',
          success: function (response) {
              let newOptions = response.map(t => {
                  let suffix = t.teacherSuffix ? `, ${t.teacherSuffix}` : '';
                  return {
                      value: t.teacherID,
                      label: `${t.teacherFName} ${t.teacherMName.slice(0,1)}. ${t.teacherLName}${suffix}`
                  };
              });

              const instance = teacherInstance || teacherChoice;
              if (instance) {
                  instance.config.noChoicesText  = 'No teachers for this course';
                  instance.config.itemSelectText = '';
                  instance.clearChoices();
                  instance.setChoices(newOptions, 'value', 'label', true);
                  instance.enable();
              }
          }
      });

      // Fetch rooms filtered by courseID
      $.ajax({
          url: 'ajax/room-list.ajax.php',
          method: 'POST',
          data: { courseID: courseID },
          dataType: 'json',
          success: function (response) {
              let newOptions = response.map(r => ({
                  value: r.roomID,
                  label: r.roomNum
              }));

              const instance = roomInstance || roomChoice;
              if (instance) {
                  instance.config.noChoicesText  = 'No rooms for this course';
                  instance.config.itemSelectText = '';
                  instance.clearChoices();
                  instance.setChoices(newOptions, 'value', 'label', true);
                  instance.enable();
              }
          }
      });
  });

  function loadCourse(){
    $.ajax({
      url: 'ajax/course-list.ajax.php',
      method: 'POST',
      dataType: 'json',
      success: function(response) {

        courseOptions = '';

        response.forEach(element => {
          courseOptions += `
            <option value="${element.courseID}">
              ${element.courseCode}
            </option>
          `;
        });

        $('.course-select').html(courseOptions);

        if(courseChoice){
          courseChoice.destroy();
        }

        courseChoice = new Choices('.course-select', {
          placeholderValue: 'Select course',
          searchPlaceholderValue: 'Search...',
          itemSelectText: '',
        });
      }
    });
  }

  function loadTeacher(){
    $.ajax({
      url: 'ajax/teacher-list.ajax.php',
      method: 'POST',
      dataType: 'json',
      success: function(response) {
        console.log(response);
        

        teacherOptions = '';

        response.forEach(element => {
          if(element.teacherSuffix != ''){
            suffix = `, ${element.teacherSuffix}`;
          }else{
            suffix = '';
          }
          teacherOptions += `
            <option value="${element.teacherID}">
              ${element.teacherFName} ${(element.teacherMName).slice(0,1)}. ${element.teacherLName}${suffix}
            </option>
          `;
        });

        $('.teacher-select').html(teacherOptions);

        if(teacherChoice){
          teacherChoice.destroy();
        }

        teacherChoice = new Choices('.teacher-select', {
          placeholderValue: 'Select teacher',
          searchPlaceholderValue: 'Search...',
          itemSelectText: '',
        });
      }
    });
  }

  function loadRoom(){
    $.ajax({
      url: 'ajax/room-list.ajax.php',
      method: 'POST',
      dataType: 'json',
      success: function(response) {

        roomOptions = '';

        response.forEach(element => {
          roomOptions += `
            <option value="${element.roomID}">
              ${element.roomNum}
            </option>
          `;
        });

        $('.room-select').html(roomOptions);

        if(roomChoice){
          roomChoice.destroy();
        }

        roomChoice = new Choices('.room-select', {
          placeholderValue: 'Select room',
          searchPlaceholderValue: 'Search...',
          itemSelectText: '',
        });
      }
    });
  }

  function saveSection() {
      let csrtItems = [];

      $('.course-item').each(function () {
          let courseID  = $(this).find('.course-select')[0].value;
          let teacherID = $(this).find('.teacher-select')[0].value;
          let roomID    = $(this).find('.room-select')[0].value;

          if (courseID && teacherID && roomID) {
              csrtItems.push({ courseID, teacherID, roomID });
          }
      });

      if (csrtItems.length === 0) {
          Swal.fire({ icon: 'warning', title: 'No Courses', text: 'Please add at least one course row.', confirmButtonText: 'OK' });
          return;
      }

      let formData = new FormData();
      formData.append('sectionCode',     $('#sectionCode').val());
      formData.append('sectionSY',       $('#sectionSY').val());
      formData.append('sectionSemester', $('.semester-select')[0].value);

      $.ajax({
          url: 'ajax/section-reg.ajax.php',
          method: 'POST',
          cache: false,
          data: formData,
          dataType: 'text',
          processData: false,
          contentType: false,
          success: async function (sectionID) {
              if (sectionID.startsWith('error')) {
                  Swal.fire({ icon: 'error', title: 'Registration Failed', text: sectionID, confirmButtonText: 'OK' });
                  return;
              }

              try {
                  for (const item of csrtItems) {
                      const result = await saveCsrt(sectionID, item);
                      if (result !== 'success') throw new Error(result);
                  }

                  Swal.fire({
                      icon: 'success',
                      title: 'Section Registered',
                      text: 'The section has been successfully registered.',
                      confirmButtonText: 'OK'
                  }).then(() => {
                      window.location.href = 'section-reg';
                  });

              } catch (err) {
                  Swal.fire({ icon: 'error', title: 'Registration Failed', text: err.message, confirmButtonText: 'OK' });
              }
          },
          error: function () {
              Swal.fire({ icon: 'error', title: 'Error', text: 'An error occurred while processing your request.', confirmButtonText: 'OK' });
          }
      });
  }

  function saveCsrt(sectionID, item) {
      let formData = new FormData();
      formData.append('sectionID', sectionID);
      formData.append('courseID',  item.courseID);
      formData.append('teacherID', item.teacherID);
      formData.append('roomID',    item.roomID);

      return new Promise((resolve, reject) => {
          $.ajax({
              url: 'ajax/csrt-reg.ajax.php',
              method: 'POST',
              cache: false,
              data: formData,
              dataType: 'text',
              processData: false,
              contentType: false,
              success: function (response) { resolve(response); },
              error: function () { reject(new Error('AJAX error on CSRT save.')); }
          });
      });
  }
});