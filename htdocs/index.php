<?php
//start session
session_start();
include 'additionals/autoloader.php';

?>

<!DOCTYPE html>
<html>
<head>
	<title>Pear Student Login</title>
</head>
<body>
<div class="container">
  <form method="post" action="index.php">
    <input type="text" name="username">
    <input type="text" name="password">
    <input type="submit" value="click" name="login">
</form>

<form method="post" action="index.php">
	<input type="text" name="username">
	<input type="text" name="password">
	<input type="submit" value="click" name="signup">
</form>
<?php
        if(isset($_POST['login']))
        {
						 $asd = new StudentController($_POST["username"], $_POST["password"]);
             $asd->validateStudent($_POST["username"],$_POST["password"]);
        }

        if(isset($_POST['signup']))
        {
						 $asd = new StudentController($_POST["username"],$_POST["password"]);
             $asd->createStudent($_POST["username"],$_POST["password"],0,"",0,0);
        }
?>
		    	</div>
		</div>
	</div>
</div>
</body>
</html>
