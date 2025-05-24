<?php
require_once 'C:/xampp/htdocs/Internship-Tasks-for-Web-Development-PHP-MySQL/Task-3/includes/db.php';
require_once 'C:/xampp/htdocs/Internship-Tasks-for-Web-Development-PHP-MySQL/Task-3/includes/functions.php';
$page_title = 'Create Post';

if (!isAdmin()) {
    redirect('index.php', 'Access denied.', 'danger');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!validateCsrfToken($_POST['csrf_token'])) {
        redirect('admin/create_post.php', 'Invalid CSRF token.', 'danger');
    }

    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);

    if (empty($title) || empty($content)) {
        redirect('admin/create_post.php', 'Please fill all fields.', 'danger');
    }

    $stmt = $pdo->prepare("INSERT INTO posts (user_id, title, content) VALUES (?, ?, ?)");
    if ($stmt->execute([$_SESSION['user_id'], $title, $content])) {
        redirect('admin/dashboard.php', 'Post created successfully.', 'success');
    } else {
        redirect('admin/create_post.php', 'Failed to create post.', 'danger');
    }
}
?>

<?php include 'C:/xampp/htdocs/Internship-Tasks-for-Web-Development-PHP-MySQL/Task-3/includes/header.php'; ?>
<h1>Create New Post</h1>
<form method="POST" action="">
    <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea class="form-control" id="content" name="content" rows="10" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Create Post</button>
    <a href="<?php echo BASE_URL; ?>admin/dashboard.php" class="btn btn-secondary">Cancel</a>
</form>
<?php include 'C:/xampp/htdocs/Internship-Tasks-for-Web-Development-PHP-MySQL/Task-3/includes/footer.php'; ?>