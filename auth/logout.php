<?php
require_once 'C:/xampp/htdocs/Internship-Tasks-for-Web-Development-PHP-MySQL/Task-3/includes/functions.php';
session_destroy();
redirect('index.php', 'Logged out successfully.', 'success');