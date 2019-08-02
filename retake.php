<?php
session_start();

$db = mysqli_connect("localhost", "root", "", "quiz");

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
  <br>

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
    <script>
    var points = "<?php echo $row['tpoints']; ?>";
    if(points <= 2){
      alert("Low score!! You found only "+ points + " out of 10");
    }else if (points == 3 || points == 4 ){
      alert("Below avarage score!! You found "+ points + " out of 10");
    }else if (points == 5 || points==6 ){
      alert("Avarage score!! You found "+ points + " out of 10");
    }else if (points == 7 || points==8 || points==9 ){
      alert("Above avarage score!! You found "+ points + " out of 10");
    }else if (points==10 ){
      alert("Excellent!! You found "+ points + " out of 10");
    }
    </script>
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
     <?php
  $id = $_SESSION['id'];
  $result = mysqli_query($db, "SELECT SUM(tpoints) AS value_sum FROM test WHERE id = $id");
  $row = mysqli_fetch_assoc($result);
  $sum = $row['value_sum'];
  ?>

  <p id="points"></p>
  <p id="level"></p>

  <script>
  var total = "<?php echo $row['value_sum']; ?>";
  document.getElementById("points").innerHTML = "You have "+total+" points";

  if(total < 20){
  document.getElementById("level").innerHTML = "You are currently level 0. Reach 20 points to get Level 1";
  } else if( total >= 20 && total <50){
    document.getElementById("level").innerHTML = "You just reached level 1 and need 50 points overall to get level 2";
  }
  </script>
   </table>

 </body>
</html>
