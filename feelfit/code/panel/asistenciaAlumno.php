<?
define("RelativePath", "..");
define("PathToCurrentPage", "/services/");
define("FileName", "getScheduleDetail.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");

$idAlumno = $_REQUEST['a'];
$idEquipamiento = $_REQUEST['e'];
$idInstructor = $_REQUEST['i'];
$fecha = $_REQUEST['f'];
$asistio = $_REQUEST['as'];

$db = new clsDBConnection2();

$db->query("insert into asistenciaalumno values(".$idAlumno.",".$fecha.",'".$asistio."',".$idEquipamiento.",".$idInstructor.")");
$id = mysql_insert_id();

/*echo $db->Errors->ToString();*/

/*echo('<?xml version="1.0" encoding="UTF-8" ?>');*/
//$resp = htmlspecialchars(utf8_encode($db->f(txtResp)),ENT_COMPAT|ENT_IGNORE,'UTF-8',false);
if ($db->Errors->Count() == 0)
{
$r = '<?xml version="1.0" encoding="UTF-8" ?>
	<Respuesta>
			<Resultado>OK</Resultado>
			<id>'.$id.'</id>
			<Descripcion />
	  </Respuesta>';
}
else
{
$r = '<?xml version="1.0" encoding="UTF-8" ?>
	<Respuesta>
			<Resultado>Error</Resultado>
			<id></id>
			<Descripcion>".htmlspecialchars($db->Errors->ToString())."</Descripcion>
	  </Respuesta>';
}
echo($r);

$db->close();


?>