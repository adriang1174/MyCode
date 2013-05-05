<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" needGeneration="0" accessDeniedPage="denegado.ccp">
	<Components>
		<Report id="2" secured="False" enablePrint="False" showMode="Web" sourceType="SQL" returnValueType="Number" linesPerWebPage="40" linesPerPhysicalPage="50" connection="Connection1" dataSource="SELECT instructor.nombre AS instructor_nombre, movimientofacturacion.*, alumno.nombre AS alumno_nombre 
FROM (movimientofacturacion LEFT JOIN alumno ON
movimientofacturacion.idAlumno = alumno.id) LEFT JOIN instructor ON
movimientofacturacion.idInstructor = instructor.id
WHERE ( tipomov = 'C' )
AND movimientofacturacion.idAlumno LIKE '%{s_idAlumno}%'
AND movimientofacturacion.anio LIKE '%{s_anio}%'
AND ( alumno.activo = 1 )
AND ( lpad(movimientofacturacion.mes,2,'0') like '%{s_mes}%' ) 
ORDER BY movimientofacturacion.id" name="movimientofacturacion" orderBy="movimientofacturacion.id" pageSizeLimit="100" wizardCaption=" Movimientofacturacion " wizardLayoutType="GroupLeftAbove" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList">
			<Components>
				<Section id="7" visible="True" lines="0" name="Report_Header" wizardSectionType="ReportHeader">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="8" visible="True" lines="1" name="Page_Header" wizardSectionType="PageHeader">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="10" visible="True" lines="1" name="idInstructor_Header">
					<Components>
						<ReportLabel id="16" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="instructor" fieldSource="instructor_nombre" wizardCaption="idInstructor" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" wizardAlign="right" PathID="movimientofacturacionidInstructor_Headerinstructor">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
					</Components>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="11" visible="True" lines="1" name="Detail">
					<Components>
						<ReportLabel id="24" fieldSourceType="DBColumn" dataType="Integer" html="False" hideDuplicates="False" resetAt="Report" name="mes" fieldSource="mes" wizardCaption="mes" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" wizardAlign="right" PathID="movimientofacturacionDetailmes">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="25" fieldSourceType="DBColumn" dataType="Integer" html="False" hideDuplicates="False" resetAt="Report" name="anio" fieldSource="anio" wizardCaption="anio" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" wizardAlign="right" PathID="movimientofacturacionDetailanio">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="26" fieldSourceType="DBColumn" dataType="Integer" html="False" hideDuplicates="False" resetAt="Report" name="importe" fieldSource="importe" wizardCaption="importe" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" wizardAlign="right" PathID="movimientofacturacionDetailimporte">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="27" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="alumno" fieldSource="alumno_nombre" wizardCaption="idAlumno" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" wizardAlign="right" PathID="movimientofacturacionDetailalumno">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="28" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="idTurno" fieldSource="idTurno" wizardCaption="idTurno" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="movimientofacturacionDetailidTurno">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<Link id="48" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Link1" PathID="movimientofacturacionDetailLink1" hrefSource="movimientofactu_maint.ccp" wizardUseTemplateBlock="False">
							<Components/>
							<Events/>
							<LinkParameters>
								<LinkParameter id="49" sourceType="DataField" format="yyyy-mm-dd" name="id" source="id"/>
							</LinkParameters>
							<Attributes/>
							<Features/>
						</Link>
						<Hidden id="50" fieldSourceType="DBColumn" dataType="Integer" name="id" PathID="movimientofacturacionDetailid" fieldSource="id" html="False">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
					</Components>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="12" visible="True" lines="1" name="idInstructor_Footer">
					<Components>
						<ReportLabel id="17" fieldSourceType="DBColumn" dataType="Integer" html="False" hideDuplicates="False" resetAt="idInstructor" name="Sum_importe" fieldSource="importe" summarised="True" function="Sum" wizardCaption="Importe" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardPrefix="Sum: " wizardAddNbsp="False" wizardAlign="right" wizardVAlign="baseline" PathID="movimientofacturacionidInstructor_FooterSum_importe">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
					</Components>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="13" visible="True" lines="1" name="Report_Footer" wizardSectionType="ReportFooter">
					<Components>
						<Panel id="14" visible="True" name="NoRecords" wizardNoRecords="No hay registros">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Panel>
						<ReportLabel id="20" fieldSourceType="DBColumn" dataType="Integer" html="False" hideDuplicates="False" resetAt="Report" name="TotalSum_importe" fieldSource="importe" summarised="True" function="Sum" wizardCaption="Importe" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardPrefix="Sum: " wizardAddNbsp="False" wizardAlign="right" wizardVAlign="baseline" PathID="movimientofacturacionReport_FooterTotalSum_importe">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
					</Components>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="15" visible="True" lines="1" name="Page_Footer" wizardSectionType="PageFooter" pageBreakAfter="True">
					<Components>
						<Navigator id="18" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="TextButtons" wizardFirst="True" wizardFirstText="|&lt;" wizardPrev="True" wizardPrevText="&lt;&lt;" wizardNext="True" wizardNextText="&gt;&gt;" wizardLast="True" wizardLastText="&gt;|" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="de" wizardImagesScheme="{ccs_style}">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Hide-Show Component" actionCategory="General" id="19" action="Hide" conditionType="Parameter" dataType="Integer" condition="LessThan" name1="TotalPages" sourceType1="SpecialValue" name2="2" sourceType2="Expression"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</Navigator>
					</Components>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="31" conditionType="Expression" useIsNull="False" field="movimientofacturacion.tipomov" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" expression="tipomov = 'C'" parameterSource="id"/>
				<TableParameter id="22" conditionType="Parameter" useIsNull="False" field="movimientofacturacion.idAlumno" dataType="Integer" searchConditionType="Contains" parameterType="URL" logicOperator="And" orderNumber="2" parameterSource="s_idAlumno"/>
				<TableParameter id="21" conditionType="Parameter" useIsNull="False" field="movimientofacturacion.anio" dataType="Integer" searchConditionType="Contains" parameterType="URL" logicOperator="And" orderNumber="1" parameterSource="s_anio"/>
				<TableParameter id="56" conditionType="Expression" useIsNull="False" field="alumno.activo" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" expression="alumno.activo = 1" parameterSource="1"/>
				<TableParameter id="63" conditionType="Expression" useIsNull="False" searchConditionType="Equal" parameterType="URL" logicOperator="And" expression="lpad(movimientofacturacion.mes,2,'0') like '%{s_mes}%'" leftBrackets="0" rightBrackets="0"/>
