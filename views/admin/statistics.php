<div class="main-content">
    <div class="header">
        <h1>Platform Statistics</h1>
        <p>Overview of key platform metrics and performance indicators</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="icon">
                <i class="fas fa-book"></i>
            </div>
            <div class="label">Total Courses</div>
            <div class="value" id="totalCourses"><?php echo $countCourses; ?></div>
        </div>
        <div class="stat-card">
            <div class="icon">
                <i class="fas fa-list"></i>
            </div>
            <div class="label">Categories</div>
            <div class="value" id="totalCategories">0</div>
        </div>
        <div class="stat-card">
            <div class="icon">
                <i class="fas fa-user-graduate"></i>
            </div>
            <div class="label">Total Students</div>
            <div class="value" id="totalStudents">0</div>
        </div>
        <div class="stat-card">
            <div class="icon">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <div class="label">Active Teachers</div>
            <div class="value" id="totalTeachers">0</div>
        </div>
    </div>

    <div class="chart-container">
        <h2 class="chart-title">Course Categories Distribution</h2>
        <div class="category-bars" id="categoryChart"></div>
    </div>

    <div class="top-items">
        <h2>Most Popular Course</h2>
        <div class="top-item" id="topCourse"></div>
    </div>

    <div class="top-items">
        <h2>Top 3 Teachers</h2>
        <div id="topTeachers"></div>
    </div>

</div>
<script>
    // Sample data - Replace with actual data from your backend
    // const data = {
    //     stats: {
    //         totalCourses: 135,
    //         totalCategories: 5,
    //         totalStudents: 12450,
    //         totalTeachers: 48
    //     },
    //     categories: [{
    //             name: 'Programming',
    //             count: 45
    //         },
    //         {
    //             name: 'Design',
    //             count: 30
    //         },
    //         {
    //             name: 'Business',
    //             count: 25
    //         },
    //         {
    //             name: 'Marketing',
    //             count: 20
    //         },
    //         {
    //             name: 'Languages',
    //             count: 15
    //         }
    //     ],
    //     topCourse: {
    //         name: 'Advanced Web Development',
    //         teacher: 'Sarah Johnson',
    //         students: 2500,
    //         category: 'Programming'
    //     },
    //     topTeachers: [{
    //             name: 'Sarah Johnson',
    //             students: 1200,
    //             courses: 8
    //         },
    //         {
    //             name: 'Michael Chen',
    //             students: 980,
    //             courses: 6
    //         },
    //         {
    //             name: 'Emma Davis',
    //             students: 850,
    //             courses: 5
    //         }
    //     ]
    // };

    // Update stats
    document.getElementById('totalCourses').textContent = data.stats.totalCourses;
    document.getElementById('totalCategories').textContent = data.stats.totalCategories;
    document.getElementById('totalStudents').textContent = data.stats.totalStudents.toLocaleString();
    document.getElementById('totalTeachers').textContent = data.stats.totalTeachers;

    // Create category chart
    const categoryChart = document.getElementById('categoryChart');
    const maxCount = Math.max(...data.categories.map(cat => cat.count));

    data.categories.forEach(category => {
        const percentage = (category.count / maxCount) * 100;
        categoryChart.innerHTML += `
                <div>
                    <div class="category-label">
                        <span>${category.name}</span>
                        <span>${category.count} courses</span>
                    </div>
                    <div class="category-bar">
                        <div class="category-bar-fill" style="width: ${percentage}%"></div>
                    </div>
                </div>
            `;
    });

    // Display top course
    document.getElementById('topCourse').innerHTML = `
            <h3>${data.topCourse.name}</h3>
            <p>Teacher: ${data.topCourse.teacher}</p>
            <p>Category: ${data.topCourse.category}</p>
            <p>Students: ${data.topCourse.students.toLocaleString()}</p>
        `;

    // Display top teachers
    const topTeachersContainer = document.getElementById('topTeachers');
    data.topTeachers.forEach(teacher => {
        topTeachersContainer.innerHTML += `
                <div class="top-item">
                    <h3>${teacher.name}</h3>
                    <p>Total Students: ${teacher.students.toLocaleString()}</p>
                    <p>Active Courses: ${teacher.courses}</p>
                </div>
            `;
    });
</script>