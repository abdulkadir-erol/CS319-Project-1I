<?php
//start session
session_start();
include 'additionals/autoloader.php';
if(!isset($_SESSION['status']))
{
    header("Location: index.php");
}

$stuList = new StudentView();
 ?>
<!DOCTYPE html>
<html>
<head>
<title>Snitch</title>
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
  padding: 14px 16px;
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
  text-align: center;
  border: none;
  cursor: pointer;
}

* {
  box-sizing: border-box;
}

/* Create three unequal columns that floats next to each other */
.column {
  float: left;
  padding: 10px;
   /* Should be removed. Only for demonstration */
}

.left {
  width: 30%;
}

.right {
  width: 70%;
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
  align-content: center;
}
td {
  padding: 5px;
  text-align: left;
}
th {
   text-align: center;
}


</style>
</head>
<body>

<div class="topBar">
		<a href="LogOut.php">Log Out</a>
		<a href="HelpPage.php">Help</a>
		<a href="HostMainPage.php">Home</a>
</div>

<div class="containerTitle">

	<div class="avatar">
		<img src="snitch.png" alt="Avatar" style="top:03%; left:50%; width:100px;">
	</div>
	<div class="pageTitle">
		<h1><br>Student List<br><br></h1>
	</div>



<div class="containerBody">
  <form method="post" action="ViewStudentList.php">

	<div class="row">
    <div class="column left">
    <table align="center">
				<tr>
					<th colspan="4">Student List</th>
				</tr>
            <tr>
					<th>Sorted by: <input type="submit" value="A-Z" name="alphabetic"></th>
               <th><input type="submit" value="GroupNum" name="groupNum"></th>
               <th><input type="submit" value="Section" name="section"></th>
               </tr>
               </table>

               <br><br>

               <?php

                 $parameters = "name";
                 if(isset($_POST['alphabetic']))
                 {
                   $parameters = "name";
                 }else if(isset($_POST['groupNum']))
                 {
                   $parameters = "group_number";
                 }else if(isset($_POST['section']))
                 {
                   $parameters = "section";
                 }
                 $stuList->showStudentList($parameters);
                ?>


</div>
<div class="column right">
  <div class="bodyText">
      <label for="psw">Enter Student ID to get reviews</label>
    </div>
    <input type="text" placeholder="Enter StudentID" name="stuID">
      <input type="submit" value="Get Reviews" name="signup">
 <br><br><br>
  <?php
  $peerComment = new StudentCommentView();
  if(isset($_POST['signup']))
  {
      $peerComment->showStudentCommentsByTargetID($_POST["stuID"]);
  }

   ?>

</div>
	</div>
   <br>
 </form>
</div>

</body>
</html>
