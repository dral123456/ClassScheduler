<div class="row w-100 justify-content-center">
    <div class="col-12 col-xl-6">
        <div class="card card-h-100">
            <div class="card-header">
                <h5 class="card-title mb-0">Room Availability</h5>
            </div>
            <div class="card-body">
                <p class="text mb-4">Set the days and time windows each room is available. Rooms with no entries are assumed available the full day (7:30 AM – 7:00 PM, Mon–Sat).</p>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="room" class="form-label">Room <span class="text-danger">*</span></label>
                        <select id="room" class="room-select"></select>
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex align-items-center justify-content-between flex-wrap mb-3">
                    <label class="form-label mb-0">Availability Windows <span class="text-danger">*</span></label>
                    <button class="btn btn-sm btn-outline-primary" type="button" id="addAvailability">
                        <i class="ri-add-line me-1"></i> Add Window
                    </button>
                </div>

                <div id="availabilityList"></div>

                <div class="col-12 mt-4">
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-danger" id="back">Back</button>
                        <button type="button" class="btn btn-primary" id="submitAvailability">Submit</button>
                        <button type="button" class="btn btn-success" id="next">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>