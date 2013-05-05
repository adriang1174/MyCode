<?php
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "inicio.php");
include_once(RelativePath . "/Common.php");

$resp = CCGetUserLogin();

if(empty($resp))
{
	header('Location: login.php');
	exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=windows-1252">
<title>Alumno</title>
<meta content="CodeCharge Studio 4.2.00.040" name="GENERATOR">
<link href="Styles/Basic/Style_doctype.css" type="text/css" rel="stylesheet">
<link href="estilo_menu.css" type="text/css" rel="stylesheet">
</head>
<body>
<table>
<tr>
	<td>
		<img id="Image1" alt="" src="logo_feelfit3.jpg" name="Image1">
    <td>
	<td>
<ul id="menu">
  
  <li><a href="#">Inicio</a> 
  <ul>
    <li><a href="../agenda">Volver a la agenda</a> </li>
 
    <li><a href="logout.php">Salir</a> </li>
 
  </ul>
 </li>
 
  <li><a href="#">Alumnos</a> 
  <ul>
    <li><a href="alumno_list.php">Listado de Alumnos</a> </li>
 
    <li><a href="asistenciaalumn_list.php">Asistencias</a> </li>
 
  </ul>
 </li>
 
  <li><a href="#">Instructores</a> 
  <ul>
    <li><a href="instructor_list.php">Listado de Instructores</a> </li>
 
    <li><a href="disponibilidadi_list.php">Horarios</a> </li>
 
    <li><a href="excepciondispon_maint.php">Cargar inasistencia</a> </li>
 
    <li><a href="excepciondispon_list.php">Listado de inasistencias</a> </li>
 
  </ul>
 </li>
 
  <li><a href="#">Equipamiento</a> 
  <ul>
    <li><a href="equipamiento_list.php">Listado de Equipamiento</a> </li>
 
  </ul>
 </li>
 
  <li><a href="#">Administración</a> 
  <ul>
    <li><a href="movimientofactu_maint.php">Cargar pago de cuota</a> </li>
 	<li><a href="gastos_list.php">Gastos Fijos</a> </li>
    <li><a href="#">Reportes</a> 
		<ul>
				<li><a href="cuotas_pagadas.php">Reporte de cuotas pagadas</a></li>
				<li><a href="cuotas_impagas.php">Reporte de cuotas impagas</a></li>
				<li><a href="reporte_fact.php">Reporte de facturación</a></li>
		</ul>
    </li>
 
  </ul>
 </li>
</ul>
</td>
</tr>
</table>
</body>
</html>