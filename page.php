<?php
require('includes/utilities.inc.php');

try {
    
    if (!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT, ['min_range' => 1])) {
        throw new Exception("Page does not exist, invalid page Id.");
    }

    $query = 'SELECT id, creatorId, title, content, DATE_FORMAT(dateAdded, "%e %M %Y") AS dateAdded FROM pages WHERE id=:id';
    $statement = $pdo->prepare($query);
    $result = $statement->execute([':id' => $_GET['id']]);

    if ($result) {
        $statement->setFetchMode(PDO::FETCH_CLASS, 'Page');
        $page = $statement->fetch();

        if ($page) {
            $pageTitle = $page->getTitle();

            include('includes/header.inc.php');
            include('views/page.html');

        } else {
            throw new Exception("Page does not exist, invalid page Id.");
        }
    } else {
        throw new Exception("Page does not exist, invalid page Id.");
    }

} catch (PDOException $e) {
    $pagetitle = "Error!";
    include('includes/header.inc.php');
    include('views/error.html');
}

include('includes/footer.inc.php');