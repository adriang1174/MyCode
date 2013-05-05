<?php
//BindEvents Method @1-55705AEA
function BindEvents()
{
    global $Report1;
    $Report1->rentabilidad->CCSEvents["BeforeShow"] = "Report1_rentabilidad_BeforeShow";
    $Report1->Navigator->CCSEvents["BeforeShow"] = "Report1_Navigator_BeforeShow";
}
//End BindEvents Method

//Report1_rentabilidad_BeforeShow @79-76FB83C4
function Report1_rentabilidad_BeforeShow(& $sender)
{
    $Report1_rentabilidad_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Report1; //Compatibility
//End Report1_rentabilidad_BeforeShow

//Custom Code @80-2A29BDB7
// -------------------------
    $renta = $Report1->sum_m_importe_1->GetValue() - $Report1->importe->GetValue();
	$Report1->rentabilidad->SetValue($renta);
// -------------------------
//End Custom Code

//Close Report1_rentabilidad_BeforeShow @79-88CC35BA
    return $Report1_rentabilidad_BeforeShow;
}
//End Close Report1_rentabilidad_BeforeShow

//Report1_Navigator_BeforeShow @69-78E652A3
function Report1_Navigator_BeforeShow(& $sender)
{
    $Report1_Navigator_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Report1; //Compatibility
//End Report1_Navigator_BeforeShow

//Hide-Show Component @70-286333C6
    $Parameter1 = $Container->TotalPages;
    $Parameter2 = 2;
    if (((is_array($Parameter1) || strlen($Parameter1)) && (is_array($Parameter2) || strlen($Parameter2))) && 0 >  CCCompareValues($Parameter1, $Parameter2, ccsInteger))
        $Component->Visible = false;
//End Hide-Show Component

//Close Report1_Navigator_BeforeShow @69-115E333B
    return $Report1_Navigator_BeforeShow;
}
//End Close Report1_Navigator_BeforeShow


?>
