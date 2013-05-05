<?php

//define('REMOTE_SERVER_URL', 'http://96.125.169.16/~uv9038/services/');
define('REMOTE_SERVER_URL', 'http://feelfit.com.ar/panel/services/');


//define('DEBUG', true);


session_start();

function clear($txt){
	$txt = str_replace('"', '', $txt);
	$txt = trim($txt);
	return html_entity_decode($txt);
}

if(trim($_GET["f"]) != ""){
	if(function_exists(trim($_GET["f"]))){
		call_user_func(trim($_GET["f"]), $_GET, $_POST);
	}
}
exit(); 

function getEvents($get, $post){
/* ESTE EJEMPLO FUNCIONA
echo json_encode( array(
        array(
            'id' => 123,
            'title' => "myevent",
            'start' => mktime(10, 00, 0, 8, 11, 2011),
            'end' => mktime(11, 00, 0, 8, 11, 2011),
            'allDay' => false
         ),
         //more events...
     ));
exit;


	echo '[{"id":1,"title":"Adri\u00e1n Garcia","equipamiento":"Power plate","start":1312891200,"end":1312894800,"allDay":false},{"id":2,"title":"Adri\u00e1n Garcia","equipamiento":"Power plate","start":1313064000,"end":1313067600,"allDay":false},{"id":3,"title":"Adri\u00e1n Garcia","equipamiento":"Power plate","start":1313323200,"end":1313326800,"allDay":false}]';
	exit;
*/
	$fecha_desde = date("Y-m-d", $get['start']);
	$realurl = REMOTE_SERVER_URL.'getSchedule.php?fd='.$fecha_desde.'&t='. $get['t'];
	
	if(isset($get['getLink'])){
	
		echo $realurl;
		exit;
	}
	
	$data = file_get_contents($realurl);
//echo  REMOTE_SERVER_URL.'getSchedule.php?fd='.$fecha_desde.'&t=M';


	$xml = simplexml_load_string($data);

	$eventos = array();

	foreach($xml->evento as $item){

		$fecha_evento = explode(" ", $item->hora); // fecha 0, hora 1
		$fecha = explode("-", $fecha_evento[0]);
		$hora = explode(":", $fecha_evento[1]);

		$tmp_item = array();
		$tmp_item['id'] = (int)($item->id);
		$tmp_item['title'] = (string)($item->nombre);
		$tmp_item['equipamiento'] = (string)($item->equipamiento);
		$tmp_item['start'] = mktime($hora[0], $hora[1], 0, $fecha[1], $fecha[2], $fecha[0]);

		$tmp_item['fecha_fmt'] = $fecha[0] .'-'. $fecha[1] .'-'. $fecha[2];
		$tmp_item['hora_fmt'] = $hora[0] .':'. $hora[1];
		$tmp_item['end'] = $tmp_item['start'] + (60 * 60);
		$tmp_item['instructor'] = (string)($item->instructor);
		$tmp_item['idequipamiento'] = (int)($item->idequipamiento);
		
		$tmp_item['idalumno'] = (int)($item->idalumno);
		$tmp_item['asistio'] = (int)($item->asistio);

		$tmp_item['recurrente'] = (int)($item->recurrente);

		$tmp_item['comparte'] = (int)($item->comparte);
		$tmp_item['hora_inicio'] = (int)($hora[0]);
		
		$horario = explode("-", $item->horario);
		$horario = explode(":", trim($horario[0]));

		if($horario[1] == '00'){ // Si es la primera o segunda media hora
			$tmp_item['horario'] = 1;
		}else{
			$tmp_item['horario'] = 2;
		}

		$tmp_item['allDay'] = false;
		
		$tmp_item['className'] = (string)($item->css);
		
		//$tmp_item['className'] = 'instructor_'. rand(1, 2);
//print_r($item);

		$eventos[] = $tmp_item;
	}	

	echo json_encode($eventos);
}

