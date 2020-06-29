
<?php

require_once('../model/database.php');
require_once('../model/user_db.php');
require_once('../utils/main.php');

$old_picture = $_POST['remove'];
echo $old_picture;

$target_dir = "../images/";
$target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
if ($_FILES["profile_picture"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
        $entered_picture = $target_file;
        echo "The file " . basename($_FILES["profile_picture"]["name"]) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
$user_id = get_id_from_email($_SESSION['user'])['user_id'];
change_picture($entered_picture, $user_id);


//header("Location: http://localhost/bouffage/sign%20in/login.php");
?>