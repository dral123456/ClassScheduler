<div class="row w-100 justify-content-center">
    <div class="col-12 col-xl-6">
        <div class="card card-h-100">
            <div class="card-header">
                <h5 class="card-title mb-0 ">Welcome!</h5>
            </div>
            <div class="card-body">
                <p class="text-muted mb-4">Please enter a school year</p>
                <form action="" method="POST">
                    <div class="row g-4">
                        <div class="col-xxl-6">
                            <input type="text" class="form-control" name="schoolYear" placeholder="e.g., 2023-2024" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3" name="submitSY">Submit Form</button>
                    <?php
                        $schoolYear = new ControllerSession();
                        $schoolYear->setSchoolYear();
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>