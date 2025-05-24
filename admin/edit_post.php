<?php
require_once 'C:/xampp/htdocs/Internship-Tasks-for-Web-Development-PHP-MySQL/Task-3/includes/db.php';
require_once 'C:/xampp/htdocs/Internship-Tasks-for-Web-Development-PHP-MySQL/Task-3/includes/functions.php';
$page_title = 'Edit Post';

if (!isAdmin()) {
    redirect('index.php', 'Access denied.', 'danger');
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    redirect('admin/dashboard.php', 'Invalid post ID.', 'danger');
}

$post_id = (int)$_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$post_id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    redirect('admin/dashboard.php', 'Post not found.', 'danger');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!validateCsrfToken($_POST['csrf_token'])) {
        redirect("admin/edit_post.php?id=$post_id", 'Invalid CSRF token.', 'danger');
    }

    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);

    if (empty($title) || empty($content)) {
        redirect("admin/edit_post.php?id=$post_id", 'Please fill all fields.', 'danger');
    }

    $stmt = $pdo->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
    if ($stmt->execute([$title, $content, $post_id])) {
        redirect('admin/dashboard.php', 'Post updated successfully.', 'success');
    } else {
        redirect("admin/edit_post.php?id=$post_id", 'Failed to update post.', 'danger');
    }
}
?>

<?php include 'C:/xampp/htdocs/Internship-Tasks-for-Web-Development-PHP-MySQL/Task-3/includes/header.php'; ?>
<h1>Edit Post</h1>
<form method="POST" action="">
    <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea class="form-control" id="content" name="content" rows="10" required><?php echo htmlspecialchars($post['content']); ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Update Post</button>
    <a href="<?php echo BASE_URL; ?>admin/dashboard.php" class="btn btn-secondary">Cancel</a>
</form>
<?php include 'C:/xampp/htdocs/Internship-Tasks-for-Web-Development-PHP-MySQL/Task-3/includes/footer.php'; ?>