<?php
//BindEvents Method @1-FEB9E0C2
function BindEvents()
{
    global $agenda;
    global $CCSEvents;
    $agenda->CCSEvents["BeforeShow"] = "agenda_BeforeShow";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//agenda_BeforeShow @2-56756127
function agenda_BeforeShow(& $sender)
{
    $agenda_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $agenda; //Compatibility
	global $respuesta;
	global $descripcion;
	global $idr;

//End agenda_BeforeShow

//Custom Code @19-2A29BDB7
// -------------------------
$db = new ClsDBConnection1();

//Modificación para que no contemple mas la media hora. Adrián 08/09/2011
$hf = (int) substr(CCGetFromGet('hi','0'),0,2);
$hf += 1;
$hf = (string) $hf . ':00';
$_GET['hf'] = $hf;
//Fin modif

switch (CCGetFromGet('do',''))
{
case 'ins':
				//Hay que ver si encuentra evento por fecha y hora. reemplazar el recordscount
				if($agenda->DataSource->RecordsCount == 0)
				{
						if(CCGetFromGet('r','') == '0')
						{
				   			$sql = "insert into agenda (idAlumno,idEquipamiento,rangodias,fechaespec,horaini,horafin,mediahora,comparte,fechavig,fechavigd)
							values(".CCGetFromGet('a','0').",".CCGetFromGet('e','0').",''".
							",'".CCGetFromGet('f','')."','".CCGetFromGet('hi','0')."','".CCGetFromGet('hf','0')."','".CCGetFromGet('m','0')."','".CCGetFromGet('c','0')."','2099-12-31','".CCGetFromGet('f','')."')";
							//$respuesta->SetValue($respuesta->GetValue().$sql.'\n');
							$db->query($sql);	
							$id = mysql_insert_id();
						}
						else
						{
							$sql = "insert into agenda (idAlumno,idEquipamiento,rangodias,fechaespec,horaini,horafin,mediahora,comparte,fechavig,fechavigd)
							values(".CCGetFromGet('a','0').",".CCGetFromGet('e','0').",concat(substring('0000000',1,DAYOFWEEK('".CCGetFromGet('f','')."')-1),'1',substring('0000000',DAYOFWEEK('".CCGetFromGet('f','')."')+1,7-DAYOFWEEK('".CCGetFromGet('f','')."')+1)),null,'".CCGetFromGet('hi','0')."','".CCGetFromGet('hf','0')."','".CCGetFromGet('m','0')."','".CCGetFromGet('c','0')."','2099-12-31','".CCGetFromGet('f','')."')";
							//$respuesta->SetValue($respuesta->GetValue().$sql.'\n');
							$db->query($sql);
							$id = mysql_insert_id();	
						}

				}
				else
				{
					// Encontró schedule para ese día
					//Si es por fecha especifica
					if(CCGetFromGet('r','') == '0')
					{
							$sql = " update agenda set fechavig = '".CCGetFromGet('f','')."' 
							 where id = ".$agenda->DataSource->id->GetValue();
							$db->query($sql);
							
							$sql = "insert into agenda (idAlumno,idEquipamiento,rangodias,fechaespec,horaini,horafin,mediahora,comparte,fechavig,fechavigd)
							values(".CCGetFromGet('a','0').",".CCGetFromGet('e','0').",''".
							",'".CCGetFromGet('f','')."','".CCGetFromGet('hi','0')."','".CCGetFromGet('hf','0')."','".CCGetFromGet('m','0')."','".CCGetFromGet('c','0')."','2099-12-31','".CCGetFromGet('f','')."')";
							$db->query($sql);							

							/*$sql = " select id from agenda where idAlumno = ".CCGetFromGet('a','0')." and idEquipamiento = ". CCGetFromGet('e',''). " and fechavig > current_date";
				 			$db->query($sql);
							$db->next_record();
							$id= $db->f('id');*/
							$id = mysql_insert_id();	
					}
					else
					{
							$sql = " update agenda set fechavig =  '".CCGetFromGet('f','')."' 
							 where id = ".$agenda->DataSource->id->GetValue();
							$db->query($sql);
							//pone 0 en el día y hace insert

							$sql = "insert into agenda (idAlumno,idEquipamiento,rangodias,fechaespec,horaini,horafin,mediahora,comparte,fechavig,fechavigd) 
							values(".CCGetFromGet('a','0').",".CCGetFromGet('e','0').",concat(substring('0000000',1,DAYOFWEEK('".CCGetFromGet('f','')."')-1),'1',substring('0000000',DAYOFWEEK('".CCGetFromGet('f','')."')+1,7-DAYOFWEEK('".CCGetFromGet('f','')."')+1)),null,'".CCGetFromGet('hi','0')."','".CCGetFromGet('hf','0')."','".CCGetFromGet('m','0')."','".CCGetFromGet('c','0')."','2099-12-31','".CCGetFromGet('f','')."')";
							//$respuesta->SetValue($respuesta->GetValue().$sql.'\n');
							$db->query($sql);
							$id = mysql_insert_id();	
					}
				}
				break;
case 'upd':
				$sql = "select fechavig,idEquipamiento,fechaespec from agenda where id = ".CCGetFromGet('id','');
				$db->query($sql);
				$db->next_record();
				$fechavig = $db->f('fechavig');
				$idEquipamiento = $db->f('idEquipamiento');
				if( !empty($fechavig ))
					$recurrente = '0';
				else
					$recurrente = '1';
				//Si solo modifico asistencia, no tocamos nada en la agenda
				if( $idEquipamiento <> CCGetFromGet('e','0') or $recurrente <> CCGetFromGet('r','0'))
				{
						//Si es por fecha especifica
						if (CCGetFromGet('r','0') == '0')
						{
								//Si antes era recuurrente, grabamos vigencia, para mantener esa historia
								if($recurrente == '1')
								{
									$sql = " update agenda set fechavig = '".CCGetFromGet('f','')."' 
									 where id = ".CCGetFromGet('id','');
									$db->query($sql);
				
									$sql = "insert into agenda (idAlumno,idEquipamiento,rangodias,fechaespec,horaini,horafin,mediahora,comparte,fechavig,fechavigd)
									values(".CCGetFromGet('a','0').",".CCGetFromGet('e','0').",''".
									",'".CCGetFromGet('f','')."','".CCGetFromGet('hi','0')."','".CCGetFromGet('hf','0')."','".CCGetFromGet('m','0')."','".CCGetFromGet('c','0')."','".$fechavig."','".CCGetFromGet('f','')."')";
									$db->query($sql);							

									$id = mysql_insert_id();	
								}
								else
								{
									 //Era fecha especifica y no cambió entonces hacemos el update de 
									 //equipamiento en ese registro
									$sql = " update agenda set idEquipamiento = ".CCGetFromGet('e','')." 
									 where id = ".CCGetFromGet('id','');
									$db->query($sql);
								}
						}
						else
						{
								$sql = " update agenda set fechavig = '".CCGetFromGet('f','')."' 
								 where id = ".CCGetFromGet('id','');
								$db->query($sql);

								$sql = "insert into agenda (idAlumno,idEquipamiento,rangodias,fechaespec,horaini,horafin,mediahora,comparte,fechavig,fechavigd) 
								values(".CCGetFromGet('a','0').",".CCGetFromGet('e','0').",concat(substring('0000000',1,DAYOFWEEK('".CCGetFromGet('f','')."')-1),'1',substring('0000000',DAYOFWEEK('".CCGetFromGet('f','')."')+1,7-DAYOFWEEK('".CCGetFromGet('f','')."')+1)),null,'".CCGetFromGet('hi','0')."','".CCGetFromGet('hf','0')."','".CCGetFromGet('m','0')."','".CCGetFromGet('c','0')."','".$fechavig."','".CCGetFromGet('f','')."')";
								$db->query($sql);
								$id = mysql_insert_id();	
						}
				}
				break;
case 'del':
				$sql = " update agenda set fechavig = '".CCGetFromGet('f','')."' where id = ".CCGetFromGet('id',''); 
				$db->query($sql);	
				$id= CCGetFromGet('id','0');
				break;
}


//
// Buscar la asistencia y actualizar o grabar de corresponder
//
$sql = "select * from asistenciaalumno where idAlumno = " .CCGetFromGet('a','0'). " and fecha = '".CCGetFromGet('f','')."' and horaini = '".CCGetFromGet('hi','0')."'";
$db->query($sql);	
if(	$db->next_record())
{
	$sql= "update asistenciaalumno set asistio = '".CCGetFromGet('as','0')."' where idAlumno = " .CCGetFromGet('a','0'). " and fecha = '".CCGetFromGet('f','')."' and horaini = '".CCGetFromGet('hi','0')."'";
	//$respuesta->SetValue($respuesta->GetValue().$sql.'\n');
	$db->query($sql);	
}
else
{
	$sql= "insert into asistenciaalumno (idAlumno,fecha,horaini,asistio,idEquipamiento,idInstructor) values(".CCGetFromGet('a','0').",'".CCGetFromGet('f','')."','".CCGetFromGet('hi','0')."','".CCGetFromGet('as','0')."',".CCGetFromGet('e','0').",0)";
	//$respuesta->SetValue($respuesta->GetValue().$sql.'\n');
	$db->query($sql);	
}

$db->close();

if ($db->Errors->Count() == 0)
{
$idr->SetValue($id);
$respuesta->SetValue("OK");
$descripcion->SetValue('');
}
else
{
$idr->SetValue($id);
//$descripcion->SetValue($respuesta->GetValue());
$respuesta->SetValue("Error");
$descripcion->SetValue(htmlspecialchars($db->Errors->ToString()));
}
// -------------------------
//End Custom Code

//Close agenda_BeforeShow @2-3995F316
    return $agenda_BeforeShow;
}
//End Close agenda_BeforeShow

//Page_BeforeShow @1-BC329203
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $SetScheduleDetail; //Compatibility
	global $respuesta;

//End Page_BeforeShow

//Custom Code @14-2A29BDB7
// -------------------------
//Buscar por fecha o día

// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow


?>
