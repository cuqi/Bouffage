<?php include '../view/head.php'; ?>

<?php
require_once('../utils/main.php');
require_once('../model/recipe_db.php');
require_once('../model/user_db.php');

if (isset($_SESSION['user'])) {

    if (isset($_POST['title'])) {
        $title = $_POST['title'];
        $cuisine = $_POST['cuisine'];
        $essay = $_POST['essay'];
        $preparation = $_POST['preparation'];
        $prep_time = $_POST['prep_time'];
        $cook_time = $_POST['cook_time'];
        $servings = $_POST['servings'];
        $complexity = $_POST['complexity'];
        $special_equipment = $_POST['special_equipment'];

        $useremail = $_SESSION['user'];
        $user_id = get_id_from_email($useremail)['user_id'];

        //include("upload.php");
        add_recipe($title, $cuisine, $essay, $preparation, $prep_time, $cook_time, $servings, $complexity, $special_equipment, $user_id); 
        header("Location: http://localhost/bouffage/");
    }
}
else {
    header("Location: http://localhost/bouffage/sign%20in/login.php");
}

?>
<main class="nofloat">
    <h1>Add your own recipe:</h1>
    <form action="recipe_add.php" method="post" id="add_product_form" enctype="multipart/form-data">
        <br>

        <label>Title:</label>
        <input type="text" name="title" placeholder="Enter the title of your recipe" required>
        <br>

        <label>Cuisine:</label>
        <select name="cuisine">
            <?php
            $all_cuisine = array();
            $all_cuisine = get_cuisine_enum();
            foreach ($all_cuisine as $cuisine_type) {
            ?>
                <option value="<?php echo $cuisine_type; ?>"><?php echo $cuisine_type; ?></option>
            <?php } ?>
        </select>
        <br>

        <label>Description: </label>
        <textarea placeholder="" name="essay" rows="10" cols="50">
        </textarea>
        <br>

        <label>Preparation: </label>
        <textarea name="preparation" rows="10" cols="35">
        </textarea>
        <br>

        <label>Preparation time: </label>
        <input type="text" name="prep_time" placeholder="Enter amount in minutes" required>
        <br>

        <label>Cooking time: </label>
        <input type="text" name="cook_time" placeholder="Enter amount in minutes" required>
        <br>

        <label>Servings: </label>
        <input type="text" name="servings" placeholder="Enter number of servings" required>
        <br>

        <label>Complexity:</label>
        <select name="complexity">
            <?php
            $all_complexity = array();
            $all_complexity = get_complexity_enum();
            foreach ($all_complexity as $complexity_type) {
            ?>
                <option value="<?php echo $complexity_type; ?>"><?php echo $complexity_type; ?></option>
            <?php } ?>
        </select>
        <br>

        <label>Special equipment: </label>
        <textarea name="special_equipment" rows="10" cols="35">
        </textarea>
        <br>

        
        <!-- <label>Select image to upload: </label>
        <input type="file" name="fileToUpload" id="fileToUpload">
             -->
        
        <label>&nbsp;</label>
        <input type="submit" value="Submit">
        <input type="button" value="Cancel" onClick="document.location.href='http://localhost/bouffage/';" />
    </form>
</main>
<?php include '../view/foot.php'; ?>