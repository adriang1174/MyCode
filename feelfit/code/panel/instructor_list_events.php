<?php
//BindEvents Method @1-4B458433
function BindEvents()
{
    global $instructor;
    $instructor->Navigator->CCSEvents["BeforeShow"] = "instructor_Navigator_BeforeShow";
}
//End BindEvents Method

//instructor_Navigator_BeforeShow @26-6B8BAD1D
function instructor_Navigator_BeforeShow(& $sender)
{
    $instructor_Navigator_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $instructor; //Compatibility
//End instructor_Navigator_BeforeShow

//Hide-Show Component @27-0DB41530
    $Parameter1 = $Container->DataSource->PageCount();
    $Parameter2 = 2;
    if (((is_array($Parameter1) || strlen($Parameter1)) && (is_array($Parameter2) || strlen($Parameter2))) && 0 >  CCCompareValues($Parameter1, $Parameter2, ccsInteger))
        $Component->Visible = false;
//End Hide-Show Component

//Close instructor_Navigator_BeforeShow @26-59D5E291
    return $instructor_Navigator_BeforeShow;
}
//End Close instructor_Navigator_BeforeShow


?>
