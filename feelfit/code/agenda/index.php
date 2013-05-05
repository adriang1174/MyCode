<?php require('headers.php');?>
<div class="detail" id="editBox" >
	<input type="hidden" id="evt_id" value="" />
    <input type="hidden" id="evt_fecha" value="" />
    <input type="hidden" id="evt_hora" value="" />
    <input type="hidden" id="evt_id_alumno" value="" />
	<div class="line" style="background:#0088cc; position:relative;">
    	<!-- nombre del usuario -->
        <span class="nombreApellido" id="editBoxTitle"></span>
        <!-- cerrar ventana -->
        <a href="#" id="closepanel">cerrar&nbsp;[x]</a>
    </div>
    <div class="line" style="background:#4cabdb; color:#fff; line-height:17px;">
    	<!-- fecha -->
        <span class="date" id="editBoxDate"></span><br />
        <!-- horario -->
        <span class="hour" id="editBoxTime"></span><br />
        <input type="checkbox" name="evt_recurrente" id="evt_recurrente"/> <span class="only">S&oacute;lo &eacute;ste d&iacute;a</span>       
    </div>
    <div class="line" style="background:#eee;">
        <!-- clase de equipo -->
        <span class="team" id="equip_container"></span>
        <!-- comparte -->
        <span class="team" id="editBoxComparte">Comparte equipo:&nbsp;&nbsp;<input type="checkbox" id="inputComparte"/></span>
        <input type="hidden" id="sel_hora_1" value="1" />
        <!-- media hora -->
<!--
        <div class="team" style="height:30px; border-bottom:none;">
        	<div style="width:50px;float:left;">Utiliza:</div>


            <div style="width:115px;float:right; text-align:left;">
                    <input type="radio" name="sel_hora" id="sel_hora_1" value="1" /> <span id="editBoxTime1"></span><br />
                    <input type="radio" name="sel_hora" id="sel_hora_2" value="2" /> <span id="editBoxTime2"></span>
            </div>
      	</div>
-->        
         <span class="team" id="editBoxAsistio">Asisti&oacute;:&nbsp;&nbsp;<input type="checkbox" id="inputAsistio"/></span>
    </div>
    <?php /*
    <div class="line" style="background:#d9d9d9;">
    	<span>Instructor<br />
        <!-- instructor -->
        <strong>Nombre del Instructor</strong>
        </span>
    </div>
	<^php */ ?>
    <div class="line" style="background:#eee; padding:10px 5px 5px;">
    	<!-- cancela el evento -->
    	<a href="#" id="cancelbox">Eliminar evento</a> <a href="#" id="savebox">Guardar</a>
    </div>
</div>

<div class="detail" id="viewBox">
	<div class="line" style="background:#0088cc; position:relative;">
    	<span class="nombreApellido staticName" id="viewBoxTitle"></span>
    </div>
    <div class="line" style="background:#4cabdb; color:#fff; line-height:17px;">
    	<!-- horario -->
        <span class="hour" id="viewBoxHorario"></span><br />
        <!-- Equipo 2 -->
        <!--
        <span class="team2" id="viewBoxEquipamiento"></span>
        -->
    </div>
    <div class="line" style="background:#d9d9d9;">
    	<span>Instructor<br />
        <!-- instructor -->
        <strong id="viewBoxInstructor">Nombre del Instructor</strong>
        </span>
    </div>
</div>

<div id="wrap">
	<div id="sidebar">
    	<!-- <div><a href="../panel/inicio.php" id="irPanel">Ir al panel</a></div> -->
    	<div>
        	<h1>
            	<img src="img/logo.gif" alt="feel FIT - Trainning center" />
            </h1>
        	<a href="../panel/inicio.php" id="irPanel">Ir al panel</a>
        </div>
        <div id="search">
        	<span id="title">Buscar Alumnos</span>
            	<input type="text" id="searchField" value="" /> <input type="button" value="" id="buscarBtn" />
        </div>
        <div id='external-events'>
            <h4>Alumnos</h4>
            <div id="alumnos_container">
            <p>Cargando referencias...</p>
            </div>
        </div>
        
    </div>
<div id="calendar_box" style="position:relative; float:right;">
	<div style="text-align:center; width:100%; padding-bottom:20px;">
    	<strong>Turno:</strong>
        <select name="turno" id="turno" class="styled">
        <option value="1">Ma&ntilde;ana</option>
        <option value="2">Tarde</option>
        </select>
    </div>
	<!-- botones mes-->
    <div style="width:125px; position:absolute; top:42px; right:0; z-index:99999;">
       <a href="#" onclick="$('#calendar').fullCalendar('incrementDate', 0, 1);" id="mesSig">Mes siguiente</a>
       <a href="#" onclick="$('#calendar').fullCalendar('incrementDate', 0, -1);" id="mesAnt">Mes anterior</a>
        <span id="button_pepe" style="float:right; margin-right:10px; padding:0 8px; line-height: 1.9em;">Mes</span>
    </div>
    <!-- fin botones mes-->
	<div id='calendar'></div>
    
    
</div>

<div style='clear:both'></div>
</div>
<?php require('footer.php'); ?>