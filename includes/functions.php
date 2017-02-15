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

function add_page($word){
	global $connection;
	$cleaned_word = clean("$word");
	$query = "INSERT INTO pages (page) VALUES ('$cleaned_word')";
	$result = mysqli_query($connection, $query);
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

//wasn't fleshed out well. Need to rewatch lynda tutorial and redo this and make an update function as well.
function delete_word(){
	global $connection;
	$url_id = $_GET['id'];
	$query = "DELETE FROM words WHERE id = '".$url_id."'";
	if(mysqli_query($connection, $query)){
		echo "Deleted!";
		echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Succesfully Updated')
    window.location.href='index.php';
    </SCRIPT>");
	}
	else{
		echo "ERROR";
	}
}

?>