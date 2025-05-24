<?php
require_once 'C:/xampp/htdocs/Internship-Tasks-for-Web-Development-PHP-MySQL/Task-3/includes/db.php';
require_once 'C:/xampp/htdocs/Internship-Tasks-for-Web-Development-PHP-MySQL/Task-3/includes/functions.php';
$page_title = 'Login';

if (isLoggedIn()) {
    redirect('index.php', 'You are already logged in.', 'info');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!validateCsrfToken($_POST['csrf_token'])) {
        redirect('auth/login.php', 'Invalid CSRF token.', 'danger');
    }

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT id, username, password, is_admin FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['is_admin'] = $user['is_admin'];
        redirect('index.php', 'Login successful!', 'success');
    } else {
        redirect('auth/login.php', 'Invalid username or password.', 'danger');
    }
}
?>

<?php include 'C:/xampp/htdocs/Internship-Tasks-for-Web-Development-PHP-MySQL/Task-3/includes/header.php'; ?>
<h1>Login</h1>
<form method="POST" action="">
    <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
    <a href="<?php echo BASE_URL; ?>auth/register.php" class="ms-2">Don't have an account? Register</a>
</form>
<?php include 'C:/xampp/htdocs/Internship-Tasks-for-Web-Development-PHP-MySQL/Task-3/includes/footer.php'; ?>