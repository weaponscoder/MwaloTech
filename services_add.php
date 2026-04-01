<?php include 'header.php'; ?>

<div class="card">
    <div class="card-header">
        <h2>Add New Service</h2>
        <a href="services.php" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to Services</a>
    </div>
    
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $short_desc = mysqli_real_escape_string($conn, $_POST['short_desc']);
        $full_desc = mysqli_real_escape_string($conn, $_POST['full_desc']);
        $icon = mysqli_real_escape_string($conn, $_POST['icon']);
        $display_order = (int)$_POST['display_order'];
        $status = isset($_POST['status']) ? 1 : 0;
        
        $sql = "INSERT INTO services (title, short_desc, full_desc, icon, display_order, status) 
                VALUES ('$title', '$short_desc', '$full_desc', '$icon', '$display_order', '$status')";
        
        if (mysqli_query($conn, $sql)) {
            echo '<div class="alert alert-success">Service added successfully!</div>';
        } else {
            echo '<div class="alert alert-danger">Error: ' . mysqli_error($conn) . '</div>';
        }
    }
    ?>
    
    <form method="POST">
        <div class="form-group">
            <label>Title *</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label>Short Description *</label>
            <textarea name="short_desc" class="form-control" required rows="3"></textarea>
        </div>
        
        <div class="form-group">
            <label>Full Description</label>
            <textarea name="full_desc" class="form-control" rows="5"></textarea>
        </div>
        
        <div class="form-group">
            <label>Icon (FontAwesome class)</label>
            <input type="text" name="icon" class="form-control" value="fa-code" placeholder="e.g., fa-code, fa-shield-alt">
            <small>Find icons at <a href="https://fontawesome.com/icons" target="_blank">FontAwesome</a></small>
        </div>
        
        <div class="form-group">
            <label>Display Order</label>
            <input type="number" name="display_order" class="form-control" value="0" min="0">
        </div>
        
        <div class="form-group">
            <label>
                <input type="checkbox" name="status" checked> Active
            </label>
        </div>
        
        <button type="submit" class="btn btn-primary">Save Service</button>
    </form>
</div>

<?php include 'footer.php'; ?>