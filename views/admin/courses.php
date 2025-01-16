    <div class="main-content">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">Course Management</h1>
            <a href="#" class="add-course-btn" onclick="showAddCourseModal()">
                <i class="fas fa-plus"></i>
                Add New Course
            </a>
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
                        <option>Development</option>
                        <option>Design</option>
                        <option>Business</option>
                        <option>Marketing</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Status</label>
                    <select>
                        <option value="">All Status</option>
                        <option>Published</option>
                        <option>Draft</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Sort By</label>
                    <select>
                        <option>Newest First</option>
                        <option>Oldest First</option>
                        <option>Most Popular</option>
                        <option>Highest Rated</option>
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
            <!-- Course Card 1 -->

            <?php
            foreach ($courses as $key => $value) {
            ?>

                <div class="course-card">
                    <div class="course-image">
                        <img src="/api/placeholder/300/160">
                        <!-- <span class="course-status status-published">Published</span> -->
                    </div>
                    <div class="course-content">
                        <div class="course-category"><?php echo $value->getCategory()->getTitle(); ?></div>
                        <h3 class="course-title"><?php echo $value->getTitle(); ?></h3>
                        <div class="course-instructor">
                            <i class="fas fa-user"></i>
                            <?php echo $value->getTeacher()->getFirstname() . " " . $value->getTeacher()->getLastname(); ?>
                        </div>
                        <div class="course-stats">
                            <div class="stat-item">
                                <div class="stat-value"><?php echo count($value->getStudents()); ?></div>
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
                        <div class="course-actions">
                            <button class="action-button edit-button">
                                <i class="fas fa-edit"></i>
                                Edit
                            </button>
                            <button class="action-button delete-button">
                                <i class="fas fa-trash"></i>
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <button class="page-button"><i class="fas fa-chevron-left"></i></button>
            <button class="page-button active">1</button>
            <button class="page-button">2</button>
            <button class="page-button">3</button>
            <button class="page-button"><i class="fas fa-chevron-right"></i></button>
        </div>
    </div>

    <script>
        // Function to show add course modal
        function showAddCourseModal() {
            // Implementation would go here
            alert('Add Course Modal - To be implemented');
        }

        // Add event listeners for filter actions
        document.querySelector('.filter-actions .add-course-btn').addEventListener('click', () => {
            // Implementation for applying filters
            alert('Applying filters - To be implemented');
        });

        // Add event listeners for edit and delete actions
        document.querySelectorAll('.edit-button').forEach(button => {
            button.addEventListener('click', (e) => {
                // Implementation for edit action
                alert('Edit course - To be implemented');
            });
        });

        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', (e) => {
                if (confirm('Are you sure you want to delete this course?')) {
                    // Implementation for delete action
                    alert('Delete course - To be implemented');
                }
            });
        });

        // Add event listeners for pagination
        document.querySelectorAll('.pagination .page-button').forEach(button => {
            button.addEventListener('click', () => {
                if (!button.classList.contains('active')) {
                    document.querySelector('.pagination .active').classList.remove('active');
                    button.classList.add('active');
                    // Implementation for pagination
                    alert('Pagination - To be implemented');
                }
            });
        });
    </script>