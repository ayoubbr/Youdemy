<div class="main-content">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">User Management</h1>

    </div>

    <!-- Filters -->
    <div class="user-filters">
        <div class="filter-grid">
            <div class="filter-group">
                <label>Search Users</label>
                <input type="text" placeholder="Search by name or email...">
            </div>
            <div class="filter-group">
                <label>Status</label>
                <select>
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="suspended">Suspended</option>
                    <option value="pending">Pending</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Role</label>
                <select>
                    <option value="">All Roles</option>
                    <option value="student">Student</option>
                    <option value="instructor">Instructor</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Join Date</label>
                <select>
                    <option value="">All Time</option>
                    <option value="today">Today</option>
                    <option value="week">This Week</option>
                    <option value="month">This Month</option>
                </select>
            </div>
        </div>
        <div class="filter-actions">
            <button class="page-button" onclick="resetFilters()">Reset</button>
            <button class="add-user-btn" onclick="applyFilters()">Apply Filters</button>
        </div>
    </div>

    <!-- Users Table -->
    <div class="users-table-container">
        <table class="users-table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($users as $key => $value) {
                    $id = $value->getId();
                ?>
                    <tr>
                        <td>
                            <div class="user-info">
                                <div class="user-avatar">
                                    <img width="45px" src="<?php echo $value->getPhoto() ?>" alt="">
                                </div>
                                <div>
                                    <div class="user-name"><?php echo $value->getFirstname(); ?></div>
                                    <div class="user-email"><?php echo $value->getLastname(); ?></div>
                                </div>
                            </div>
                        </td>
                        <td><?php echo $value->getRole()->getName(); ?></td>
                        <td>
                            <span class="status-badge status-<?php switch ($value->getStatus()) {
                                                                    case 'Pending':
                                                                        echo 'pending';
                                                                        break;
                                                                    case 'Suspended':
                                                                        echo 'suspended';
                                                                        break;
                                                                    case 'Active':
                                                                        echo 'active';
                                                                        break;
                                                                    case 'Deleted':
                                                                        echo 'deleted';
                                                                        break;
                                                                    default:
                                                                        break;
                                                                }
                                                                ?>"><?php echo $value->getStatus(); ?></span>
                        </td>
                        <td><?php echo $value->getEmail(); ?></td>
                        <td><?php echo $value->getPhone(); ?></td>
                        <td>
                            <div class="action-menu" data-user-id="<?php echo "$id"; ?>">
                                <button class="action-button" onclick="<?php echo "toggleActionMenu($id)"; ?>">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="action-dropdown" id="action-menu-<?php echo "$id"; ?>">
                                    <!-- <div class="action-item" onclick="<?php echo "handleUserAction($id, 'edit')"; ?>">
                                        <i class="fas fa-edit"></i>
                                        Edit User
                                    </div> -->
                                    <form action="/admin/user/suspend" method="post">
                                        <input type="hidden" name="id" value="<?php echo "$id"; ?>">
                                        <button class="action-item" type="submit">
                                            <i class="fas fa-ban"></i>
                                            Suspend User
                                        </button>
                                    </form>
                                    <form action="/admin/user/activate" method="post">
                                        <input type="hidden" name="id" value="<?php echo "$id"; ?>">
                                        <button class="action-item" type="submit">
                                            <i class="fa-solid fa-check-double"></i>
                                            Activate User
                                        </button>
                                    </form>
                                    <form action="/admin/user/delete" method="post">
                                        <input type="hidden" name="id" value="<?php echo "$id"; ?>">
                                        <button class="action-item delete">
                                            <i class="fas fa-trash"></i>
                                            Delete User
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Edit User Modal -->
<div id="edit-user-modal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Edit User</h2>
            <button class="modal-close">×</button>
        </div>
        <form id="edit-user-form">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select id="role" name="role" required>
                    <option value="student">Student</option>
                    <option value="instructor">Instructor</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="form-actions">
                <button type="button" class="modal-close page-button">Cancel</button>
                <button class="add-user-btn" onclick="openEditModal('new')">
                    <i class="fas fa-plus"></i>
                    Add New User
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Error Message Container -->
<div id="error-message" class="error-message"></div>


<script>
    function toggleActionMenu(userId) {

        const menu = document.getElementById(`action-menu-${userId}`);
        // // Close all other open menus
        document.querySelectorAll('.action-dropdown').forEach(dropdown => {
            if (dropdown.id !== `action-menu-${userId}`) {
                dropdown.classList.remove('active');
            }
        });
        menu.classList.toggle('active');
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', (e) => {
        if (!e.target.closest('.action-menu')) {
            document.querySelectorAll('.action-dropdown').forEach(dropdown => {
                dropdown.classList.remove('active');
            });
        }
    });
</script>