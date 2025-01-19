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
            //   var_dump($courses);
            foreach ($courses as $key => $value) {
            ?>

                <div class="course-card">
                    <!-- <div class="course-image"> -->
                        <!-- <img src="/api/placeholder/300/160"> -->
                        <!-- <span class="course-status status-published">Published</span> -->
                    <!-- </div> -->
                    <div class="course-content">
                        <div class="course-category"><?php echo $value->getCategory()->getTitle(); ?></div>
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

                                $array = explode(', ', $value->getTags());
                                foreach ($array as $key => $value) {
                            ?>
                                    <span><?php echo $value . ' '; ?></span>
                            <?php
                                }
                            }
                            ?>
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

    <!-- Add this HTML just before the closing </div> of "main-content" -->
    <div id="addCourseModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Add New Course</h2>
                <span class="close-modal">&times;</span>
            </div>
            <form id="addCourseForm" action="/course/create" method="post">
                <div class="form-row">
                    <div class="form-group">
                        <label for="title">Course Title</label>
                        <input type="text" id="title" name="title" required>
                    </div>

                    <div class="form-group">
                        <label for="categoryName">Category</label>
                        <select id="categoryName" name="categoryName" required>
                            <option value="">Select Category</option>
                            <?php
                            // $categories = $_SESSION['categories'];
                            foreach ($categories as $key => $value) {
                            ?>
                                <option value="<?php echo $value->getTitle(); ?>"><?php echo $value->getTitle(); ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group half">
                        <label for="price">Price ($)</label>
                        <input type="number" id="price" name="price" min="0" step="0.01" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group half">
                        <label for="content">Course Content</label>
                        <input type="text" id="content" name="content" required>
                    </div>
                </div>
                <!-- <div class="form-row"> -->
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="4" required></textarea>
                </div>
                <!-- </div>  -->


                <div class="form-group tags">
                    <?php
                    foreach ($tags as $key => $value) {
                    ?>
                        <div>
                            <input type="checkbox" id="<?php echo $value->getId() ?>" name="tags[]" value="<?php echo $value->getTitle() ?>" />
                            <label for="<?php echo $value->getTitle() ?>"><?php echo $value->getTitle() ?></label>
                        </div>
                    <?php
                    } ?>
                </div>
                <div class="modal-actions">
                    <button type="button" class="page-button" onclick="closeAddCourseModal()">Cancel</button>
                    <button type="submit" class="add-course-btn">Create Course</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function showAddCourseModal() {
            document.getElementById('addCourseModal').style.display = 'block';
        }

        // Function to close the modal
        function closeAddCourseModal() {
            document.getElementById('addCourseModal').style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('addCourseModal');
            if (event.target == modal) {
                closeAddCourseModal();
            }
        }

        // Close modal when clicking the X button
        document.querySelector('.close-modal').onclick = function() {
            closeAddCourseModal();
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