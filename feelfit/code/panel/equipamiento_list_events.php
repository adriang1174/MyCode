<?php
//BindEvents Method @1-58179ED1
function BindEvents()
{
    global $equipamiento;
    $equipamiento->Navigator->CCSEvents["BeforeShow"] = "equipamiento_Navigator_BeforeShow";
}
//End BindEvents Method

//equipamiento_Navigator_BeforeShow @15-92007830
function equipamiento_Navigator_BeforeShow(& $sender)
{
    $equipamiento_Navigator_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $equipamiento; //Compatibility
//End equipamiento_Navigator_BeforeShow

//Hide-Show Component @16-0DB41530
    $Parameter1 = $Container->DataSource->PageCount();
    $Parameter2 = 2;
    if (((is_array($Parameter1) || strlen($Parameter1)) && (is_array($Parameter2) || strlen($Parameter2))) && 0 >  CCCompareValues($Parameter1, $Parameter2, ccsInteger))
        $Component->Visible = false;
//End Hide-Show Component

//Close equipamiento_Navigator_BeforeShow @15-E905A43E
    return $equipamiento_Navigator_BeforeShow;
}
//End Close equipamiento_Navigator_BeforeShow


?>
