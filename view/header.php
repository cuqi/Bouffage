<!DOCTYPE html>
<html>
<!-- the head section -->

<head>
    <title>Bouffage</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $app_path ?>main2.css" />
    <link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico" />
</head>

<body>

    <div class="topnav" id="myNav">
        <a href="javascript:window.location.reload(true)">
            <img src="./images/bouffage.png" style="max-height: 60px;">
        </a>
        <a class="active" href="http://localhost/bouffage/user/recipe_add.php"> Add Recipes </a>

        <form action="./" method="POST">
            <input class="searchbar" name="search" type="text" placeholder="Search...">
            <input class="submit" type="submit" value="search">
        </form>

        <?php
        // Check if user is logged in and
        // display appropriate account links
        $account_url = $app_path . 'sign in';
        $login_url = 'sign in/login.php';

        $logout_url = $account_url . '?sign%20in=logout';

        $toindex = $app_path . 'sign in';


        if (isset($_SESSION['user'])) :
        ?>
            <form action="./sign in/index.php" method="POST">
                <input type="hidden" name="whatdo" value="my_account">
                <button class="myButton1" type="submit">My Account</button>
            </form>
            <form action="./sign in/index.php" method="POST">
                <input type="hidden" name="whatdo" value="logout">
                <button class="myButton1" type="submit">Logout</button>
            </form>
        <?php else : ?>

            <form action="./sign in/index.php" method="POST">
                <input type="hidden" name="whatdo" value="login">
                <button class="myButton1" type="submit">Login</button>
            </form>

        <?php endif; ?>

        
    </div>