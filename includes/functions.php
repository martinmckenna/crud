<?php
include('includes/connection/databaseconnect.php');

//get the info from the row and print it to the page 
function print_info(){
	global $connection;
	$url_id = $_GET['id'];
	$query = "SELECT * FROM words WHERE id = '".$url_id."' LIMIT 1";
	$result = mysqli_query($connection, $query);
	while($row = mysqli_fetch_row($result)){
		echo $row[1];
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
	$query = "SELECT * FROM $table";
	$result = mysqli_query($connection, $query);
	while($row = mysqli_fetch_assoc($result)){ //loop through the rows
		$output = "<a href = \"word.php?id=";
		$output .= urlencode($row["id"]);
		$output .= "\">";
		$output .= $row["word"];
		$output .= "</a>";
		echo $output;
		echo "</br>";
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
		mysqli_stmt_execute($executed);
		echo "Deleted!";
		echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Succesfully Updated')
    window.location.href='index.php';
    </SCRIPT>");
		//close statement
		mysqli_stmt_close($executed);
		
	}
	else{
		echo "ERROR";
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
		mysqli_stmt_execute($updated);
		echo "Deleted!";
		echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Succesfully Updated')
    window.location.href='index.php';
    </SCRIPT>");
		//close statement
		mysqli_stmt_close($updated);
		
	}
	else{
		echo "ERROR";
	}
}

?>