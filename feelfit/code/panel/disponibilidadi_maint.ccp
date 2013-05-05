<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" needGeneration="0" accessDeniedPage="denegado.ccp">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Connection1" name="disponibilidadinstructor" dataSource="disponibilidadinstructor" errorSummator="Error" wizardCaption="Agregar/Editar Disponibilidadinstructor " wizardFormMethod="post" returnPage="disponibilidadi_list.ccp" PathID="disponibilidadinstructor">
			<Components>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Agregar" PathID="disponibilidadinstructorButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Enviar" PathID="disponibilidadinstructorButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="5" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Borrar" PathID="disponibilidadinstructorButton_Delete">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<ListBox id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="idInstructor" fieldSource="idInstructor" required="False" caption="Id Instructor" wizardCaption="Id Instructor" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" PathID="disponibilidadinstructoridInstructor" sourceType="Table" connection="Connection1" dataSource="instructor" boundColumn="id" textColumn="nombre">
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
				<ListBox id="8" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="idEquipamiento" fieldSource="idEquipamiento" required="False" caption="Id Equipamiento" wizardCaption="Id Equipamiento" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" PathID="disponibilidadinstructoridEquipamiento" sourceType="Table" connection="Connection1" dataSource="equipamiento" boundColumn="id" textColumn="descripcion">
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
				<Hidden id="9" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="rangodias" fieldSource="rangodias" required="False" caption="Rangodias" wizardCaption="Rangodias" wizardSize="7" wizardMaxLength="7" wizardIsPassword="False" PathID="disponibilidadinstructorrangodias">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="21"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="10" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="fechaespec" fieldSource="fechaespec" required="False" caption="Fechaespec" wizardCaption="Fechaespec" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" PathID="disponibilidadinstructorfechaespec">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="11" name="DatePicker_fechaespec" control="fechaespec" wizardSatellite="True" wizardControl="fechaespec" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="disponibilidadinstructorDatePicker_fechaespec">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<TextBox id="12" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="horaini" fieldSource="horaini" required="False" caption="Horaini" wizardCaption="Horaini" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" PathID="disponibilidadinstructorhoraini">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="13" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="horafin" fieldSource="horafin" required="False" caption="Horafin" wizardCaption="Horafin" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" PathID="disponibilidadinstructorhorafin">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<CheckBox id="14" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="l" PathID="disponibilidadinstructorl" checkedValue="1" uncheckedValue="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<CheckBox id="15" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="m" PathID="disponibilidadinstructorm" checkedValue="1" uncheckedValue="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<CheckBox id="16" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="x" PathID="disponibilidadinstructorx" checkedValue="1" uncheckedValue="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<CheckBox id="17" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="j" PathID="disponibilidadinstructorj" checkedValue="1" uncheckedValue="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<CheckBox id="18" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="v" PathID="disponibilidadinstructorv" checkedValue="1" uncheckedValue="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<CheckBox id="19" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s" PathID="disponibilidadinstructors" checkedValue="1" uncheckedValue="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<CheckBox id="20" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="d" PathID="disponibilidadinstructord" checkedValue="1" uncheckedValue="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
			</Components>
			<Events>
				<Event name="BeforeBuildInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="22"/>
					</Actions>
				</Event>
				<Event name="BeforeBuildUpdate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="23"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="6" conditionType="Parameter" useIsNull="False" field="id" parameterSource="id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
			</TableParameters>
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
		<IncludePage id="24" name="header" PathID="header" page="header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="disponibilidadi_maint_events.php" forShow="False" comment="//"/>
		<CodeFile id="Code" language="PHPTemplates" name="disponibilidadi_maint.php" forShow="True" url="disponibilidadi_maint.php" comment="//"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
