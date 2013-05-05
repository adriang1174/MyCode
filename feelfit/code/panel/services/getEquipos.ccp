<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="Connection1" dataSource="equipamiento" name="equipamiento" pageSizeLimit="100" wizardCaption=" Equipamiento Lista de" wizardAllowInsert="False">
			<Components>
				<Label id="3" fieldSourceType="DBColumn" dataType="Integer" html="False" name="id" fieldSource="id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="4" fieldSourceType="DBColumn" dataType="Text" html="False" name="codigo" fieldSource="codigo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="5" fieldSourceType="DBColumn" dataType="Text" html="False" name="descripcion" fieldSource="descripcion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="6"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters/>
			<JoinTables/>
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
		<CodeFile id="Code" language="PHPTemplates" name="getEquipos.php" forShow="True" url="getEquipos.php" comment="//"/>
		<CodeFile id="Events" language="PHPTemplates" name="getEquipos_events.php" forShow="False" comment="//"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
