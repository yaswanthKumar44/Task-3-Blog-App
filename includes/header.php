<?php
require_once 'C:/xampp/htdocs/Internship-Tasks-for-Web-Development-PHP-MySQL/Task-3/includes/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?> | <?php echo isset($page_title) ? htmlspecialchars($page_title) : 'Home'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="<?php echo BASE_URL; ?>index.php"><?php echo SITE_NAME; ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>index.php">Home</a>
                    </li>
                    <?php if (isAdmin()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL; ?>admin/dashboard.php">Dashboard</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <form class="d-flex" action="<?php echo BASE_URL; ?>search.php" method="GET">
                    <input class="form-control me-2" type="search" name="query" placeholder="Search posts..." aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>
                <ul class="navbar-nav ms-3">
                    <?php if (isLoggedIn()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL; ?>auth/logout.php">Logout (<?php echo htmlspecialchars($_SESSION['username']); ?>)</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL; ?>auth/login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL; ?>auth/register.php">Register</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <?php displayFlashMessage(); ?>