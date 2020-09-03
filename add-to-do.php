<?php
include_once('config.php');
if($_SERVER['REQUEST_METHOD'] == "POST"){
	// Get data from the REST client
	$name = isset($_POST['name']) ? mysqli_real_escape_string($link, $_POST['name']) : "";
	$due = isset($_POST['due']) ? mysqli_real_escape_string($link, $_POST['due']) : "";
	$class = isset($_POST['class']) ? mysqli_real_escape_string($link, $_POST['class']) : "";
	$id = isset($_POST['id']) ? mysqli_real_escape_string($link, $_POST['id']) : "";
	// Insert data into database
	$sql = "INSERT INTO `todolist`.`tasks` (`name`, `due`, `class`, `id`) VALUES ('$name', '$due', '$class', '$id');";
	$post_data_query = mysqli_query($link, $sql);
	if($post_data_query){
		$json = array("status" => 1, "Success" => "Task has been added successfully!");
	}
	else{
		$json = array("status" => 0, "Error" => "Error adding Task! Please try again!");
	}
}
else{
	$json = array("status" => 0, "Info" => "Request method not accepted!");
}
@mysqli_close($link);
// Set Content-type to JSON
header('Content-type: application/json');
echo json_encode($json);

?>