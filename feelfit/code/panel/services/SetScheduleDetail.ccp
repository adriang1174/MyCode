<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="10" connection="Connection1" dataSource="SELECT * 
FROM agenda
WHERE idAlumno = {a}
AND idEquipamiento = {e} 
and (substring( rangodias, DAYOFWEEK( '{fecha}' ) , 1 ) = '1'
OR fechaespec = '{fecha}')
and horaini = '{horaini}'
and fechavig &gt; current_date" activeCollection="SQLParameters" name="agenda" pageSizeLimit="100" wizardCaption=" Agenda Lista de" wizardAllowInsert="False" parameterTypeListName="ParameterTypeList">
			<Components>
				<Label id="6" fieldSourceType="DBColumn" dataType="Integer" html="False" name="id" fieldSource="id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="7" fieldSourceType="DBColumn" dataType="Integer" html="False" name="idAlumno" fieldSource="idAlumno">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="8" fieldSourceType="DBColumn" dataType="Integer" html="False" name="idEquipamiento" fieldSource="idEquipamiento">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="9" fieldSourceType="DBColumn" dataType="Text" html="False" name="rangodias" fieldSource="rangodias">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="10" fieldSourceType="DBColumn" dataType="Date" html="False" name="fechaespec" fieldSource="fechaespec">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="11" fieldSourceType="DBColumn" dataType="Text" html="False" name="horaini" fieldSource="horaini">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="12" fieldSourceType="DBColumn" dataType="Text" html="False" name="horafin" fieldSource="horafin">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="13" fieldSourceType="DBColumn" dataType="Integer" html="False" name="mediahora" fieldSource="mediahora">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="19"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="4" conditionType="Parameter" useIsNull="False" field="idAlumno" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="a"/>
				<TableParameter id="5" conditionType="Parameter" useIsNull="False" field="idEquipamiento" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="e"/>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="15" parameterType="URL" variable="a" dataType="Integer" parameterSource="a" defaultValue="0"/>
				<SQLParameter id="16" parameterType="URL" variable="e" dataType="Integer" parameterSource="e" defaultValue="0"/>
				<SQLParameter id="17" variable="fecha" parameterType="URL" dataType="Text" parameterSource="f"/>
				<SQLParameter id="20" variable="horaini" parameterType="URL" dataType="Text" parameterSource="hi"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Label id="18" fieldSourceType="DBColumn" dataType="Text" html="False" name="respuesta" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="SetScheduleDetailrespuesta">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Label id="21" fieldSourceType="DBColumn" dataType="Text" html="False" name="idr" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="SetScheduleDetailidr">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Label id="22" fieldSourceType="DBColumn" dataType="Text" html="False" name="descripcion" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="SetScheduleDetaildescripcion">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="SetScheduleDetail_events.php" forShow="False" comment="//"/>
		<CodeFile id="Code" language="PHPTemplates" name="SetScheduleDetail.php" forShow="True" url="SetScheduleDetail.php" comment="//"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="BeforeShow" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="14"/>
			</Actions>
		</Event>
	</Events>
</Page>
