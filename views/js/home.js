$(document).ready(function() {
  $('#submitSY').click(function(event) {
    let schoolYear = $('#schoolYear').val();
    let sy = new FormData();
    sy.append('schoolYear', schoolYear);
    $.ajax({
      url: 'ajax/setSchoolYear.ajax.php',
      method: 'POST',
      data: sy,
      processData: false,
      contentType: false
    });

  });
});