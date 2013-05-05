<?
define("RelativePath", "..");
define("PathToCurrentPage", "/services/");
define("FileName", "getScheduleDetail.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");

$fechadesde = $_REQUEST['fd'];
$fechahasta = $_REQUEST['fh'];
$turno 		= $_REQUEST['t'];

$db = new clsDBConnection2();

$db->query("call getSchedule2('".$fechadesde."','".$turno."')");

$db->next_record();

/*echo $db->Errors->ToString();*/

echo '<?xml version="1.0" encoding="UTF-8" ?>
';
//$resp = htmlspecialchars(utf8_encode($db->f(txtResp)),ENT_COMPAT|ENT_IGNORE,'UTF-8',false);
//$resp = htmlspecialchars_decode(htmlspecialchars($db->f(txtResp),ENT_COMPAT|ENT_IGNORE,'ISO-8859-1',false));
//$resp = htmlentities($db->f(txtResp),ENT_COMPAT|ENT_IGNORE,'ISO-8859-1',false);
//$resp = $db->f(txtResp);

$resp = utf8_encode($db->f(txtResp));
//$resp = htmlentities(utf8_encode($db->f(txtResp)),ENT_COMPAT|ENT_IGNORE,'UTF-8',false);

//$resp = str_replace("&lt;", "<", $resp);
//$resp = str_replace("&gt;", ">", $resp);
echo($resp);

$db->close();


?>