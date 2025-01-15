<div class="dashboard">
    <h1 class="page-title">Course Statistics</h1>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-icon icon-students">
                    <i class="fas fa-users"></i>
                </div>
                <div>
                    <div class="stat-title">Total Students</div>
                    <div class="stat-value">1,234</div>
                    <div class="stat-change change-positive">
                        <i class="fas fa-arrow-up"></i>
                        <span>12% vs last month</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-icon icon-courses">
                    <i class="fas fa-book"></i>
                </div>
                <div>
                    <div class="stat-title">Active Courses</div>
                    <div class="stat-value">24</div>
                    <div class="stat-change change-positive">
                        <i class="fas fa-arrow-up"></i>
                        <span>3 new this month</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-icon icon-completion">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div>
                    <div class="stat-title">Completion Rate</div>
                    <div class="stat-value">78%</div>
                    <div class="stat-change change-positive">
                        <i class="fas fa-arrow-up"></i>
                        <span>5% vs last month</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-icon icon-engagement">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div>
                    <div class="stat-title">Student Engagement</div>
                    <div class="stat-value">85%</div>
                    <div class="stat-change change-negative">
                        <i class="fas fa-arrow-down"></i>
                        <span>2% vs last month</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="charts-grid">
        <div class="chart-card">
            <div class="chart-header">
                <h2 class="chart-title">Student Enrollment Trends</h2>
                <div class="time-filter">
                    <button class="filter-btn">Week</button>
                    <button class="filter-btn active">Month</button>
                    <button class="filter-btn">Year</button>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="enrollmentChart"></canvas>
            </div>
        </div>

        <div class="chart-card">
            <div class="chart-header">
                <h2 class="chart-title">Course Popularity</h2>
                <div class="time-filter">
                    <button class="filter-btn">Week</button>
                    <button class="filter-btn active">Month</button>
                    <button class="filter-btn">Year</button>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="popularityChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    // Enrollment Trends Chart
    const enrollmentCtx = document.getElementById('enrollmentChart').getContext('2d');
    new Chart(enrollmentCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'New Enrollments',
                data: [150, 200, 180, 250, 300, 280],
                borderColor: '#4f46e5',
                tension: 0.4,
                fill: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Course Popularity Chart
    const popularityCtx = document.getElementById('popularityChart').getContext('2d');
    new Chart(popularityCtx, {
        type: 'bar',
        data: {
            labels: ['Web Dev', 'ML', 'Data Science', 'Mobile Dev', 'UI/UX'],
            datasets: [{
                label: 'Students Enrolled',
                data: [300, 250, 200, 180, 150],
                backgroundColor: '#4f46e5'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Time filter buttons functionality
    document.querySelectorAll('.time-filter').forEach(filter => {
        filter.addEventListener('click', (e) => {
            if (e.target.classList.contains('filter-btn')) {
                filter.querySelectorAll('.filter-btn').forEach(btn => {
                    btn.classList.remove('active');
                });
                e.target.classList.add('active');
            }
        });
    });
</script>