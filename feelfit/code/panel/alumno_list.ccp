<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" needGeneration="0" accessDeniedPage="denegado.ccp" showSyncDlg="false">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="alumnoSearch" returnPage="alumno_list.ccp" wizardCaption=" Alumno Buscar" wizardOrientation="Vertical" wizardFormMethod="post" PathID="alumnoSearch">
			<Components>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Buscar" PathID="alumnoSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="4" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_nombre" wizardCaption="Nombre" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" PathID="alumnoSearchs_nombre">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_domicilio" wizardCaption="Domicilio" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" PathID="alumnoSearchs_domicilio">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="8" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_telefono" wizardCaption="Telefono" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" PathID="alumnoSearchs_telefono">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="9" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_email" wizardCaption="Email" wizardSize="50" wizardMaxLength="128" wizardIsPassword="False" PathID="alumnoSearchs_email">
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
		<Grid id="11" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="20" name="alumno" connection="Connection1" pageSizeLimit="100" wizardCaption=" Alumno Lista de" wizardGridType="Tabular" wizardAllowSorting="True" wizardSortingType="SimpleDir" wizardUsePageScroller="True" wizardAllowInsert="True" wizardAltRecord="False" wizardRecordSeparator="False" wizardAltRecordType="Controls" dataSource="alumno" pasteActions="pasteActions">
			<Components>
				<Link id="13" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="alumno_Insert" hrefSource="alumno_maint.ccp" removeParameters="id" wizardThemeItem="NavigatorLink" wizardDefaultValue="Agregar Nuevo" PathID="alumnoalumno_Insert">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
				<Sorter id="21" visible="True" name="Sorter_id" column="id" wizardCaption="Id" wizardSortingType="SimpleDir" wizardControl="id" wizardAddNbsp="False" PathID="alumnoSorter_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="22" visible="True" name="Sorter_nombre" column="nombre" wizardCaption="Nombre" wizardSortingType="SimpleDir" wizardControl="nombre" wizardAddNbsp="False" PathID="alumnoSorter_nombre">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="23" visible="True" name="Sorter_tipodoc" column="tipodoc" wizardCaption="Tipodoc" wizardSortingType="SimpleDir" wizardControl="tipodoc" wizardAddNbsp="False" PathID="alumnoSorter_tipodoc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="24" visible="True" name="Sorter_nrodocumento" column="nrodocumento" wizardCaption="Nrodocumento" wizardSortingType="SimpleDir" wizardControl="nrodocumento" wizardAddNbsp="False" PathID="alumnoSorter_nrodocumento">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="25" visible="True" name="Sorter_domicilio" column="domicilio" wizardCaption="Domicilio" wizardSortingType="SimpleDir" wizardControl="domicilio" wizardAddNbsp="False" PathID="alumnoSorter_domicilio">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="26" visible="True" name="Sorter_telefono" column="telefono" wizardCaption="Telefono" wizardSortingType="SimpleDir" wizardControl="telefono" wizardAddNbsp="False" PathID="alumnoSorter_telefono">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="27" visible="True" name="Sorter_email" column="email" wizardCaption="Email" wizardSortingType="SimpleDir" wizardControl="email" wizardAddNbsp="False" PathID="alumnoSorter_email">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="28" visible="True" name="Sorter_comparte" column="comparte" wizardCaption="Comparte" wizardSortingType="SimpleDir" wizardControl="comparte" wizardAddNbsp="False" PathID="alumnoSorter_comparte">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Link id="30" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="id" fieldSource="id" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" hrefSource="alumno_maint.ccp" PathID="alumnoid">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="31" sourceType="DataField" format="yyyy-mm-dd" name="id" source="id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="33" fieldSourceType="DBColumn" dataType="Text" html="False" name="nombre" fieldSource="nombre" wizardCaption="Nombre" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardAddNbsp="True" PathID="alumnonombre">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="35" fieldSourceType="DBColumn" dataType="Text" html="False" name="tipodoc" fieldSource="tipodoc" wizardCaption="Tipodoc" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardAddNbsp="True" PathID="alumnotipodoc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="37" fieldSourceType="DBColumn" dataType="Text" html="False" name="nrodocumento" fieldSource="nrodocumento" wizardCaption="Nrodocumento" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardAddNbsp="True" PathID="alumnonrodocumento">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="39" fieldSourceType="DBColumn" dataType="Text" html="False" name="domicilio" fieldSource="domicilio" wizardCaption="Domicilio" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardAddNbsp="True" PathID="alumnodomicilio">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="41" fieldSourceType="DBColumn" dataType="Text" html="False" name="telefono" fieldSource="telefono" wizardCaption="Telefono" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardAddNbsp="True" PathID="alumnotelefono">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="43" fieldSourceType="DBColumn" dataType="Text" html="False" name="email" fieldSource="email" wizardCaption="Email" wizardSize="50" wizardMaxLength="128" wizardIsPassword="False" wizardAddNbsp="True" PathID="alumnoemail">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="45" fieldSourceType="DBColumn" dataType="Text" html="False" name="comparte" fieldSource="comparte" wizardCaption="Comparte" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" wizardAddNbsp="True" PathID="alumnocomparte">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="48"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="46" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardFirst="True" wizardPrev="True" wizardFirstText="|&lt;" wizardPrevText="&lt;&lt;" wizardNextText="&gt;&gt;" wizardLastText="&gt;|" wizardNext="True" wizardLast="True" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="True" wizardOfText="de" wizardImagesScheme="{ccs_style}">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Hide-Show Component" actionCategory="General" id="47" action="Hide" conditionType="Parameter" dataType="Integer" condition="LessThan" name1="TotalPages" sourceType1="SpecialValue" name2="2" sourceType2="Expression"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="50" fieldSourceType="DBColumn" dataType="Integer" html="False" name="cuota" PathID="alumnocuota" fieldSource="cuota">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="54" fieldSourceType="DBColumn" dataType="Text" html="False" name="negrita" PathID="alumnonegrita">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="56" fieldSourceType="DBColumn" dataType="Text" html="False" name="cont" PathID="alumnocont">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="57"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="58" fieldSourceType="DBColumn" dataType="Text" html="False" name="activo" PathID="alumnoactivo" fieldSource="activo">
