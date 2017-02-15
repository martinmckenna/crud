<?php require_once('includes/connection/databaseconnect.php'); ?>
<?php require_once('includes/functions.php'); ?>
<?php
//if the form is submitted, run the add_word function
if(isset($_POST['submit'])){
	add_word($_POST["word"]);
}

if(isset($_POST['page_submit'])){
	add_page($_POST["page"]);
}

//if the delet form is submitted, run the delete_word function
if(isset($_POST['delete_submit'])){
	delete_word($_POST['deleted_word']);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Test App</title>
	<link rel="stylesheet" type="text/css" href="styles/style.css">
</head>
<body>
<h1>Create Word</h1>
<div class = "form">
	<form method="post" name = "add_word">
		<input type="text" name="word" maxlength="30">
		<input type="submit" name="submit">
	</form>
</div>

<div class = "word-list">
	<?php get_column_from_table('word', 'words'); ?>
</div>


</body>
</html>

<?php require_once('connection/databasedisconnect.php'); ?>