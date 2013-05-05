<?php 
session_start();
if(empty($_SESSION['UserID']))
{
	header('Location: login.php');
	exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<link rel='stylesheet' type='text/css' href='cupertino/theme.css' />
<link rel='stylesheet' type='text/css' href='fullcalendar/fullcalendar.css' />
<link rel='stylesheet' type='text/css' href='fullcalendar/fullcalendar.print.css' media='print' />
<link rel='stylesheet' type='text/css' href='styles.css' />
<script type='text/javascript' src='jquery/jquery-1.5.2.min.js'></script>
<script type='text/javascript' src='jquery/jquery-ui-1.8.11.custom.min.js'></script>
<script type='text/javascript' src='fullcalendar/fullcalendar.min.js'></script>
<script type='text/javascript' src='jquery/custom-form-elements.js'></script>
<script type='text/javascript' src='script.js'></script>
<link rel='stylesheet' type='text/css' href='instructores.css' />

</head>
<body>