<?php
require_once "header.php";

$id = (int)$_GET['id'];
$skill = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM skills WHERE id = $id"));

if (!$skill) {
    header("Location: skills.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $percentage = (int)$_POST['percentage'];
    $icon = mysqli_real_escape_string($conn, $_POST['icon']);
    $display_order = (int)$_POST['display_order'];
    
    $sql = "UPDATE skills SET 
            name = '$name',
            category = '$category',
            percentage = '$percentage',
            icon = '$icon',
            display_order = '$display_order'
            WHERE id = $id";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: skills.php?msg=updated");
        exit;
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>
<div class="card">
    <div class="card-header">
        <h2>Edit Skill</h2>
        <a href="skills.php" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to Skills</a>
    </div>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    
    <form method="POST">
        <div class="form-group">
            <label>Skill Name *</label>
            <input type="text" name="name" class="form-control" required value="<?= htmlspecialchars($skill['name']) ?>">
        </div>
        
        <div class="form-group">
            <label>Category *</label>
            <select name="category" class="form-control" required>
                <option value="frontend" <?= $skill['category'] == 'frontend' ? 'selected' : '' ?>>Frontend</option>
                <option value="backend" <?= $skill['category'] == 'backend' ? 'selected' : '' ?>>Backend</option>
                <option value="database" <?= $skill['category'] == 'database' ? 'selected' : '' ?>>Database</option>
                <option value="security" <?= $skill['category'] == 'security' ? 'selected' : '' ?>>Security</option>
                <option value="infrastructure" <?= $skill['category'] == 'infrastructure' ? 'selected' : '' ?>>Infrastructure</option>
                <option value="other" <?= $skill['category'] == 'other' ? 'selected' : '' ?>>Other</option>
            </select>
        </div>
        
        <div class="form-group">
            <label>Percentage (0-100) *</label>
            <input type="number" name="percentage" class="form-control" required min="0" max="100" value="<?= $skill['percentage'] ?>">
        </div>
        
        <div class="form-group">
            <label>Icon (FontAwesome class) *</label>
            <input type="text" name="icon" class="form-control" required value="<?= htmlspecialchars($skill['icon']) ?>">
        </div>
        
        <div class="form-group">
            <label>Display Order</label>
            <input type="number" name="display_order" class="form-control" value="<?= $skill['display_order'] ?>">
        </div>
        
        <button type="submit" class="btn btn-primary">Update Skill</button>
    </form>
</div>
<?php require_once "footer.php"; ?>