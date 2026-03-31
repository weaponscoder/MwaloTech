<?php
// admin.php
session_start();

// Simple password protection
$admin_password = "admin123";

// Handle login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['password'])) {
    if ($_POST['password'] === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
    } else {
        $error = "Invalid password!";
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: admin.php");
    exit;
}

// If not logged in, show login form
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Admin Login</title>
        <style>
            body { font-family: Arial; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
            .login-form { background: white; padding: 40px; border-radius: 10px; box-shadow: 0 10px 30px rgba(0,0,0,0.2); width: 350px; }
            .login-form h2 { text-align: center; color: #333; margin-bottom: 30px; }
            .login-form input { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
            .login-form button { width: 100%; padding: 12px; background: #d36804; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; }
            .login-form button:hover { background: #b55500; }
            .error { color: red; text-align: center; margin: 10px 0; }
        </style>
    </head>
    <body>
        <div class="login-form">
            <h2>Admin Login</h2>
            <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
            <form method="POST">
                <input type="password" name="password" placeholder="Enter password" required>
                <button type="submit">Login</button>
            </form>
  
        </div>
    </body>
    </html>
    <?php
    exit;
}

// If logged in, show admin panel
require_once "db.php";

// Get data
$contacts = mysqli_query($conn, "SELECT * FROM contact_messages ORDER BY created_at DESC");
$testimonials = mysqli_query($conn, "SELECT * FROM testimonials ORDER BY created_at DESC");

$contact_count = mysqli_num_rows($contacts);
$testimonial_count = mysqli_num_rows($testimonials);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - Mwalo Tech</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial; background: #f8fafc; padding: 20px; }
        .container { max-width: 1200px; margin: 0 auto; }
        h1 { color: #333; border-bottom: 3px solid #d36804; padding-bottom: 10px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
        .logout { background: #ff4444; color: white; padding: 8px 20px; text-decoration: none; border-radius: 5px; font-size: 14px; }
        .logout:hover { background: #cc0000; }
        .stats { display: flex; gap: 20px; margin-bottom: 30px; }
        .stat-box { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); flex: 1; text-align: center; }
        .stat-box h3 { color: #666; font-size: 14px; margin-bottom: 10px; }
        .stat-box .number { font-size: 36px; font-weight: bold; color: #d36804; }
        table { width: 100%; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 40px; }
        th { background: #d36804; color: white; padding: 15px; text-align: left; }
        td { padding: 15px; border-bottom: 1px solid #eee; }
        tr:hover { background: #f5f5f5; }
        h2 { margin: 30px 0 15px; color: #333; }
        .no-data { text-align: center; padding: 30px; color: #666; }
        .rating { color: gold; font-size: 18px; }
        .message-preview { max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
    </style>
</head>
<body>
    <div class="container">
        <h1>
            Mwalo Tech - Admin Panel
            <a href="?logout=1" class="logout">Logout</a>
        </h1>
        
        <div class="stats">
            <div class="stat-box">
                <h3>Total Contact Messages</h3>
                <div class="number"><?= $contact_count ?></div>
            </div>
            <div class="stat-box">
                <h3>Total Testimonials</h3>
                <div class="number"><?= $testimonial_count ?></div>
            </div>
        </div>
        
        <h2>📬 Contact Messages</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Date</th>
            </tr>
            <?php if ($contact_count > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($contacts)): ?>
                <tr>
                    <td>#<?= $row['id'] ?></td>
                    <td><strong><?= htmlspecialchars($row['name']) ?></strong></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td class="message-preview"><?= htmlspecialchars($row['message']) ?></td>
                    <td><?= date('M d, Y H:i', strtotime($row['created_at'])) ?></td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="5" class="no-data">No contact messages yet</td></tr>
            <?php endif; ?>
        </table>
        
        <h2>⭐ Testimonials</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Title</th>
                <th>Message</th>
                <th>Rating</th>
                <th>Date</th>
            </tr>
            <?php if ($testimonial_count > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($testimonials)): ?>
                <tr>
                    <td>#<?= $row['id'] ?></td>
                    <td><strong><?= htmlspecialchars($row['name']) ?></strong></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['title'] ?? '-') ?></td>
                    <td class="message-preview"><?= htmlspecialchars($row['message']) ?></td>
                    <td class="rating"><?= str_repeat('⭐', $row['rating']) ?></td>
                    <td><?= date('M d, Y H:i', strtotime($row['created_at'])) ?></td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="7" class="no-data">No testimonials yet</td></tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>
<?php mysqli_close($conn); ?>