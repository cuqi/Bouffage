<?php
 
require_once('../model/database.php');
require_once('../model/user_db.php');
require_once('../utils/main.php');
 
$old_picture = $_POST['remove'];
 
$target_dir = "../images/";
$target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
    if ($check !== false) {
        display_error("File is an image - " . $check["mime"] . ".");
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
if (file_exists($target_file)) {
    display_error("Sorry, file already exists.");
    $uploadOk = 0;
}
if ($_FILES["profile_picture"]["size"] > 50000000) {
    display_error("Sorry, your file is too large.");
    $uploadOk = 0;
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    display_error("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
  $uploadOk = 0;
}
if ($uploadOk == 0) {
    display_error("Sorry, your file was not uploaded.");
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
        $entered_picture = $target_file;
        $user_id = get_id_from_email($_SESSION['user'])['user_id'];
        change_picture($entered_picture, $user_id);
        ?>
        <script> 
            window.history.back();
        </script>

        <?php
    } else {
        display_error("Sorry, there was an error uploading your file.");
    }
}
 
 
//header("Location: http://localhost/bouffage/sign%20in/login.php");
?>