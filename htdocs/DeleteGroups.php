<?php
include 'additionals/autoloader.php';
session_start();

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
  height: 300px; /* Should be removed. Only for demonstration */
}

.left, .middle {
  width: 25%;
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
}
th, td {
  padding: 5px;
  text-align: left;
}


</style>
</head>
<body>

<div class="topBar">
		<a href="HomePage.php">Log Out</a>
		<a href="HelpPage.php">Help</a>
		<a href="HostMainPage.php">Home</a>
</div>

<div class="containerTitle">

	<div class="avatar">
		<img src="snitch.png" alt="Avatar" style="top:03%; left:50%; width:100px;">
	</div>
	<div class="pageTitle">
		<h1><br>Delete Groups<br><br></h1>
	</div>

</div>
<?php
$gr = new GroupController();
if(isset($_POST['saveChanges']))
{
  $gr->deleteGroups($_POST["sectionNum"], $_POST["groupNum"]);
}
 ?>
<div class="containerBody">
	<div class="row">
    <form method="post" action="DeleteGroups.php">
			<table style="width:50%">
				<tr>
					<td>Section Number</td>
					<td><input type="text" placeholder="Enter section number" name="sectionNum" size="15" required></td>
				</tr>
            <tr>
					<td>Group Number</td>
					<td><input type="text" placeholder="Enter group number" name="groupNum" size="15" required></td>
				</tr>
			</table>
	</div>
   <br>
   <div class="bodyText">
      <input type="submit" value="Save Changes" name="saveChanges">
   </div>
 </form>
</div>

</body>
</html>
