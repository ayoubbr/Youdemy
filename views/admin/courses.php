    <div class="main-content">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">Course Management</h1>
        </div>

        <!-- Filters Section -->
        <div class="course-filters">
            <div class="filter-grid">
                <div class="filter-group">
                    <label>Search Courses</label>
                    <input type="text" placeholder="Search by title or instructor...">
                </div>
                <div class="filter-group">
                    <label>Category</label>
                    <select>
                        <option value="">All Categories</option>
                        <?php
                        foreach ($categories as $key => $category) {
                        ?>
                            <option><?= $category->getTitle(); ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Tag</label>
                    <select>
                        <option value="">All Tags</option>
                        <?php
                        foreach ($tags as $key => $tag) {
                        ?>
                            <option><?= $tag->getTitle(); ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Teacher</label>
                    <select>
                        <option>All Teachers</option>
                        <?php
                        foreach ($teachers as $key => $teacher) {
                            if ($teacher->getRole()->getName() == 'Teacher') {
                        ?>
                                <option><?php echo $teacher->getFirstname() . ' ' . $teacher->getLastname(); ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="filter-actions">
                <button class="page-button">Reset Filters</button>
                <button class="add-course-btn">Apply Filters</button>
            </div>
        </div>

        <!-- Courses Grid -->
        <div class="courses-grid">
            <?php
            foreach ($courses as $key => $value) {
            ?>
                <div class="course-card">
                    <!-- <div class="course-image"> -->
                    <!-- <img src="/api/placeholder/300/160"> -->
                    <!-- <span class="course-status status-published">Published</span> -->
                    <!-- </div> -->
                    <div class="course-content">
                        <div class="course-header">
                            <div class="course-status2"><?php echo $value->getStatus(); ?></div>

                            <div class="course-category"><?php echo $value->getCategory()->getTitle(); ?></div>
                        </div>
                        <h3 class="course-title"><?php echo $value->getTitle(); ?></h3>
                        <div class="course-instructor">
                            <i class="fas fa-user"></i>
                            <?php echo $value->getTeacher()->getFirstname() . " " . $value->getTeacher()->getLastname(); ?>
                        </div>
                        <div class="course-stats">
                            <div class="stat-item">
                                <div class="stat-value"><?php echo count($value->getStudents());

                                                        ?></div>
                                <div class="stat-label">Students</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value"><?php echo $value->getRating(); ?></div>
                                <div class="stat-label">Rating</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">$<?php echo $value->getPrice(); ?></div>
                                <div class="stat-label">Price</div>
                            </div>
                        </div>
                        <div class="course-tags">
                            <?php
                            if (!is_null($value->getTags())) {
                                foreach ($value->getTags() as $key => $tag) {
                            ?>
                                    <span><?php echo $tag->getTitle(); ?></span>
                            <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="course-actions">
                            <?php
                            if ($value->getStatus() == 'Active') {
                            ?>
                                <form action="/admin/courses/one/archive" method="post">
                                    <input type="hidden" name="id" value="<?= $value->getId(); ?>">
                                    <button type="submit" class="action-button ">
                                        <i class="fas fa-box-archive"></i>
                                        Archive
                                    </button>
                                </form>
                            <?php
                            } else if ($value->getStatus() == 'Archived') {
                            ?>
                                <form action="/admin/courses/one/activate" method="post">
                                    <input type="hidden" name="id" value="<?= $value->getId(); ?>">
                                    <button type="submit" class="action-button activate">
                                        <i class="fa-solid fa-check-double"></i>
                                        Activate
                                    </button>
                                </form>
                            <?php

                            } else {
                            ?>
                                <form action="/admin/courses/one/archive" method="post">
                                    <input type="hidden" name="id" value="<?= $value->getId(); ?>">
                                    <button type="submit" class="action-button ">
                                        <i class="fas fa-box-archive"></i>
                                        Archive
                                    </button>
                                </form>
                                <form action="/admin/courses/one/activate" method="post">
                                    <input type="hidden" name="id" value="<?= $value->getId(); ?>">
                                    <button type="submit" class="action-button activate">
                                        <i class="fa-solid fa-check-double"></i>
                                        Activate
                                    </button>
                                </form>
                            <?php
                            }
                            ?>


                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <script>
        // Add event listeners for filter actions
        document.querySelector('.filter-actions .add-course-btn').addEventListener('click', () => {
            // Implementation for applying filters
            alert('Applying filters - To be implemented');
        });
    </script>