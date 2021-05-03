<?php
include 'additionals/autoloader.php';

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
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.bodyText {
    color: #000000;
    display: flex;
    text-align: center;
    justify-content: center;
    align-items: center;
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
  width: 20%;
}

.middlemiddle{
  width: 20%;
}

.right {
  width: 40%;
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
		<a href="LogOut.php">Log Out</a>
		<a href="HelpPage.php">Help</a>
		<a href="HostMainPage.php">Home</a>
</div>

<div class="containerTitle">

	<div class="avatar">
		<img src="snitch.png" alt="Avatar" style="top:03%; left:50%; width:100px;">
	</div>
	<div class="pageTitle">
		<h1><br>Settings Page<br><br></h1>
	</div>

</div>
<?php
  if(isset($_POST['shuffle']))
  {
    $group = new GroupController();
    $group->shuffleStudent($_POST["section"]);
  }
 ?>
<div class="containerBody">
	<div class="row">
		<div class="column left" style="background-color:#f19da7;">
			<div class="bodyText">
				<label for="visibility"><br>Visibility Option</label><br>
                </div>
               <input type="submit" value="On" name="vis_on">
               <input type="submit" value="Off" name="vis_off">
               <form method="post" action="SettingsHostPage.php">
         <br><br><br><br>
            <input type="text" placeholder="Enter section" name="section" size="8" >
            <input type="submit" value="Shuffle Remaining Students" name="shuffle">
            </form>
         <br><br><br><br>
			<div class="bodyText">
            <a href="CloseCoursePage.php"><button>Close Course</button></a>
			</div>
		</div>
		<div class="column middle" style="background-color:#f19da7;">
         <div class="bodyText">
               <a href="CreateGroups.php"><button>Create Groups</button></a>
			</div>
         <br><br>
         <div class="bodyText">
               <a href="ChangeGroupsPage.php"><button>Change Groups</button></a>
			</div>
         <br><br>
         <div class="bodyText">
               <a href="DeleteGroups.php"><button>Delete Groups</button></a>
			</div>
		</div>
    <div class="column middlemiddle" style="background-color:#f19da7;">
      <?php
        $deadlineView = new DeadlineView();
        $deadlineView->showAllDeadlines();
       ?>
    </div>
		<div class="column right" style="background-color:#f19da7;">

      <form method="post" action="SettingsHostPage.php">
			<table style="width:80%">
				<tr>
					<th colspan="2" style="text-align:center">Set Deadlines</th>
				</tr>
				<tr>
					<td style="text-align:center">ASSIGNMENT</td>
					<td style="text-align:center">DEADLINE<br>(yy-mm-dd)</td>
				</tr>
				<tr>
					<td>Analysis Report IT1</td>
					<td><input type="text" placeholder="Enter deadline" name="dl_ar1" size="10" ></td>
				</tr>
            <tr>
					<td>Analysis Report IT2</td>
					<td><input type="text" placeholder="Enter deadline" name="dl_ar2" size="10"></td>
				</tr>
            <tr>
					<td>Design Report IT1</td>
					<td><input type="text" placeholder="Enter deadline" name="dl_dr1" size="10" ></td>
				</tr>
            <tr>
					<td>Design Report IT2</td>
					<td><input type="text" placeholder="Enter deadline" name="dl_dr2" size="10" ></td>
				</tr>
            <tr>
					<td>Final Report</td>
					<td><input type="text" placeholder="Enter deadline" name="dl_fr" size="10"></td>
				</tr>
            <tr>
               <td colspan="2" style="text-align:center"><input type="submit" value="Save Changes" name="saveChanges"></th>
            </tr>
			</table>
      <?php
      $deadline = new DeadlineController();

      if(isset($_POST['saveChanges']))
      {
        if($_POST["dl_ar1"] != "")
        {
          $name = "Analysis Report IT1";
          $deadline->insertDeadline($name, $_POST["dl_ar1"]);
        }
        if($_POST["dl_ar2"] != "")
        {
          $name = "Analysis Report IT2";
          $deadline->insertDeadline($name, $_POST["dl_ar2"]);
        }

        if($_POST["dl_dr1"] != "")
        {
          $name = "Design Report IT1";
          $deadline->insertDeadline($name, $_POST["dl_dr1"]);
        }

        if($_POST["dl_dr2"] != "")
        {
          $name = "Design Report IT2";
          $deadline->insertDeadline($name, $_POST["dl_dr2"]);
        }

        if($_POST["dl_fr"] != "")
        {
          $name = "Final Report";
          $deadline->insertDeadline($name, $_POST["dl_fr"]);
        }

        echo "<meta http-equiv='refresh' content='0'>";
      }

       ?>
    </form>
		</div>
	</div>
</div>


</body>
</html>
