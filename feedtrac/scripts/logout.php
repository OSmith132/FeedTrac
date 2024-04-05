<?php

session_start();

if (isset($_SESSION['userID'])) {
    unset($_SESSION['userID']);
}

$path = dirname($_SERVER['PHP_SELF']) . '/../login.php';

header("Location: {$path}");

exit;

?>