$(document).ready(function() {
  let courseChoice;
  let courseOptions = '';

  loadCourse();

  $('#submitTeacher').click(function(event) {
    if ($('#teacherFName').val() === '' || $('#teacherMName').val() === '' || $('#teacherLName').val() === '' || $('#course').val() === null) {
      Swal.fire({
        icon: 'warning',
        title: 'Incomplete Fields',
        text: 'Please fill in all the required fields before submitting.',
        confirmButtonText: 'OK'
      });
      return;
    }
    saveTeacher();
  });

  $('#back').click(function() {
    window.location.href = 'course-reg';
  });

  $('#next').click(function() {
    window.location.href = 'teacher-reg';
  });

  $('#addCourse').click(function() {
    let courseItem = `
    <div class="course-item mb-3">
        <div class="row g-3 align-items-end course-item-row">
            <div class="col-md-10">
                <select class="course-select">
                  ${courseOptions}
                </select>
            </div>
            <div class="col-md-2 d-flex">
                <button class="btn w-100 btn-outline-danger remove-course" type="button">
                    <i class="ri-close-line"></i>
                </button>
            </div>
        </div>
    </div>
    `;

    $('#courseList').append(courseItem);

    const newSelect = $('#courseList .course-select').last()[0];

    new Choices(newSelect, {
        placeholderValue: 'Select an option',
        searchPlaceholderValue: 'Search...'
    });
  });

  $(document).on('click', '.remove-course', function() {
    $(this).closest('.course-item').remove();
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
              ${element.courseName} (${element.courseCode})
            </option>
          `;
        });

        $('.course-select').html(courseOptions);

        if(courseChoice){
          courseChoice.destroy();
        }

        courseChoice = new Choices('.course-select', {
          placeholderValue: 'Select an option',
          searchPlaceholderValue: 'Search...'
        });
      }
    });
  }

  function saveTeacher(){
    let teacherFName = $('#teacherFName').val();
    let teacherMName = $('#teacherMName').val();
    let teacherLName = $('#teacherLName').val();
    let teacherSuffix = $('#teacherSuffix').val();

    let teacherData = new FormData();

    teacherData.append('teacherFName', teacherFName);
    teacherData.append('teacherMName', teacherMName);
    teacherData.append('teacherLName', teacherLName);
    teacherData.append('teacherSuffix', teacherSuffix);

    $.ajax({
      url: 'ajax/teacher-reg.ajax.php',
      method: 'POST',
      cache: false,
      data: teacherData,
      dataType: 'json',
      processData: false,
      contentType: false,
      success: function(response) {
        if (response) {
      
          // Collect selected value from each course-select (not all options)
          let selectedCourses = [];
          $(".course-select").each(function() {
            let val = $(this).val();
            if (val && !selectedCourses.includes(val)) {
              selectedCourses.push(val);
            }
          });
      
          console.log(selectedCourses);
      
          // Run saves sequentially using async/await
          (async () => {
            try {
              for (const courseID of selectedCourses) {
                await saveCourseTeacher(response, courseID);
              }
              Swal.fire({
                icon: 'success',
                title: 'Teacher Registered',
                text: 'The teacher has been successfully registered.',
                confirmButtonText: 'OK'
              }).then(() => {
                window.location.href = 'teacher-reg';
              });
            } catch (err) {
              Swal.fire({
                icon: 'error',
                title: 'Registration Failed',
                text: 'Failed to register the teacher.',
                confirmButtonText: 'OK'
              });
            }
          })();
      
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Registration Failed',
            text: 'Failed to register the teacher.',
            confirmButtonText: 'OK'
          });
        }
      },
      error: function() {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'An error occurred while processing your request.',
          confirmButtonText: 'OK'
        });
      }
    });
  }

  function saveCourseTeacher(teacherID, courseID) {
    let courseTeacherData = new FormData();
    courseTeacherData.append('courseID', courseID);
    courseTeacherData.append('teacherID', teacherID);
  
    return new Promise((resolve, reject) => {
      $.ajax({
        url: 'ajax/course_teacher-reg.ajax.php',
        method: 'POST',
        cache: false,
        data: courseTeacherData,
        dataType: 'text',
        processData: false,
        contentType: false,
        success: function(response) {
          if (response === 'success') {
            resolve();
          } else {
            reject('Failed to save course-teacher link.');
          }
        },
        error: function() {
          reject('AJAX error on course-teacher save.');
        }
      });
    });
  }
});