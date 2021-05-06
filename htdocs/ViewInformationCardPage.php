<?php
//start session
session_start();
include 'additionals/autoloader.php';
if(!isset($_SESSION['status']))
{
    header("Location: index.php");
}

$myStudentController = new StudentController();
$myStudentCommentView = new StudentCommentView();
$myDeadlineView = new DeadlineView();
$student = $myStudentController->getStuByStudentID($_SESSION['user']);

?>
<!DOCTYPE html>
<html>
<head>
<title>View Information Card Page</title>
<style>

/* Top Menu Bar of the website */
.topBar {
  background-color: #f19da7;
  overflow: hidden;
}

/* Links in the Top Menu Bar */
.topBar a {
  position: sticky;
  float: right;
  color: #000000;
  text-align: center;
  padding: 18px 16px;
  text-decoration: none;
  font-size: 17px;
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
  top: 100px;
  left: 30px;
}

/* Body */
.containerBody {
  height: 100%;
	width: %90;
	overflow: hidden;
	text-align: center;
	background: #f19da7;
	margin: 10px auto;
	padding: 20px;
}

/* Body Title */
.bodyTitle {
	color: #f2f2f2;
	font-size: 24px;
	display: flex;
	text-align: center;
	font-family: sans-serif;
	justify-content: center;
	align-items: center;
	height: 70px;
}

.greeting{
  position: sticky;
  float: left;
  color: #000000;
  text-align: center;
  padding:20px;
}
/* Set a style for all buttons */
button {
  background-color: #9DD1F1;
  color: black;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 50%;
}

* {
  box-sizing: border-box;
}

/* Create three unequal columns that floats next to each other */
.column {
  float: left;
  padding: 10px;
  height: 300px; /* Should be removed. Only for demonstration */
}

.left {
  width: 18%;
}

.right {
  width: 82%;
}
/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 5px;
  text-align: left;
}


</style>
</head>
<body>

<div class="topBar">
  <div class="greeting">
      <?php echo "Welcome to SNITCH," . $student['name']?>
  </div>
		<a href="LogOut.php">Log Out</a>
		<a href="HelpPage.php">Help</a>
		<a href="StudentMenuPage.php">Home</a>

</div>

<div class="containerTitle">

	<div class="avatar">
		<img src="snitch.png" alt="Avatar" style="top:03%; left:50%; width:100px;">
	</div>
	<div class="pageTitle">
		<h1><br>View Information Card Page<br><br></h1>
	</div>

</div>

<div class="containerBody">
	<div class="row">
		<div class="column left" style="background-color:#f19da7;">
			<div class="profilePic">
				<img src="profilePic.png" alt="Profile Pic" style="top:03%; left:50%; width:100px;">
			</div>
			<div class="bodyText">
				<label for="studentName"><br><?php echo $student['name'];?></br></label>
			</div>
			<div class="bodyText">
				<label for="email"><br><?php echo $student['email'];?></br></label>
			</div>
			<div class="bodyText">
				<label for="studentID"><br><?php echo $student['studentID'];?></br></label>
			</div>
			<br>
			<a href="EditProfilePage.php"><button>Edit Profile</button></a>
      <br>
      <br>
      <br>
          <?php $myDeadlineView->showAllDeadlines(); ?>
		</div>
    	<div class="column right" style="background-color:#f19da7;">
    			<table style="width:80%">
    				<?php $myStudentCommentView->showStudentCommentsByTargetID($_SESSION['user']); ?>
    			</table>
    		</div>
	</div>
</div>

</body>
</html>
