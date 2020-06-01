<?php
// Get the document root
$doc_root = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT', FILTER_SANITIZE_STRING);

// Get the application path
$uri = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_STRING);
$dirs = explode('/', $uri);
$app_path = '/' . $dirs[1] . '/' . $dirs[2] . '/';

// Set the include path
set_include_path($doc_root . $app_path);

// Get common code
$level = sizeof($dirs);

//echo $dirs[0];
//echo $dirs[1];
//echo $level;
//echo isset($dirs[3]);
// require_once('../model/database.php');
// require_once('tags.php');
//echo $level;
if(isset($dirs[3]) && $level == 4) {
    require_once('tags.php');
    require_once('../model/database.php');
}
elseif($level == 3) {
    require_once('tags.php');
    require_once('model/database.php');
}
else {
    require_once('tags.php');
    require_once('model/database.php');
}


// Define some common functions
function display_db_error($error_message) {
    global $app_path;
    include 'errors/db_error.php';
    exit;
}

function display_error($error_message) {
    global $app_path;
    include 'errors/error.php';
    exit;
}

function redirect($url) {
    session_write_close();
    header("Location: " . $url);
    exit;
}

session_start();
?>
