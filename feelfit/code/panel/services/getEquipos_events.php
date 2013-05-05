<?php
//BindEvents Method @1-C463DDD8
function BindEvents()
{
    global $equipamiento;
    $equipamiento->CCSEvents["BeforeShowRow"] = "equipamiento_BeforeShowRow";
}
//End BindEvents Method

//equipamiento_BeforeShowRow @2-3B71FFDE
function equipamiento_BeforeShowRow(& $sender)
{
    $equipamiento_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $equipamiento; //Compatibility
//End equipamiento_BeforeShowRow

//Custom Code @6-2A29BDB7
// -------------------------
    $equipamiento->id->SetValue(htmlspecialchars($equipamiento->DataSource->id->GetValue()));
	$equipamiento->codigo->SetValue(htmlspecialchars(utf8_encode($equipamiento->DataSource->codigo->GetValue())));
	//$equipamiento->descripcion->SetValue(htmlspecialchars($equipamiento->DataSource->descripcion->GetValue(),ENT_COMPAT|ENT_IGNORE,'UTF-8'));
	$equipamiento->descripcion->SetValue(htmlspecialchars(utf8_encode($equipamiento->DataSource->descripcion->GetValue()),ENT_COMPAT|ENT_IGNORE,'UTF-8'));
// -------------------------
//End Custom Code

//Close equipamiento_BeforeShowRow @2-43125C70
    return $equipamiento_BeforeShowRow;
}
//End Close equipamiento_BeforeShowRow


?>
