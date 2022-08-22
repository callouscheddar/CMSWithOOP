<?php
require 'includes/utilities.inc.php';

$form = new HTML_QuickForm2('tutorial');

$email = $form->addElement('text', 'email');
$email->setLabel('Email Address');
$email->addFilter('trim');
$email->addRule('required', 'Please enter your email.');
$email->addRule('email', 'Please enter your email.');

$password = $form->addElement('text', 'password');
$password->setLabel('Password');
$password->addFilter('trim');
$password->addRule('required', 'Enter a password.');

$form->addElement('submit', 'submit', ['value' => 'login']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($form->validate()) {
        $query = "SELECT id, userType, username, email FROM users WHERE email=:email AND pass=SHA1(:pass)";
        $stmt = $pdo->prepare($query);
        $res = $stmt->execute([':email' => $email->getValue(), ':pass' => $password->getValue()]);

        if ($res) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
            $user = $stmt->fetch();

            if ($user) {
                $_SESSION['user'] = $user;
                header('Location: index.php');
                exit;
            }
        }
    }
}

$pageTitle = 'Login';
include 'includes/header.inc.php';
include 'views/login.html';
include 'includes/footer.inc.php';
