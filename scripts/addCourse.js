$(document).ready(function () {
    let countTeacher = 1;
    let countSection = 1;

    $.ajax({
        url: "../forms/fetchRooms.php",
        type: "GET",
        dataType: "json",
        success: function(res){

            res.data.forEach(element => {
                console.log(element.category);
                
                const listItem = $(`
                    <li><a class="dropdown-item">${element.category}</a></li>
                `);

                listItem.find("a").on("click", function(e) {
                    e.preventDefault();
                    $("#selectedCategory").val(element.category);
                });

                $("#categoryDropdown").append(listItem);
            });
            
        },
        error: function(xhr, status, error){
            console.log("AJAX Error:", status, error);
            console.log("Server Response:", xhr.responseText);
        }
    })

    $("#addTeacher").click(() => {
        let newInput = `
            <div class="mb-3">
                <input type="text" class="form-control" name="dynamic_input[]" placeholder="Teacher" id = "teacher${countTeacher}">
                <button type="button" class="removeTeacher btn btn-danger" id="removeTeacher${countTeacher}">Remove</button>
            </div>
        `;

        $("#teachersContainer").append(newInput);
        countTeacher++;

        $(".removeTeacher").click((e) => {
            let teacherid = e.target.id.slice(6).toLowerCase();
            $(`#${e.target.id}`).remove();
            $(`#${teacherid}`).remove();
        });
    });

    $("#addSection").click(() => {
        let newInput = `
            <div class="mb-3">
                <input type="text" class="form-control" name="dynamic_input[]" placeholder="Section" id = "section${countSection}">
                <button type="button" class="removeSection btn btn-danger" id="removeSection${countSection}">Remove</button>
            </div>
        `;

        $("#sectionsContainer").append(newInput);
        countSection++;

        $(".removeSection").click((e) => {
            let teacherid = e.target.id.slice(6).toLowerCase();
            $(`#${e.target.id}`).remove();
            $(`#${teacherid}`).remove();
        });
    });

    $("#submit").click(() => {
        let name = $("#courseName").val();
        let hours = $("#courseHours").val();
        let sessions = $("#courseSessions").val();
        let term = $("#courseTerm").val();
        let year = $("#courseYear").val();
        let code = $("#courseCode").val();
        let category = $("#selectedCategory").val();

        let teachers = [];
        $("#teachersContainer input").each(function () {
            teachers.push($(this).val());
        });

        let sections = [];
        $("#sectionsContainer input").each(function () {
            sections.push($(this).val());
        });        

        $.ajax({
            url: "../forms/addCourse.php",
            type: "POST", 
            dataType: "json", 
            data: {
                name,
                hours,
                sessions,
                term,
                year,
                teachers,
                sections,
                code,
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