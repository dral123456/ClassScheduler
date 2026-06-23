<div class="row w-100 justify-content-center">
    <div class="col-12 col-xl-6">
        <div class="card card-h-100">
            <div class="card-header">
              <h5 class="card-title mb-0">Course Registration</h5>
            </div>
            <div class="card-body">
              <p class="text mb-4">Please fill up the form below to register a new course.</p>
              <form action="" method="POST">
                <div class="row g-3">
                  <div class="col-md-6">
                    <label for="courseCode" class="form-label">Course Code<span class="text-danger ms-1">*</span></label>
                    <input type="text" class="form-control" id="courseCode" placeholder="e.g., GENAT01R" required>
                  </div>
                  <div class="col-md-6">
                    <label for="courseName" class="form-label">Course Name<span class="text-danger ms-1">*</span></label>
                    <input type="text" class="form-control" id="courseName" placeholder="e.g., Nationallian Course" required>
                  </div>
                  <div class="col-md-6">
                    <label for="roomNeed" class="form-label">Room Type Needed<span class="text-danger ms-1">*</span></label>
                    <select class="form-select" id="roomNeed" required>
                      <option disabled selected>--</option>
                      <option value="Lecture Room">Lecture Room</option>
                      <option value="Computer Laboratory">Computer Laboratory</option>
                      <option value="Physics Laboratory">Physics Laboratory</option>
                      <option value="Psychology Laboratory">Psychology Laboratory</option>
                      <option value="P.E. Room">P.E. Room</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label for="courseHours" class="form-label">Number of Hours per Week<span class="text-danger ms-1">*</span></label>
                    <input type="text" class="form-control" id="courseHours" placeholder="e.g., 4" required>
                  </div>
                  <div class="col-md-6">
                    <label for="courseSessions" class="form-label">Number of Sessions per Week<span class="text-danger ms-1">*</span></label>
                    <input type="text" class="form-control" id="courseSessions" placeholder="e.g., 2" required>
                  </div>
                  <div class="col-md-6 d-flex flex-column">
                    <label class="form-label">Is this a saturday course?<span class="text-danger ms-1">*</span></label>
                    <div class="d-flex justify-content-start gap-4 flex-grow-1 align-items-center">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="no">
                        <label class="form-check-label" for="no">
                          No
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="yes">
                        <label class="form-check-label" for="yes">
                          Yes
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-3">
                    <div class="d-flex justify-content-between">
                      <button type="button" class="btn btn-danger mt-3" id="back">Back</button>
                      <button type="button" class="btn btn-primary mt-3" id="submitCourse">Submit</button>
                      <button type="button" class="btn btn-success mt-3" id="next">Next</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
        </div>
    </div>
</div>