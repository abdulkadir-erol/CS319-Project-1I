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
    <input type="text" name="email">
    <input type="text" name="password">
    <input type="submit" value="click" name="login">
</form>

<form method="post" action="index.php">
	<input type="text" name="email">
	<input type="text" name="password">
	<input type="text" name="studentID">
	<input type="submit" value="click" name="signup">
</form>
<?php
        if(isset($_POST['login']))
        {
						 $asd = new StudentController();
             $asd->validateStudent($_POST["email"],$_POST["password"]);
        }

        if(isset($_POST['signup']))
        {
						 $asd = new StudentController();
             $asd->createStudent($_POST["email"],$_POST["password"],$_POST["studentID"],"",0,0);
        }
?>

</div>
</body>
</html>
