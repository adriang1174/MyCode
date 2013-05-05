<?php
//BindEvents Method @1-EE8FAEFE
function BindEvents()
{
    global $asistenciaalumno;
    $asistenciaalumno->Navigator->CCSEvents["BeforeShow"] = "asistenciaalumno_Navigator_BeforeShow";
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


?>
