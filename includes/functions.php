<?php
require_once 'C:/xampp/htdocs/Internship-Tasks-for-Web-Development-PHP-MySQL/Task-3/includes/config.php';

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Check if user is admin
function isAdmin() {
    return isLoggedIn() && isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;
}

// Generate CSRF token
function generateCsrfToken() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// Validate CSRF token
function validateCsrfToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

// Redirect with message
function redirect($url, $message = null, $type = 'success') {
    if ($message) {
        $_SESSION['message'] = ['text' => $message, 'type' => $type];
    }
    header("Location: " . BASE_URL . $url);
    exit;
}

// Display flash message
function displayFlashMessage() {
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        echo "<div class='alert alert-{$message['type']} alert-dismissible fade show' role='alert'>
                {$message['text']}
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
        unset($_SESSION['message']);
    }
}