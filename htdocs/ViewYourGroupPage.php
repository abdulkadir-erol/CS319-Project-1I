<?php
//start session
session_start();
include 'additionals/autoloader.php';
if(!isset($_SESSION['status']))
{
    header("Location: index.php");
}
$myStudentController = new StudentController();
$myStudentView = new StudentView();
$myArtifactController = new ArtifactController();
$myArtifactView = new ArtifactView();
$myArtifactCommentView = new ArtifactCommentView();
$student = $myStudentController->getStuByStudentID($_SESSION['user']);
if($student['group_number']==0)
{
  header("Location: StudentMenuPage.php");
}
$artifacts = $myArtifactController->getArtifactByGroup($student["group_number"]);
?>
<!DOCTYPE html>
<html>
<head>
<title>View Your Group Page</title>
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
  position: relative;
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
input[type=submit] {
  background-color: #9DD1F1;
  color: black;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 50%;
}

.column {
  float: left;

}
.left{
  width: 70%;
}

.right{
  width : 30%;
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
		<h1><br>View Your Group Page<br><br></h1>
	</div>

</div>

<div class="containerBody">
	<div class="row">
	<div class="column left" style="background-color:#f19da7;">

        <br>
        <?php
          $myArtifactCommentView->showArtifactCommentsByGroup($student['section'].$student['group_number']);
         ?>
	</div>
	<div class="column right" style="background-color:#f19da7;">
		<table class="center" style="width:50%"	>
        <br>
        <?php
        $myStudentView->showStudentsByGroup($student['group_number'],$student['section']);
        ?>
        <br>
				<?php $myArtifactView->showArtifactsByGroup($student['section'] . $student['group_number']);?>
			</table>
      <br>
      <form method="post" action="ViewYourGroupPage.php">
      <label for="artifacts">Choose an artifact:</label>
      <br>
      <select name="artifacts" id="artifacts">
        <option value="Analysis Report IT 1">Analysis Report IT 1</option>
        <option value="Design Report IT 1">Design Report IT 1</option>
        <option value="Analysis Report IT 2">Analysis Report IT 2</option>
        <option value="Design Report IT 2">Design Report IT 2</option>
        <option value="Final Report ">Final Report </option>
      </select>

    	<div class="bodyText">
          <label for="psw"><br>Link</br></label>
    	</div>
        <input type="text" placeholder="Enter the link" size="30" name="link" required>
      <br>
      <br>
        <input type="submit" value="Submit" name="submit">
    	<br>
    	<br>
    </form>
    <?php
            if(isset($_POST['submit']))
            {
                $current_date = date('Y-m-d H:i:s');
                $deadline = "2023-04-29";
                 if($current_date > $deadline)
                 {
                   echo "The deadline for this artifact has passed";
                 }
                 else {
                   $myArtifactController->uploadArtifact($_POST["artifacts"],$student['section'].$student['group_number']
                   ,$_POST["link"]);
                 }

            }
    ?>
	</div>
	</div>
	<br>


</div>


</body>
</html>
