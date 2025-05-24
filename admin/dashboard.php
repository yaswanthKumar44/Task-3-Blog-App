<?php
require_once 'C:/xampp/htdocs/Internship-Tasks-for-Web-Development-PHP-MySQL/Task-3/includes/db.php';
require_once 'C:/xampp/htdocs/Internship-Tasks-for-Web-Development-PHP-MySQL/Task-3/includes/functions.php';
$page_title = 'Admin Dashboard';

if (!isAdmin()) {
    redirect('index.php', 'Access denied.', 'danger');
}

$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * POSTS_PER_PAGE;

$stmt = $pdo->query("SELECT COUNT(*) FROM posts");
$total_posts = $stmt->fetchColumn();
$total_pages = ceil($total_posts / POSTS_PER_PAGE);

$stmt = $pdo->prepare("SELECT p.*, u.username FROM posts p JOIN users u ON p.user_id = u.id ORDER BY p.created_at DESC LIMIT :limit OFFSET :offset");
$stmt->bindValue(':limit', POSTS_PER_PAGE, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'C:/xampp/htdocs/Internship-Tasks-for-Web-Development-PHP-MySQL/Task-3/includes/header.php'; ?>
<h1>Admin Dashboard</h1>
<a href="<?php echo BASE_URL; ?>admin/create_post.php" class="btn btn-success mb-3">Create New Post</a>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($posts): ?>
            <?php foreach ($posts as $post): ?>
                <tr>
                    <td><a href="<?php echo BASE_URL; ?>post.php?id=<?php echo $post['id']; ?>"><?php echo htmlspecialchars($post['title']); ?></a></td>
                    <td><?php echo htmlspecialchars($post['username']); ?></td>
                    <td><?php echo $post['created_at']; ?></td>
                    <td>
                        <a href="<?php echo BASE_URL; ?>admin/edit_post.php?id=<?php echo $post['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="<?php echo BASE_URL; ?>admin/delete_post.php?id=<?php echo $post['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="4">No posts found.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <?php if ($page > 1): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a>
            </li>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>
        <?php if ($page < $total_pages): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>
<?php include 'C:/xampp/htdocs/Internship-Tasks-for-Web-Development-PHP-MySQL/Task-3/includes/footer.php'; ?>