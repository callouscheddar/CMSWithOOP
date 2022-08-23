<?php
require 'includes/utilities.inc.php';

if ($user && isset($_SESSION['user'])) {
    $user = null;
    $_SESSION = [];
    setcookie(session_name(), false, time()-3600);
    session_destroy();
}

$pageTitle = 'Logout';
include 'includes/header.inc.php';
include 'views/logout.html';
include 'includes/footer.inc.php';