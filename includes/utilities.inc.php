<?php
// class autoloader
function class_loader($class)
{
    require('classes/' . $class  . '.php');
}
spl_autoload_register('class_loader');

session_start();

$user = $_SESSION['user'] ?? null;

try {
    $pdo = new PDO('mysql:dbname=phpadvanced;host=localhost', 'root', '');
} catch (PDOException $e) {
    $pagetitle = "Error!";
    include('includes/header.inc.php');
    include('views/error.html');
    include('includes/footer.inc.php');
    exit();
}
