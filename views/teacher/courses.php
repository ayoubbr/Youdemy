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

            <?php
            foreach ($courses as $key => $value) {
                $id = $value->getId();
            ?>

                <div class="course-card">
                    <!-- <div class="course-image"> -->
                    <!-- <img src="/api/placeholder/300/160"> -->
                    <!-- <span class="course-status status-published">Published</span> -->
                    <!-- </div> -->
                    <div class="course-content">
                        <div class="course-category"><?php echo $value->getCategory()->getTitle(); ?></div>
                        <h3 class="course-title"><?php echo $value->getTitle(); ?></h3>
                        <h3 class="course-title" style="display:none;"><?php echo $value->getDescription(); ?></h3>
                        <div class="course-instructor">
                            <i class="fas fa-user"></i>
                            <?php echo $value->getTeacher()->getFirstname() . " " . $value->getTeacher()->getLastname(); ?>
                        </div>
                        <div class="course-instructor">
                            <i class="fa-solid fa-link"></i>
                            <a href="<?php echo $value->getContent(); ?>">Click here to see course.</a>
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

                                // $array = explode(', ', $value->getTags());
                                foreach ($value->getTags() as $key => $tag) {
                            ?>
                                    <span><?php echo $tag->getTitle(); ?></span>
                            <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="course-actions">
                            <button class="action-button edit-button" onclick="<?php echo "edit('course', $id)"; ?>">
                                <i class="fas fa-edit"></i>
                                Edit
                            </button>
                            <form action="/teacher/courses/one/delete" method="post">
                                <input type="hidden" name="id" value="<?= $value->getId(); ?>">
                                <button type="submit" class="action-button delete-button">
                                    <i class="fas fa-trash"></i>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

    <!-- Add this HTML just before the closing </div> of "main-content" -->
    <div id="addCourseModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Add New Course</h2>
                <span class="close-modal">&times;</span>
            </div>
            <form id="addCourseForm" action="/teacher/course/create" method="post">
                <div class="form-row">
                    <div class="form-group half">
                        <label for="title">Course Title</label>
                        <input type="text" id="title" name="title" required>
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

                    <div class="form-group half">
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

    <!-- Edit Course Modal -->
    <div id="editCourseModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Add New Course</h2>
                <span class="close-modal" onclick="hideModal('editCourseModal')">&times;</span>
            </div>
            <form id="addCourseForm" action="/teacher/course/update" method="post">
                <input type="hidden" name="id" id="editCourseId">
                <div class="form-row">
                    <div class="form-group half">
                        <label for="title">Course Title</label>
                        <input type="text" id="editCourseTitle" name="title" required>
                    </div>

                    <div class="form-group half">
                        <label for="price">Price ($)</label>
                        <input type="number" id="editCoursePrice" name="price" min="0" step="0.01" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group half">
                        <label for="content">Course Content</label>
                        <input type="text" id="editCourseContent" name="content" required>
                    </div>

                    <div class="form-group half">
                        <label for="categoryName">Category</label>
                        <select id="editCourseCategory" name="categoryName" required>
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
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="editCourseDescription" name="description" rows="4" required></textarea>
                </div>
                <div class="form-group tags">
                    <?php
                    foreach ($tags as $key => $value) {
                        $tagTitle = $value->getTitle();
                    ?>
                        <div>
                            <input type="checkbox" id="tag_<?php echo $tagTitle; ?>"
                                value="<?php echo $tagTitle; ?>" name="tags[]" />
                            <label for="tag_<?php echo $tagTitle; ?> ?>"><?php echo $value->getTitle() ?></label>
                        </div>
                    <?php
                    } ?>
                </div>
                <div class="modal-actions">
                    <button type="button" class="page-button" onclick="hideModal('editCourseModal')">Cancel</button>
                    <button type="submit" class="add-course-btn">Create Course</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function showAddCourseModal() {
            document.getElementById('addCourseModal').style.display = 'block';
        }

        function closeAddCourseModal() {
            document.getElementById('addCourseModal').style.display = 'none';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('addCourseModal');
            if (event.target == modal) {
                closeAddCourseModal();
            }
        }

        document.querySelector('.close-modal').onclick = function() {
            closeAddCourseModal();
        }

        function showModal(id) {
            document.getElementById(id).classList.add('active');
        }

        function hideModal(id) {
            document.getElementById(id).classList.remove('active');
        }

        function edit(type, id) {
            const card = event.target.closest('div.course-content');
            const category = card.children[0].textContent;
            const title = card.children[1].textContent;
            const description = card.children[2].textContent;
            const content = card.children[4].children[1].getAttribute("href");
            const price = card.children[5].children[2].children[0].textContent.substr(1);
            const tagsText = card.children[6].textContent;

            // const tags = card.children[6].textContent.split(',').map(tag => tag.trim());
            const tags = tagsText.split(/\s+/) // Split by whitespace
                .filter(tag => tag.trim() !== ''); // Remove empty strings

            console.log('Tags found:', tags); // For debugging


            if (type === 'course') {

                // Reset all checkboxes first
                const checkboxes = document.querySelectorAll('input[name="tags[]"]');
                checkboxes.forEach(checkbox => {
                    checkbox.checked = false;
                });

                // Check the boxes that match the course tags
                tags.forEach(tag => {
                    console.log(tag);

                    // Find checkbox by looping through all checkboxes instead of using querySelector
                    checkboxes.forEach(checkbox => {
                        // console.log(checkbox .value);
                        // console.log(tag);
                        if (checkbox.value === tag) {

                            checkbox.checked = true;
                        }
                    });
                });

                document.getElementById('editCourseId').value = id;
                document.getElementById('editCourseTitle').value = title;
                document.getElementById('editCourseDescription').value = description;
                document.getElementById('editCoursePrice').value = price;
                document.getElementById('editCourseCategory').value = category;
                document.getElementById('editCourseContent').value = content;

                showModal('editCourseModal');
            }
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove('active');
            }
        }

        // Add event listeners for filter actions
        document.querySelector('.filter-actions .add-course-btn').addEventListener('click', () => {
            // Implementation for applying filters
            alert('Applying filters - To be implemented');
        });

        // // Add event listeners for edit and delete actions
        // document.querySelectorAll('.edit-button').forEach(button => {
        //     button.addEventListener('click', (e) => {
        //         // Implementation for edit action
        //         alert('Edit course - To be implemented');
        //     });
        // });
    </script>