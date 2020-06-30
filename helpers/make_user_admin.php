<?php
require_once('../model/user_db.php');
require_once('../utils/main.php');

if (isset($_SESSION['user'])) 
{
    if($_SESSION['role'] == "Admin")
    {
        $connected_user = $_SESSION['user'];
        $user = $_POST['user_admin'];
        make_this_user_admin($user);
        ?>
        <script>
            window.history.back();
            </script>

        <?php
    }
    else
    {
        error_log("You do not have the right credentials!");
    }
}
else
{
    header("Location: http://localhost/bouffage/sign%20in/login.php");
}
?>