<?php
require_once "header.php";

// Handle delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    mysqli_query($conn, "DELETE FROM projects WHERE id = $id");
    header("Location: projects.php?msg=deleted");
    exit;
}

// Get all projects
$projects = mysqli_query($conn, "SELECT * FROM projects ORDER BY display_order ASC");
?>
<div class="card">
    <div class="card-header">
        <h2>Manage Projects</h2>
        <a href="projects_add.php" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Project</a>
    </div>
    
    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-success">Project <?= $_GET['msg'] ?> successfully!</div>
    <?php endif; ?>
    
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Technologies</th>
                    <th>Order</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($projects) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($projects)): ?>
                    <tr>
                        <td>#<?= $row['id'] ?></td>
                        <td>
                            <?php if (!empty($row['image'])): ?>
                                <img src="../asset/<?= $row['image'] ?>" alt="<?= $row['title'] ?>" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                            <?php else: ?>
                                <i class="fas fa-image" style="font-size: 30px; color: #ccc;"></i>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($row['title']) ?></td>
                        <td><?= htmlspecialchars($row['category']) ?></td>
                        <td><?= htmlspecialchars($row['technologies']) ?></td>
                        <td><?= $row['display_order'] ?></td>
                        <td>
                            <a href="projects_edit.php?id=<?= $row['id'] ?>" class="btn btn-edit"><i class="fas fa-edit"></i> Edit</a>
                            <a href="projects.php?delete=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Delete this project?')"><i class="fas fa-trash"></i> Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align: center;">No projects found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once "footer.php"; ?>