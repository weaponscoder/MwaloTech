<?php
require_once "header.php";

// Handle delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    mysqli_query($conn, "DELETE FROM skills WHERE id = $id");
    header("Location: skills.php?msg=deleted");
    exit;
}

// Get all skills
$skills = mysqli_query($conn, "SELECT * FROM skills ORDER BY category, display_order ASC");
?>
<div class="card">
    <div class="card-header">
        <h2>Manage Skills</h2>
        <a href="skills_add.php" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Skill</a>
    </div>
    
    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-success">Skill <?= $_GET['msg'] ?> successfully!</div>
    <?php endif; ?>
    
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Skill Name</th>
                    <th>Category</th>
                    <th>Percentage</th>
                    <th>Icon</th>
                    <th>Order</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($skills) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($skills)): ?>
                    <tr>
                        <td>#<?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= htmlspecialchars($row['category']) ?></td>
                        <td>
                            <div style="display: flex; align-items: center;">
                                <span style="width: 50px;"><?= $row['percentage'] ?>%</span>
                                <div style="flex: 1; height: 8px; background: #eee; border-radius: 4px; margin-left: 10px;">
                                    <div style="width: <?= $row['percentage'] ?>%; height: 100%; background: #00ffcc; border-radius: 4px;"></div>
                                </div>
                            </div>
                        </td>
                        <td><i class="fas <?= $row['icon'] ?>"></i></td>
                        <td><?= $row['display_order'] ?></td>
                        <td>
                            <a href="skills_edit.php?id=<?= $row['id'] ?>" class="btn btn-edit"><i class="fas fa-edit"></i> Edit</a>
                            <a href="skills.php?delete=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Delete this skill?')"><i class="fas fa-trash"></i> Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align: center;">No skills found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once "footer.php"; ?>