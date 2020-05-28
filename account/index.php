<?php

require_once('../model/recipe_db.php');
require_once('../model/user_db.php');

require_once('../model/fields.php');
require_once('../model/validate.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {        
        $action = 'view_login';
        if (isset($_SESSION['user'])) {
            $action = 'view_account';
        }
    }
}

switch ($action) {
    case 'view_account':
        $user_id = $_SESSION['user']['user_id'];
        $username = $_SESSION['user']['username'];
        $email = $_SESSION['user']['email'];        
        $view_user = get_user($user_id);
        include 'account_view.php';
        break;
    case 'logout':
        unset($_SESSION['user']);
        redirect('..');
        break;
    default:
        // display_error("Unknown account action: " . $action);
        break;
}
?>