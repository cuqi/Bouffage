<?php
    require_once('../model/user_db.php');

$useremail = $_POST['email'];
$userpassword = $_POST['password'];    

$success = is_valid_user($useremail, $userpassword);

if($success)
{
     header("Location: http://localhost/bouffage");
     exit();
}
// else 
// {
//     if($wrong_password)
//     {
//         header("Location: http://localhost/bouffage/sign%20in/login.php");
//         exit();
//     }
    else
    {
    header("Location: http://localhost/bouffage/sign%20in/signup.php");
    exit();
    }

?>