<?php
session_start();

$username = "";
$errors = array();

$db = mysqli_connect('localhost', 'root', '', 'quiz');

if (isset($_POST['reg_user'])) {

  $username = mysqli_real_escape_string($db, $_POST['username']);

  $user_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
      $_SESSION['id'] = $user['id'];
  	  header('Location: select.php');
      exit();
}

  else {
  	$query = "INSERT INTO users (username) VALUES('$username')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now registered";
    $_SESSION['id'] = $user['id'];
  	header('location: select.php');
  }
}
