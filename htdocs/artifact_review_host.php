<?php
//start session
session_start();
include 'additionals/autoloader.php';
if(!isset($_SESSION['status']))
{
    header("Location: index.php");
}

$myStudentController = new StudentController();
$myArtifactView = new ArtifactView();
$student = $myStudentController->getStuByStudentID($_SESSION['user']);
$myArtifactComment  = new ArtifactCommentView();
?>
<!DOCTYPE html>
<html>
<head>
<title>Artifact Review Page</title>
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

table, th, td {
  border: 1px solid black;
  border-collapse: collapse;

}
th, td {
  padding: 5px;
  text-align: center;
}

.center {
  margin-left: auto;
  margin-right: auto;
}



</style>
</head>
<body>

<div class="topBar">
  <div class="greeting">
      <?php echo "Welcome to SNITCH," ?>
  </div>
		<a href="LogOut.php">Log Out</a>
		<a href="HelpPage.php">Help</a>
		<a href="HostMainPage.php">Home</a>
</div>

<div class="containerTitle">

	<div class="avatar">
		<img src="snitch.png" alt="Avatar" style="top:03%; left:50%; width:100px;">
	</div>
	<div class="pageTitle">
		<h1><br>Artifact Review Page<br><br></h1>
	</div>

</div>

<div class="containerBody">
  <?php $myArtifactView->showArtifacts(); ?>
  <form method="post" action="artifact_review_host.php">
  <br><br>
  <div class="bodyText">
      <label for="psw"><br>Group Num</br></label>
  </div>
    <input type="text" placeholder="Enter Group Number" name="groupnum" required>
	<br><br>
	<label for="selectReview">Select Artifact</label>
	<br>
	<select name="selectReview" id="selectReview" multiple>
		<option value="Analysis Report IT1">Analysis Report IT1</option>
		<option value="Analysis Report IT2">Analysis Report IT2</option>
		<option value="Design Report IT1">Design Report IT1</option>
		<option value="Design Report IT2">Design Report IT2 <link rel="import" href="">2</option>
		<option value="Final Report">Final Report</option>
	</select>
	<br><br><br>
		<label for="artifactComment">Comment on Artifact</label>
		<br><br>
		<textarea  name="artifactComment" rows="10" cols="50">Add a comment about artifact</textarea>
    <br>
    <br>
      <input type="submit" value="Submit Review" name="submit">
    <br>
    <br>
  </form>
  <?php
  $myArtifactComment->showArtifactComments();
   ?>
  <?php

          if(isset($_POST['submit']))
          {
               $myArtifactCommentController = new ArtifactCommentController();
               $result = $myStudentController->getStuByStudentGroup($_POST["groupnum"][1],$_POST["groupnum"][0]);
               if (count($result ) == 0)
               {
                 echo "The group you have entered does not exist.";
               }
               else {
                 $myArtifactCommentController->uploadArtifactComment($_POST["artifactComment"],
                                                              $_POST["groupnum"],
                                                              $_SESSION["user"],
                                                              date('Y-m-d H:i:s'),
                                                              $_POST["selectReview"]);
               }


          }
  ?>
</div>


</body>
</html>
