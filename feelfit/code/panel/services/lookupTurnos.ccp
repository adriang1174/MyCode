<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="10" connection="Connection1" dataSource="select concat(min(horaini),' - ',max(horaini)) as horario, 'M' as Turno from configuracionturnos where codigo = 'M'
union
select concat(min(horaini),' - ',max(horaini)) as horario, 'T' as Turno from configuracionturnos where codigo = 'T'
" name="select_concat_min_horaini" pageSizeLimit="100" wizardCaption=" Select Concat(min(horaini), ' - ',max(horaini)) As Horario, ' M' As Turno From Configuracionturnos Where Codigo = ' M'
union
select Concat(min(horaini), ' - ',max(horaini)) As Horario, ' T' As Turno From Configuracionturnos Where Codigo = ' T'
; Lista de" wizardAllowInsert="False">
			<Components>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="horario" fieldSource="horario">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="16" fieldSourceType="DBColumn" dataType="Text" html="False" name="Turno" fieldSource="Turno">
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
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="lookupTurnos.php" forShow="True" url="lookupTurnos.php" comment="//"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
