<?php
// CategoryAdd.php
?>
<h2>Add New Category</h2>
<form action="/manga_shop/categories/store" method="POST">
    <div class="form-group">
        <label for="category_name">Category Name</label>
        <input type="text" class="form-control" name="category_name" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" name="description" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Add Category</button>
</form>
