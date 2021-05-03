<?php
//start session
session_start();
include 'additionals/autoloader.php';
if(!isset($_SESSION['status']))
{
    header("Location: index.php");
}

$myStudentController = new StudentController();
$student = $myStudentController->getStuByStudentID($_SESSION['user']);

?>
<!DOCTYPE html>
<html>
<head>
<title>Student Menu Page</title>
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
.greeting{
  position: sticky;
  float: left;
  color: #000000;
  text-align: center;
  padding:20px;
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
		<h1><br>Student Menu Page<br><br></h1>
	</div>

</div>

<div class="containerBody">
		<a href="ViewInformationCardPage.php"><button>View Information Card</button></a>
		<a href="ViewYourGroupPage.php"><button>View Your Group</button></a>
		<a href="PeerReviewPage.php"><button>Peer Review</button></a>
		<a href="ArtifactReviewPage.php"><button>Artifact Review</button></a>
</div>


</body>
</html>
