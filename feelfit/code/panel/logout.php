<?php
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "logout.php");
include(RelativePath . "/Common.php");
include(RelativePath . "/Template.php");
include(RelativePath . "/Sorter.php");
include(RelativePath . "/Navigator.php");
$Redirect = 'login.php';
CCLogoutUser();
header("Location: " . $Redirect);
?>
