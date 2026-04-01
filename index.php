<?php include 'header.php'; ?>

<div class="card">
    <div class="card-header">
        <h2>Dashboard</h2>
    </div>
    
    <?php
    // Get counts
    $services_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM services"))['count'];
    $projects_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM projects"))['count'];
    $skills_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM skills"))['count'];
    $messages_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM contact_messages"))['count'];
    ?>
    
    <div class="stats-grid">
        <div class="stat-card">
            <i class="fas fa-cogs"></i>
            <h3>Total Services</h3>
            <div class="number"><?= $services_count ?></div>
        </div>
        
        <div class="stat-card">
            <i class="fas fa-project-diagram"></i>
            <h3>Total Projects</h3>
            <div class="number"><?= $projects_count ?></div>
        </div>
        
        <div class="stat-card">
            <i class="fas fa-code"></i>
            <h3>Total Skills</h3>
            <div class="number"><?= $skills_count ?></div>
        </div>
        
        <div class="stat-card">
            <i class="fas fa-envelope"></i>
            <h3>Messages</h3>
            <div class="number"><?= $messages_count ?></div>
        </div>
    </div>
    
    <!-- Recent Messages -->
    <div class="card" style="margin-top: 30px;">
        <div class="card-header">
            <h3>Recent Messages</h3>
            <a href="messages.php" class="btn btn-primary">View All</a>
        </div>
        
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $recent = mysqli_query($conn, "SELECT * FROM contact_messages ORDER BY created_at DESC LIMIT 5");
                    if (mysqli_num_rows($recent) > 0):
                        while ($row = mysqli_fetch_assoc($recent)):
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= substr(htmlspecialchars($row['message']), 0, 50) ?>...</td>
                        <td><?= date('M d, Y', strtotime($row['created_at'])) ?></td>
                    </tr>
                    <?php 
                        endwhile;
                    else:
                    ?>
                    <tr>
                        <td colspan="4" style="text-align: center;">No messages yet</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>