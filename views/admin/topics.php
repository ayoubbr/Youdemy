
<div class="main-content">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">Tags & Categories</h1>
        <div class="header-actions">
            <button class="add-user-btn" onclick="showModal('add-category-modal')">
                <i class="fas fa-plus"></i>
                Add Category
            </button>
            <button class="add-user-btn" onclick="showModal('add-tag-modal')">
                <i class="fas fa-plus"></i>
                Add Tag
            </button>
        </div>
    </div>

    <!-- Filters -->
    <div class="user-filters">
        <div class="filter-grid">
            <div class="filter-group">
                <label>Search</label>
                <input type="text" placeholder="Search tags or categories...">
            </div>
            <div class="filter-group">
                <label>Type</label>
                <select>
                    <option value="">All Types</option>
                    <option value="tag">Tags</option>
                    <option value="category">Categories</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Status</label>
                <select>
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
        </div>
        <div class="filter-actions">
            <button class="page-button">Reset</button>
            <button class="add-user-btn">Apply Filters</button>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="section-title">
        <h2>Categories</h2>
        <span class="count-badge">12 Categories</span>
    </div>

    <div class="table-container">
        <table class="users-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Description</th>
                    <th>Courses</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="category-info">
                            <div class="category-icon">
                                <i class="fas fa-laptop-code"></i>
                            </div>
                            <div class="category-name">Web Development</div>
                        </div>
                    </td>
                    <td>web-development</td>
                    <td>All web development related courses</td>
                    <td>24</td>
                    <td>
                        <span class="status-badge status-active">Active</span>
                    </td>
                    <td>
                        <div class="action-menu" data-category-id="1">
                            <button class="action-button" onclick="toggleActionMenu('category-1')">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="action-dropdown" id="category-menu-1">
                                <div class="action-item" onclick="handleCategoryAction(1, 'edit')">
                                    <i class="fas fa-edit"></i>
                                    Edit
                                </div>
                                <div class="action-item" onclick="handleCategoryAction(1, 'deactivate')">
                                    <i class="fas fa-ban"></i>
                                    Deactivate
                                </div>
                                <div class="action-item delete" onclick="handleCategoryAction(1, 'delete')">
                                    <i class="fas fa-trash"></i>
                                    Delete
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <!-- Add more category rows as needed -->
            </tbody>
        </table>
    </div>

    <!-- Tags Section -->
    <div class="section-title">
        <h2>Tags</h2>
        <span class="count-badge">45 Tags</span>
    </div>

    <div class="table-container">
        <table class="users-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Courses</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="tag-name">JavaScript</div>
                    </td>
                    <td>javascript</td>
                    <td>32</td>
                    <td>
                        <span class="status-badge status-active">Active</span>
                    </td>
                    <td>
                        <div class="action-menu" data-tag-id="1">
                            <button class="action-button" onclick="toggleActionMenu('tag-1')">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="action-dropdown" id="tag-menu-1">
                                <div class="action-item" onclick="handleTagAction(1, 'edit')">
                                    <i class="fas fa-edit"></i>
                                    Edit
                                </div>
                                <div class="action-item" onclick="handleTagAction(1, 'deactivate')">
                                    <i class="fas fa-ban"></i>
                                    Deactivate
                                </div>
                                <div class="action-item delete" onclick="handleTagAction(1, 'delete')">
                                    <i class="fas fa-trash"></i>
                                    Delete
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <!-- Add more tag rows as needed -->
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination">
        <div class="pagination-info">
            Showing 1-10 of 57 items
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

<!-- Add Category Modal -->
<div id="add-category-modal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Add Category</h2>
            <button class="modal-close">×</button>
        </div>
        <form id="add-category-form">
            <div class="form-group">
                <label for="category-name">Category Name</label>
                <input type="text" id="category-name" name="name" required>
            </div>
            <div class="form-group">
                <label for="category-slug">Slug</label>
                <input type="text" id="category-slug" name="slug" required>
            </div>
            <div class="form-group">
                <label for="category-icon">Icon (FontAwesome class)</label>
                <input type="text" id="category-icon" name="icon" placeholder="fas fa-laptop-code">
            </div>
            <div class="form-group">
                <label for="category-description">Description</label>
                <textarea id="category-description" name="description" rows="3"></textarea>
            </div>
            <div class="form-actions">
                <button type="button" class="modal-close page-button">Cancel</button>
                <button type="submit" class="add-user-btn">Add Category</button>
            </div>
        </form>
    </div>
</div>

<!-- Add Tag Modal -->
<div id="add-tag-modal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Add Tag</h2>
            <button class="modal-close">×</button>
        </div>
        <form id="add-tag-form">
            <div class="form-group">
                <label for="tag-name">Tag Name</label>
                <input type="text" id="tag-name" name="name" required>
            </div>
            <div class="form-group">
                <label for="tag-slug">Slug</label>
                <input type="text" id="tag-slug" name="slug" required>
            </div>
            <div class="form-actions">
                <button type="button" class="modal-close page-button">Cancel</button>
                <button type="submit" class="add-user-btn">Add Tag</button>
            </div>
        </form>
    </div>
</div>

<!-- Error Message Container -->
<div id="error-message" class="error-message"></div>
<script>
    // Show modal
    function showModal(modalId) {
        document.getElementById(modalId).classList.add('show');
    }

    // Hide modal
    function hideModal(modalId) {
        document.getElementById(modalId).classList.remove('show');
    }

    // Close modal when clicking outside
    document.querySelectorAll('.modal').forEach(modal => {
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.remove('show');
            }
        });
    });

    // Close modal when clicking close button
    document.querySelectorAll('.modal-close').forEach(button => {
        button.addEventListener('click', () => {
            const modal = button.closest('.modal');
            modal.classList.remove('show');
        });
    });
</script>