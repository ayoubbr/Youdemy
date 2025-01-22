<div class="main-content">
    <div class="page-header">
        <h1 class="page-title">Teachers Management</h1>

    </div>

    <div class="users-table-container">
        <table class="users-table">
            <thead>
                <tr>
                    <th>Teacher</th>
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
                    if ($value->getRole()->getName() == 'Teacher') {


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
                                        <form action="/admin/teacher/suspend" method="post">
                                            <input type="hidden" name="id" value="<?php echo "$id"; ?>">
                                            <button class="action-item" type="submit">
                                                <i class="fas fa-ban"></i>
                                                Suspend
                                            </button>
                                        </form>
                                        <form action="/admin/teacher/validate" method="post">
                                            <input type="hidden" name="id" value="<?php echo "$id"; ?>">
                                            <button class="action-item" type="submit">
                                                <i class="fa-solid fa-check-double"></i>
                                                Validate
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
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

<div id="error-message" class="error-message"></div>


<script>
    function toggleActionMenu(userId) {

        const menu = document.getElementById(`action-menu-${userId}`);
        document.querySelectorAll('.action-dropdown').forEach(dropdown => {
            if (dropdown.id !== `action-menu-${userId}`) {
                dropdown.classList.remove('active');
            }
        });
        menu.classList.toggle('active');
    }


    document.addEventListener('click', (e) => {
        if (!e.target.closest('.action-menu')) {
            document.querySelectorAll('.action-dropdown').forEach(dropdown => {
                dropdown.classList.remove('active');
            });
        }
    });


    function handleUserAction(userId, action) {
        switch (action) {
            case 'edit':
                openEditModal(userId);
                break;
            case 'delete':
                confirmDeleteUser(userId);
                break;
            case 'activate':
                toggleUserStatus(userId, 'active');
                break;
        }
    }

    function openEditModal(userId) {
        const modal = document.getElementById('edit-user-modal');
        const form = modal.querySelector('form');

        modal.classList.add('show');
    }

  
    function confirmDeleteUser(userId) {
        if (confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
            deleteUser(userId).then(response => {
                if (response.success) {
                    refreshUserList();
                } else {
                    showError(response.message);
                }
            });
        }
    }

    function showError(message) {
        const errorDiv = document.getElementById('error-message');
        errorDiv.textContent = message;
        errorDiv.classList.add('active');
        setTimeout(() => {
            errorDiv.classList.remove('show');
        }, 3000);
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.remove('show');
    }

    document.addEventListener('DOMContentLoaded', () => {
        const editForm = document.querySelector('#edit-user-modal form');
        if (editForm) {
            editForm.addEventListener('submit', handleUserFormSubmit);
        }

        document.querySelectorAll('.modal-close').forEach(button => {
            button.addEventListener('click', () => {
                const modal = button.closest('.modal');
                if (modal) {
                    closeModal(modal.id);
                }
            });
        });
    });
</script>