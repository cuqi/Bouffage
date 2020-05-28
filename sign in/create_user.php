<?php 
require_once('../model/database.php');
require_once('../model/user_db.php');

$entered_email = $_POST['email'];
$entered_username = $_POST['username'];
$entered_password1 = $_POST['password1'];
$entered_password2 = $_POST['password2'];
if ($entered_password1 == $entered_password2)
{
    $this_user_id = add_user_to_db($entered_email, $entered_password1, $entered_username);
}
else
{
    echo "<html><p>window.alert('Hello\nHow are you?');</p></html>";

}
?>