DELIMITER $$

DROP PROCEDURE IF EXISTS `feelfit_gimnasio`.`getSchedule2` $$
CREATE PROCEDURE `getSchedule2`(in vfechaini date,in vturno varchar(1))
BEGIN
  DECLARE v1 INT DEFAULT 2;
  declare vdia int;
  DECLARE done INT DEFAULT 0;
  declare done2 int default 0;
  declare txtResp text;
  declare vnombre varchar(50);
  declare vhoraini varchar(5);
  declare valumno varchar(50);
  declare vhorario varchar(20);
  declare vequipamiento varchar(50);
  declare vidagenda int;
  declare vfecha date;
  declare vfechafin date;
  declare vinstructor varchar(50);
  declare videquipamiento int;
  declare vidalumno int;
  declare vasistio int;
  declare vidasistencia int;
  declare vcomparte varchar(1);
  declare vrecurrente int;
  declare vcolor varchar(50);
  declare vdescripcionequipo varchar(100);

  DECLARE cur1 CURSOR FOR
        select horaini
        from configuracionturnos
        where codigo = CONVERT(vturno USING utf8) COLLATE utf8_general_ci
        order by id;


  DECLARE cur2 CURSOR FOR
                SELECT agenda.id, agenda.comparte,
                  alumno.nombre, alumno.id,
                  alumno.comparte,
/*
                  CASE WHEN mediahora = '1'
									THEN concat( horaini, ' - ', concat( substr( horaini, 1, 2 ) , ':30' ) )
									ELSE concat( concat( substr( horaini, 1, 2 ) , ':30' ) , ' - ', horafin )
									END as horario,*/
                  concat( horaini , ' - ', horafin ) as horario,
                    equipamiento.id
									, equipamiento.codigo,
                    equipamiento.descripcion,
                  CASE WHEN rangodias <> '' THEN 1 ELSE 0 END as recurrente
									FROM agenda
									LEFT JOIN alumno ON ( agenda.idAlumno = alumno.id )
									LEFT JOIN equipamiento ON ( agenda.idEquipamiento = equipamiento.id )
									WHERE (
									substring( rangodias, DAYOFWEEK( vfecha ) , 1 ) = '1'
									OR fechaespec = CONVERT(vfecha USING utf8) COLLATE utf8_general_ci
									)
									AND horaini = CONVERT(vhoraini USING utf8) COLLATE utf8_general_ci
/*                  AND fechavig > CONVERT(vfecha USING utf8) COLLATE utf8_general_ci */
                  AND CONVERT(vfecha USING utf8) COLLATE utf8_general_ci >= fechavigd
                  AND CONVERT(vfecha USING utf8) COLLATE utf8_general_ci <  fechavig
/*                  AND fechavig = ( select min(fechavig) from agenda   a
                                    where  (
                        									substring( rangodias, DAYOFWEEK( vfecha ) , 1 ) = '1'
									                      OR fechaespec = CONVERT(vfecha USING utf8) COLLATE utf8_general_ci
									                        )
									                      AND horaini = CONVERT(vhoraini USING utf8) COLLATE utf8_general_ci
                                        and fechavig > CONVERT(vfecha USING utf8) COLLATE utf8_general_ci
                                        and a.idAlumno = agenda.idAlumno
                                 )  */
                  ;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

/*set vturno = 'M';
set vfechaini = '2011-07-11';  */
set vfechafin = DATE_ADD(vfechaini,INTERVAL '6' DAY);
set vfecha = vfechaini;
/*set txtResp = concat('<?xml version="1.0" encoding="UTF-8"?>','\n','<Schedule>','\n');*/
set txtResp = concat('<Schedule>','\n');

