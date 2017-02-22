<?php require_once('includes/header.php'); ?>

<body>
<div class = "form" id ="searchform">
	<form method="post" name = "search">
		<input type="text" name="search-word" placeholder="search" maxlength="30">
		<button type="submit" name="search-submit" id="search">
			<i class="fa fa-search fa-2x" aria-hidden="true"></i>
		</button>
	</form>
</div>
<div class = "form">
	<form method="post" name = "add_word">
		<input type="text" name="word" placeholder="new word" maxlength="30">
		<button type="submit" name="submit">
		<i class="fa fa-plus fa-2x" aria-hidden="true"></i>
		</button>
	</form>
	<?php
	//if the form is submitted, run the add_word function
	if(isset($_POST['submit'])){
		$trimmed = trim($_POST["word"]);
		if(empty($trimmed)){
			echo "Please enter something!";
		}
		else{
			if(!check_for_duplicate($_POST["word"])){
				add_word($_POST["word"]);
			}
			else{
				echo "This word already exists!";
			}
		}
	}
	?>
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