</TableParameters>
			<JoinTables>
				<JoinTable id="30" tableName="movimientofacturacion" posLeft="10" posTop="10" posWidth="115" posHeight="180"/>
				<JoinTable id="32" tableName="instructor" posLeft="146" posTop="10" posWidth="95" posHeight="120"/>
				<JoinTable id="38" tableName="alumno" posLeft="278" posTop="152" posWidth="115" posHeight="180"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="45" tableLeft="movimientofacturacion" tableRight="alumno" fieldLeft="movimientofacturacion.idAlumno" fieldRight="alumno.id" joinType="left" conditionType="Equal"/>
				<JoinTable2 id="46" tableLeft="movimientofacturacion" tableRight="instructor" fieldLeft="movimientofacturacion.idInstructor" fieldRight="instructor.id" joinType="left" conditionType="Equal"/>
			</JoinLinks>
			<Fields>
				<Field id="37" tableName="instructor" fieldName="instructor.nombre" alias="instructor_nombre"/>
				<Field id="44" tableName="movimientofacturacion" fieldName="movimientofacturacion.*"/>
				<Field id="51" tableName="alumno" fieldName="alumno.nombre" alias="alumno_nombre"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
<SQLParameter id="64" parameterType="URL" variable="s_idAlumno" dataType="Integer" parameterSource="s_idAlumno" defaultValue="0"/>
<SQLParameter id="65" parameterType="URL" variable="s_anio" dataType="Integer" parameterSource="s_anio" defaultValue="0"/>
<SQLParameter id="66" variable="s_mes" parameterType="URL" dataType="Text" parameterSource="s_mes"/>
</SQLParameters>
			<ReportGroups>
				<ReportGroup id="9" name="idInstructor" field="idInstructor" sqlField="idInstructor" sortOrder="asc"/>
			</ReportGroups>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Report>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="movimientofacturacionSearch" wizardCaption=" Movimientofacturacion Buscar" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="cuotas_pagadas.ccp" PathID="movimientofacturacionSearch">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Buscar" PathID="movimientofacturacionSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="s_anio" wizardCaption="Anio" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" PathID="movimientofacturacionSearchs_anio">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="6" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" returnValueType="Number" name="s_idAlumno" wizardCaption="Id Alumno" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardEmptyCaption="Seleccionar Valor" PathID="movimientofacturacionSearchs_idAlumno" connection="Connection1" dataSource="alumno" boundColumn="id" textColumn="nombre" activeCollection="TableParameters">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="58" conditionType="Expression" useIsNull="False" field="activo" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" expression="activo=1" parameterSource="1"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="57" tableName="alumno" posLeft="10" posTop="10" posWidth="115" posHeight="180"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<ListBox id="54" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_mes" PathID="movimientofacturacionSearchs_mes" sourceType="Table" connection="Connection1" dataSource="meses" boundColumn="nro" textColumn="nombre">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="59" tableName="meses" posLeft="10" posTop="10" posWidth="95" posHeight="88"/>
					</JoinTables>
					<JoinLinks/>
					<Fields>
						<Field id="60" fieldName="lpad(nro,2,'0')" isExpression="True" alias="nro"/>
						<Field id="61" tableName="meses" fieldName="nombre"/>
						<Field id="62" tableName="meses" fieldName="nro" alias="meses_nro"/>
					</Fields>
				</ListBox>
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
		<IncludePage id="47" name="header" PathID="header" page="header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="cuotas_pagadas_events.php" forShow="False" comment="//"/>
		<CodeFile id="Code" language="PHPTemplates" name="cuotas_pagadas.php" forShow="True" url="cuotas_pagadas.php" comment="//"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="52" groupID="1"/>
		<Group id="53" groupID="100"/>
	</SecurityGroups>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
