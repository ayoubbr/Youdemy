   <div class="dashboard">
       <div class="page-header">
           <h1 class="page-title">Enrolled Students for course: <?php echo $result['course_title']; ?></h1>
           <p>View all students enrolled in your course</p>
       </div>
       <div class="students-table">
           <div class="table-responsive">
               <table>
                   <thead>
                       <tr>
                           <th>Photo</th>
                           <th>Student Name</th>
                           <th>Email</th>
                           <th>Phone</th>
                           <th>Status</th>
                       </tr>
                   </thead>
                   <tbody id="studentsTableBody">
                       <?php
                        if (count($result['students']) > 0) {
                            foreach ($result['students'] as $key => $value) {
                        ?>
                               <tr>
                                   <td><img src="<?php echo $value->getPhoto(); ?>" width="60px" alt=""></td>
                                   <td>
                                       <div style="font-weight: 500;"><?php echo $value->getFirstname() . ' ' . $value->getLastname(); ?></div>
                                   </td>
                                   <td><?php echo $value->getEmail(); ?></td>
                                   <td><?php echo $value->getPhone(); ?></td>
                                   <td>
                                       <span class="status-badge status-${student.status}">
                                           <?php echo $value->getStatus(); ?>
                                       </span>
                                   </td>
                               </tr>
                           <?php
                            }
                        } else {
                            ?>
                           <tr>
                               <td>Still No Students for this course.</td>
                           </tr>
                       <?php
                        }
                        ?>
                   </tbody>
               </table>
           </div>
       </div>
   </div>