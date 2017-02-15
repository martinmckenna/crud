<?php require_once('includes/connection/databaseconnect.php'); ?>
<?php require_once('includes/functions.php'); ?>
<?php
//if the form is submitted, run the add_word function
if(isset($_POST['delete'])){
	delete_word();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Word Page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="styles/style.css" rel="stylesheet">
    </head>
    <body>
        <?php
            print_info();
        ?>
        <form method="post" name = "delete">
            <input type="submit" value="Delete" name="delete"/>
        </form>
    </body>
</html>