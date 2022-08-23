<?php

require 'includes/utilities.inc.php';

// load page
// check if a user
// check & validate page id
// fetch page with id
// store page as w/ our Page class
// create a form with HTML_QuickForm2 class
// check for form submission (form submission must occur after creation of form)
// set form with values from Page class (this must occur after checking  for form submission)


if ($user) {
    
    if (isset($_GET['id']) && filter_var(($_GET['id']), FILTER_VALIDATE_INT, ['min_range' => 1])) {
        $id = $_GET['id'];
        $_SESSION['pageId'] = $id;
    } else {
        $id = $_SESSION['pageId'];
    }
    
    if ($id) {
        $query = 'SELECT id, creatorId, title, content, DATE_FORMAT(dateAdded, "%e %M %Y") AS dateAdded FROM pages WHERE id=:id';
        $stmt = $pdo->prepare($query);
        $result = $stmt->execute([':id' => $id]);

        if ($result) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Page');
            $page = $stmt->fetch();

            print_r($page);

            if ($page) {
                $form = new HTML_QuickForm2("edit_page");
                $title = $form->addElement("text", "title", "required");
                $title->setLabel("Title:");
                $title->addRule('required', 'Title is required');
            
                $content = $form->addElement("textarea", "content");
                $content->setLabel("Content:");
                $content->addRule('required', 'Content is required.');

                $pageId = $form->addElement('hidden', 'id');
                $pageId->setValue($pageId);
            
                $form->addElement("submit", "submit", ['value' => 'Edit']);

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if ($form->validate()) {
                        $query = "UPDATE pages SET title=:title, content=:content WHERE id=:id";
                        $stmt = $pdo->prepare($query);
                        $result = $stmt->execute([':title' => $title->getValue(), ':content' => $content->getValue(), ':id' => $page->getId()]);
                
                        if ($result) {
                            $_SESSION['page']['id'] = NULL;
                            header("Location: page.php?id={$page->getId()}");
                            exit();
                        }
                    }
                }

                $title->setValue($page->getTitle());
                $content->setValue($page->getContent());
            } else {
                throw new Exception("It seems this page does not exist.");
            }
        } else {
            throw new Exception("It seems this page does not exist.");
        }
    } else {
        throw new Exception("Page does not exist, invalid page Id.");
    }
} else {
    header('Location: index.php');
    exit();
}

include 'includes/header.inc.php';
include 'views/edit_page.html';
include 'includes/footer.inc.php';
