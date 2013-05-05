<?php
//BindEvents Method @1-88AD0311
function BindEvents()
{
    global $alumno;
    $alumno->comparte->CCSEvents["BeforeShow"] = "alumno_comparte_BeforeShow";
    $alumno->Navigator->CCSEvents["BeforeShow"] = "alumno_Navigator_BeforeShow";
    $alumno->cont->CCSEvents["BeforeShow"] = "alumno_cont_BeforeShow";
    $alumno->activo->CCSEvents["BeforeShow"] = "alumno_activo_BeforeShow";
    $alumno->CCSEvents["BeforeShowRow"] = "alumno_BeforeShowRow";
}
//End BindEvents Method

//alumno_comparte_BeforeShow @45-B01EAC4B
function alumno_comparte_BeforeShow(& $sender)
{
    $alumno_comparte_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $alumno; //Compatibility
//End alumno_comparte_BeforeShow

//Custom Code @48-2A29BDB7
// -------------------------
if($alumno->DataSource->comparte->GetValue() == '1')
	$alumno->comparte->SetValue('Si');
else
	$alumno->comparte->SetValue('No');

// -------------------------
//End Custom Code

//Close alumno_comparte_BeforeShow @45-C1A86254
    return $alumno_comparte_BeforeShow;
}
//End Close alumno_comparte_BeforeShow

//alumno_Navigator_BeforeShow @46-EC7124FC
function alumno_Navigator_BeforeShow(& $sender)
{
    $alumno_Navigator_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $alumno; //Compatibility
//End alumno_Navigator_BeforeShow

//Hide-Show Component @47-0DB41530
    $Parameter1 = $Container->DataSource->PageCount();
    $Parameter2 = 2;
    if (((is_array($Parameter1) || strlen($Parameter1)) && (is_array($Parameter2) || strlen($Parameter2))) && 0 >  CCCompareValues($Parameter1, $Parameter2, ccsInteger))
        $Component->Visible = false;
//End Hide-Show Component

//Close alumno_Navigator_BeforeShow @46-FDDC711E
    return $alumno_Navigator_BeforeShow;
}
//End Close alumno_Navigator_BeforeShow

//alumno_cont_BeforeShow @56-0F20AD86
function alumno_cont_BeforeShow(& $sender)
{
    $alumno_cont_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $alumno; //Compatibility
//End alumno_cont_BeforeShow

//Custom Code @57-2A29BDB7
// -------------------------
$alumno->cont->SetValue($alumno->DataSource->RecordsCount);
// -------------------------
//End Custom Code

//Close alumno_cont_BeforeShow @56-5D9B4038
    return $alumno_cont_BeforeShow;
}
//End Close alumno_cont_BeforeShow

//alumno_activo_BeforeShow @58-D9344774
function alumno_activo_BeforeShow(& $sender)
{
    $alumno_activo_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $alumno; //Compatibility
//End alumno_activo_BeforeShow

//Custom Code @60-2A29BDB7
// -------------------------
if($alumno->DataSource->activo->GetValue() == '1')
	$alumno->activo->SetValue('Si');
else
	$alumno->activo->SetValue('No');

// -------------------------
//End Custom Code

//Close alumno_activo_BeforeShow @58-E7C67574
    return $alumno_activo_BeforeShow;
}
//End Close alumno_activo_BeforeShow

//alumno_BeforeShowRow @11-FEAAE176
function alumno_BeforeShowRow(& $sender)
{
    $alumno_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $alumno; //Compatibility
//End alumno_BeforeShowRow

//Custom Code @55-2A29BDB7
// -------------------------
    if($alumno->DataSource->comparte->GetValue() == '1')
		$alumno->negrita->SetValue("font-weight: bold ");
    else
		$alumno->negrita->SetValue("font-weight: normal ");
// -------------------------
//End Custom Code

//Close alumno_BeforeShowRow @11-3B495E18
    return $alumno_BeforeShowRow;
}
//End Close alumno_BeforeShowRow

//DEL  $alumno->ro





?>
