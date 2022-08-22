<?php
require('includes/utilities.inc.php');

$pageTitle = 'Welcome Page';
include('includes/header.inc.php');

try {
    $query = 'SELECT id, title, content, DATE_FORMAT(dateAdded, "%e %M %Y") AS dateAdded FROM pages ORDER BY dateAdded DESC LIMIT 3';
    $result = $pdo->query($query);
    if ($result && $result->rowCount() > 0) {
        $result->setFetchMode(PDO::FETCH_CLASS, 'Page');

        include('views/index.html');
    } else {
        throw new Exception('No content is available to be viewed at this time.');
    }
} catch (PDOException $e) {
    include('views/error.html');
}

include('includes/footer.inc.php');