function getTurnos(){
	$data = file_get_contents(REMOTE_SERVER_URL.'lookupTurnos.php');
	$xml = simplexml_load_string($data);
	//print_r($xml);

	foreach($xml->turno as $turno){
		//print_r($turno);
		$cod_turno = clear($turno->cod);
		$horarios = clear($turno->horario);
		$horarios = explode("-", $horarios);
		$_SESSION['turnos'][trim($cod_turno)]['from'] = trim($horarios[0]);
		$_SESSION['turnos'][trim($cod_turno)]['to'] = trim($horarios[1]);
	}
	
	echo json_encode($_SESSION['turnos']);
	
}

function getAlumnos($get, $post){
	
	if(isset($get['buscar']) && trim($get['buscar']) != ''){
		$data = file_get_contents(REMOTE_SERVER_URL.'lookupAlumnos.php?txt='.urlencode($get['buscar']));
	}else{
		$data = file_get_contents(REMOTE_SERVER_URL.'lookupAlumnos.php');
	}
	
	$xml = simplexml_load_string($data);
	foreach ($xml as $alumno){
		if((int)(str_replace('"', '', $alumno->comparte)) == 1){
			$comparte = 'comparte';
		}else{
			$comparte = '';
		}
		echo  '<div class="external-event '. $comparte .'" id="container_user_'. clear($alumno->id) .'">'. clear($alumno->nombre).'</div>';
	}

        
}


function getEquipos($get, $post){
	$data = file_get_contents(REMOTE_SERVER_URL.'getEquipos.php');
	
	$xml = simplexml_load_string($data);
	
	echo 'Equipo&nbsp;&nbsp;&nbsp;';
	foreach ($xml as $equipo){
		echo '<input type="radio" class="radio_equipo" name="sel_equipo" id="sel_equipo_'.clear($equipo->id).'" title="'. clear($equipo->descripcion) .'" value="'. clear($equipo->id).'" />&nbsp;'. clear($equipo->codigo).'&nbsp;&nbsp;';
	}
	
	
}

function save($get, $post){

	$tmp_hora = explode(":", $get['hora']);
	
	if($tmp_hora[0] < 10){
		$tmp_hora[0] = "0".$tmp_hora[0];
	}
	
	if($get['horario'] = 1){ // Primera media hora
		
		$hf = $tmp_hora[0] .':30';
	}else{
		$hf = ($tmp_hora[0] +1 ) .':00';
	}
	
	
	if($get['recurrente'] == 1){
		$recurrente = 0;
	}else{
		$recurrente = 1;
	}
	
	$tmp_hi = (int)($get['hora']);
	if($tmp_hi < 10){
		$tmp_hi = "0".$tmp_hi;
	}
	
	$hi = $tmp_hi;

	
	if($_GET['id'] == 'TMP'){ // ALTA
		$final_url = REMOTE_SERVER_URL.'SetScheduleDetail.php?f='.$get['fecha'].'&hi='.$hi.':00&a='.$get['alumno'].'&e='.$get['equipo'].'&r='.$recurrente.'&m='. $get['horario'].'&hf='.$hf.'&c='. $get['comparte'].'&do=ins';	
	}else{ // EDICION
		$final_url = REMOTE_SERVER_URL.'SetScheduleDetail.php?f='.$get['fecha'].'&hi='.$hi.':00&a='.$get['alumno'].'&e='.$get['equipo'].'&r='.$recurrente.'&m='. $get['horario'].'&hf='.$hf.'&c='. $get['comparte'].'&id='.$get['id'].'&as='.$get['asistencia'] .'&do=upd';	
	}

	$data = file_get_contents($final_url);

	$xml = simplexml_load_string($data);
	
	//echo $final_url;
	
	if($xml->res == 'OK'){
		
		if(DEBUG){
			echo $final_url;
		}else{
			echo "ok";	
		}
		//echo "\nID:";
		//echo $xml->id;
	}else{
		echo "ERROR";
	}
}

function delete($get, $post){
	$data = file_get_contents(REMOTE_SERVER_URL.'delEvent.php?id='. $get['id'].'&fecha='.$get['fecha']);
	
	$xml = simplexml_load_string($data);

	echo $xml->Resultado;
}


?>