<?php
session_start();
unset($_SESSION["user"]);
unset($_SESSION["status"]);
session_destroy();
header("Location:	index.php");
?>
