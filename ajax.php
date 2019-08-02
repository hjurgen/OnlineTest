<?php
session_start();

	$db = new mysqli("localhost", "root", "", "quiz");
	$id = $_SESSION['id'];

  if ($db->connect_errno){
    
	echo "no";
  }

	if (isset($_POST)) {

			$tpoints = $_POST['correct'];
			$db->query("INSERT INTO test (tpoints, id) VALUES ('$tpoints', $id)");

			header('location: retake.php');
	}
?>