<Components/>
<Events>
<Event name="BeforeShow" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="60"/>
</Actions>
</Event>
</Events>
<Attributes/>
<Features/>
</Label>
</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="55"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="14" conditionType="Parameter" useIsNull="False" field="nombre" parameterSource="s_nombre" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="1"/>
				<TableParameter id="17" conditionType="Parameter" useIsNull="False" field="domicilio" parameterSource="s_domicilio" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="4"/>
				<TableParameter id="18" conditionType="Parameter" useIsNull="False" field="telefono" parameterSource="s_telefono" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="5"/>
				<TableParameter id="19" conditionType="Parameter" useIsNull="False" field="email" parameterSource="s_email" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="6"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="12" tableName="alumno" posWidth="115" posHeight="180" posLeft="10" posRight="-1" posTop="10"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="29" tableName="alumno" fieldName="id"/>
				<Field id="32" tableName="alumno" fieldName="nombre"/>
				<Field id="34" tableName="alumno" fieldName="tipodoc"/>
				<Field id="36" tableName="alumno" fieldName="nrodocumento"/>
				<Field id="38" tableName="alumno" fieldName="domicilio"/>
				<Field id="40" tableName="alumno" fieldName="telefono"/>
				<Field id="42" tableName="alumno" fieldName="email"/>
				<Field id="44" tableName="alumno" fieldName="comparte"/>
				<Field id="51" tableName="alumno" fieldName="cuota"/>
				<Field id="59" tableName="alumno" fieldName="activo"/>
</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes>
				<Attribute id="53" name="negrita"/>
			</Attributes>
			<Features/>
		</Grid>
		<IncludePage id="49" name="header" PathID="header" page="header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="alumno_list_events.php" forShow="False" comment="//"/>
		<CodeFile id="Code" language="PHPTemplates" name="alumno_list.php" forShow="True" url="alumno_list.php" comment="//"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
