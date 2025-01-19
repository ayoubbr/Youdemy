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
                            <form action="/admin/category/delete" method="post">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <button type="submit" class="btn">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
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
                            <form action="/admin/tag/delete" method="post">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <button type="submit" class="btn">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
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
        <form method="post" action="/admin/category/create">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" required>
            </div>
            <div class="form-group">
                <label>Description</label>
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
        <form method="post" action="/admin/tag/create">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" required>
            </div>
            <div class="form-group">
                <label>Description</label>
                <input type="text" name="description" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Tag</button>
        </form>
    </div>
</div>

<!-- Edit Category Modal -->
<div id="editCategoryModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Edit Category</h3>
            <button class="close-btn" onclick="hideModal('editCategoryModal')">&times;</button>
        </div>
        <form method="post" action="/admin/category/update">
            <input type="hidden" name="id" id="editCategoryId">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" id="editCategoryTitle" required>
            </div>
            <div class="form-group">
                <label>Description</label>
                <input type="text" name="description" id="editCategoryDescription" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Category</button>
        </form>
    </div>
</div>

<!-- Edit Tag Modal -->
<div id="editTagModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Edit Tag</h3>
            <button class="close-btn" onclick="hideModal('editTagModal')">&times;</button>
        </div>
        <form method="post" action="/admin/tag/update">
            <input type="hidden" name="id" id="editTagId">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" id="editTagTitle" required>
            </div>
            <div class="form-group">
                <label>Description</label>
                <input type="text" name="description" id="editTagDescription" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Tag</button>
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

    function editItem(type, id) {
        const row = event.target.closest('tr');
        const title = row.children[1].textContent;
        const description = row.children[2].textContent;

        if (type === 'category') {
            document.getElementById('editCategoryId').value = id;
            document.getElementById('editCategoryTitle').value = title;
            document.getElementById('editCategoryDescription').value = description;
            showModal('editCategoryModal');
        } else if (type === 'tag') {
            document.getElementById('editTagId').value = id;
            document.getElementById('editTagTitle').value = title;
            document.getElementById('editTagDescription').value = description;
            showModal('editTagModal');
        }
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        if (event.target.classList.contains('modal')) {
            event.target.classList.remove('active');
        }
    }
</script>