<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<IncludePage id="2" name="header" PathID="header" page="header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Report id="3" secured="False" enablePrint="False" showMode="Web" sourceType="SQL" returnValueType="Number" linesPerWebPage="40" linesPerPhysicalPage="50" connection="Connection1" dataSource="select a.id,a.nombre,a.anio,a.mes from
(
select a.id,a.nombre,an.anio,an.mes
from alumno a ,anios an
where
a.activo = 1 AND
CONCAT( an.anio, lpad(an.mes,2,'0') ) &lt;=  concat(year(now()),lpad(month(now()),2,'0'))
and CONCAT( an.anio, lpad(an.mes,2,'0') ) &gt;= concat(year(a.fechaalta),LPAD( MONTH( a.fechaalta ) , 2,  '0' ))
ORDER BY a.id, an.anio, an.mes
) a
left join
(
select al.id,al.nombre,m.mes,m.anio from alumno al
LEFT JOIN movimientofacturacion m ON ( al.id = m.idAlumno )
where
CONCAT( m.anio, lpad(m.mes,2,'0') ) &lt;=  concat(year(now()),lpad(month(now()),2,'0'))
ORDER BY al.id, m.anio, m.mes
) b
on (a.id = b.id and a.anio= b.anio and a.mes = b.mes)
WHERE
b.id is null
and a.anio = {s_anio}
and a.mes = {s_mes}" name="Report1" pageSizeLimit="100" wizardCaption=" Report1 " wizardLayoutType="Tabular" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList">
			<Components>
				<Section id="4" visible="True" lines="0" name="Report_Header" wizardSectionType="ReportHeader">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="5" visible="True" lines="1" name="Page_Header" wizardSectionType="PageHeader">
					<Components>
						<Sorter id="12" visible="True" name="Sorter_id" column="id" wizardCaption="Id" wizardSortingType="SimpleDir" wizardControl="id">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
						<Sorter id="14" visible="True" name="Sorter_nombre" column="nombre" wizardCaption="Nombre" wizardSortingType="SimpleDir" wizardControl="nombre">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
						<Sorter id="16" visible="True" name="Sorter_anio" column="anio" wizardCaption="Anio" wizardSortingType="SimpleDir" wizardControl="anio">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
						<Sorter id="18" visible="True" name="Sorter_mes" column="mes" wizardCaption="Mes" wizardSortingType="SimpleDir" wizardControl="mes">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
					</Components>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="6" visible="True" lines="1" name="Detail">
					<Components>
						<ReportLabel id="13" fieldSourceType="DBColumn" dataType="Integer" html="False" hideDuplicates="False" resetAt="Report" name="id" fieldSource="id" wizardCaption="id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" wizardAlign="right" PathID="Report1Detailid">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="15" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="nombre" fieldSource="nombre" wizardCaption="nombre" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="Report1Detailnombre">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="17" fieldSourceType="DBColumn" dataType="Integer" html="False" hideDuplicates="False" resetAt="Report" name="anio" fieldSource="anio" wizardCaption="anio" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" wizardAlign="right" PathID="Report1Detailanio">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="19" fieldSourceType="DBColumn" dataType="Integer" html="False" hideDuplicates="False" resetAt="Report" name="mes" fieldSource="mes" wizardCaption="mes" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" wizardAlign="right" PathID="Report1Detailmes">
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
				<Section id="7" visible="True" lines="0" name="Report_Footer" wizardSectionType="ReportFooter">
					<Components>
						<Panel id="8" visible="True" name="NoRecords" wizardNoRecords="No hay registros">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Panel>
					</Components>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="9" visible="True" lines="1" name="Page_Footer" wizardSectionType="PageFooter" pageBreakAfter="True">
					<Components>
						<Navigator id="10" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="TextButtons" wizardFirst="True" wizardFirstText="|&lt;" wizardPrev="True" wizardPrevText="&lt;&lt;" wizardNext="True" wizardNextText="&gt;&gt;" wizardLast="True" wizardLastText="&gt;|" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="de" wizardImagesScheme="{ccs_style}">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Hide-Show Component" actionCategory="General" id="11" action="Hide" conditionType="Parameter" dataType="Integer" condition="LessThan" name1="TotalPages" sourceType1="SpecialValue" name2="2" sourceType2="Expression"/>
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
				<TableParameter id="24" conditionType="Parameter" useIsNull="False" field="anio" parameterSource="s_anio" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
				<TableParameter id="25" conditionType="Parameter" useIsNull="False" field="mes" parameterSource="s_mes" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="2"/>
			</TableParameters>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="20" variable="s_anio" parameterType="URL" dataType="Text" parameterSource="s_anio" defaultValue="0" designDefaultValue="0"/>
				<SQLParameter id="21" variable="s_mes" parameterType="URL" dataType="Text" parameterSource="s_mes" defaultValue="0" designDefaultValue="0"/>
			</SQLParameters>
			<ReportGroups/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Report>
		<Record id="22" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="Report2" wizardCaption=" Report1 Buscar" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="cuotas_impagas.ccp" PathID="Report2">
			<Components>
				<Button id="23" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Buscar" PathID="Report2Button_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="26" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="s_anio" wizardCaption="Anio" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" PathID="Report2s_anio">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="27" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" returnValueType="Number" name="s_mes" wizardCaption="Mes" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardEmptyCaption="Seleccionar Valor" PathID="Report2s_mes" connection="Connection1" dataSource="meses" boundColumn="nro" textColumn="nombre">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
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
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="cuotas_impagas_events.php" forShow="False" comment="//"/>
		<CodeFile id="Code" language="PHPTemplates" name="cuotas_impagas.php" forShow="True" url="cuotas_impagas.php" comment="//"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
