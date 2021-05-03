<?php
session_start();
include 'additionals/autoloader.php';
$myStudentController = new StudentController();
$student = $myStudentController->getStuByStudentID($_SESSION['user']);
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

.viewContainer{
  width: %90;
	overflow: hidden;
	text-align: center;
	background: #f19da8;
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
  height: 300px; /* Should be removed. Only for demonstration */
}

.left {
  width: 50%;
}

.right {
  width: 50%;
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
		<h1><br>Add Students to Groups<br><br></h1>
	</div>

</div>
<div class="viewContainer">
  <div class="column left">
<?php
$stu = new StudentView();
$stu->showStudentsByGroup(0, $student['section']);
 ?>

  </div>
  <div class="column right">
  <?php

    $gtu = new GroupView();
    $gtu->showAllGroups();
   ?>

  </div>
</div>

<?php

  if(isset($_POST['submit']))
  {
    $studentx = new GroupController();
    $st = new StudentController();
    $stt = $st->getStuByStudentID($_POST["email"]);
    if(count($stt) == 0)
    {
      echo "Enter a valid id";
    }else {
      $studentx->addStudentGroup($_POST["email"],$stt['section'], $_POST["psw"]);
    //  $stu->showStudentsByGroup(0);

    }

echo "<meta http-equiv='refresh' content='0'>";
  }
 ?>
 <div class="containerBody">
   <form method="post" action="AddStudentsToGroupsPage.php">
     <div class="bodyText">
         <label for="email"><br>Student ID</br></label>
     </div>
     <input type="text" placeholder="Enter Student ID" name="email" required>

     <div class="bodyText">
       <label for="psw"><br>Group Number</br></label>
     </div>
     <input type="text" placeholder="Enter Group Number" name="psw" required>
   <br>
   <br>
     <input type="submit" value="Login" name="submit">
     <br>
     <br>


     </form>

 </div>

</body>
</html>
