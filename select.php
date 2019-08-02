<?php
  session_start();
?>

<html>
<head>
	<title>Category</title>
  <link href="style.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>
<body>
  <nav class="navtop">
    <div>
      <h1>Online Test</h1>
      <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
    </div>
  </nav>
<div class="content">
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php
          	echo $_SESSION['success'];
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
    <?php endif ?>
</div>

<div class="box";
<p>Select Category:</p>
    <form action="index.php" method="post">
    <select name="category" id="category">
        <option value="" selected>Any Category</option>
        <option value="9">General Knowledge </option>
        <option value="11">Entertainment: Film</option>
        <option value="12">Entertainment: Music</option>
        <option value="13">Entertainment: Musicals & Theaters</option>
        <option value="14">Entertainment: Television</option>
        <option value="15">Entertainment: Video Games</option>
        <option value="16">Entertainment: Board Games</option>
        <option value="17">Science & Nature</option>
        <option value="18">Science: Computers</option>
    </select>

    <p>Select Difficulty:</p>

    <select name="difficulty" id="difficulty">
        <option value="" selected>Any Difficulty</option>
        <option value="easy">Easy</option>
        <option value="medium">Medium</option>
        <option value="hard">Hard</option>
    </select>
    <br>
    <br>
    <input type="submit" value="Submit" class="btn1">
</div>
</form>
</body>
</html>
<?php
if(isset($_POST['submit'])) {
header('Location: prova1.php');
};
?>
