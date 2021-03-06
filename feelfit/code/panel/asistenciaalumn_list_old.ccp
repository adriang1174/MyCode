<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" needGeneration="0" accessDeniedPage="denegado.ccp">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="asistenciaalumnoSearch" returnPage="asistenciaalumn_list_old.ccp" wizardCaption=" Asistenciaalumno Buscar" wizardOrientation="Vertical" wizardFormMethod="post" PathID="asistenciaalumnoSearch" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions">
			<Components>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Buscar" PathID="asistenciaalumnoSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<ListBox id="4" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="s_alumno" wizardCaption="Asistio" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" PathID="asistenciaalumnoSearchs_alumno" sourceType="Table" connection="Connection1" dataSource="alumno" boundColumn="id" textColumn="nombre">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
				</ListBox>
				<TextBox id="51" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="s_fdesde" PathID="asistenciaalumnoSearchs_fdesde">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="52" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="s_fhasta" PathID="asistenciaalumnoSearchs_fhasta">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="53" name="DatePicker_s_fdesde1" PathID="asistenciaalumnoSearchDatePicker_s_fdesde1" control="s_fdesde" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<DatePicker id="54" name="DatePicker_s_fhasta1" PathID="asistenciaalumnoSearchDatePicker_s_fhasta1" control="s_fhasta" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
			</Components>
			<Events/>
			<TableParameters/>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<Grid id="5" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="20" name="asistenciaalumno" connection="Connection1" pageSizeLimit="100" wizardCaption=" Asistenciaalumno Lista de" wizardGridType="Tabular" wizardAllowSorting="True" wizardSortingType="SimpleDir" wizardUsePageScroller="True" wizardAllowInsert="True" wizardAltRecord="False" wizardRecordSeparator="False" wizardAltRecordType="Controls" dataSource="asistenciaalumno, alumno, equipamiento, instructor" activeCollection="TableParameters">
			<Components>
				<Sorter id="9" visible="True" name="Sorter_id" column="id" wizardCaption="Id" wizardSortingType="SimpleDir" wizardControl="id" wizardAddNbsp="False" PathID="asistenciaalumnoSorter_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="10" visible="True" name="Sorter_idAlumno" column="idAlumno" wizardCaption="Id Alumno" wizardSortingType="SimpleDir" wizardControl="idAlumno" wizardAddNbsp="False" PathID="asistenciaalumnoSorter_idAlumno">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="11" visible="True" name="Sorter_fecha" column="fecha" wizardCaption="Fecha" wizardSortingType="SimpleDir" wizardControl="fecha" wizardAddNbsp="False" PathID="asistenciaalumnoSorter_fecha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="12" visible="True" name="Sorter_asistio" column="asistio" wizardCaption="Asistio" wizardSortingType="SimpleDir" wizardControl="asistio" wizardAddNbsp="False" PathID="asistenciaalumnoSorter_asistio">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="13" visible="True" name="Sorter_idEquipamiento" column="idEquipamiento" wizardCaption="Id Equipamiento" wizardSortingType="SimpleDir" wizardControl="idEquipamiento" wizardAddNbsp="False" PathID="asistenciaalumnoSorter_idEquipamiento">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="14" visible="True" name="Sorter_idInstructor" column="idInstructor" wizardCaption="Id Instructor" wizardSortingType="SimpleDir" wizardControl="idInstructor" wizardAddNbsp="False" PathID="asistenciaalumnoSorter_idInstructor">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Link id="16" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="id" fieldSource="id" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" hrefSource="asistenciaalumn_maint.ccp" PathID="asistenciaalumnoid">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="17" sourceType="DataField" format="yyyy-mm-dd" name="id" source="id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Hidden id="19" fieldSourceType="DBColumn" dataType="Integer" html="False" name="idAlumno" fieldSource="idAlumno" wizardCaption="Id Alumno" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" PathID="asistenciaalumnoidAlumno">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="21" fieldSourceType="DBColumn" dataType="Date" html="False" name="fecha" fieldSource="fecha" wizardCaption="Fecha" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardAddNbsp="True" PathID="asistenciaalumnofecha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<CheckBox id="23" fieldSourceType="DBColumn" dataType="Text" html="False" name="asistio" fieldSource="asistio" wizardCaption="Asistio" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" wizardAddNbsp="True" PathID="asistenciaalumnoasistio" visible="Yes" checkedValue="1" uncheckedValue="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<Hidden id="25" fieldSourceType="DBColumn" dataType="Integer" html="False" name="idEquipamiento" fieldSource="idEquipamiento" wizardCaption="Id Equipamiento" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" PathID="asistenciaalumnoidEquipamiento">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="27" fieldSourceType="DBColumn" dataType="Integer" html="False" name="idInstructor" fieldSource="idInstructor" wizardCaption="Id Instructor" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" PathID="asistenciaalumnoidInstructor">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Navigator id="28" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardFirst="True" wizardPrev="True" wizardFirstText="|&lt;" wizardPrevText="&lt;&lt;" wizardNextText="&gt;&gt;" wizardLastText="&gt;|" wizardNext="True" wizardLast="True" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="True" wizardOfText="de" wizardImagesScheme="{ccs_style}">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Hide-Show Component" actionCategory="General" id="29" action="Hide" conditionType="Parameter" dataType="Integer" condition="LessThan" name1="TotalPages" sourceType1="SpecialValue" name2="2" sourceType2="Expression"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="48" fieldSourceType="DBColumn" dataType="Text" html="False" name="alumno_nombre" PathID="asistenciaalumnoalumno_nombre" fieldSource="alumno_nombre">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="49" fieldSourceType="DBColumn" dataType="Text" html="False" name="descripcion" PathID="asistenciaalumnodescripcion" fieldSource="descripcion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="50" fieldSourceType="DBColumn" dataType="Text" html="False" name="instructor_nombre" PathID="asistenciaalumnoinstructor_nombre" fieldSource="instructor_nombre">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="55" conditionType="Parameter" useIsNull="False" field="asistenciaalumno.idAlumno" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="12" parameterSource="s_alumno"/>
				<TableParameter id="56" conditionType="Parameter" useIsNull="False" field="asistenciaalumno.fecha" dataType="Date" searchConditionType="GreaterThanOrEqual" parameterType="URL" logicOperator="And" defaultValue="1901-01-01" parameterSource="s_fdesde"/>
				<TableParameter id="57" conditionType="Parameter" useIsNull="False" field="asistenciaalumno.fecha" dataType="Date" searchConditionType="LessThanOrEqual" parameterType="URL" logicOperator="And" defaultValue="2100-01-01" parameterSource="s_fhasta"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="6" tableName="asistenciaalumno" posWidth="121" posHeight="152" posLeft="10" posRight="-1" posTop="10"/>
				<JoinTable id="30" tableName="alumno" posLeft="455" posTop="9" posWidth="115" posHeight="180"/>
				<JoinTable id="34" tableName="equipamiento" posLeft="452" posTop="199" posWidth="95" posHeight="104"/>
				<JoinTable id="39" tableName="instructor" posLeft="186" posTop="214" posWidth="95" posHeight="120"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="61" tableLeft="asistenciaalumno" fieldLeft="asistenciaalumno.idInstructor" tableRight="instructor" fieldRight="instructor.id" joinType="left" conditionType="Equal"/>
				<JoinTable2 id="60" tableLeft="asistenciaalumno" fieldLeft="asistenciaalumno.idEquipamiento" tableRight="equipamiento" fieldRight="equipamiento.id" joinType="left" conditionType="Equal"/>
				<JoinTable2 id="59" tableLeft="asistenciaalumno" fieldLeft="asistenciaalumno.idAlumno" tableRight="alumno" fieldRight="alumno.id" joinType="inner" conditionType="Equal"/>
			</JoinLinks>
			<Fields>
				<Field id="15" tableName="asistenciaalumno" fieldName="asistenciaalumno.id" alias="asistenciaalumno_id"/>
				<Field id="18" tableName="asistenciaalumno" fieldName="idAlumno"/>
				<Field id="20" tableName="asistenciaalumno" fieldName="fecha"/>
				<Field id="22" tableName="asistenciaalumno" fieldName="asistio"/>
				<Field id="24" tableName="asistenciaalumno" fieldName="idEquipamiento"/>
				<Field id="26" tableName="asistenciaalumno" fieldName="idInstructor"/>
				<Field id="45" tableName="instructor" fieldName="instructor.nombre" alias="instructor_nombre"/>
				<Field id="46" tableName="equipamiento" fieldName="descripcion"/>
				<Field id="47" tableName="alumno" fieldName="alumno.nombre" alias="alumno_nombre"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<IncludePage id="58" name="header" PathID="header" page="header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="asistenciaalumn_list_old_events.php" forShow="False" comment="//"/>
		<CodeFile id="Code" language="PHPTemplates" name="asistenciaalumn_list_old.php" forShow="True" url="asistenciaalumn_list_old.php" comment="//"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
