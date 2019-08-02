<?php include('server.php') ?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</style>
</head>
<body>
  <nav class="navtop">
    <div>
      <h1>Online Test</h1>
    </div>
  </nav>
  <div class="a">
  <form method="post" action="login.php">
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>" required>
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn1" name="reg_user">Login</button>
  	</div>
  </form>
</div>
</body>
</html>
