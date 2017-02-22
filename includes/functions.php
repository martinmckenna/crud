<?php
include('includes/connection/databaseconnect.php');

//get the info from the row and print it to the page 
function print_info(){
	global $connection;
	$url_id = $_GET['id'];
	$query = "SELECT * FROM words WHERE id = '".$url_id."' LIMIT 1";
	$result = mysqli_query($connection, $query);
	while($row = mysqli_fetch_row($result)){
		// echo "<div id='printed_word'>";
		echo $row[1];
		// echo "</div>";
	}
}

//escapes characters to protect from SQL injections
function clean($a){
	global $connection;
	$cleaned = mysqli_real_escape_string($connection, $a);
	return $cleaned;
}

//extract data from the submitted form, clean for injections, then put the cleaned
// word into the database table
//The CREATE part of the app
function add_word($word){
	global $connection;
	$cleaned_word = clean("$word");
	$query = "INSERT INTO words (word) VALUES ('$cleaned_word')";
	$result = mysqli_query($connection, $query);
	mysqli_fetch_row(result);
}

//get entire columnn from any table
//The READ part of the app
function get_column_from_table($column, $table){
	global $connection;
	$query = "SELECT * FROM $table ORDER BY word ASC";
	$result = mysqli_query($connection, $query);
	while($row = mysqli_fetch_assoc($result)){ //loop through the rows
		$output = '<div class = "entry">';
		$output .= "<a href = \"word.php?id=";
		$output .= urlencode($row["id"]);
		$output .= "\">";
		$output .= $row["word"];
		$output .= "</a>";
		$output .= '</div>';
		echo $output;
	}
	
}

//Delete function. Grabs the id from the url then compares it to the id in the row 
//and deletes the appropriate row
function delete_word(){
	global $connection;
	$url_id = $_GET['id'];
	if ($executed = mysqli_prepare($connection, 'DELETE FROM words WHERE id =?')){
		//binds parameters for markers (i=integer)
		mysqli_stmt_bind_param($executed, "i", $url_id);
		//execute the query
		if(mysqli_stmt_execute($executed)){
		header("Refresh:1; url=index.php");
		echo '<div class = "banner">';
		echo "Entry Deleted! Redirecting back to the homepage...";
		echo '</div>';
		}
		else{
			echo "ERROR";
		}
		//close statement
		mysqli_stmt_close($executed);
		
	}
}

//Update function. Sets word to new word based on the id in the url.
function update_word($word){
	global $connection;
	$url_id = $_GET['id'];
	if ($updated = mysqli_prepare($connection, "UPDATE words SET word=('$word') WHERE id = ?")){
		//binds parameters for markers (i=integer)
		mysqli_stmt_bind_param($updated, "i", $url_id);
		//execute the query
		if(mysqli_stmt_execute($updated)){
		header("Refresh:1; url=index.php");
		echo '<div class = "banner">';
		echo "Entry Updated! Redirecting back to the homepage...";
		echo '</div>';
		}
		else{
			echo "ERROR";
		}
		//close statement
		mysqli_stmt_close($updated);
		
	}
}

function search_word($word){
	global $connection;
	$cleaned_word = clean("$word");
	$query = "SELECT * FROM words WHERE word=('$cleaned_word')";
	$result = mysqli_query($connection, $query);
	if(mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_assoc($result)){ //loop through the rows
			$output = '<div class = "entry">';
			$output .= "<a href = \"word.php?id=";
			$output .= urlencode($row["id"]);
			$output .= "\">";
			$output .= $row["word"];
			$output .= "</a>";
			$output .= '</div>';
			echo $output;
		}
	}
	else{
		echo "<div id = 'notfound'>Looks like this word doesn't exist yet, idiot<br/><a href='index.php'>Go back</a></div>";
	}
}

function get_rows_from_table($table){
	global $connection;
	$query = "SELECT * FROM $table";
	$result = mysqli_query($connection, $query);
	return $result;
}

//makes $result an assoc array and then sticks it in the data array. Need it prevent duplicate words in the database, ya feel?
function convert_result_to_array($result){
	$data = [];
	while($info=mysqli_fetch_assoc($result)){
		$data[] = $info;
	}
	return $data;
}

function check_for_duplicate($input){
	$words_array = convert_result_to_array(get_rows_from_table("words"));
	foreach($words_array as $value){
		if(strtolower($input) == strtolower($value["word"])){
			return true;
		}
	}
}

?>