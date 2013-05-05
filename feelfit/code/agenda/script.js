var DEBUG = false;


var mouse_x;
var mouse_y;
var day_names = new Array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");	
var val_mintime_m;
var val_maxtime_m;

var val_mintime_t;
var val_maxtime_t;
var turno;

function mostrarCalendario(turno){
	
	$('#calendar').fullCalendar( 'destroy' );
	
	if(turno == 1){ // mañana
		turno = 'M';
		val_mintime = val_mintime_m;
		val_maxtime = val_maxtime_m;
	}else{ // tarde
		turno = 'T';
		val_mintime = val_mintime_t;
		val_maxtime = val_maxtime_t;
	}

	$('#calendar').fullCalendar({
		dayNames:["Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"],
		dayNamesShort:["Dom","Lun","Mar","Mie","Jue","Vie","Sab"],
		monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Setiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'], 
		columnFormat: {
			month: 'ddd',    // Mon
			week: 'ddd d/M', // Mon 9/7
			day: 'dddd d/M'  // Monday 9/7
		},
		 eventSources: [

				// your event source
				{
					url: 'ajax.php',
					type: 'GET',
					data: {
						f: 'getEvents',
						t: turno
					},
					error: function() {
						alert('Ocurrio un error al actualizar los eventos del calendario');
					},
					complete: function(res){
						if(DEBUG){
							$.post($(this).attr('url')+'&getLink', function(reallink){
								alert("LINK"+reallink);	
							});
						}
						
					}
				}
		
				// any other sources...
		
			],

		buttonText: {
			prev:     '&nbsp;&#9668;&nbsp;',  // left triangle
			next:     '&nbsp;&#9658;&nbsp;',  // right triangle
			prevYear: '&nbsp;&lt;&lt;&nbsp;', // <<
			nextYear: '&nbsp;&gt;&gt;&nbsp;', // >>
			today:    'Hoy',
			month:    'Mes',
			week:     'Semana',
			day:      'D&iacute;a'
		},
		allDayText: 'todo el d&iacute;a',
		allDaySlot: false,
		firstDay: 1,
		defaultView: 'agendaWeek',
		theme: true,
		header: {
			left: 'prev,next today',
			center: 'title',
			right: ''
		},
		slotMinutes: 60,
		disableResizing: true,
		defaultEventMinutes: 60,
		minTime: val_mintime,
		maxTime: val_maxtime,
		editable: false,
		droppable: true, // this allows things to be dropped onto the calendar !!!
		timeFormat: {
			agenda: ''
		},

		eventClick: function(theevent){

			date = theevent.start;
			$('.radio_equipo').attr('checked', false);
			
			$('#editBoxDate').html(day_names[date.getDay()] + ' ' + date.getDate() +'/' + (date.getMonth() + 1) +'/'+date.getFullYear());
			
			$('#editBoxAsistio').show();
			
			if(theevent.asistio == 1){
				$('#inputAsistio').attr('checked', true);
			}else{
				$('#inputAsistio').attr('checked', false);
			}
			
			$('#editBoxTime').html('Horario: '+date.getHours()+':00 a '+ (date.getHours() +1) +':00');
			
			//$('#editBoxTime1').html(date.getHours()+':00 a '+date.getHours()+':30');
			//$('#editBoxTime2').html(date.getHours()+':30 a '+(date.getHours() +1 )+':00');
			$('#editBoxTime1').html(date.getHours()+':00 a '+(date.getHours() +1 )+':00');
			$('#editBoxTime2').html(date.getHours()+':00 a '+(date.getHours() +1 )+':00');

			
			if(theevent.horario == 1){
				$('#sel_hora_1').attr('checked', true);
			}else{
				$('#sel_hora_2').attr('checked', true);
			}
			
			if(theevent.comparte == 1){
				$('#inputComparte').attr('checked', true);
				$('#editBoxComparte').show();
			}else{
				$('#inputComparte').attr('checked', false);
				$('#editBoxComparte').hide();
			}
			
			$('#sel_equipo_'+theevent.idequipamiento).attr('checked', true);
			$('#editBoxTitle').html(theevent.title);
			
			$('#evt_id').val(theevent.id);
			
			
			if(theevent.recurrente == 1){
				$('#evt_recurrente').attr('checked', false);
			}else{
				$('#evt_recurrente').attr('checked', true);
			}
			
			$('#evt_hora').val(theevent.hora_inicio);
			
			$('#evt_id_alumno').val(theevent.idalumno);
			
			$('#evt_fecha').val(theevent.fecha_fmt);
			
			
			$('#editBox').css('top', mouse_y);
			$('#editBox').css('left', mouse_x);
			$('#editBox').show();
			
		},
		eventMouseover: function(theevent){
			if($('#editBox').css('display') != 'block' && $('#viewBox').css('display') != 'block'){
				$('#viewBox').css('top', mouse_y);
				$('#viewBox').css('left', mouse_x);
				
				$('#viewBoxTitle').html(theevent.title);
				$('#viewBoxEquipamiento').html('Equipo&nbsp;<strong>'+theevent.equipamiento+'</strong>');


				//if(theevent.horario == 1){
				//		horario = 'Horario: '+ theevent.start.getHours() +':00 a '+ theevent.start.getHours() +':30';	
				//}else{
				//		horario = 'Horario: '+ theevent.start.getHours() +':30 a '+ (theevent.start.getHours()+1) +':00';
				//}
				horario = 'Horario: '+ theevent.start.getHours() +':00 a '+ (theevent.start.getHours()+1) +':00';
			
				$('#viewBoxHorario').html(horario);

				$('#viewBoxInstructor').html(theevent.instructor);
				$('#viewBox').show();
				
			}else{
				return false;	
			}
		},
		eventMouseout: function(theevent){
			$('#viewBox').hide();
		},
		eventDrop: function(theevent){
			$('#calendar').fullCalendar( 'removeEvents', 'TMP');
			$('#editBoxDate').hide();
			alert(theevent);
		},
		drop: function(date, allDay) { // this function is called when something is dropped
			$('#calendar').fullCalendar( 'removeEvents', 'TMP');
			$('.radio_equipo').attr('checked', false);
			
			
			
			$('#editBoxAsistio').hide();
			
			$('#editBoxDate').html(day_names[date.getDay()] + ' ' + date.getDate() +'/' + (date.getMonth() + 1) +'/'+date.getFullYear());
			
			
			$('#editBoxTime').html('Horario: '+date.getHours()+':00 a '+ (date.getHours() +1) +':00');
							
			
			
			//$('#editBoxTime1').html(date.getHours()+':00 a '+date.getHours()+':30');
			//$('#editBoxTime2').html(date.getHours()+':30 a '+(date.getHours() +1 )+':00');
			$('#editBoxTime1').html(date.getHours()+':00 a '+(date.getHours() +1 )+':00');
			$('#editBoxTime2').html(date.getHours()+':00 a '+(date.getHours() +1 )+':00');
			
			$('#sel_hora_1').attr('checked', true);
			
			$('#inputComparte').attr('checked', false);
			
			$('#editBoxComparte').hide();
			
			if($(this).hasClass('comparte')){
				$('#editBoxComparte').show();
			}
			
			$('#editBoxTitle').html($(this).html());
			
			
			$('#editBox').css('top', mouse_y);
			$('#editBox').css('left', mouse_x);
			$('#editBox').show();
			
		
			// retrieve the dropped element's stored Event Object
			var originalEventObject = $(this).data('eventObject');
			
			// we need to copy it, so that multiple events don't have a reference to the same object
			var copiedEventObject = $.extend({}, originalEventObject);
			
			// assign it the date that was reported
			id_alumno = $(this).attr('id').substring(15);

			$('#evt_id').val('TMP');
			$('#evt_fecha').val(date.getFullYear() +'-'+ (date.getMonth()+1) +'-'+date.getDate());
			$('#evt_hora').val(date.getHours());
			$('#evt_id_alumno').val(id_alumno);
			
			
			copiedEventObject.start = date;
			copiedEventObject.allDay = allDay;
			copiedEventObject.id = 'TMP';
			copiedEventObject.title = $(this).html();
			copiedEventObject.id_alumno = id_alumno;
			
			
			// render the event on the calendar
			// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
			$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
			
			
			
			
		}
	});

}



