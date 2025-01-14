<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | E-Learning Platform</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            /* Primary Colors */
            --primary-color: #4f46e5;
            --primary-dark: #4338ca;
            --primary-light: #818cf8;

            /* Secondary Colors */
            --secondary-color: #06b6d4;
            --secondary-dark: #0891b2;
            --secondary-light: #22d3ee;

            /* Background Gradients */
            --bg-gradient: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%);
            --card-gradient: linear-gradient(rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.9));

            /* Neutral Colors */
            --background-color: #f8fafc;
            --text-color: #1e293b;
            --text-light: #64748b;
            --white: #ffffff;

            /* Shadows */
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.12);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        body {
            background-color: var(--background-color);
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background: var(--white);
            box-shadow: var(--shadow-md);
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--primary-color);
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: var(--text-light);
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            transition: all 0.3s;
        }

        .nav-item:hover,
        .nav-item.active {
            background: var(--primary-color);
            color: var(--white);
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            padding: 2rem;
            overflow-y: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .header h1 {
            font-size: 1.75rem;
            color: var(--text-color);
        }

        .add-new-btn {
            background: var(--primary-color);
            color: var(--white);
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: background-color 0.3s;
        }

        .add-new-btn:hover {
            background: var(--primary-dark);
        }

        /* Dashboard Cards */
        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .dashboard-card {
            background: var(--white);
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
        }

        .card-title {
            color: var(--text-light);
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
        }

        .card-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--text-color);
            margin-bottom: 0.5rem;
        }

        .card-change {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            font-size: 0.875rem;
            color: #10b981;
        }

        /* Table Styles */
        .data-table {
            background: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        th {
            background: var(--background-color);
            font-weight: 600;
            color: var(--text-light);
        }

        td {
            color: var(--text-color);
        }

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.875rem;
        }

        .status-active {
            background: #dcfce7;
            color: #166534;
        }

        .status-pending {
            background: #fef9c3;
            color: #854d0e;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .action-btn {
            padding: 0.5rem;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .edit-btn {
            background: #dbeafe;
            color: #1e40af;
        }

        .delete-btn {
            background: #fee2e2;
            color: #991b1b;
        }

        .action-btn:hover {
            opacity: 0.8;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: var(--white);
            padding: 2rem;
            border-radius: 12px;
            width: 100%;
            max-width: 500px;
            box-shadow: var(--shadow-lg);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .modal-title {
            font-size: 1.25rem;
            font-weight: 600;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--text-light);
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-color);
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 6px;
            font-size: 1rem;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .modal-btn {
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 0.875rem;
        }

        .cancel-btn {
            background: var(--background-color);
            color: var(--text-color);
        }

        .save-btn {
            background: var(--primary-color);
            color: var(--white);
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo">
            <i class="fas fa-graduation-cap"></i>
            Admin Panel
        </div>
        <nav>
            <a href="#" class="nav-item active">
                <i class="fas fa-chart-line"></i>
                Dashboard
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-book"></i>
                Courses
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-users"></i>
                Users
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-tags"></i>
                Categories & Tags
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-cog"></i>
                Settings
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <div class="header">
            <h1>Dashboard Overview</h1>
            <button class="add-new-btn" onclick="showModal('addCourseModal')">
                <i class="fas fa-plus"></i>
                Add New Course
            </button>
        </div>

        <!-- Dashboard Cards -->
        <div class="dashboard-cards">
            <div class="dashboard-card">
                <div class="card-title">Total Courses</div>
                <div class="card-value">124</div>
                <div class="card-change">
                    <i class="fas fa-arrow-up"></i>
                    12.5% this month
                </div>
            </div>
            <div class="dashboard-card">
                <div class="card-title">Total Students</div>
                <div class="card-value">1,234</div>
                <div class="card-change">
                    <i class="fas fa-arrow-up"></i>
                    8.2% this month
                </div>
            </div>
            <div class="dashboard-card">
                <div class="card-title">Revenue</div>
                <div class="card-value">$12,345</div>
                <div class="card-change">
                    <i class="fas fa-arrow-up"></i>
                    15.3% this month
                </div>
            </div>
            <div class="dashboard-card">
                <div class="card-title">Active Categories</div>
                <div class="card-value">18</div>
                <div class="card-change">
                    <i class="fas fa-arrow-up"></i>
                    2 new this month
                </div>
            </div>
        </div>

        <!-- Courses Table -->
        <div class="data-table">
            <table>
                <thead>
                    <tr>
                        <th>Course Name</th>
                        <th>Category</th>
                        <th>Instructor</th>
                        <th>Students</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Web Development Bootcamp</td>
                        <td>Development</td>
                        <td>John Doe</td>
                        <td>234</td>
                        <td><span class="status-badge status-active">Active</span></td>
                        <td>
                            <div class="action-buttons">
                                <button class="action-btn edit-btn" onclick="showModal('editCourseModal')">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="action-btn delete-btn">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>UI/UX Design Fundamentals</td>
                        <td>Design</td>
                        <td>Jane Smith</td>
                        <td>186</td>
                        <td><span class="status-badge status-pending">Pending</span></td>
                        <td>
                            <div class="action-buttons">
                                <button class="action-btn edit-btn">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="action-btn delete-btn">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>

    <!-- Add Course Modal -->
    <div class="modal" id="addCourseModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Add New Course</h2>
                <button class="close-btn" onclick="hideModal('addCourseModal')">&times;</button>
            </div>
            <form>
                <div class="form-group">
                    <label>Course Title</label>
                    <input type="text" placeholder="Enter course title">
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select>
                        <option>Development</option>
                        <option>Design</option>
                        <option>Business</option>
                        <option>Marketing</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea rows="3" placeholder="Enter course description"></textarea>
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input type="number" placeholder="Enter course price">
                </div>
                <div class="modal-footer">
                    <button type="button" class="modal-btn cancel-btn" onclick="hideModal('addCourseModal')">Cancel</button>
                    <button type="submit" class="modal-btn save-btn">Save Course</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Modal functionality
        function showModal(modalId) {
            document.getElementById(modalId).classList.add('active');
        }

        function hideModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove('active');
            }
        }

        // Navigation functionality
        const navItems = document.querySelectorAll('.nav-item');

        navItems.forEach(item => {
            item.addEventListener('click', () => {
                // Remove active class from all items
                navItems.forEach(nav => nav.classList.remove('active'));
                // Add active class to clicked item
                item.classList.add('active');
            });
        });

        // Sample data management
        const courses = [{
                id: 1,
                title: 'Web Development Bootcamp',
                category: 'Development',
                instructor: 'John Doe',
                students: 234,
                status: 'active'
            },
            {
                id: 2,
                title: 'UI/UX Design Fundamentals',
                category: 'Design',
                instructor: 'Jane Smith',
                students: 186,
                status: 'pending'
            }
        ];

        // Function to render courses table
        function renderCoursesTable() {
            const tableBody = document.querySelector('tbody');
            tableBody.innerHTML = courses.map(course => `
                    <tr>
                        <td>${course.title}</td>
                        <td>${course.category}</td>
                        <td>${course.instructor}</td>
                        <td>${course.students}</td>
                        <td><span class="status-badge status-${course.status}">${course.status}</span></td>
                        <td>
                            <div class="action-buttons">
                                <button class="action-btn edit-btn" onclick="editCourse(${course.id})">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="action-btn delete-btn" onclick="deleteCourse(${course.id})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                `).join('');
        }

        // Function to add new course
        function addCourse(event) {
            event.preventDefault();
            const form = event.target;
            const newCourse = {
                id: courses.length + 1,
                title: form.querySelector('[placeholder="Enter course title"]').value,
                category: form.querySelector('select').value,
                instructor: 'New Instructor', // This would come from the logged-in user
                students: 0,
                status: 'pending'
            };

            courses.push(newCourse);
            renderCoursesTable();
            hideModal('addCourseModal');
            form.reset();
        }

        // Function to delete course
        function deleteCourse(id) {
            if (confirm('Are you sure you want to delete this course?')) {
                const index = courses.findIndex(course => course.id === id);
                courses.splice(index, 1);
                renderCoursesTable();
            }
        }

        // Function to edit course
        function editCourse(id) {
            const course = courses.find(course => course.id === id);
            showModal('editCourseModal');
            // Populate form with course data
            const form = document.querySelector('#editCourseModal form');
            form.querySelector('[placeholder="Enter course title"]').value = course.title;
            form.querySelector('select').value = course.category;
        }

        // Add event listeners
        document.querySelector('#addCourseModal form').addEventListener('submit', addCourse);

        // Initial render
        renderCoursesTable();
    </script>
</body>

</html>