<?php require_once('includes/header.php'); ?>
<?php
//if the form is submitted, run the add_word function
if(isset($_POST['delete'])){
	delete_word();
}
if(isset($_POST['submit_update'])){
	update_word($_POST["updated_word"]);
}
?>


    <body>
        <?php
            print_info();
        ?>
        <form method="post" name = "delete">
            <input type="submit" value="Delete" name="delete"/>
        </form>
        <form method="post" name = "updated">
            <input type="text" name="updated_word" placeholder="new word"/>
            <input type="submit" name="submit_update" value="Update"/>
        </form>
    </body>
<?php require_once('includes/footer.php'); ?>