function saveEvent(){
	id = $('#evt_id').val();
	fecha = $('#evt_fecha').val();
	hora = $('#evt_hora').val();
	//alert(hora);
	//return;
	alumno = $('#evt_id_alumno').val();
	equipo = $('input[name=sel_equipo]:checked').val();
	if(equipo == undefined){
		alert("Seleccione el equipo");
		return false;
	}
	if($('#evt_recurrente').attr('checked')){
		recurrente = 1;	
	}else{
		recurrente = 0;
	}
	
	if($('#inputComparte').attr('checked')){
		comparte = 1;	
	}else{
		comparte = 0;
	}
	
	if($('#inputAsistio').attr('checked')){
		asistencia = 1;	
	}else{
		asistencia = 0;
	}
	
	
	
	horario = $('input[name=sel_hora]:checked').val();
	
	$.get('ajax.php?f=save&fecha='+fecha+'&hora='+hora+'&alumno='+alumno+'&equipo='+equipo+'&recurrente='+recurrente+'&horario='+horario+'&comparte='+comparte+'&id='+id+'&asistencia='+asistencia, function(res){
		if(DEBUG){
			alert(res);	
		}
		if(res == 'ERROR'){
			alert("Ocurrio un error al actualizar el evento");
		}else{
			$('#editBox').hide();
			$('#calendar').fullCalendar( 'removeEvents');
			$('#calendar').fullCalendar( 'refetchEvents');			
		}
	});
}

