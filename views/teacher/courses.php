<div class="dashboard">
    <div class="dashboard-header">
        <h1 class="page-title">Course Management</h1>
        <button class="add-course-btn" onclick="openModal('add')">
            <i class="fas fa-plus"></i> Add New Course
        </button>
    </div>

    <div class="course-grid" id="courseGrid">
        <!-- Courses will be inserted here by JavaScript -->
    </div>
</div>

<!-- Add/Edit Course Modal -->
<div class="modal" id="courseModal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title" id="modalTitle">Add New Course</h2>
            <button class="close-btn" onclick="closeModal()">&times;</button>
        </div>
        <form id="courseForm" onsubmit="saveCourse(event)">
            <div class="form-group">
                <label class="form-label">Course Title</label>
                <input type="text" class="form-input" id="courseTitle" required>
            </div>
            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea class="form-input" id="courseDescription" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Duration (hours)</label>
                <input type="number" class="form-input" id="courseDuration" required>
            </div>
            <div class="form-group">
                <label class="form-label">Maximum Students</label>
                <input type="number" class="form-input" id="maxStudents" required>
            </div>
            <button type="submit" class="save-btn">Save Course</button>
        </form>
    </div>
</div>

<!-- View Enrollments Modal -->
<div class="modal" id="enrollmentsModal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title">Course Enrollments</h2>
            <button class="close-btn" onclick="closeEnrollmentsModal()">&times;</button>
        </div>
        <div class="enrollment-list" id="enrollmentsList">
            <!-- Enrollments will be inserted here -->
        </div>
    </div>
</div>

<script>
    // Sample data - in a real application, this would come from a backend
    let courses = [{
            id: 1,
            title: "Advanced Web Development",
            description: "Learn modern web development techniques",
            duration: 48,
            maxStudents: 30,
            enrollments: [{
                    id: 1,
                    studentName: "John Doe",
                    email: "john@example.com",
                    enrollmentDate: "2025-01-10"
                },
                {
                    id: 2,
                    studentName: "Jane Smith",
                    email: "jane@example.com",
                    enrollmentDate: "2025-01-12"
                }
            ]
        },
        {
            id: 2,
            title: "Machine Learning Fundamentals",
            description: "Introduction to machine learning concepts",
            duration: 36,
            maxStudents: 25,
            enrollments: [{
                id: 3,
                studentName: "Mike Johnson",
                email: "mike@example.com",
                enrollmentDate: "2025-01-14"
            }]
        },
        {
            id: 2,
            title: "Machine Learning Fundamentals",
            description: "Introduction to machine learning concepts",
            duration: 36,
            maxStudents: 25,
            enrollments: [{
                id: 3,
                studentName: "Mike Johnson",
                email: "mike@example.com",
                enrollmentDate: "2025-01-14"
            }]
        },
        {
            id: 2,
            title: "Machine Learning Fundamentals",
            description: "Introduction to machine learning concepts",
            duration: 36,
            maxStudents: 25,
            enrollments: [{
                id: 3,
                studentName: "Mike Johnson",
                email: "mike@example.com",
                enrollmentDate: "2025-01-14"
            }]
        },
        {
            id: 2,
            title: "Machine Learning Fundamentals",
            description: "Introduction to machine learning concepts",
            duration: 36,
            maxStudents: 25,
            enrollments: [{
                id: 3,
                studentName: "Mike Johnson",
                email: "mike@example.com",
                enrollmentDate: "2025-01-14"
            }]
        }
    ];

    // Render all courses
    function renderCourses() {
        const courseGrid = document.getElementById('courseGrid');
        courseGrid.innerHTML = courses.map(course => `
                <div class="course-card">
                    <div class="course-header">
                        <h2 class="course-title">${course.title}</h2>
                        <div class="course-actions">
                            <button class="action-btn view-btn" onclick="viewEnrollments(${course.id})">
                                <i class="fas fa-users"></i>
                            </button>
                            <button class="action-btn edit-btn" onclick="openModal('edit', ${course.id})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="action-btn delete-btn" onclick="deleteCourse(${course.id})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <div class="course-meta">
                        <div class="meta-item">
                            <i class="fas fa-clock"></i>
                            <span>${course.duration} hours</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-users"></i>
                            <span>${course.enrollments.length}/${course.maxStudents} students</span>
                        </div>
                    </div>
                    <p>${course.description}</p>
                </div>
            `).join('');
    }

    // Modal management
    let currentCourseId = null;

    function openModal(type, courseId = null) {
        const modal = document.getElementById('courseModal');
        const title = document.getElementById('modalTitle');
        currentCourseId = courseId;

        if (type === 'edit' && courseId) {
            const course = courses.find(c => c.id === courseId);
            title.textContent = 'Edit Course';
            document.getElementById('courseTitle').value = course.title;
            document.getElementById('courseDescription').value = course.description;
            document.getElementById('courseDuration').value = course.duration;
            document.getElementById('maxStudents').value = course.maxStudents;
        } else {
            console.log('test');
            
            title.textContent = 'Add New Course';
            document.getElementById('courseForm').reset();
        }
        console.log('222');

        modal.style.display = 'flex';
        console.log(modal.style.display);

    }

    function closeModal() {
        document.getElementById('courseModal').style.display = 'none';
        currentCourseId = null;
    }

    function saveCourse(event) {
        event.preventDefault();

        const courseData = {
            title: document.getElementById('courseTitle').value,
            description: document.getElementById('courseDescription').value,
            duration: parseInt(document.getElementById('courseDuration').value),
            maxStudents: parseInt(document.getElementById('maxStudents').value),
            enrollments: []
        };

        if (currentCourseId) {
            // Edit existing course
            const index = courses.findIndex(c => c.id === currentCourseId);
            courseData.id = currentCourseId;
            courseData.enrollments = courses[index].enrollments;
            courses[index] = courseData;
        } else {
            // Add new course
            courseData.id = courses.length + 1;
            courses.push(courseData);
        }

        renderCourses();
        closeModal();
    }

    function deleteCourse(courseId) {
        if (confirm('Are you sure you want to delete this course?')) {
            courses = courses.filter(c => c.id !== courseId);
            renderCourses();
        }
    }

    function viewEnrollments(courseId) {
        const course = courses.find(c => c.id === courseId);
        const modal = document.getElementById('enrollmentsModal');
        const list = document.getElementById('enrollmentsList');

        list.innerHTML = course.enrollments.map(enrollment => `
                <div class="enrollment-item">
                    <div>
                        <strong>${enrollment.studentName}</strong>
                        <div>${enrollment.email}</div>
                        <div>Enrolled: ${enrollment.enrollmentDate}</div>
                    </div>
                </div>
            `).join('') || '<p>No enrollments yet</p>';

        modal.style.display = 'flex';
    }

    function closeEnrollmentsModal() {
        document.getElementById('enrollmentsModal').style.display = 'none';
    }

    // Initialize the dashboard
    renderCourses();

    // Close modals when clicking outside
    window.onclick = function(event) {
        const courseModal = document.getElementById('courseModal');
        const enrollmentsModal = document.getElementById('enrollmentsModal');
        if (event.target === courseModal) {
            closeModal();
        }
        if (event.target === enrollmentsModal) {
            closeEnrollmentsModal();
        }
    }
</script>