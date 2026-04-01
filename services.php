<?php include 'header.php'; ?>

<div class="card">
    <div class="card-header">
        <h2>Manage Services</h2>
        <a href="services_add.php" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Service</a>
    </div>
    
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Short Description</th>
                    <th>Icon</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $services = mysqli_query($conn, "SELECT * FROM services ORDER BY display_order ASC");
                if (mysqli_num_rows($services) > 0):
                    while ($row = mysqli_fetch_assoc($services)):
                ?>
                <tr>
                    <td>#<?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td><?= substr(htmlspecialchars($row['short_desc']), 0, 50) ?>...</td>
                    <td><i class="fas <?= $row['icon'] ?>"></i></td>
                    <td><?= $row['display_order'] ?></td>
                    <td>
                        <?php if ($row['status'] == 1): ?>
                            <span style="color: green;">Active</span>
                        <?php else: ?>
                            <span style="color: red;">Inactive</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="services_edit.php?id=<?= $row['id'] ?>" class="btn btn-edit"><i class="fas fa-edit"></i> Edit</a>
                        <a href="services_delete.php?id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i> Delete</a>
                    </td>
                </tr>
                <?php 
                    endwhile;
                else:
                ?>
                <tr>
                    <td colspan="7" style="text-align: center;">No services found</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>