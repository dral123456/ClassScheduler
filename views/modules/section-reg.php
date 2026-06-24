<div class="row w-100 justify-content-center">
    <div class="col-12 col-xl-6">
        <div class="card card-h-100">
            <div class="card-header">
              <h5 class="card-title mb-0">Section Registration</h5>
            </div>
            <div class="card-body">
              <p class="text mb-4">Please fill up the form below to register a new section.</p>
              <form action="" method="POST">
                <div class="row g-3">
                  <div class="col-md-6">
                    <label for="sectionCode" class="form-label">Section Name<span class="text-danger ms-1">*</span></label>
                    <input type="text" class="form-control" id="sectionCode" placeholder="e.g., COM241" required>
                  </div>
                  
                  <div class="col-md-12">
                    <div class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                      <label class="form-label mb-0">Courses <span class="text-danger">*</span></label>
                      <button class="btn btn-sm btn-outline-primary" type="button" id="addCourse">
                        <i class="ri-add-line me-1"></i> Add Course
                      </button>
                    </div>
                    <div id="courseList" class="course-list">
                      <div class="course-item mb-3">
                        <div class="row g-3 align-items-end course-item-row">
                          <div class="col-md-3">
                            <label class="form-label">
                              Course Code <span class="text-danger">*</span>
                            </label>
                              <select id="course" class = "course-select">
                                
                              </select>
                          </div>
                          <div class="col-md-5">
                              <label class="form-label">
                                Teacher <span class="text-danger">*</span>
                              </label>
                              <select id="teacher" class = "teacher-select" disabled>
                                
                              </select>
                          </div>
                          <div class="col-md-3">
                              <label class="form-label">
                                Room <span class="text-danger">*</span>
                              </label>
                              <select id="room" class = "room-select" disabled>
                                
                              </select>
                          </div>
                          <div class="col-md-1 d-flex">
                            <button class="btn w-100 btn-outline-danger remove-course d-flex justify-content-center align-items-center"
                                    type="button"
                                    disabled>
                                <i class="ri-close-line"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 mt-4">
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-danger" id="back">
                            Back
                        </button>

                        <button type="button" class="btn btn-primary" id="submitSection">
                            Submit
                        </button>

                        <button type="button" class="btn btn-success" id="next">
                            Next
                        </button>
                    </div>
                </div>
                </div>
              </form>
            </div>
        </div>
    </div>
</div>