<?php
session_start();
include 'additionals/autoloader.php';
$a = new ArtifactView();
$a->showArtifacts( );
?>
<!DOCTYPE html>
<html>
<head>
<style>
.container {
  width: 500px;
  clear: both;
}

.container input {
  width: 100%;
  clear: both;
}
</style>
</head>
<body>

<h1>Select the group name and artifact</h1>
<div class="container">
  <form method="post" action="artifact_review.php">
    GroupName:<input type="text" name="groupname">
    ArtifactName:<input type="text" name="artifactname">
    Comment:<textarea rows="5" cols="80" name="TITLE">
    </textarea>
    <input type="submit" value="Submit comment" name="login">
</form>
<?php
if(isset($_POST['login']))
{
     $asd = new ArtifactComment();
     $asd->insertArtifactCommentToDB($_POST["TITLE"],$_POST["groupname"],
     $_SESSION['user'],date('Y-m-d H:i:s'),$_POST["artifactname"]);
     $x = new ArtifactCommentView();
     $x->showArtifactComments();
}
?>
</div>
</body>
</html>
