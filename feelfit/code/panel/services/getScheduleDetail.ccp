<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="10" connection="Connection1" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="SELECT agenda.id,alumno.nombre, 
CASE WHEN mediahora = '1'
THEN concat( horaini, ' - ', concat( substr( horaini, 1, 2 ) , ':30' ) ) 
ELSE concat( concat( substr( horaini, 1, 2 ) , ':30' ) , ' - ', horafin ) 
END as horario
, equipamiento.descripcion, 'aa' as instructor
FROM agenda
LEFT JOIN alumno ON ( agenda.idAlumno = alumno.id ) 
LEFT JOIN equipamiento ON ( agenda.idEquipamiento = equipamiento.id ) 
WHERE (
substring( rangodias, DAYOFWEEK( '{fecha}' ) , 1 ) = '1'
OR fechaespec = '{fecha}'
)
AND horaini = '{hora}'" name="SELECT_alumno_nombre_hora" pageSizeLimit="100" wizardCaption=" SELECT Alumno Nombre, Horaini, Horafin, Equipamiento Descripcion, 'aa' As Instructor
 FROM Agenda
 LEFT JOIN Alumno ON ( Agenda Id Alumno = Alumno Id ) 
 LEFT JOIN Equipamiento ON ( Agenda Id Equipamiento = Equipamiento Id ) 
 WHERE (
substring( Rangodias, DAYOFWEEK( '{fecha}' ) , 1 ) = '1'
 OR Fechaespec = '{fecha}'
)
 AND Horaini = '{hora}' Lista de" wizardAllowInsert="False" pasteActions="pasteActions">
			<Components>
				<Label id="7" fieldSourceType="DBColumn" dataType="Integer" html="False" name="id" fieldSource="id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="5" fieldSourceType="DBColumn" dataType="Memo" html="False" name="nombre" fieldSource="nombre">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="6" fieldSourceType="DBColumn" dataType="Text" html="False" name="horario" fieldSource="horario">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="10" fieldSourceType="DBColumn" dataType="Memo" html="False" name="descripcion1" fieldSource="descripcion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="11" fieldSourceType="DBColumn" dataType="Memo" html="False" name="instructor1" fieldSource="instructor">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events/>
			<TableParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="3" variable="fecha" parameterType="URL" dataType="Text" parameterSource="f"/>
				<SQLParameter id="4" variable="hora" parameterType="URL" dataType="Text" parameterSource="h"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="getScheduleDetail.php" forShow="True" url="getScheduleDetail.php" comment="//"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
