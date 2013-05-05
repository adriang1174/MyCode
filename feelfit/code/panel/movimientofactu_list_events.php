<?php
//BindEvents Method @1-ED9E9B25
function BindEvents()
{
    global $movimientofacturacion;
    $movimientofacturacion->Navigator->CCSEvents["BeforeShow"] = "movimientofacturacion_Navigator_BeforeShow";
}
//End BindEvents Method

//movimientofacturacion_Navigator_BeforeShow @30-4D797FE4
function movimientofacturacion_Navigator_BeforeShow(& $sender)
{
    $movimientofacturacion_Navigator_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $movimientofacturacion; //Compatibility
//End movimientofacturacion_Navigator_BeforeShow

//Hide-Show Component @31-0DB41530
    $Parameter1 = $Container->DataSource->PageCount();
    $Parameter2 = 2;
    if (((is_array($Parameter1) || strlen($Parameter1)) && (is_array($Parameter2) || strlen($Parameter2))) && 0 >  CCCompareValues($Parameter1, $Parameter2, ccsInteger))
        $Component->Visible = false;
//End Hide-Show Component

//Close movimientofacturacion_Navigator_BeforeShow @30-1E9BA27C
    return $movimientofacturacion_Navigator_BeforeShow;
}
//End Close movimientofacturacion_Navigator_BeforeShow


?>
