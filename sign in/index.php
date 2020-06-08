<?php

require_once('../utils/main.php');
require_once('../model/recipe_db.php');
require_once('../model/user_db.php');
require_once('../helpers/fields.php');
require_once('../helpers/validate.php');

$action = $_POST['whatdo'];

    if ($action == NULL) {
        $action = 'login';
        if (isset($_SESSION['user'])) {
            echo "yessir";
            $action = 'my_account';
        }
    }


switch ($action) {
    case 'login':
        //header("Location: https://youtu.be/dQw4w9WgXcQ");
        include('login.php');
    break;
    case 'my_account':
        include('account_view.php');
    break;
    case 'logout':
        session_destroy();
        redirect('..');
    break;
    default:
        display_error("Unknown account action: " . $action);
    break;
}

?>