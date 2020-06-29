<!DOCTYPE html>
<html>
<!-- the head section -->

<head>
    <title>Bouffage</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $app_path ?>../main2.css" />
    <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
</head>

<body>
    <!-- The Modal -->
    <div id="id01" class="modal" style="display: none">
    <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>

    <!-- Modal Content -->
    <form id="form" class="modal-content animate" action="/bouffage/sign in/login.php" method="POST">
        <div class="imgcontainer" style="margin-bottom: 0px;">
        <img src="../sign in/avatar.png" alt="Avatar" class="avatar">
        </div>

        <div class="container">
        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter email" name="email" required>
        <br>

        <?php
            if(isset($wrong_password))
            {
            echo "<p> Wrong password </p>";
            }
        ?>

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>

        <button id="button" type="submit">Login</button>
        <label>
            <input type="checkbox" checked="checked" name="remember"> Remember me
        </label>
        </div>

        <div class="container" style="background-color:#f1f1f1">
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
        <span class="psw">Forgot <a href="#">password?</a></span>
        </div>
    </form>

    <script>
        // Get the modal
        var modal = document.getElementById('id01');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
        }
    </script>
  </div>


    <div class="topnav" id="myNav">
        <a href="javascript:window.location.reload(true)">
            <img src="../images/bouffage.png" style="max-height: 60px;">
        </a>
        <a class="active" href="http://localhost/bouffage/user/recipe_add.php"> Add Recipes </a>

        <form action="./" method="POST">
            <input class="searchbar" name="search" type="text" placeholder="Search...">
            <!-- <input class="submit" type="submit" value=""> -->
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
            <form action="../sign in/index.php" method="POST">
                <input type="hidden" name="whatdo" value="my_account">
                <button class="myButton1" type="submit">My Account</button>
            </form>
            <form action="../sign in/index.php" method="POST">
                <input type="hidden" name="whatdo" value="logout">
                <button class="myButton2" type="submit">Logout</button>
            </form>
        <?php else : ?>

            <!-- <form action="./sign in/index.php" method="POST">
                <input type="hidden" name="whatdo" value="login">
                <button class="myButton1" type="submit">Login</button>
            </form> -->
            <button class="myButton1" type="submit" onclick="ShowLogin()">Login</button>
            <script>
                // Get the modal
                function ShowLogin()
                {
                    var modal = document.getElementById('id01');
                    modal.style.display = "block";
                }
            </script>

        <?php endif; ?>
        <?php 
        if(isset($_SESSION['login']))
        {
            ?>
            <script>
                 ShowLogin();
        </script>
            <?php
            unset($_SESSION['login']);
        }
    ?>
        
    </div>