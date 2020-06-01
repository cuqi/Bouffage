<?php

require_once('../utils/main.php');
require_once('../model/recipe_db.php');
require_once('../model/user_db.php');
require_once('../utils/secure_conn.php');

require_once('../model/fields.php');
require_once('../model/validate.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {        
        $action = 'login';
        if (isset($_SESSION['user'])) {
            $action = 'view_account';
        }
    }
}
echo $action;
switch ($action) {
    case 'login':
        //include('login.php');
        echo '<p>' . session_id() . '</p>';
        
    case 'view_account':
        echo 'trash';
        // $user_id = $_SESSION['user']['user_id'];
        // $username = $_SESSION['user']['username'];
        // $email = $_SESSION['user']['email'];        
        // $view_user = get_user($user_id);
        // include 'account_view.php';
        break;
    case 'logout':
        echo 'yes';
        unset($_SESSION['user']);
        redirect('..');
        break;
    default:
        // display_error("Unknown account action: " . $action);
        break;
}

?>