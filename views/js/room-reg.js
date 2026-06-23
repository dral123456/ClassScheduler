$(document).ready(function() {
  $('#submitRoom').click(function(event) {
    if ($('#roomNum').val() === '' || $('#roomType').val() === null) {
      Swal.fire({
        icon: 'warning',
        title: 'Incomplete Fields',
        text: 'Please fill in all the fields before submitting.',
        confirmButtonText: 'OK'
      });
      return;
    }
    saveRoom();
  });

  $('#back').click(function() {
    window.location.href = 'school-year';
  });

  $('#next').click(function() {
    window.location.href = 'course-reg';
  });

  function saveRoom(){
    let roomNum = $('#roomNum').val();
    let roomType = $('#roomType').val();
    let roomData = new FormData();
    roomData.append('roomNum', roomNum);
    roomData.append('roomType', roomType);
    $.ajax({
      url: 'ajax/room-reg.ajax.php',
      method: 'POST',
      cache: false,
      data: roomData,
      dataType: 'text',
      processData: false,
      contentType: false,
      success: function(response) {
        if (response === 'success') {
          Swal.fire({
            icon: 'success',
            title: 'Room Registered',
            text: 'The room has been successfully registered.',
            confirmButtonText: 'OK'
          }).then(() => {
            window.location.href = 'room-reg';
          });        
        }else{
          Swal.fire({
            icon: 'error',
            title: 'Registration Failed',
            text: 'Failed to register the room.',
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