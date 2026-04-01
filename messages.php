<?php
require_once "header.php";

// Handle delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    mysqli_query($conn, "DELETE FROM contact_messages WHERE id = $id");
    header("Location: messages.php?msg=deleted");
    exit;
}

// Get all messages
$messages = mysqli_query($conn, "SELECT * FROM contact_messages ORDER BY created_at DESC");
?>
<div class="card">
    <div class="card-header">
        <h2>Contact Messages</h2>
    </div>
    
    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-success">Message <?= $_GET['msg'] ?> successfully!</div>
    <?php endif; ?>
    
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($messages) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($messages)): ?>
                    <tr>
                        <td>#<?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><a href="mailto:<?= htmlspecialchars($row['email']) ?>"><?= htmlspecialchars($row['email']) ?></a></td>
                        <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
                        <td><?= date('M d, Y H:i', strtotime($row['created_at'])) ?></td>
                        <td>
                            <a href="mailto:<?= $row['email'] ?>?subject=Re: Contact from Mwalo Tech" class="btn btn-edit"><i class="fas fa-reply"></i> Reply</a>
                            <a href="messages.php?delete=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Delete this message?')"><i class="fas fa-trash"></i> Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">No messages found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once "footer.php"; ?>