<?php
require_once "header.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $github_link = mysqli_real_escape_string($conn, $_POST['github_link']);
    $live_link = mysqli_real_escape_string($conn, $_POST['live_link']);
    $technologies = mysqli_real_escape_string($conn, $_POST['technologies']);
    $display_order = (int)$_POST['display_order'];
    
    // Handle image upload
    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "../asset/";
        $image = time() . '_' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $image);
    }
    
    $sql = "INSERT INTO projects (title, description, category, image, github_link, live_link, technologies, display_order) 
            VALUES ('$title', '$description', '$category', '$image', '$github_link', '$live_link', '$technologies', '$display_order')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: projects.php?msg=added");
        exit;
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>
<div class="card">
    <div class="card-header">
        <h2>Add New Project</h2>
        <a href="projects.php" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to Projects</a>
    </div>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Project Title *</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label>Description *</label>
            <textarea name="description" class="form-control" required rows="5"></textarea>
        </div>
        
        <div class="form-group">
            <label>Category</label>
            <input type="text" name="category" class="form-control" placeholder="e.g., Web Development, Mobile App">
        </div>
        
        <div class="form-group">
            <label>Technologies</label>
            <input type="text" name="technologies" class="form-control" placeholder="e.g., HTML, CSS, JavaScript, PHP">
        </div>
        
        <div class="form-group">
            <label>GitHub Link</label>
            <input type="url" name="github_link" class="form-control" placeholder="https://github.com/...">
        </div>
        
        <div class="form-group">
            <label>Live Demo Link</label>
            <input type="url" name="live_link" class="form-control" placeholder="https://...">
        </div>
        
        <div class="form-group">
            <label>Project Image</label>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>
        
        <div class="form-group">
            <label>Display Order</label>
            <input type="number" name="display_order" class="form-control" value="0">
        </div>
        
        <button type="submit" class="btn btn-primary">Save Project</button>
    </form>
</div>
<?php require_once "footer.php"; ?>