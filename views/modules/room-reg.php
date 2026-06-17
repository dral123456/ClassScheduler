<div class="row w-100 justify-content-center">
    <div class="col-12 col-xl-6">
        <div class="card card-h-100">
            <div class="card-header">
              <h5 class="card-title mb-0">Room Registration</h5>
            </div>
            <div class="card-body">
              <p class="text mb-4">Please fill up the form below to register a new room.</p>
              <form action="" method="POST">
                <div class="row">
                  <div class="col-md-6">
                    <label for="roomNum" class="form-label">Room Number<span class="text-danger ms-1">*</span></label>
                    <input type="text" class="form-control" id="roomNum" placeholder="e.g., 705" required>
                  </div>
                  <div class="col-md-6">
                    <label for="roomType" class="form-label">Room Type<span class="text-danger ms-1">*</span></label>
                    <select class="form-select" id="roomType" required>
                      <option disabled selected>--</option>
                      <option value="Lecture Room">Lecture Room</option>
                      <option value="Computer Laboratory">Computer Laboratory</option>
                      <option value="Physics Laboratory">Physics Laboratory</option>
                      <option value="Psychology Laboratory">Psychology Laboratory</option>
                      <option value="P.E. Room">P.E. Room</option>
                    </select>
                  </div>
                  <div class="row mt-3">
                    <div class="d-flex justify-content-between">
                      <button type="button" class="btn btn-danger mt-3" id="back">Back</button>
                      <button type="button" class="btn btn-primary mt-3" id="submitRoom">Submit</button>
                      <button type="button" class="btn btn-success mt-3" id="next">Next</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
        </div>
    </div>
</div>