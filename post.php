<?php
require_once 'C:/xampp/htdocs/Internship-Tasks-for-Web-Development-PHP-MySQL/Task-3/includes/db.php';
require_once 'C:/xampp/htdocs/Internship-Tasks-for-Web-Development-PHP-MySQL/Task-3/includes/functions.php';
$page_title = 'Post';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    redirect('index.php', 'Invalid post ID.', 'danger');
}

$post_id = (int)$_GET['id'];
$stmt = $pdo->prepare("SELECT p.*, u.username FROM posts p JOIN users u ON p.user_id = u.id WHERE p.id = ?");
$stmt->execute([$post_id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    redirect('index.php', 'Post not found.', 'danger');
}
?>

<?php include 'C:/xampp/htdocs/Internship-Tasks-for-Web-Development-PHP-MySQL/Task-3/includes/header.php'; ?>
<h1><?php echo htmlspecialchars($post['title']); ?></h1>
<p><small class="text-muted">Posted by <?php echo htmlspecialchars($post['username']); ?> on <?php echo $post['created_at']; ?></small></p>
<div class="card">
    <div class="card-body">
        <p class="card-text"><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
        <a href="<?php echo BASE_URL; ?>index.php" class="btn btn-primary">Back to Posts</a>
        <?php if (isAdmin()): ?>
            <a href="<?php echo BASE_URL; ?>admin/edit_post.php?id=<?php echo $post['id']; ?>" class="btn btn-warning">Edit</a>
            <a href="<?php echo BASE_URL; ?>admin/delete_post.php?id=<?php echo $post['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</a>
        <?php endif; ?>
    </div>
</div>
<?php include 'C:/xampp/htdocs/Internship-Tasks-for-Web-Development-PHP-MySQL/Task-3/includes/footer.php'; ?>