function makeDraggable(){

	/* initialize the external events
	-----------------------------------------------------------------*/
	
	$('#external-events div.external-event').each(function() {
	
		// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
		// it doesn't need to have a start or end
		var eventObject = {
			title: $.trim($(this).text()) // use the element's text as the event title
		};
		
		// store the Event Object in the DOM element so we can get to it later
		$(this).data('eventObject', eventObject);
		
		// make the event draggable using jQuery UI
		$(this).draggable({
			zIndex: 999,
			revert: true,      // will cause the event to go back to its
			revertDuration: 0  //  original position after the drag
		});
		
	});
	
}

	$(document).ready(function() {
	
		$('#turno').change(function(){
			mostrarCalendario($(this).val());
		});
		
		$.getJSON('ajax.php?f=getTurnos', function(res){
			val_mintime_m = res.M.from;
			val_maxtime_m = res.M.to;
			val_mintime_t = res.T.from;
			val_maxtime_t = res.T.to;
			mostrarCalendario(1);			
		});
		
		

	});

// drag and details panel on/off


$(document).ready(function() {
	$(".line #closepanel").click(function() {
		
		$(".detail").fadeOut(200);
		$('#calendar').fullCalendar( 'removeEvents', 'TMP');										  	
		return false;
		});
	
	$('#searchField').keypress(function(e){
		var code = (e.keyCode ? e.keyCode : e.which);
		if(code == 13) { 
   			$('#buscarBtn').trigger('click');
 		}								
	});
	
	$('#buscarBtn').click(function(){
		busqueda = $('#searchField').val();
		$('#alumnos_container').html('<p>Cargando referencias...</p>');
		$.get('ajax.php?f=getAlumnos&buscar='+busqueda, function(res){
			$('#alumnos_container').html(res);
			makeDraggable();
		});
		/*
		busqueda = $('#searchField').val().toLowerCase();
		
		$('.external-event').each(function(){
			
			txt = $(this).html().toLowerCase();
			if(txt.indexOf(busqueda) > -1){
				$(this).show();
			}else{
				$(this).hide();	
			}
			
	   	});
		*/
	});
	
	$("#savebox").click(function(){
		saveEvent();	
		return false;
	});
	
	$('#cancelbox').click(function(){
		
		var evt_id = $('#evt_id').val();
		var 	fecha = $('#evt_fecha').val();

		$('#editBox').hide();
		if(evt_id != 'TMP'){
			$.get('ajax.php?f=delete&id='+ evt_id+'&fecha='+fecha, function(res){
				if(res != 'OK'){
					alert("Ocurrio un error al eliminar el evento");
				}
				$('#calendar').fullCalendar( 'removeEvents');
				$('#calendar').fullCalendar( 'refetchEvents');														
			});
		}

		return false;
	});
	
	$.get('ajax.php?f=getAlumnos', function(res){
		$('#alumnos_container').html(res);
		makeDraggable();
	});
	
	$.get('ajax.php?f=getEquipos', function(res){
		$('#equip_container').html(res);
	});


	$(document).mousemove(function(e){
		mouse_x = e.pageX;
		mouse_y = e.pageY;
	  	$('#status').html(e.pageX +', '+ e.pageY);
	 }); 


});