<?php
//BindEvents Method @1-EA8CF9D7
function BindEvents()
{
    global $alumno;
    $alumno->CCSEvents["BeforeShowRow"] = "alumno_BeforeShowRow";
}
//End BindEvents Method

//alumno_BeforeShowRow @2-FEAAE176
function alumno_BeforeShowRow(& $sender)
{
    $alumno_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $alumno; //Compatibility
//End alumno_BeforeShowRow

//Custom Code @13-2A29BDB7
// -------------------------
    	//$equipamiento->codigo->SetValue(htmlspecialchars(utf8_encode($equipamiento->DataSource->codigo->GetValue())));
		$alumno->nombre->SetValue(htmlspecialchars(utf8_encode($alumno->DataSource->nombre->GetValue())));
		$alumno->domicilio->SetValue(htmlspecialchars(utf8_encode($alumno->DataSource->domicilio->GetValue())));
// -------------------------
//End Custom Code

//Close alumno_BeforeShowRow @2-3B495E18
    return $alumno_BeforeShowRow;
}
//End Close alumno_BeforeShowRow


?>
