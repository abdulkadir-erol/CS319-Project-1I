<?php
//start session
session_start();
include 'additionals/autoloader.php';

?>

<!DOCTYPE html>
<html>
<head>
	<title>Pear Host Login</title>
</head>
<body>
<div class="container">
  <form method="post" action="hosthome.php">
    <input type="text" name="email">
    <input type="text" name="password">
    <input type="submit" value="click" name="login">
</form>


<?php
        if(isset($_POST['login']))
        {
						 $asd = new HostController();
             $asd->validateHost($_POST["email"],$_POST["password"]);
             header('location:artifact_review_host.php');
        }

?>

</div>
</body>
</html>
