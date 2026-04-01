<?php
require_once "header.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $percentage = (int)$_POST['percentage'];
    $icon = mysqli_real_escape_string($conn, $_POST['icon']);
    $display_order = (int)$_POST['display_order'];
    
    $sql = "INSERT INTO skills (name, category, percentage, icon, display_order) 
            VALUES ('$name', '$category', '$percentage', '$icon', '$display_order')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: skills.php?msg=added");
        exit;
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>
<div class="card">
    <div class="card-header">
        <h2>Add New Skill</h2>
        <a href="skills.php" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to Skills</a>
    </div>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    
    <form method="POST">
        <div class="form-group">
            <label>Skill Name *</label>
            <input type="text" name="name" class="form-control" required placeholder="e.g., HTML5, JavaScript">
        </div>
        
        <div class="form-group">
            <label>Category *</label>
            <select name="category" class="form-control" required>
                <option value="frontend">Frontend</option>
                <option value="backend">Backend</option>
                <option value="database">Database</option>
                <option value="security">Security</option>
                <option value="infrastructure">Infrastructure</option>
                <option value="other">Other</option>
            </select>
        </div>
        
        <div class="form-group">
            <label>Percentage (0-100) *</label>
            <input type="number" name="percentage" class="form-control" required min="0" max="100" value="80">
        </div>
        
        <div class="form-group">
            <label>Icon (FontAwesome class) *</label>
            <input type="text" name="icon" class="form-control" required value="fa-code" placeholder="e.g., fa-html5, fa-js, fa-php">
            <small>Find icons at <a href="https://fontawesome.com/icons" target="_blank">FontAwesome</a></small>
        </div>
        
        <div class="form-group">
            <label>Display Order</label>
            <input type="number" name="display_order" class="form-control" value="0">
        </div>
        
        <button type="submit" class="btn btn-primary">Save Skill</button>
    </form>
</div>
<?php require_once "footer.php"; ?>