WHILE v1 <= 8 DO
    set vdia =  mod(v1,7);

    select nombre into vnombre from semana where dia = CONVERT(vdia USING utf8) COLLATE utf8_general_ci limit 1;
    /*set txtResp = concat(txtResp,'<',vnombre,' ',vfecha,'>','\n');*/
    /****  Acá cursor  de turnos loopeando por las horas       ****/
    set done = 0;
    OPEN cur1;
    /*******Arranca cursor  ******/
    REPEAT
    			FETCH cur1 INTO vhoraini;
    			IF NOT done THEN
    						/*set txtResp = concat(txtResp,'<',substring(vhoraini,1,2),'>','\n'); */
                set valumno = null;
                set vhorario = null;
                set vequipamiento = null;
                set vasistio = null;
                set vcomparte = null;
                set vidasistencia = null;
                set videquipamiento = null;
                set vinstructor = null;

                  OPEN cur2;
                  REPEAT
                			FETCH cur2 INTO vidagenda,vcomparte,valumno,vidalumno,vcomparte,vhorario,videquipamiento,vequipamiento,vdescripcionequipo,vrecurrente;
                			IF NOT done THEN

      	    		          if valumno is not null then
                              /*
                               *  Buscamos el intructor
                               */
                               SELECT i.nombre , i.color into vinstructor,vcolor
                               FROM disponibilidadinstructor d
                               join instructor i on(d.idInstructor = i.id)
                               WHERE
                                  idEquipamiento = videquipamiento
                              and (substring( rangodias, DAYOFWEEK( vfecha ) , 1 ) = '1'
                                OR fechaespec = CONVERT(vfecha USING utf8) COLLATE utf8_general_ci)
                              and cast(substring(vhorario,1,INSTR(vhorario,':')-1) as decimal) between
                               cast(substring(horaini,1,INSTR(horaini,':')-1) as decimal) and cast(substring(horafin,1,INSTR(horafin,':')-1) as decimal)
                              /*and lpad(horaini,5,'0') = substring(vhorario,1,5)*/
                              and not exists(select * from excepciondisponibilidadinstructor where fecha = CONVERT(vfecha USING utf8) COLLATE utf8_general_ci) limit 1;

                              if vinstructor is null then
                                  set vinstructor = '';
                                  set vcolor = 'instructor_1';
                              else
                                  set vinstructor = vdescripcionequipo;
                              end if;
                              /*
                               * Buscamos la asistencia
                               *
                               */

                              SELECT a.id, a.asistio into vidasistencia, vasistio
                              FROM asistenciaalumno a
                              WHERE idAlumno = vidalumno and fecha = CONVERT(vfecha USING utf8) COLLATE utf8_general_ci
                              and horaini = concat(substring(CONVERT(vhorario USING utf8) COLLATE utf8_general_ci,1,2),':00');

                              if vidasistencia is null then
                                  set vasistio = 0;
                              end if;

                              set txtResp = 		concat(txtResp,'<evento>','\n');
                              set txtResp = 		concat(txtResp,'<id>',vidagenda,'</id>','\n');
				    	                set txtResp = 		concat(txtResp,'<hora>',concat(vfecha,' ',vhoraini),'</hora>','\n');
						    		      		set txtResp = 		concat(txtResp,'<idalumno>',vidalumno,'</idalumno>','\n');
                              set txtResp = 		concat(txtResp,'<nombre>','<![CDATA[',valumno,']]>','</nombre>','\n');
      						            set txtResp = 		concat(txtResp,'<comparte>',vcomparte,'</comparte>','\n');
                              set txtResp = 		concat(txtResp,'<horario>',vhorario,'</horario>','\n');
                              set txtResp = 		concat(txtResp,'<recurrente>',vrecurrente,'</recurrente>','\n');
                              set txtResp = 		concat(txtResp,'<asistio>',vasistio,'</asistio>','\n');
		    			 	      			 set txtResp = 		concat(txtResp,'<idequipamiento>',videquipamiento,'</idequipamiento>','\n');
				    	 				       set txtResp = 		concat(txtResp,'<equipamiento>','<![CDATA[',vequipamiento,']]>','</equipamiento>','\n');
                              set txtResp = 		concat(txtResp,'<instructor>','<![CDATA[',vinstructor,']]>','</instructor>','\n');
                              set txtResp = 		concat(txtResp,'<css>',vcolor,'</css>','\n');
                              set txtResp = 		concat(txtResp,'</evento>','\n');
                             /* set txtResp = concat(txtResp,'</',substring(vhoraini,1,2),'>','\n'); */
                              set done = 0;
                        end if;
            			    END IF;
                UNTIL done END REPEAT;
                CLOSE cur2;
                set done = 0;
			    END IF;
  UNTIL done END REPEAT;
  CLOSE cur1;
  /*******Fin cursor      ******/
  SET v1 = v1 + 1;
  set vfecha = DATE_ADD(vfecha, INTERVAL 1 DAY);
/*  set txtResp = concat(txtResp,'</',vnombre,'>','\n'); */
END WHILE;
set txtResp = concat(txtResp,'</Schedule>','\n');
select txtResp;
END $$

DELIMITER ;