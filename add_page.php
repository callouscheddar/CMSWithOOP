<?php

require 'includes/utilities.inc.php';

if ($user) {
    $form = new HTML_QuickForm2("add_page");
    $title = $form->addElement("text", "title", "required");
    $title->setLabel("Title:");
    $title->addRule('required', 'Title is required');

    $content = $form->addElement("textarea", "content");
    $content->setLabel("Content:");
    $content->addRule('required', 'Content is required.');

    $form->addElement("submit", "submit", ['value' => 'Submit']);

    if ($_SERVER['REQUEST_METHOD'] ==  'POST') {
        $query = "INSERT INTO pages (creatorId, title, content, dateAdded) VALUES (:creatorId, :title, :content, NOW())";
        $stmt = $pdo->prepare($query);
        $res = $stmt->execute([':creatorId' => $user->getId(), ':title' => $title->getValue(), ':content' => $content->getValue()]);

        if ($res) {
            // Does a pdo return the resulting row after an insert? solved, solution:
            $toPage = 'page.php?id=' . $pdo->lastInsertId();
            header("Location: $toPage");
            exit();
        } 
    }
} else {
    header('Location: index.php');
    exit();
}

include 'includes/header.inc.php';
include 'views/add_page.html';
include 'includes/footer.inc.php';
