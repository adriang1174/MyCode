<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="Connection1" dataSource="alumno" activeCollection="TableParameters" name="alumno" pageSizeLimit="100" wizardCaption=" Alumno Lista de" wizardAllowInsert="False">
			<Components>
				<Label id="5" fieldSourceType="DBColumn" dataType="Integer" html="False" name="id" fieldSource="id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="6" fieldSourceType="DBColumn" dataType="Text" html="False" name="nombre" fieldSource="nombre">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="7" fieldSourceType="DBColumn" dataType="Text" html="False" name="tipodoc" fieldSource="tipodoc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="8" fieldSourceType="DBColumn" dataType="Text" html="False" name="nrodocumento" fieldSource="nrodocumento">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="9" fieldSourceType="DBColumn" dataType="Text" html="False" name="domicilio" fieldSource="domicilio">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="10" fieldSourceType="DBColumn" dataType="Text" html="False" name="telefono" fieldSource="telefono">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="11" fieldSourceType="DBColumn" dataType="Text" html="False" name="email" fieldSource="email">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="12" fieldSourceType="DBColumn" dataType="Text" html="False" name="comparte" fieldSource="comparte">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="13"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="4" conditionType="Parameter" useIsNull="False" field="nombre" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="And" parameterSource="txt"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="3" tableName="alumno" posLeft="10" posTop="10" posWidth="115" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="lookupAlumnos.php" forShow="True" url="lookupAlumnos.php" comment="//"/>
		<CodeFile id="Events" language="PHPTemplates" name="lookupAlumnos_events.php" forShow="False" comment="//"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
