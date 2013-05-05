<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" needGeneration="0" accessDeniedPage="denegado.ccp">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="20" name="disponibilidadinstructor" connection="Connection1" pageSizeLimit="100" wizardCaption=" Disponibilidadinstructor Lista de" wizardGridType="Tabular" wizardAllowSorting="True" wizardSortingType="SimpleDir" wizardUsePageScroller="True" wizardAllowInsert="True" wizardAltRecord="False" wizardRecordSeparator="False" wizardAltRecordType="Controls" dataSource="disponibilidadinstructor, instructor, equipamiento" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions">
			<Components>
				<Link id="4" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="disponibilidadinstructor_Insert" hrefSource="disponibilidadi_maint.ccp" removeParameters="id" wizardThemeItem="NavigatorLink" wizardDefaultValue="Agregar Nuevo" PathID="disponibilidadinstructordisponibilidadinstructor_Insert" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
				<Sorter id="6" visible="True" name="Sorter_idInstructor" column="nombre" wizardCaption="Id Instructor" wizardSortingType="SimpleDir" wizardControl="idInstructor" wizardAddNbsp="False" PathID="disponibilidadinstructorSorter_idInstructor">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="7" visible="True" name="Sorter_idEquipamiento" column="idEquipamiento" wizardCaption="Id Equipamiento" wizardSortingType="SimpleDir" wizardControl="idEquipamiento" wizardAddNbsp="False" PathID="disponibilidadinstructorSorter_idEquipamiento">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="10" visible="True" name="Sorter_horaini" column="horaini" wizardCaption="Horaini" wizardSortingType="SimpleDir" wizardControl="horaini" wizardAddNbsp="False" PathID="disponibilidadinstructorSorter_horaini">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="11" visible="True" name="Sorter_horafin" column="horafin" wizardCaption="Horafin" wizardSortingType="SimpleDir" wizardControl="horafin" wizardAddNbsp="False" PathID="disponibilidadinstructorSorter_horafin">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Link id="13" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="link1" fieldSource="disponibilidadinstructor_id" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" hrefSource="disponibilidadi_maint.ccp" PathID="disponibilidadinstructorlink1" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="14" sourceType="DataField" format="yyyy-mm-dd" name="id" source="disponibilidadinstructor_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="16" fieldSourceType="DBColumn" dataType="Text" html="False" name="instructor" fieldSource="nombre" wizardCaption="Id Instructor" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" PathID="disponibilidadinstructorinstructor">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="18" fieldSourceType="DBColumn" dataType="Text" html="False" name="equipamiento" fieldSource="descripcion" wizardCaption="Id Equipamiento" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" PathID="disponibilidadinstructorequipamiento">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="20" fieldSourceType="DBColumn" dataType="Text" html="False" name="rangodias" fieldSource="rangodias" wizardCaption="Rangodias" wizardSize="7" wizardMaxLength="7" wizardIsPassword="False" wizardAddNbsp="True" PathID="disponibilidadinstructorrangodias">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="39"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="24" fieldSourceType="DBColumn" dataType="Text" html="False" name="horaini" fieldSource="horaini" wizardCaption="Horaini" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardAddNbsp="True" PathID="disponibilidadinstructorhoraini">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="26" fieldSourceType="DBColumn" dataType="Text" html="False" name="horafin" fieldSource="horafin" wizardCaption="Horafin" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardAddNbsp="True" PathID="disponibilidadinstructorhorafin">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="27" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardFirst="True" wizardPrev="True" wizardFirstText="|&lt;" wizardPrevText="&lt;&lt;" wizardNextText="&gt;&gt;" wizardLastText="&gt;|" wizardNext="True" wizardLast="True" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="True" wizardOfText="de" wizardImagesScheme="{ccs_style}">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Hide-Show Component" actionCategory="General" id="28" action="Hide" conditionType="Parameter" dataType="Integer" condition="LessThan" name1="TotalPages" sourceType1="SpecialValue" name2="2" sourceType2="Expression"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="22" fieldSourceType="DBColumn" dataType="Date" html="False" name="fechaespec" fieldSource="fechaespec" wizardCaption="Fechaespec" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardAddNbsp="True" PathID="disponibilidadinstructorfechaespec">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="41" fieldSourceType="DBColumn" dataType="Integer" name="id" PathID="disponibilidadinstructorid" fieldSource="disponibilidadinstructor_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
</Components>
			<Events/>
			<TableParameters/>
			<JoinTables>
				<JoinTable id="3" tableName="disponibilidadinstructor" posWidth="121" posHeight="168" posLeft="10" posRight="-1" posTop="10"/>
				<JoinTable id="29" tableName="instructor" posLeft="288" posTop="15" posWidth="95" posHeight="120"/>
				<JoinTable id="32" tableName="equipamiento" posLeft="306" posTop="174" posWidth="95" posHeight="104"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="37" tableLeft="disponibilidadinstructor" tableRight="instructor" fieldLeft="disponibilidadinstructor.idInstructor" fieldRight="instructor.id" joinType="inner" conditionType="Equal"/>
				<JoinTable2 id="38" tableLeft="disponibilidadinstructor" tableRight="equipamiento" fieldLeft="disponibilidadinstructor.idEquipamiento" fieldRight="equipamiento.id" joinType="inner" conditionType="Equal"/>
			</JoinLinks>
			<Fields>
				<Field id="12" tableName="disponibilidadinstructor" fieldName="disponibilidadinstructor.id" alias="disponibilidadinstructor_id"/>
				<Field id="15" tableName="disponibilidadinstructor" fieldName="idInstructor"/>
				<Field id="17" tableName="disponibilidadinstructor" fieldName="idEquipamiento"/>
				<Field id="19" tableName="disponibilidadinstructor" fieldName="rangodias"/>
				<Field id="21" tableName="disponibilidadinstructor" fieldName="fechaespec"/>
				<Field id="23" tableName="disponibilidadinstructor" fieldName="horaini"/>
				<Field id="25" tableName="disponibilidadinstructor" fieldName="horafin"/>
				<Field id="35" tableName="instructor" fieldName="nombre"/>
				<Field id="36" tableName="equipamiento" fieldName="descripcion"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<IncludePage id="40" name="header" PathID="header" page="header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="disponibilidadi_list_events.php" forShow="False" comment="//"/>
		<CodeFile id="Code" language="PHPTemplates" name="disponibilidadi_list.php" forShow="True" url="disponibilidadi_list.php" comment="//"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
