<?php

require_once('../utils/main.php');
require_once('../model/recipe_db.php');
require_once('../model/user_db.php');
// require_once('../utils/secure_conn.php');

require_once('../helpers/fields.php');
require_once('../helpers/validate.php');

if(isset($_SESSION['user'])){

    echo $_SESSION['user'];
}

$action = $_POST['whatdo'];

if ($action == NULL){
    $action = $_GET['whatdo'];
    if ($action == NULL) {
        $action = 'login';
        // if (isset($_SESSION['user'])) {
        //     echo "yessir";
        //     $action = 'my_account';
        // }
    }
}

switch ($action) {
    case 'login':
        include('login.php');
    break;
    case 'my_account':
        include('account_view.php');
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