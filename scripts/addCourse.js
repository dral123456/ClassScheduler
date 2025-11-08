$(document).ready(function () {
    let countTeacher = 1;
    let countSection = 1;

    $.ajax({
        url: "../forms/fetchRooms.php",
        type: "GET",
        dataType: "json",
        success: function(res){

            res.data.forEach(element => {                
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
        let courseName = $("#courseName").val();
        let hours = $("#courseHours").val();
        let sessions = $("#courseSessions").val();
        let term = $("#courseTerm").val();
        let year = $("#courseYear").val().replace(/\s+/g, "");
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
                courseName,
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

        sections.forEach((sectionName) => {
            $.ajax({
                url : "../forms/fetchSpecificSection.php",
                type : "GET",
                dataType : "json",
                data : {
                    sectionName,
                    term,
                    year
                },
                success : function(res) {
                    if (res.status === "success") {
                        console.log("Section found:", res.data);
                        console.log("Updating courses...");
                        
                        if(!($.inArray(code, res.data[0].courses) !== -1)){
                            let sectionID = res.data[0].id;
                            let sectionCourses = []
                            sectionCourses = res.data[0].courses;
                            sectionCourses.push(code);
                            $.ajax({
                                url : "../forms/updateSectionCourse.php",
                                type : "POST",
                                dataType : "json",
                                data : {
                                    sectionCourses,
                                    sectionID
                                },
                                success : function (response){
                                    console.log(response.message);
                                },
                                error: function (xhr, status, error) {
                                    console.log("AJAX Error:", status, error);
                                    console.log("Server Response:", xhr.responseText); 
                                }
                            })
                        }else{
                            console.log("Course already in section");
                        }
                    } 
                    else if (res.status === "none") {
                        console.log("No match found");
                        console.log("Inserting section");
                        let courses = [];
                        courses.push(code);
                        $.ajax({
                            url : "../forms/addSection.php",
                            type : "POST",
                            dataType : "json",
                            data : {
                                sectionName,
                                term,
                                year,
                                courses
                            },
                            success : function(res){
                                console.log(res.message);
                            },
                            error: function (xhr, status, error) {
                                console.log("AJAX Error:", status, error);
                                console.log("Server Response:", xhr.responseText); 
                            }
                        })
                    } 
                    else if (res.status === "error") {
                        console.log("Input error:", res.message);
                        console.log(res.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.log("AJAX Error:", status, error);
                    console.log("Server Response:", xhr.responseText); 
                }
            });
        })

        teachers.forEach((teacherName) => {
            $.ajax({
                url : "../forms/fetchSpecificTeacher.php",
                type : "GET",
                dataType : "json",
                data : {
                    teacherName,
                    term,
                    year
                },
                success : function(res) {
                    if (res.status === "success") {
                        console.log("Teacher found:", res.data);
                        console.log("Updating courses...");
                        
                        if(!($.inArray(code, res.data[0].courses) !== -1)){
                            let sectionID = res.data[0].id;
                            let teacherCourses = []
                            teacherCourses = res.data[0].courses;
                            teacherCourses.push(code);
                            $.ajax({
                                url : "../forms/updateTeacherCourse.php",
                                type : "POST",
                                dataType : "json",
                                data : {
                                    teacherCourses,
                                    sectionID
                                },
                                success : function (response){
                                    console.log(response.message);
                                },
                                error: function (xhr, status, error) {
                                    console.log("AJAX Error:", status, error);
                                    console.log("Server Response:", xhr.responseText); 
                                }
                            })
                        }else{
                            console.log("Course already in section");
                        }
                    } 
                    else if (res.status === "none") {
                        console.log("No match found");
                        console.log("Inserting teacher");
                        let courses = [];
                        courses.push(code);
                        console.log(teacherName,term,year,courses);
                        
                        $.ajax({
                            url : "../forms/addTeacher.php",
                            type : "POST",
                            dataType : "json",
                            data : {
                                teacherName,
                                term,
                                year,
                                courses
                            },
                            success : function(res){
                                console.log(res.message);
                            },
                            error: function (xhr, status, error) {
                                console.log("AJAX Error:", status, error);
                                console.log("Server Response:", xhr.responseText); 
                            }
                        })
                    } 
                    else if (res.status === "error") {
                        console.log("Input error:", res.message);
                        console.log(res.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.log("AJAX Error:", status, error);
                    console.log("Server Response:", xhr.responseText); 
                }
            });
        })
    });
});