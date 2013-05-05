<?php
//BindEvents Method @1-458A8C5F
function BindEvents()
{
    global $asistenciaalumno;
    $asistenciaalumno->Navigator->CCSEvents["BeforeShow"] = "asistenciaalumno_Navigator_BeforeShow";
    $asistenciaalumno->ds->CCSEvents["BeforeBuildSelect"] = "asistenciaalumno_ds_BeforeBuildSelect";
}
//End BindEvents Method

//asistenciaalumno_Navigator_BeforeShow @28-49E7FAD2
function asistenciaalumno_Navigator_BeforeShow(& $sender)
{
    $asistenciaalumno_Navigator_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $asistenciaalumno; //Compatibility
//End asistenciaalumno_Navigator_BeforeShow

//Hide-Show Component @29-0DB41530
    $Parameter1 = $Container->DataSource->PageCount();
    $Parameter2 = 2;
    if (((is_array($Parameter1) || strlen($Parameter1)) && (is_array($Parameter2) || strlen($Parameter2))) && 0 >  CCCompareValues($Parameter1, $Parameter2, ccsInteger))
        $Component->Visible = false;
//End Hide-Show Component

//Close asistenciaalumno_Navigator_BeforeShow @28-34383A37
    return $asistenciaalumno_Navigator_BeforeShow;
}
//End Close asistenciaalumno_Navigator_BeforeShow

//asistenciaalumno_ds_BeforeBuildSelect @5-C884AD64
function asistenciaalumno_ds_BeforeBuildSelect(& $sender)
{
    $asistenciaalumno_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $asistenciaalumno; //Compatibility
//End asistenciaalumno_ds_BeforeBuildSelect

//Custom Code @62-2A29BDB7
// -------------------------
//Hay que formatear
		//2009-08-26 00:00:00.000
		//26/08/2009
		$y = substr(CCGetParam('s_fdesde',''),6,4);
		$m = substr(CCGetParam('s_fdesde',''),3,2);
		$d = substr(CCGetParam('s_fdesde',''),0,2);
		$fd = $y."-".$m."-".$d;
		$y = substr(CCGetParam('s_fhasta',''),6,4);
		$m = substr(CCGetParam('s_fhasta',''),3,2);
		$d = substr(CCGetParam('s_fhasta',''),0,2);
		$fh = $y."-".$m."-".$d;

    $db = new clsDBConnection2();
	$sql = "call getAsistencias('".$fd."','".$fh."',".CCGetParam('s_alumno',0).")";
	//var_dump($sql);
	$db->query($sql);
	// -------------------------
//End Custom Code

//Close asistenciaalumno_ds_BeforeBuildSelect @5-B409EA3A
    return $asistenciaalumno_ds_BeforeBuildSelect;
}
//End Close asistenciaalumno_ds_BeforeBuildSelect


?>
