<?php
require_once 'C:/xampp/htdocs/Internship-Tasks-for-Web-Development-PHP-MySQL/Task-3/includes/db.php';
require_once 'C:/xampp/htdocs/Internship-Tasks-for-Web-Development-PHP-MySQL/Task-3/includes/functions.php';
$page_title = 'Register';

if (isLoggedIn()) {
    redirect('index.php', 'You are already logged in.', 'info');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!validateCsrfToken($_POST['csrf_token'])) {
        redirect('auth/register.php', 'Invalid CSRF token.', 'danger');
    }

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($username) || empty($password) || $password !== $confirm_password) {
        redirect('auth/register.php', 'Please fill all fields and ensure passwords match.', 'danger');
    }

    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->fetch()) {
        redirect('auth/register.php', 'Username already exists.', 'danger');
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    if ($stmt->execute([$username, $hashed_password])) {
        redirect('auth/login.php', 'Registration successful! Please log in.', 'success');
    } else {
        redirect('auth/register.php', 'Registration failed.', 'danger');
    }
}
?>

<?php include 'C:/xampp/htdocs/Internship-Tasks-for-Web-Development-PHP-MySQL/Task-3/includes/header.php'; ?>
<h1>Register</h1>
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
    <div class="mb-3">
        <label for="confirm_password" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
</form>
<?php include 'C:/xampp/htdocs/Internship-Tasks-for-Web-Development-PHP-MySQL/Task-3/includes/footer.php'; ?>