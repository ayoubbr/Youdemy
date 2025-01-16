<div class="container">
    <div class="header">
        <h1 class="title">Tags & Categories</h1>
        <div class="actions">
            <button class="btn btn-primary" onclick="showModal('categoryModal')">
                <i class="fas fa-plus"></i>
                Add Category
            </button>
            <button class="btn btn-primary" onclick="showModal('tagModal')">
                <i class="fas fa-plus"></i>
                Add Tag
            </button>
        </div>
    </div>

    <div class="filters">
        <div class="filter-grid">
            <div class="filter-group">
                <label>Search</label>
                <input type="text" placeholder="Search...">
            </div>
            <div class="filter-group">
                <label>Type</label>
                <select>
                    <option value="">All</option>
                    <option value="category">Categories</option>
                    <option value="tag">Tags</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Status</label>
                <select>
                    <option value="">All</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-header">
            <h2>Categories</h2>
            <span>Total
                <?php
                $categories = $_SESSION['categories'];
                echo count($categories);
                ?>
            </span>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Order</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php

                foreach ($categories as $key => $value) {
                    $id = $value->getId();

                ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $value->getTitle(); ?></td>
                        <td><?php echo $value->getDescription(); ?></td>
                        <td class="actions-td">
                            <button class="btn" onclick="<?php echo "editItem('category', $id)"; ?>">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn" onclick="<?php echo "deleteItem('category', $id)"; ?>">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="section">
        <div class="section-header">
            <h2>Tags</h2>
            <span>Total:
                <?php
                $tags = $_SESSION['tags'];
                echo count($tags);
                ?>
            </span>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Order</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($tags as $key => $value) {
                    $id = $value->getId();
                ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $value->getTitle(); ?></td>
                        <td><?php echo $value->getDescription(); ?></td>
                        <td class="actions-td">
                            <button class="btn" onclick="<?php echo "editItem('tag', $id)"; ?>">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn" onclick="<?php echo "deleteItem('tag', $id)"; ?>">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Category Modal -->
<div id="categoryModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Add Category</h3>
            <button class="close-btn" onclick="hideModal('categoryModal')">&times;</button>
        </div>
        <form method="post" action="/category/create">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" required>
            </div>
            <div class="form-group">
                <label>Slug</label>
                <input type="text" name="description" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Category</button>
        </form>
    </div>
</div>

<!-- Tag Modal -->
<div id="tagModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Add Tag</h3>
            <button class="close-btn" onclick="hideModal('tagModal')">&times;</button>
        </div>
        <form onsubmit="handleSubmit(event, 'tag')">
            <div class="form-group">
                <label>Name</label>
                <input type="text" required>
            </div>
            <div class="form-group">
                <label>Slug</label>
                <input type="text" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Tag</button>
        </form>
    </div>
</div>

<script>
    function showModal(id) {
        document.getElementById(id).classList.add('active');
    }

    function hideModal(id) {
        document.getElementById(id).classList.remove('active');
    }

    function handleSubmit(event, type) {
        event.preventDefault();
        // Add your form submission logic here
        console.log(`Submitting ${type} form`);
        hideModal(`${type}Modal`);
    }

    function editItem(type, id) {
        console.log(`Editing ${type} with id ${id}`);
        // Add your edit logic here
    }

    function deleteItem(type, id) {
        if (confirm(`Are you sure you want to delete this ${type}?`)) {
            console.log(`Deleting ${type} with id ${id}`);
            // Add your delete logic here
        }
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        if (event.target.classList.contains('modal')) {
            event.target.classList.remove('active');
        }
    }
</script>