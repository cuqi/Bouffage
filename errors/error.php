<?php
require_once('../utils/main.php'); 
include('../view/head.php');
?>
<main>
    <h1>Error</h1>
    <?php
        if(isset($_SESSION['errormsg']))
        {
            $error_message = $_SESSION['errormsg'];
            echo ("<p>$error_message</p>");
            unset($_SESSION['errormsg']);
        }
        ?>
</main>
<?php include '../view/foot.php'; ?>