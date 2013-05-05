<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" needGeneration="0" accessDeniedPage="denegado.ccp">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="20" name="excepciondisponibilidadin" connection="Connection1" pageSizeLimit="100" wizardCaption=" Excepciondisponibilidadinstructor Lista de" wizardGridType="Tabular" wizardAllowSorting="True" wizardSortingType="SimpleDir" wizardUsePageScroller="True" wizardAllowInsert="True" wizardAltRecord="False" wizardRecordSeparator="False" wizardAltRecordType="Controls" dataSource="excepciondisponibilidadinstructor, instructor" pasteActions="pasteActions">
			<Components>
				<Link id="4" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="excepciondisponibilidadin_Insert" hrefSource="excepciondispon_maint.ccp" removeParameters="id" wizardThemeItem="NavigatorLink" wizardDefaultValue="Agregar Nuevo" PathID="excepciondisponibilidadinexcepciondisponibilidadin_Insert">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
				<Sorter id="6" visible="True" name="Sorter_idInstructor" column="nombre" wizardCaption="Id Instructor" wizardSortingType="SimpleDir" wizardControl="idInstructor" wizardAddNbsp="False" PathID="excepciondisponibilidadinSorter_idInstructor">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="7" visible="True" name="Sorter_fecha" column="fecha" wizardCaption="Fecha" wizardSortingType="SimpleDir" wizardControl="fecha" wizardAddNbsp="False" PathID="excepciondisponibilidadinSorter_fecha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Link id="9" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="link1" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" hrefSource="excepciondispon_maint.ccp" PathID="excepciondisponibilidadinlink1" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="25" sourceType="DataField" name="id" source="excepciondisponibilidadinstructor_id"/>
</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="12" fieldSourceType="DBColumn" dataType="Text" html="False" name="instructor" fieldSource="nombre" wizardCaption="Id Instructor" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" PathID="excepciondisponibilidadininstructor">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="14" fieldSourceType="DBColumn" dataType="Date" html="False" name="fecha" fieldSource="fecha" wizardCaption="Fecha" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardAddNbsp="True" PathID="excepciondisponibilidadinfecha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="15" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardFirst="True" wizardPrev="True" wizardFirstText="|&lt;" wizardPrevText="&lt;&lt;" wizardNextText="&gt;&gt;" wizardLastText="&gt;|" wizardNext="True" wizardLast="True" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="True" wizardOfText="de" wizardImagesScheme="{ccs_style}">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Hide-Show Component" actionCategory="General" id="16" action="Hide" conditionType="Parameter" dataType="Integer" condition="LessThan" name1="TotalPages" sourceType1="SpecialValue" name2="2" sourceType2="Expression"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Navigator>
				<Hidden id="23" fieldSourceType="DBColumn" dataType="Integer" name="id" PathID="excepciondisponibilidadinid" fieldSource="id" html="False">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
</Components>
			<Events/>
			<TableParameters/>
			<JoinTables>
				<JoinTable id="3" tableName="excepciondisponibilidadinstructor" posWidth="95" posHeight="104" posLeft="10" posRight="-1" posTop="10"/>
				<JoinTable id="17" tableName="instructor" posLeft="339" posTop="10" posWidth="95" posHeight="120"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="20" tableLeft="excepciondisponibilidadinstructor" tableRight="instructor" fieldLeft="excepciondisponibilidadinstructor.idInstructor" fieldRight="instructor.id" joinType="inner" conditionType="Equal"/>
			</JoinLinks>
			<Fields>
				<Field id="11" tableName="excepciondisponibilidadinstructor" fieldName="idInstructor"/>
				<Field id="13" tableName="excepciondisponibilidadinstructor" fieldName="fecha"/>
				<Field id="21" tableName="instructor" fieldName="nombre"/>
				<Field id="26" tableName="excepciondisponibilidadinstructor" fieldName="excepciondisponibilidadinstructor.id" alias="excepciondisponibilidadinstructor_id"/>
</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<IncludePage id="22" name="header" PathID="header" page="header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="excepciondispon_list_events.php" forShow="False" comment="//"/>
		<CodeFile id="Code" language="PHPTemplates" name="excepciondispon_list.php" forShow="True" url="excepciondispon_list.php" comment="//"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
