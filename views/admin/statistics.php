<div class="main-content">
    <div class="header">
        <h1>Platform Statistics</h1>
        <p>Overview of key platform metrics and performance indicators</p>
    </div>

    <div class="top-items-container">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="icon">
                    <i class="fas fa-book"></i>
                </div>
                <div class="label">Total Courses</div>
                <div class="value" id="totalCourses"><?php echo $countCourses; ?></div>
            </div>
        </div>
        <div class="top-items">
            <h2>Most Popular Course</h2>
            <div class="top-item" id="topCourse">
                <h3>Title: <?php echo isset($courseWithMostStudents['title']) ? $courseWithMostStudents['title'] : 'NO Data';  ?></h3>
                <p>Description: <?php echo isset($courseWithMostStudents['description']) ? $courseWithMostStudents['description'] : 'NO Data'; ?></p>
                <p>Price: <?php echo isset($courseWithMostStudents['price']) ? $courseWithMostStudents['price'] : 'NO Data'; ?></p>
                <p>Category: <?php echo isset($courseWithMostStudents['category']) ? $courseWithMostStudents['category'] : 'NO Data'; ?></p>
                <p>Teacher: <?php echo isset($courseWithMostStudents['teacher_name']) ? $courseWithMostStudents['teacher_name'] : "NO Data"; ?></p>
                <p>Students: <?php echo isset($courseWithMostStudents['student_count']) ? $courseWithMostStudents['student_count'] : "NO Data"; ?></p>
            </div>
        </div>

        <div class="top-items">
            <h2>Top 3 Teachers</h2>
            <div id="topTeachers">
                <div class="top-item">
                    <?php
                    if (count($topThreeTeachers) > 0) {
                        foreach ($topThreeTeachers as $key => $value) {
                    ?>
                            <h3><?php echo $value['firstname'] . ' ' . $value['lastname']; ?></h3>
                            <p>Total Students: <?php echo $value['total_students']; ?></p>

                    <?php
                        }
                    } else {
                        echo "No Data So Far!";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="chart-container">
        <h2 class="chart-title">Course Categories Distribution</h2>
        <div class="category-bars" id="categoryChart">
            <?php
            $count = 0;

            foreach ($countCoursesByCategoryArray as $key => $value) {
                $count += $value;
            }

            foreach ($countCoursesByCategoryArray as $key => $value) {
            ?>
                <div>
                    <div class="category-label">
                        <span><?php echo $key; ?></span>
                        <span><?php echo $value; ?> courses</span>
                    </div>
                    <div class="category-bar">
                        <div class="category-bar-fill" style="width: <?php echo ($value / $count) * 100; ?>%"></div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>