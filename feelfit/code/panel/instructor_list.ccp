<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" needGeneration="0" accessDeniedPage="denegado.ccp">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="instructorSearch" returnPage="instructor_list.ccp" wizardCaption=" Instructor Buscar" wizardOrientation="Vertical" wizardFormMethod="post" PathID="instructorSearch">
			<Components>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Buscar" PathID="instructorSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="4" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_nombre" wizardCaption="Nombre" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" PathID="instructorSearchs_nombre">
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
		<Grid id="7" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="20" name="instructor" connection="Connection1" pageSizeLimit="100" wizardCaption=" Instructor Lista de" wizardGridType="Tabular" wizardAllowSorting="True" wizardSortingType="SimpleDir" wizardUsePageScroller="True" wizardAllowInsert="True" wizardAltRecord="False" wizardRecordSeparator="False" wizardAltRecordType="Controls" dataSource="instructor">
			<Components>
				<Link id="9" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="instructor_Insert" hrefSource="instructor_maint.ccp" removeParameters="id" wizardThemeItem="NavigatorLink" wizardDefaultValue="Agregar Nuevo" PathID="instructorinstructor_Insert">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
				<Sorter id="13" visible="True" name="Sorter_id" column="id" wizardCaption="Id" wizardSortingType="SimpleDir" wizardControl="id" wizardAddNbsp="False" PathID="instructorSorter_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="14" visible="True" name="Sorter_nombre" column="nombre" wizardCaption="Nombre" wizardSortingType="SimpleDir" wizardControl="nombre" wizardAddNbsp="False" PathID="instructorSorter_nombre">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="15" visible="True" name="Sorter_tipodoc" column="tipodoc" wizardCaption="Tipodoc" wizardSortingType="SimpleDir" wizardControl="tipodoc" wizardAddNbsp="False" PathID="instructorSorter_tipodoc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="16" visible="True" name="Sorter_nrodocumento" column="nrodocumento" wizardCaption="Nrodocumento" wizardSortingType="SimpleDir" wizardControl="nrodocumento" wizardAddNbsp="False" PathID="instructorSorter_nrodocumento">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Link id="18" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="id" fieldSource="id" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" hrefSource="instructor_maint.ccp" PathID="instructorid">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="19" sourceType="DataField" format="yyyy-mm-dd" name="id" source="id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="21" fieldSourceType="DBColumn" dataType="Text" html="False" name="nombre" fieldSource="nombre" wizardCaption="Nombre" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardAddNbsp="True" PathID="instructornombre">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="23" fieldSourceType="DBColumn" dataType="Text" html="False" name="tipodoc" fieldSource="tipodoc" wizardCaption="Tipodoc" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardAddNbsp="True" PathID="instructortipodoc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="25" fieldSourceType="DBColumn" dataType="Text" html="False" name="nrodocumento" fieldSource="nrodocumento" wizardCaption="Nrodocumento" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardAddNbsp="True" PathID="instructornrodocumento">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="26" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardFirst="True" wizardPrev="True" wizardFirstText="|&lt;" wizardPrevText="&lt;&lt;" wizardNextText="&gt;&gt;" wizardLastText="&gt;|" wizardNext="True" wizardLast="True" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="True" wizardOfText="de" wizardImagesScheme="{ccs_style}">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Hide-Show Component" actionCategory="General" id="27" action="Hide" conditionType="Parameter" dataType="Integer" condition="LessThan" name1="TotalPages" sourceType1="SpecialValue" name2="2" sourceType2="Expression"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="10" conditionType="Parameter" useIsNull="False" field="nombre" parameterSource="s_nombre" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="1"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="8" tableName="instructor" posWidth="95" posHeight="120" posLeft="10" posRight="-1" posTop="10"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="17" tableName="instructor" fieldName="id"/>
				<Field id="20" tableName="instructor" fieldName="nombre"/>
				<Field id="22" tableName="instructor" fieldName="tipodoc"/>
				<Field id="24" tableName="instructor" fieldName="nrodocumento"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<IncludePage id="28" name="header" PathID="header" page="header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="instructor_list_events.php" forShow="False" comment="//"/>
		<CodeFile id="Code" language="PHPTemplates" name="instructor_list.php" forShow="True" url="instructor_list.php" comment="//"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
