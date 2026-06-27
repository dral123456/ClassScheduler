<?php $route = $_GET['route'] ?? 'school-year'; ?>
<aside class="pe-app-sidebar" id="sidebar">
    <div class="pe-app-sidebar-logo px-6 d-flex align-items-center position-relative">
        <a href="school-year" class="d-flex align-items-end logo-main">
            <h4 class="text-body-emphasis fw-bolder mb-0 ms-1">Class Scheduler</h3>
        </a>
    </div>
    <nav class="pe-app-sidebar-menu nav nav-pills" data-simplebar id="sidebar-simplebar">
        <div class="d-flex align-items-start flex-column w-100">
            <ul class="pe-main-menu list-unstyled">

                <li class="pe-menu-title">Setup</li>

                <li class="pe-slide <?= $route === 'course-reg' ? 'active' : '' ?>">
                    <a href="course-reg" class="pe-nav-link">
                        <i class="ri-book-line pe-nav-icon"></i>
                        <span class="pe-nav-content">Courses</span>
                    </a>
                </li>
                <li class="pe-slide pe-has-sub">
                    <a href="#collapseRooms"
                       class="pe-nav-link <?= in_array($route, ['room-reg', 'room-availability-reg']) ? '' : 'collapsed' ?>"
                       data-bs-toggle="collapse"
                       aria-expanded="<?= in_array($route, ['room-reg', 'room-availability-reg']) ? 'true' : 'false' ?>"
                       aria-controls="collapseRooms">
                        <i class="ri-user-line pe-nav-icon"></i>
                        <span class="pe-nav-content">Rooms</span>
                        <i class="ri-arrow-down-s-line pe-nav-arrow"></i>
                    </a>
                    <ul class="pe-slide-menu collapse <?= in_array($route, ['room-reg', 'room-availability-reg']) ? 'show' : '' ?>" id="collapseRooms">
                        <li class="pe-slide-item <?= $route === 'room-reg' ? 'active' : '' ?>">
                            <a href="room-reg" class="pe-nav-link">Registration</a>
                        </li>
                        <li class="pe-slide-item <?= $route === 'room-availability-reg' ? 'active' : '' ?>">
                            <a href="room-availability-reg" class="pe-nav-link">Availability</a>
                        </li>
                    </ul>
                </li>

                <li class="pe-slide pe-has-sub">
                    <a href="#collapseTeachers"
                       class="pe-nav-link <?= in_array($route, ['teacher-reg', 'teacher-availability-reg']) ? '' : 'collapsed' ?>"
                       data-bs-toggle="collapse"
                       aria-expanded="<?= in_array($route, ['teacher-reg', 'teacher_availability-reg']) ? 'true' : 'false' ?>"
                       aria-controls="collapseTeachers">
                        <i class="ri-user-line pe-nav-icon"></i>
                        <span class="pe-nav-content">Teachers</span>
                        <i class="ri-arrow-down-s-line pe-nav-arrow"></i>
                    </a>
                    <ul class="pe-slide-menu collapse <?= in_array($route, ['teacher-reg', 'teacher_availability-reg']) ? 'show' : '' ?>" id="collapseTeachers">
                        <li class="pe-slide-item <?= $route === 'teacher-reg' ? 'active' : '' ?>">
                            <a href="teacher-reg" class="pe-nav-link">Registration</a>
                        </li>
                        <li class="pe-slide-item <?= $route === 'teacher_availability-reg' ? 'active' : '' ?>">
                            <a href="teacher-availability-reg" class="pe-nav-link">Availability</a>
                        </li>
                    </ul>
                </li>

                <li class="pe-menu-title">Scheduling</li>

                <li class="pe-slide <?= $route === 'section-reg' ? 'active' : '' ?>">
                    <a href="section-reg" class="pe-nav-link">
                        <i class="ri-group-line pe-nav-icon"></i>
                        <span class="pe-nav-content">Sections</span>
                    </a>
                </li>

                <li class="pe-slide <?= $route === 'schedule-reg' ? 'active' : '' ?>">
                    <a href="schedule-reg" class="pe-nav-link">
                        <i class="ri-calendar-schedule-line pe-nav-icon"></i>
                        <span class="pe-nav-content">Schedule</span>
                    </a>
                </li>

            </ul>
        </div>
    </nav>
</aside>