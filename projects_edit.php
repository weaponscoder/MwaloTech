<?php
require_once "header.php";

$id = (int)$_GET['id'];
$project = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM projects WHERE id = $id"));

if (!$project) {
    header("Location: projects.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $github_link = mysqli_real_escape_string($conn, $_POST['github_link']);
    $live_link = mysqli_real_escape_string($conn, $_POST['live_link']);
    $technologies = mysqli_real_escape_string($conn, $_POST['technologies']);
    $display_order = (int)$_POST['display_order'];
    
    $image = $project['image'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "../asset/";
        $image = time() . '_' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $image);
        
        // Delete old image
        if (!empty($project['image']) && file_exists("../asset/" . $project['image'])) {
            unlink("../asset/" . $project['image']);
        }
    }
    
    $sql = "UPDATE projects SET 
            title = '$title',
            description = '$description',
            category = '$category',
            image = '$image',
            github_link = '$github_link',
            live_link = '$live_link',
            technologies = '$technologies',
            display_order = '$display_order'
            WHERE id = $id";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: projects.php?msg=updated");
        exit;
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>
<div class="card">
    <div class="card-header">
        <h2>Edit Project</h2>
        <a href="projects.php" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to Projects</a>
    </div>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Project Title *</label>
            <input type="text" name="title" class="form-control" required value="<?= htmlspecialchars($project['title']) ?>">
        </div>
        
        <div class="form-group">
            <label>Description *</label>
            <textarea name="description" class="form-control" required rows="5"><?= htmlspecialchars($project['description']) ?></textarea>
        </div>
        
        <div class="form-group">
            <label>Category</label>
            <input type="text" name="category" class="form-control" value="<?= htmlspecialchars($project['category']) ?>">
        </div>
        
        <div class="form-group">
            <label>Technologies</label>
            <input type="text" name="technologies" class="form-control" value="<?= htmlspecialchars($project['technologies']) ?>">
        </div>
        
        <div class="form-group">
            <label>GitHub Link</label>
            <input type="url" name="github_link" class="form-control" value="<?= htmlspecialchars($project['github_link']) ?>">
        </div>
        
        <div class="form-group">
            <label>Live Demo Link</label>
            <input type="url" name="live_link" class="form-control" value="<?= htmlspecialchars($project['live_link']) ?>">
        </div>
        
        <div class="form-group">
            <label>Current Image</label><br>
            <?php if (!empty($project['image'])): ?>
                <img src="../asset/<?= $project['image'] ?>" alt="" style="max-width: 200px; margin-bottom: 10px;">
            <?php endif; ?>
            <input type="file" name="image" class="form-control" accept="image/*">
            <small>Leave empty to keep current image</small>
        </div>
        
        <div class="form-group">
            <label>Display Order</label>
            <input type="number" name="display_order" class="form-control" value="<?= $project['display_order'] ?>">
        </div>
        
        <button type="submit" class="btn btn-primary">Update Project</button>
    </form>
</div>
<?php require_once "footer.php"; ?>