<?php
// Set up the database connection
$dsn = 'mysql:host=localhost;dbname=seeddata2';
 $username = 'root';
 $password = '';

$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES   => false);

try {
    $db = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    include('errors/db_error_connect.php');
    exit();
}
?>