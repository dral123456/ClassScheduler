$(document).ready(function() {
  $('#submitCourse').click(function(event) {
    if ($('#courseCode').val() === '' || $('#courseName').val() === '' || $('#roomNeed').val() === null || $('#courseHours').val() === '' || $('#courseSessions').val() === '' || ($('#no').prop('checked') === false && $('#yes').prop('checked') === false)) {
      Swal.fire({
        icon: 'warning',
        title: 'Incomplete Fields',
        text: 'Please fill in all the fields before submitting.',
        confirmButtonText: 'OK'
      });
      return;
    }
    saveCourse();
  });

  $('#back').click(function() {
    window.location.href = 'room-reg';
  });

  $('#next').click(function() {
    window.location.href = 'teacher-reg';
  });

  function saveCourse(){
    let courseCode = $('#courseCode').val();
    let courseName = $('#courseName').val();
    let roomNeed = $('#roomNeed').val();
    let courseHours = $('#courseHours').val();
    let courseSessions = $('#courseSessions').val();
    let isSaturdayCourse = $('#yes').prop('checked') ? 1 : 0;
    let courseData = new FormData();
    courseData.append('courseCode', courseCode);
    courseData.append('courseName', courseName);
    courseData.append('roomNeed', roomNeed);
    courseData.append('courseHours', courseHours);
    courseData.append('courseSessions', courseSessions);
    courseData.append('isSaturdayCourse', isSaturdayCourse);
    $.ajax({
      url: 'ajax/course-reg.ajax.php',
      method: 'POST',
      cache: false,
      data: courseData,
      dataType: 'text',
      processData: false,
      contentType: false,
      success: function(response) {
        if (response === 'success') {
          Swal.fire({
            icon: 'success',
            title: 'Course Registered',
            text: 'The course has been successfully registered.',
            confirmButtonText: 'OK'
          }).then(() => {
            window.location.href = 'course-reg';
          });        
        }else{
          Swal.fire({
            icon: 'error',
            title: 'Registration Failed',
            text: 'Failed to register the course.',
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
});