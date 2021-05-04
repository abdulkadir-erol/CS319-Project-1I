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
$student = $myStudentController->getStuByStudentID($_SESSION['user']);
if($student['group_number']==0)
{
  header("Location: StudentMenuPage.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Peer Review Page</title>
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
input[type=submit] {
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
		<h1><br>Peer Review Page<br><br></h1>
	</div>

</div>
<?php
        if($student['group_number'] != "0" && isset($_POST['review']))
        {
            if( $_POST["studentID"] == $_SESSION['user'] )
            {
              echo "Self criticism is a valuable virtue, however, please enter a review about your team members";
            }
            else if( ((0 > ( $_POST["contScore"])) || (10 <  ( $_POST["contScore"])))  ||
                    ((0 > ( $_POST["partScore"])) || (10 <  ( $_POST["partScore"])))  ||
                    ((0 > ( $_POST["commScore"])) || (10 <  ( $_POST["commScore"])))  ||
                    ((0 > ( $_POST["knowScore"])) || (10 <  ( $_POST["knowScore"])))
                  )
            {
                echo "invalid score";
            }
            else {
              $boolean = false;
              $allStudents = $myStudentController->getStuByStudentGroup($student['group_number'], $student['section']);
              foreach($allStudents as $teamMember)
              {
                if( $teamMember['studentID'] ==$_POST["studentID"] )
                {
                    $boolean = true;
                }
              }

              if($boolean)
              {
                $myStudentCommentController = new StudentCommentController();
                $myStudentCommentController->insertDB($_POST["peerreview"],$_POST["studentID"],
                                            $_SESSION['user'], date('Y-m-d H:i:s'),
                                            $_POST["contScore"],
                                            $_POST["partScore"],
                                            $_POST["commScore"],
                                            $_POST["knowScore"]);
              }
              else {
                echo "It is nice to see that you are eager to review others who is not in your group, nevertheless, please enter an ID beloging to one of your peers.";
              }

            }

        }
?>
<div class="containerBody">
	<label for="peerSelect">Your Group Members</label>
	<br><br>
  <?php
    $myStudentView->showStudentsByGroup($student['group_number'],$student['section']);
   ?>
	<br>
  <form method="post" action="PeerReviewPage.php">
	<div class="bodyText">
		<label for="studentid"><br>Student ID</br></label>
	</div>
    <input type="text" placeholder="Enter studentID" name="studentID" required>

    <div class="bodyText">
  		<label for="contribution"><br>Contribution Score(1-10)</br></label>
  	</div>
      <input type="text" placeholder="Enter contribution score" name="contScore" required>


    <div class="bodyText">
    		<label for="communication"><br>Communication Score(1-10)</br></label>
  	</div>
        <input type="text" placeholder="Enter participation score" name="commScore" required>



    <div class="bodyText">
          <label for="knowledge"><br>Knowledge Score(1-10)</br></label>
    </div>
          <input type="text" placeholder="Enter knowledge score" name="knowScore" required>




    <div class="bodyText">
        <label for="participation"><br>Participation Score(1-10)</br></label>
    </div>
        <input type="text" placeholder="Enter participation score" name="partScore" required>
    <div>
    <br>
    <br>
    <textarea name="peerreview" rows="10" cols="50">Add a comment about your peer</textarea>
  </div>
  <br>
    <input type="submit" value="submit peer review" name="review">
	<br>
	<br>
    </form>

</div>


</body>
</html>
