<div class="main-content">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">User Management</h1>
        <button class="add-user-btn" onclick="openEditModal('new')">
            <i class="fas fa-plus"></i>
            Add New User
        </button>
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
                    <th>Join Date</th>
                    <th>Last Login</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- User Row 1 -->
                <tr>
                    <td>
                        <div class="user-info">
                            <div class="user-avatar">JD</div>
                            <div>
                                <div class="user-name">John Doe</div>
                                <div class="user-email">john.doe@example.com</div>
                            </div>
                        </div>
                    </td>
                    <td>Student</td>
                    <td>
                        <span class="status-badge status-active">Active</span>
                    </td>
                    <td>Jan 15, 2024</td>
                    <td>2 hours ago</td>
                    <td>
                        <div class="action-menu" data-user-id="1">
                            <button class="action-button" onclick="toggleActionMenu(1)">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="action-dropdown" id="action-menu-1">
                                <div class="action-item" onclick="handleUserAction(1, 'edit')">
                                    <i class="fas fa-edit"></i>
                                    Edit User
                                </div>
                                <div class="action-item" onclick="handleUserAction(1, 'suspend')">
                                    <i class="fas fa-ban"></i>
                                    Suspend User
                                </div>
                                <div class="action-item delete" onclick="handleUserAction(1, 'delete')">
                                    <i class="fas fa-trash"></i>
                                    Delete User
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>

                <!-- User Row 2 -->
                <tr>
                    <td>
                        <div class="user-info">
                            <div class="user-avatar">JS</div>
                            <div>
                                <div class="user-name">Jane Smith</div>
                                <div class="user-email">jane.smith@example.com</div>
                            </div>
                        </div>
                    </td>
                    <td>Instructor</td>
                    <td>
                        <span class="status-badge status-suspended">Suspended</span>
                    </td>
                    <td>Dec 20, 2023</td>
                    <td>1 day ago</td>
                    <td>
                        <div class="action-menu" data-user-id="2">
                            <button class="action-button" onclick="toggleActionMenu(2)">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="action-dropdown" id="action-menu-2">
                                <div class="action-item">
                                    <i class="fas fa-edit"></i>
                                    Edit User
                                </div>
                                <div class="action-item">
                                    <i class="fas fa-check"></i>
                                    Activate User
                                </div>
                                <div class="action-item delete">
                                    <i class="fas fa-trash"></i>
                                    Delete User
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>

                <!-- Add more user rows as needed -->
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination">
        <div class="pagination-info">
            Showing 1-10 of 100 users
        </div>
        <div class="pagination-buttons">
            <button class="page-button"><i class="fas fa-chevron-left"></i></button>
            <button class="page-button active">1</button>
            <button class="page-button">2</button>
            <button class="page-button">3</button>
            <button class="page-button">4</button>
            <button class="page-button">5</button>
            <button class="page-button"><i class="fas fa-chevron-right"></i></button>
        </div>
    </div>
</div>
<!-- Add this right after the closing div of "main-content" -->

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

<!-- Add New User Modal -->
<div id="add-user-modal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Add New User</h2>
            <button class="modal-close">×</button>
        </div>
        <form id="add-user-form">
            <div class="form-group">
                <label for="new-name">Full Name</label>
                <input type="text" id="new-name" name="name" required>
            </div>
            <div class="form-group">
                <label for="new-email">Email</label>
                <input type="email" id="new-email" name="email" required>
            </div>
            <div class="form-group">
                <label for="new-role">Role</label>
                <select id="new-role" name="role" required>
                    <option value="student">Student</option>
                    <option value="instructor">Instructor</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="form-actions">
                <button type="button" class="modal-close page-button">Cancel</button>
                <button type="submit" class="add-user-btn">Add User</button>
            </div>
        </form>
    </div>
</div>
<script>
    // Toggle action menu dropdown
    function toggleActionMenu(userId) {
        const menu = document.getElementById(`action-menu-${userId}`);
        // Close all other open menus
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

    // Handle user actions
    function handleUserAction(userId, action) {
        switch (action) {
            case 'edit':
                openEditModal(userId);
                break;
            case 'delete':
                confirmDeleteUser(userId);
                break;
            case 'suspend':
                toggleUserStatus(userId, 'suspended');
                break;
            case 'activate':
                toggleUserStatus(userId, 'active');
                break;
        }
    }

    // Open edit user modal
    function openEditModal(userId) {
        const modal = document.getElementById('edit-user-modal');
        const form = modal.querySelector('form');

        // Fetch user data and populate form
        fetchUserData(userId).then(userData => {
            form.querySelector('[name="name"]').value = userData.name;
            form.querySelector('[name="email"]').value = userData.email;
            form.querySelector('[name="role"]').value = userData.role;
            form.dataset.userId = userId;
        });

        modal.classList.add('active');
    }

    // Handle user form submission
    function handleUserFormSubmit(event) {
        event.preventDefault();
        const form = event.target;
        const userId = form.dataset.userId;

        const userData = {
            name: form.querySelector('[name="name"]').value,
            email: form.querySelector('[name="email"]').value,
            role: form.querySelector('[name="role"]').value
        };

        updateUser(userId, userData).then(response => {
            if (response.success) {
                closeModal('edit-user-modal');
                refreshUserList();
            } else {
                showError(response.message);
            }
        });
    }

    // Confirm and handle user deletion
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

    // Toggle user status (suspend/activate)
    function toggleUserStatus(userId, status) {
        updateUserStatus(userId, status).then(response => {
            if (response.success) {
                refreshUserList();
            } else {
                showError(response.message);
            }
        });
    }

    // API calls (implement these based on your backend)
    async function fetchUserData(userId) {
        // Implement API call to fetch user data
        const response = await fetch(`/api/users/${userId}`);
        return response.json();
    }

    async function updateUser(userId, userData) {
        // Implement API call to update user
        const response = await fetch(`/api/users/${userId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(userData)
        });
        return response.json();
    }

    async function deleteUser(userId) {
        // Implement API call to delete user
        const response = await fetch(`/api/users/${userId}`, {
            method: 'DELETE'
        });
        return response.json();
    }

    async function updateUserStatus(userId, status) {
        // Implement API call to update user status
        const response = await fetch(`/api/users/${userId}/status`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                status
            })
        });
        return response.json();
    }

    // Utility functions
    function showError(message) {
        const errorDiv = document.getElementById('error-message');
        errorDiv.textContent = message;
        errorDiv.classList.add('active');
        setTimeout(() => {
            errorDiv.classList.remove('active');
        }, 3000);
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.remove('active');
    }

    function refreshUserList() {
        // Implement function to refresh the user list
        // This might involve re-fetching data and updating the DOM
        location.reload(); // Temporary solution - implement proper refresh
    }

    // Event listeners
    document.addEventListener('DOMContentLoaded', () => {
        // Set up form submission handlers
        const editForm = document.querySelector('#edit-user-modal form');
        if (editForm) {
            editForm.addEventListener('submit', handleUserFormSubmit);
        }

        // Set up modal close buttons
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