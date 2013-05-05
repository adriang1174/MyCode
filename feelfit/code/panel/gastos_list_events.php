<?php
//BindEvents Method @1-B401FF25
function BindEvents()
{
    global $gastos;
    $gastos->Navigator->CCSEvents["BeforeShow"] = "gastos_Navigator_BeforeShow";
}
//End BindEvents Method

//gastos_Navigator_BeforeShow @15-B15D51BA
function gastos_Navigator_BeforeShow(& $sender)
{
    $gastos_Navigator_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $gastos; //Compatibility
//End gastos_Navigator_BeforeShow

//Hide-Show Component @16-0DB41530
    $Parameter1 = $Container->DataSource->PageCount();
    $Parameter2 = 2;
    if (((is_array($Parameter1) || strlen($Parameter1)) && (is_array($Parameter2) || strlen($Parameter2))) && 0 >  CCCompareValues($Parameter1, $Parameter2, ccsInteger))
        $Component->Visible = false;
//End Hide-Show Component

//Close gastos_Navigator_BeforeShow @15-A3A48040
    return $gastos_Navigator_BeforeShow;
}
//End Close gastos_Navigator_BeforeShow


?>
