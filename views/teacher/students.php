    <div class="dashboard">
        <div class="page-header">
            <h1 class="page-title">Enrolled Students</h1>
            <p>View and manage all students enrolled in your courses</p>
        </div>

        <div class="filters">
            <div class="search-bar">
                <input type="text" class="search-input" placeholder="Search students..." onkeyup="filterStudents()">
            </div>
            <select class="filter-select" onchange="filterStudents()">
                <option value="">All Courses</option>
                <option value="web-dev">Web Development</option>
                <option value="ml">Machine Learning</option>
                <option value="data-science">Data Science</option>
            </select>
            <select class="filter-select" onchange="filterStudents()">
                <option value="">All Status</option>
                <option value="active">Active</option>
                <option value="pending">Pending</option>
            </select>
        </div>

        <div class="students-table">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Email</th>
                            <th>Course</th>
                            <th>Enrollment Date</th>
                            <th>Progress</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="studentsTableBody">
                        <!-- Table rows will be populated by JavaScript -->
                    </tbody>
                </table>
            </div>
            <div class="pagination">
                <div class="page-info">
                    Showing <span id="startRange">1</span> to <span id="endRange">10</span> of <span id="totalStudents">100</span> students
                </div>
                <div class="page-buttons">
                    <button class="page-btn">&lt;</button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">3</button>
                    <button class="page-btn">&gt;</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sample data - in a real application, this would come from a backend
        const enrolledStudents = [{
                id: 1,
                name: "John Doe",
                email: "john.doe@example.com",
                course: "Web Development",
                enrollmentDate: "2025-01-10",
                progress: 75,
                status: "active"
            },
            {
                id: 2,
                name: "Jane Smith",
                email: "jane.smith@example.com",
                course: "Machine Learning",
                enrollmentDate: "2025-01-12",
                progress: 45,
                status: "active"
            },
            {
                id: 3,
                name: "Mike Johnson",
                email: "mike.j@example.com",
                course: "Data Science",
                enrollmentDate: "2025-01-14",
                progress: 20,
                status: "pending"
            }
            // Add more sample data as needed
        ];

        function renderStudents() {
            const tableBody = document.getElementById('studentsTableBody');
            tableBody.innerHTML = enrolledStudents.map(student => `
                <tr>
                    <td>
                        <div style="font-weight: 500;">${student.name}</div>
                    </td>
                    <td>${student.email}</td>
                    <td><span class="course-badge">${student.course}</span></td>
                    <td>${formatDate(student.enrollmentDate)}</td>
                    <td>
                        <div class="progress-bar">
                            <div class="progress" style="width: ${student.progress}%"></div>
                        </div>
                        ${student.progress}%
                    </td>
                    <td>
                        <span class="status-badge status-${student.status}">
                            ${capitalizeFirst(student.status)}
                        </span>
                    </td>
                    <td>
                        <button class="action-btn view-btn" onclick="viewStudent(${student.id})">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="action-btn message-btn" onclick="messageStudent(${student.id})">
                            <i class="fas fa-envelope"></i>
                        </button>
                    </td>
                </tr>
            `).join('');
        }

        function formatDate(dateStr) {
            return new Date(dateStr).toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'short',
                day: 'numeric'
            });
        }

        function capitalizeFirst(str) {
            return str.charAt(0).toUpperCase() + str.slice(1);
        }

        function filterStudents() {
            // Filter logic would go here
            renderStudents();
        }

        function viewStudent(studentId) {
            // View student details logic
            console.log('Viewing student:', studentId);
        }

        function messageStudent(studentId) {
            // Message student logic
            console.log('Messaging student:', studentId);
        }

        // Initial render
        renderStudents();
    </script>