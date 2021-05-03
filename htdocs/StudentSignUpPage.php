<?php
//start session
session_start();
include 'additionals/autoloader.php';

?>
<!DOCTYPE html>
<html>
<head>
<title>Student Sign Up Page</title>
<style>

body {
  background-color: white;
  text-align: center;
  color: black;
  font-family: Arial, Helvetica, sans-serif;
}

/* Page Title and Logo */
.containerTitle {
	width: %90;
	overflow: hidden;
	background: #9DD1F1;
	margin: 10px auto;
	padding: 20px;
}

/* Page Title */
.pageTitle {
	color: #000000;
	text-align: center;
	font-family: Lucida Console;
}

/* Logo */
.avatar {
  position: absolute;
  top: 50px;
  left: 30px;
}

/* Body */
.containerBody {
	width: %90;
	overflow: hidden;
	text-align: center;
	background: #f19da7;
	margin: 10px auto;
	padding: 20px;
}

/* Body Title */
.bodyText {
	color: #000000;
	display: flex;
	text-align: center;
	justify-content: center;
	align-items: center;
}

/* Set a style for all buttons */
input[type=submit] {
  background-color: #9DD1F1;
  color: black;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 30%;
}

/* Input fields */
input[type=text], input[type=password] {
  width: 30%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}


</style>
</head>
<body>

<div class="containerTitle">
	<div class="avatar">
		<img src="snitch.png" alt="Avatar" style="top:03%; left:50%; width:100px;">
	</div>
	<div class="pageTitle">
		<h1><br>Student Sign Up Page<br><br></h1>
	</div>

</div>

<div class="containerBody">
  <form method="post" action="StudentSignUpPage.php">
	<div class="bodyText">
		<label for="studentName"><br>Full Name</br></label>
	</div>
    <input type="text" placeholder="Enter Full Name" name="studentName" required>

	<div class="bodyText">
		<label for="studentID"><br>Student ID</br></label>
	</div>
    <input type="text" placeholder="Enter Student ID" name="studentID" required>

	<div class="bodyText">
	<label for="sectionNumber"><br>Section Number</br></label>
	</div>
    <input type="text" placeholder="Enter Section Number" name="sectionNumber" required>

	<div class="bodyText">
		<label for="email"><br>E-mail</br></label>
	</div>
    <input type="text" placeholder="Enter E-mail" name="email" required>

	<div class="bodyText">
      <label for="psw"><br>Password</br></label>
	</div>
    <input type="password" placeholder="Enter Password" name="psw" required>
    <br>
    <br>
      <input type="submit" value="Signup" name="signup">
  	<br>
  	<br>

	<div class="bodyText">
		<span class="psw">Already have an account? <a href="StudentLogInPage.php">Log In</a></span>
    </div>
  </form>
  <?php
          if(isset($_POST['signup']))
          {
  						 $myStudentController = new StudentController();
               $myStudentController->createStudent($_POST["email"],
                                                    $_POST["psw"],
                                                    $_POST["studentID"],
                                                    $_POST["studentName"], "0",
                                                    $_POST["sectionNumber"]);
          header('location:StudentLogInPage.php');
          }
  ?>
</div>

</body>
</html>
