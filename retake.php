<?php
session_start();

$db = new mysqli("localhost", "root", "", "quiz");
?>
 <!DOCTYPE HTML>
<html>
<head>
<title>Result</title>
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
	<form action="select.php" method="post">
	<input type="submit" value="New test">
	</form>

	<input onclick="change()" type="button" id="btn" value="Display"></input>
  <script>
	function change(){
    table.style.display='block';
    }
  </script>

	<?php
	$id = $_SESSION['id'];
	$test = mysqli_query($db, "SELECT * FROM test WHERE id = $id ORDER BY tid DESC LIMIT 1");
	while ($row = mysqli_fetch_array($test)) { ?>
		<p> The result of test is <?php echo $row['tpoints']; ?>/10 </p>
		<?php
}?>

  <table style="display:none" id="table">
   <thead>
     <tr>
       <th>Number</th>
       <th>Points</th>
     </tr>
   </thead>
   <tbody>

		 <?php

		 $id = $_SESSION['id'];
		 $test = mysqli_query($db, "SELECT * FROM test WHERE id = $id");

		 	$i = 1; while ($row = mysqli_fetch_array($test)) { ?>

		 		<tr>
		 			<td class="number"> <?php echo $i; ?> </td>
		 			<td class="tpoints"> <?php echo $row['tpoints']; ?>/10</td>

		 	</tr>

		 <?php $i++; } ?>

     </tbody>
   </table>
 </body>
</html>
