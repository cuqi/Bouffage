<?php 
    // Include the database configuration file 
    require_once('../model/recipe_db.php');
    require_once('../model/recipe_image_db.php');
    // File upload configuration 
    $targetDir = "../images/"; 
    $allowTypes = array('jpg','png','jpeg','gif'); 
     
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
    $fileNames = array_filter($_FILES['files']['name']); 
    if(!empty($fileNames)){ 
        foreach($_FILES['files']['name'] as $key=>$val){ 
            // File upload path 
            $fileName = basename($_FILES['files']['name'][$key]); 
            $targetFilePath = $targetDir . $fileName; 
             
            // Check whether file type is valid 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
            if(in_array($fileType, $allowTypes)){ 
                // Upload file to server 
                if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){ 
                    // Image db insert sql
                  $last_id = get_last_recipe_id()['MAX(recipe_id)'];
                  $recipe_image_id = add_image($targetFilePath, $last_id);
                }
                else{ 
                    $errorUpload .= $_FILES['files']['name'][$key].' | '; 
                } 
            }
            else{ 
                $errorUploadType .= $_FILES['files']['name'][$key].' | '; 
            }
        }
    }
     
    // Display status message 
    echo $statusMsg; 
?>