<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" needGeneration="0" accessDeniedPage="denegado.ccp">
	<Components>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="movimientofacturacionSearch" wizardCaption=" Movimientofacturacion Buscar" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="reporte_fact.ccp" PathID="movimientofacturacionSearch">
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
				<ListBox id="53" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="s_mes" PathID="movimientofacturacionSearchs_mes" sourceType="Table" connection="Connection1" dataSource="meses" boundColumn="nro" textColumn="nombre">
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
		<Report id="54" secured="False" enablePrint="False" showMode="Web" sourceType="SQL" returnValueType="Number" linesPerWebPage="40" linesPerPhysicalPage="50" connection="Connection1" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="SELECT m.anio,m.mes,sum(m.importe) as importe_fact,g.importe
FROM movimientofacturacion m ,(select sum(importe) as importe from  gastos  where anio = '{s_anio}' and mes = '{s_mes}') g
where tipomov = 'C'
and m.anio = '{s_anio}'
and m.mes = '{s_mes}'
group by m.anio,m.mes,g.importe" name="Report1" pageSizeLimit="100" wizardCaption=" Report1 " wizardLayoutType="GroupLeft">
			<Components>
				<Section id="57" visible="True" lines="0" name="Report_Header" wizardSectionType="ReportHeader">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="58" visible="True" lines="1" name="Page_Header" wizardSectionType="PageHeader">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="60" visible="True" lines="0" name="anio_Header">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="62" visible="True" lines="0" name="mes_Header">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="63" visible="True" lines="1" name="Detail">
					<Components>
						<ReportLabel id="72" fieldSourceType="DBColumn" dataType="Integer" html="False" hideDuplicates="True" resetAt="Report" name="anio" fieldSource="anio" wizardCaption="anio" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" wizardAlign="right" PathID="Report1Detailanio">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="74" fieldSourceType="DBColumn" dataType="Integer" html="False" hideDuplicates="True" resetAt="Report" name="mes" fieldSource="mes" wizardCaption="mes" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" wizardAlign="right" PathID="Report1Detailmes">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="76" fieldSourceType="DBColumn" dataType="Float" html="False" hideDuplicates="False" resetAt="Report" name="sum_m_importe_1" fieldSource="importe_fact" wizardCaption="sum(m.importe)" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" wizardAlign="right" PathID="Report1Detailsum_m_importe_1">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="78" fieldSourceType="DBColumn" dataType="Float" html="False" hideDuplicates="False" resetAt="Report" name="importe" fieldSource="importe" wizardCaption="importe" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" wizardAlign="right" PathID="Report1Detailimporte">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="79" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="rentabilidad" PathID="Report1Detailrentabilidad">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="80"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</ReportLabel>
					</Components>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="64" visible="True" lines="0" name="mes_Footer">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="65" visible="True" lines="0" name="anio_Footer">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="66" visible="True" lines="0" name="Report_Footer" wizardSectionType="ReportFooter">
					<Components>
						<Panel id="67" visible="True" name="NoRecords" wizardNoRecords="No hay registros">
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
				<Section id="68" visible="True" lines="1" name="Page_Footer" wizardSectionType="PageFooter" pageBreakAfter="True">
					<Components>
						<Navigator id="69" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Centered" wizardFirst="True" wizardFirstText="Inicio" wizardPrev="True" wizardPrevText="Anterior" wizardNext="True" wizardNextText="Siguiente" wizardLast="True" wizardLastText="Final" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="de" wizardImagesScheme="{ccs_style}">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Hide-Show Component" actionCategory="General" id="70" action="Hide" conditionType="Parameter" dataType="Integer" condition="LessThan" name1="TotalPages" sourceType1="SpecialValue" name2="2" sourceType2="Expression"/>
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
			<TableParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields>
				<Field id="71" fieldName="anio" alias="anio"/>
				<Field id="73" fieldName="mes" alias="mes"/>
				<Field id="75" fieldName="sum(m.importe)" alias="sum(m_importe)"/>
				<Field id="77" fieldName="importe" alias="importe"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="55" variable="s_anio" parameterType="URL" dataType="Text" parameterSource="s_anio" designDefaultValue="2011"/>
				<SQLParameter id="56" variable="s_mes" parameterType="URL" dataType="Text" parameterSource="s_mes" designDefaultValue="9"/>
			</SQLParameters>
			<ReportGroups>
				<ReportGroup id="59" name="anio" field="anio" sqlField="anio" sortOrder="asc"/>
				<ReportGroup id="61" name="mes" field="mes" sqlField="mes" sortOrder="asc"/>
			</ReportGroups>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Report>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="reporte_fact_events.php" forShow="False" comment="//"/>
		<CodeFile id="Code" language="PHPTemplates" name="reporte_fact.php" forShow="True" url="reporte_fact.php" comment="//"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="52" groupID="1"/>
	</SecurityGroups>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
