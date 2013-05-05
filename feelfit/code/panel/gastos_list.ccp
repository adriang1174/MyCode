<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" needGeneration="0" accessDeniedPage="denegado.ccp">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="20" name="gastos" connection="Connection1" pageSizeLimit="100" wizardCaption=" Gastos Lista de" wizardGridType="Tabular" wizardAllowSorting="True" wizardSortingType="SimpleDir" wizardUsePageScroller="True" wizardAllowInsert="True" wizardAltRecord="False" wizardRecordSeparator="False" wizardAltRecordType="Controls" dataSource="gastos" activeCollection="TableParameters" orderBy="anio, mes">
			<Components>
				<Link id="4" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="gastos_Insert" hrefSource="gastos_maint.ccp" removeParameters="id" wizardThemeItem="NavigatorLink" wizardDefaultValue="Agregar Nuevo" PathID="gastosgastos_Insert">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
				<Sorter id="5" visible="True" name="Sorter_id" column="id" wizardCaption="Id" wizardSortingType="SimpleDir" wizardControl="id" wizardAddNbsp="False" PathID="gastosSorter_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="6" visible="True" name="Sorter_detalle" column="detalle" wizardCaption="Detalle" wizardSortingType="SimpleDir" wizardControl="detalle" wizardAddNbsp="False" PathID="gastosSorter_detalle">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="7" visible="True" name="Sorter_importe" column="importe" wizardCaption="Importe" wizardSortingType="SimpleDir" wizardControl="importe" wizardAddNbsp="False" PathID="gastosSorter_importe">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Link id="9" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="id" fieldSource="id" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" hrefSource="gastos_maint.ccp" PathID="gastosid">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="10" sourceType="DataField" format="yyyy-mm-dd" name="id" source="id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="12" fieldSourceType="DBColumn" dataType="Text" html="False" name="detalle" fieldSource="detalle" wizardCaption="Detalle" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardAddNbsp="True" PathID="gastosdetalle">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="14" fieldSourceType="DBColumn" dataType="Float" html="False" name="importe" fieldSource="importe" wizardCaption="Importe" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" PathID="gastosimporte">
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
				<Label id="26" fieldSourceType="DBColumn" dataType="Text" html="False" name="mes" PathID="gastosmes" fieldSource="mes">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="27" fieldSourceType="DBColumn" dataType="Text" html="False" name="anio" PathID="gastosanio" fieldSource="anio">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="22" conditionType="Parameter" useIsNull="False" field="mes" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1" parameterSource="s_mes"/>
				<TableParameter id="23" conditionType="Parameter" useIsNull="False" field="anio" parameterSource="s_anio" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="2"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="3" tableName="gastos" posWidth="95" posHeight="136" posLeft="10" posRight="-1" posTop="10"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="8" tableName="gastos" fieldName="id"/>
				<Field id="11" tableName="gastos" fieldName="detalle"/>
				<Field id="13" tableName="gastos" fieldName="importe"/>
				<Field id="28" tableName="gastos" fieldName="mes"/>
				<Field id="29" tableName="gastos" fieldName="anio"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<IncludePage id="18" name="header" PathID="header" page="header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Record id="20" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="gastos1" wizardCaption=" Gastos Buscar" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="gastos_list.ccp" PathID="gastos1">
			<Components>
				<Button id="21" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Buscar" PathID="gastos1Button_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<ListBox id="24" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" returnValueType="Number" name="s_mes" wizardCaption="Mes" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardEmptyCaption="Seleccionar Valor" PathID="gastos1s_mes" connection="Connection1" dataSource="meses" boundColumn="nro" textColumn="nombre">
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
				<TextBox id="25" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="s_anio" wizardCaption="Anio" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" PathID="gastos1s_anio">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
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
		<CodeFile id="Events" language="PHPTemplates" name="gastos_list_events.php" forShow="False" comment="//"/>
		<CodeFile id="Code" language="PHPTemplates" name="gastos_list.php" forShow="True" url="gastos_list.php" comment="//"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="19" groupID="1"/>
	</SecurityGroups>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
