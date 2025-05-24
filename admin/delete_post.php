<?php
require_once 'C:/xampp/htdocs/Internship-Tasks-for-Web-Development-PHP-MySQL/Task-3/includes/db.php';
require_once 'C:/xampp/htdocs/Internship-Tasks-for-Web-Development-PHP-MySQL/Task-3/includes/functions.php';

if (!isAdmin()) {
    redirect('index.php', 'Access denied.', 'danger');
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    redirect('admin/dashboard.php', 'Invalid post ID.', 'danger');
}

$post_id = (int)$_GET['id'];
$stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
if ($stmt->execute([$post_id])) {
    redirect('admin/dashboard.php', 'Post deleted successfully.', 'success');
} else {
    redirect('admin/dashboard.php', 'Failed to delete post.', 'danger');
}