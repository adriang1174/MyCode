<?php
//BindEvents Method @1-4F4B3608
function BindEvents()
{
    global $movimientofacturacion;
    $movimientofacturacion->tipomov->CCSEvents["BeforeShow"] = "movimientofacturacion_tipomov_BeforeShow";
}
//End BindEvents Method

//movimientofacturacion_tipomov_BeforeShow @7-9C33AD11
function movimientofacturacion_tipomov_BeforeShow(& $sender)
{
    $movimientofacturacion_tipomov_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $movimientofacturacion; //Compatibility
//End movimientofacturacion_tipomov_BeforeShow

//Custom Code @15-2A29BDB7
// -------------------------
    $movimientofacturacion->tipomov->SetValue('C');
// -------------------------
//End Custom Code

//Close movimientofacturacion_tipomov_BeforeShow @7-8E455119
    return $movimientofacturacion_tipomov_BeforeShow;
}
//End Close movimientofacturacion_tipomov_BeforeShow


?>
