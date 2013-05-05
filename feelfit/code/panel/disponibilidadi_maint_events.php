<?php
//BindEvents Method @1-39946777
function BindEvents()
{
    global $disponibilidadinstructor;
    $disponibilidadinstructor->rangodias->CCSEvents["BeforeShow"] = "disponibilidadinstructor_rangodias_BeforeShow";
    $disponibilidadinstructor->ds->CCSEvents["BeforeBuildInsert"] = "disponibilidadinstructor_ds_BeforeBuildInsert";
    $disponibilidadinstructor->ds->CCSEvents["BeforeBuildUpdate"] = "disponibilidadinstructor_ds_BeforeBuildUpdate";
}
//End BindEvents Method

//disponibilidadinstructor_rangodias_BeforeShow @9-3F3DF7A8
function disponibilidadinstructor_rangodias_BeforeShow(& $sender)
{
    $disponibilidadinstructor_rangodias_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $disponibilidadinstructor; //Compatibility
//End disponibilidadinstructor_rangodias_BeforeShow

//Custom Code @21-2A29BDB7
// -------------------------
 $semana = array("d","l","m","x","j","v","s");
 
$str = '';
for($i=0;$i<=6;$i++)
{
	if(substr($disponibilidadinstructor->DataSource->rangodias->GetValue(),$i,1)=='1')
		 $disponibilidadinstructor->{$semana[$i]}->SetValue('1');
	else 	
		 $disponibilidadinstructor->{$semana[$i]}->SetValue('0');
}

// -------------------------
//End Custom Code

//Close disponibilidadinstructor_rangodias_BeforeShow @9-ADF3FDB8
    return $disponibilidadinstructor_rangodias_BeforeShow;
}
//End Close disponibilidadinstructor_rangodias_BeforeShow

//disponibilidadinstructor_ds_BeforeBuildInsert @2-597263CC
function disponibilidadinstructor_ds_BeforeBuildInsert(& $sender)
{
    $disponibilidadinstructor_ds_BeforeBuildInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $disponibilidadinstructor; //Compatibility
//End disponibilidadinstructor_ds_BeforeBuildInsert

//Custom Code @22-2A29BDB7
// -------------------------
$semana = array("d","l","m","x","j","v","s");
 
$str = '';
for($i=0;$i<=6;$i++)
{
		$str.= $disponibilidadinstructor->{$semana[$i]}->GetValue();
}
$disponibilidadinstructor->rangodias->SetValue($str);

// -------------------------
//End Custom Code

//Close disponibilidadinstructor_ds_BeforeBuildInsert @2-899F15DF
    return $disponibilidadinstructor_ds_BeforeBuildInsert;
}
//End Close disponibilidadinstructor_ds_BeforeBuildInsert

//disponibilidadinstructor_ds_BeforeBuildUpdate @2-D561B9AA
function disponibilidadinstructor_ds_BeforeBuildUpdate(& $sender)
{
    $disponibilidadinstructor_ds_BeforeBuildUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $disponibilidadinstructor; //Compatibility
//End disponibilidadinstructor_ds_BeforeBuildUpdate

//Custom Code @23-2A29BDB7
// -------------------------
$semana = array("d","l","m","x","j","v","s");
 
$str = '';
for($i=0;$i<=6;$i++)
{
		$str.= $disponibilidadinstructor->{$semana[$i]}->GetValue();
}
$disponibilidadinstructor->DataSource->rangodias->SetValue($str);
// -------------------------
//End Custom Code

//Close disponibilidadinstructor_ds_BeforeBuildUpdate @2-46B6D450
    return $disponibilidadinstructor_ds_BeforeBuildUpdate;
}
//End Close disponibilidadinstructor_ds_BeforeBuildUpdate


?>
