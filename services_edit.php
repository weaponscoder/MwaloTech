<?php include 'header.php'; ?>

<div class="card">
    <div class="card-header">
        <h2>Edit Service</h2>
        <a href="services.php" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to Services</a>
    </div>
    
    <?php
    $id = (int)$_GET['id'];
    $service = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM services WHERE id = $id"));
    
    if (!$service) {
        echo '<div class="alert alert-danger">Service not found!</div>';
        include 'footer.php';
        exit;
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $short_desc = mysqli_real_escape_string($conn, $_POST['short_desc']);
        $full_desc = mysqli_real_escape_string($conn, $_POST['full_desc']);
        $icon = mysqli_real_escape_string($conn, $_POST['icon']);
        $display_order = (int)$_POST['display_order'];
        $status = isset($_POST['status']) ? 1 : 0;
        
        $sql = "UPDATE services SET 
                title = '$title',
                short_desc = '$short_desc',
                full_desc = '$full_desc',
                icon = '$icon',
                display_order = '$display_order',
                status = '$status'
                WHERE id = $id";
        
        if (mysqli_query($conn, $sql)) {
            echo '<div class="alert alert-success">Service updated successfully!</div>';
            // Refresh data
            $service = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM services WHERE id = $id"));
        } else {
            echo '<div class="alert alert-danger">Error: ' . mysqli_error($conn) . '</div>';
        }
    }
    ?>
    
    <form method="POST">
        <div class="form-group">
            <label>Title *</label>
            <input type="text" name="title" class="form-control" required value="<?= htmlspecialchars($service['title']) ?>">
        </div>
        
        <div class="form-group">
            <label>Short Description *</label>
            <textarea name="short_desc" class="form-control" required rows="3"><?= htmlspecialchars($service['short_desc']) ?></textarea>
        </div>
        
        <div class="form-group">
            <label>Full Description</label>
            <textarea name="full_desc" class="form-control" rows="5"><?= htmlspecialchars($service['full_desc']) ?></textarea>
        </div>
        
        <div class="form-group">
            <label>Icon (FontAwesome class)</label>
            <input type="text" name="icon" class="form-control" value="<?= htmlspecialchars($service['icon']) ?>">
        </div>
        
        <div class="form-group">
            <label>Display Order</label>
            <input type="number" name="display_order" class="form-control" value="<?= $service['display_order'] ?>" min="0">
        </div>
        
        <div class="form-group">
            <label>
                <input type="checkbox" name="status" <?= $service['status'] == 1 ? 'checked' : '' ?>> Active
            </label>
        </div>
        
        <button type="submit" class="btn btn-primary">Update Service</button>
    </form>
</div>

<?php include 'footer.php'; ?>