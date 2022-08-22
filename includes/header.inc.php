<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Website' ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <h1>Website</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <?php if ($user) : ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else : ?>
                    <li><a href="login.php">Login</a></li>
                <?php endif ?>
                <li>Other Stuff</li>
                <?php if ($user &&  $user->canCreatePage()) : ?>
                    <li><a href="add_page.php">Add a New Page</a></li>
                <?php endif ?>
            </ul>
        </nav>
    </header>