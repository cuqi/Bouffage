<link rel="stylesheet" type="text/css" href="./modal.css" />

<?php
require_once('../utils/main.php');

if (isset($_POST['email'])) {
  require_once('../model/user_db.php');
  $useremail = $_POST['email'];
  $userpassword = $_POST['password'];
  $success = is_valid_user($useremail, $userpassword);

  if ($success) {
    $_SESSION['user'] = $useremail;
    $_SESSION['role'] = get_role($useremail)['role'];

    ?>
    <script>
      window.history.go(-1);
      </script>
    <?php
    exit();
  }
  else {
        $wrong_password = is_valid_email($useremail);
        if ($wrong_password) {
        } 
        else {
          header("Location: http://localhost/bouffage/sign%20in/signup.php");
          exit();
        }
  }

  unset($_SESSION['login']);
}
else
{
  $_SESSION['login'] = "yes";
  ?>
    <script>
      window.history.go(-1);
      </script>
    <?php
}
?>