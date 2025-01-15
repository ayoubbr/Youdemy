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