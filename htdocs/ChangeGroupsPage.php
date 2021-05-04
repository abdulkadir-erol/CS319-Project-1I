<?php
include 'additionals/autoloader.php';
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

<?php
  $requestGroup = new GroupView();
  $requests = $requestGroup->getGroupRequests();
  $requestGroupNum = 0;
  $requestGroupTarget = 0;
  $requestStudentId = 0;
  $gr = new GroupController();
$requestGroupSection = 0;
$requestGroupNums = 0;
$flag = True;

  if(count($requests) > 0 && $flag)
  {
    $requestStudentId = $requests[0]['student_id'];
    $stuController = new StudentController();
    $requestGroupNum = $stuController->getStuByStudentID($requests[0]['student_id']);
    $requestGroupNums = $requestGroupNum['group_number'];
    $requestGroupSection = $requestGroupNum['section'];
    $requestGroupTarget = $requests[0]['target_group'];

  }

  if(isset($_POST['deny']) && count($requests) > 0)
  {
    $gr->denyRequests($requestStudentId, $requestGroupTarget);
    $requests = $requestGroup->getGroupRequests();
    if(count($requests) != 0 )
    {
      $requestStudentId = $requests[0]['student_id'];
      $stuController = new StudentController();
      $requestGroupNum = $stuController->getStuByStudentID($requests[0]['student_id']);
      $requestGroupNums = $requestGroupNum[0]['group_number'];
      $requestGroupSection = $requestGroupNum[0]['section'];
      $requestGroupTarget = $requests[0]['target_group'];
    }


unset($_POST['deny']);
  }else if(isset($_POST['approv']) && count($requests) > 0)
  {
    $gr->changeGroupRequests($requestStudentId, $requestGroupTarget);
    $requests = $requestGroup->getGroupRequests();
    if(count($requests) != 0 )
    {
      $requestStudentId = $requests[0]['student_id'];
      $stuController = new StudentController();
      $requestGroupNum = $stuController->getStuByStudentID($requests[0]['student_id']);
      $requestGroupNums = $requestGroupNum[0]['group_number'];
      $requestGroupSection = $requestGroupNum[0]['section'];
      $requestGroupTarget = $requests[0]['target_group'];
    }
unset($_POST['approv']);
$flag = True;
    echo "changed";
  }else if(count($requests) == 0)
  {
    echo "There is no request";
  }


 ?>
<div class="containerTitle">

	<div class="avatar">
		<img src="snitch.png" alt="Avatar" style="top:03%; left:50%; width:100px;">
	</div>
	<div class="pageTitle">
		<h1><br>Change Groups<br><br></h1>
	</div>

</div>
<form method="post" action="ChangeGroupsPage.php">
<div class="containerBody">
	<label for="labels">Student with ID <?php echo $requestStudentId; ?> requests to transfer from <?php echo $requestGroupSection.$requestGroupNums; ?> to <?php echo $requestGroupTarget ?>.</label>
   <br><br>
   <input type="submit" value="Deny" name="deny">
   <input type="submit" value="Approve" name="approv">
</div>
</form>

</body>
</html>
