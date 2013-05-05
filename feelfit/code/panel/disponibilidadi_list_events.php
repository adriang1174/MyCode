<?php
//BindEvents Method @1-2BF7FEDF
function BindEvents()
{
    global $disponibilidadinstructor;
    $disponibilidadinstructor->rangodias->CCSEvents["BeforeShow"] = "disponibilidadinstructor_rangodias_BeforeShow";
    $disponibilidadinstructor->Navigator->CCSEvents["BeforeShow"] = "disponibilidadinstructor_Navigator_BeforeShow";
}
//End BindEvents Method

//disponibilidadinstructor_rangodias_BeforeShow @20-3F3DF7A8
function disponibilidadinstructor_rangodias_BeforeShow(& $sender)
{
    $disponibilidadinstructor_rangodias_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $disponibilidadinstructor; //Compatibility
//End disponibilidadinstructor_rangodias_BeforeShow

//Custom Code @39-2A29BDB7
// -------------------------
$semana = array("D","L","M","X","J","V","S");
$str = '';
for($i=0;$i<=6;$i++)
{
	if(substr($disponibilidadinstructor->DataSource->rangodias->GetValue(),$i,1)=='1')
		 $str .= $semana[$i].' ';
	else 	
		 $str .= '  ';
}
$disponibilidadinstructor->rangodias->SetValue($str);
// -------------------------
//End Custom Code

//Close disponibilidadinstructor_rangodias_BeforeShow @20-ADF3FDB8
    return $disponibilidadinstructor_rangodias_BeforeShow;
}
//End Close disponibilidadinstructor_rangodias_BeforeShow

//disponibilidadinstructor_Navigator_BeforeShow @27-F406A4EF
function disponibilidadinstructor_Navigator_BeforeShow(& $sender)
{
    $disponibilidadinstructor_Navigator_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $disponibilidadinstructor; //Compatibility
//End disponibilidadinstructor_Navigator_BeforeShow

//Hide-Show Component @28-0DB41530
    $Parameter1 = $Container->DataSource->PageCount();
    $Parameter2 = 2;
    if (((is_array($Parameter1) || strlen($Parameter1)) && (is_array($Parameter2) || strlen($Parameter2))) && 0 >  CCCompareValues($Parameter1, $Parameter2, ccsInteger))
        $Component->Visible = false;
//End Hide-Show Component

//Close disponibilidadinstructor_Navigator_BeforeShow @27-FCF73C7F
    return $disponibilidadinstructor_Navigator_BeforeShow;
}
//End Close disponibilidadinstructor_Navigator_BeforeShow


?>
