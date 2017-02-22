<?php require_once('includes/header.php'); ?>
<body>
    <?php
    //if the form is submitted, run the add_word function
    if(isset($_POST['delete'])){
    	delete_word();
    }
    if(isset($_POST['submit_update'])){
    	update_word($_POST["updated_word"]);
    }
    ?>
    <div class = "form">
        <form method="post" name = "delete">
            <label for="delete"><?php print_info();?></label>
            <button type="submit" value="Delete" name="delete">
                <i class="fa fa-trash fa-2x" aria-hidden="true"></i>
            </button>
        </form>
    </div>
    <div class = "form">
        <form method="post" name = "updated">
            <input type="text" name="updated_word" placeholder="enter the edited word"/>
            <button type="submit" name="submit_update" value="Update">
                <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
            </button>
        </form>
    </div>
</body>
<?php require_once('includes/footer.php'); ?>