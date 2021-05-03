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
<title>Edit Profile Page</title>
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
	overflow: auto;
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
input[type=submit] {
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

.left, .right {
  width: 25%;
}

.middle {
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
      <?php echo "Welcome to SNITCH, " . $student['name']?>
		<a href="LogOut.php">Log Out</a>
		<a href="HelpPage.php">Help</a>
		<a href="StudentMenuPage.php">Home</a>
</div>

<div class="containerTitle">

	<div class="avatar">
		<img src="snitch.png" alt="Avatar" style="top:03%; left:50%; width:100px;">
	</div>
	<div class="pageTitle">
		<h1><br>Edit Profile Page<br><br></h1>
	</div>

</div>

<div class="containerBody">
	<div class="row">
		<div class="column left" style="background-color:#f19da7;">
			<div class="profilePic">
				<img src="profilePic.png" alt="Profile Pic" style="top:03%; left:50%; width:120px;">
			</div>

			<br>
			<a href="#"><button>Upload a Photo</button></a>
		</div>

		<div class="column middle" style="background-color:#f19da7;">
      <form method="post" action="EditProfilePage.php">

			<div class="bodyText">
				<label for="psw"><br>Password</label>
			</div>
			<input type="password" placeholder="Enter Password" name="psw" required>

			<div class="bodyText">
				<label for="pswAgain"><br>Password Again</label>
			</div>
			<input type="password" placeholder="Enter Password Again" name="pswAgain" required>

      <br>
      <br>
        <input type="submit" value="Save Changes" name="savechanges">
      <br>
      <br>
    </form>
    <?php
            if(isset($_POST['savechanges']))
            {
                if( $_POST['pswAgain'] == $_POST['psw'])
                {
                   $myStudentController->updateStuInfo($_POST["psw"],$student['studentID']);
                }
                else {
                  echo "The passwords you have entered does not match.";
                }

            }
    ?>
		</div>
		<div class="column right" style="background-color:#f19da7;">
      <form method="post" action="EditProfilePage.php">

			<div class="bodyText">
				<label for="changeGroupID"><br>Group to Change</label>
			</div>
			<input type="text" placeholder="Group to Change" name="changeGroupID" required>

      <br>
      <br>
        <input type="submit" value="Send Request" name="Request">
        <?php
                if(isset($_POST['Request']))
                {

                  if($student['group_number'] == "0")
                  {
                      echo "You can not change something does not exits";
                  }else {
                    $myGroupController = new GroupController();
                    $myGroupController->sendChangeRequest($_SESSION['user'],$_POST['changeGroupID']);
                  }

                }
        ?>
      <br>
      <br>
    </form>
		</div>
	</div>
</div>

</body>
</html>
