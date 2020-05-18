<?php
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    // header('WWW-Authenticate: Basic realm="My Realm"');
    // header('HTTP/1.0 401 Unauthorized');
    // echo 'Text to send if user hits Cancel button';
    // exit;
} else {
    require_once('../model/user_db.php');
$dbuser = get_all_credentials();
$userusername = $_POST['username'];
$userpassword = $_POST['password'];    
$success = false;
foreach ($dbuser as $loggeduser);
{
    $name = $dbuser['username'];
    if ($name == $userusername)
        {
            if ($dbuser['password']== $userpassword )
            {
                $success = true;
            }
        }
    }
}
if($success)
{
     header("Location: http://localhost/bouffage/index.php");
     exit();
}
else{
    header("Location: http://localhost/bouffage/sign%20in/signup.php");
    exit();
}

?>