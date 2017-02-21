<?php require_once('includes/header.php'); ?>
<?php
//if the form is submitted, run the add_word function
if(isset($_POST['submit'])){
	add_word($_POST["word"]);
}
?>

<body>
<h1>Create Word</h1>
<div class = "form">
	<form method="post" name = "add_word">
		<input type="text" name="word" maxlength="30">
		<input type="submit" name="submit">
	</form>
</div>
<h1>Search</h1>
<div class = "form">
	<form method="post" name = "search">
		<input type="text" name="search-word" maxlength="30">
		<input type="submit" name="search-submit">
	</form>
</div>

<div class = "word-list">
	<?php 
	//if the search form is submitted, run the search_word function
	if(isset($_POST['search-submit'])){
		search_word($_POST['search-word']);
	}
	else{
		get_column_from_table('word', 'words');
	} ?>
</div>
</body>

<?php require_once('includes/footer.php'); ?>