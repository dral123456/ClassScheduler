$(document).ready(function () {

    $("#submit").click(() => {
        let name = $("#roomName").val();
        let number = $("#roomNumber").val();
        let category = $("#roomCategory").val();

        $.ajax({
            url: "../forms/addRoom.php",
            type: "POST", 
            dataType: "json", 
            data: {
                name,
                number,
                category
            },
            success: function (res) {
                alert(res.message);
            },
            error: function (xhr, status, error) {
                console.log("AJAX Error:", status, error);
                console.log("Server Response:", xhr.responseText); 
            }
        });
    });



});