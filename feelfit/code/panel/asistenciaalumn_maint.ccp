<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Connection1" name="asistenciaalumno" dataSource="asistenciaalumno" errorSummator="Error" wizardCaption="Agregar/Editar Asistenciaalumno " wizardFormMethod="post" returnPage="asistenciaalumn_list.ccp" PathID="asistenciaalumno">
			<Components>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Agregar" PathID="asistenciaalumnoButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Enviar" PathID="asistenciaalumnoButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="5" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Borrar" PathID="asistenciaalumnoButton_Delete">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="idAlumno" fieldSource="idAlumno" required="False" caption="Id Alumno" wizardCaption="Id Alumno" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" PathID="asistenciaalumnoidAlumno">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="8" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="fecha" fieldSource="fecha" required="False" caption="Fecha" wizardCaption="Fecha" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" PathID="asistenciaalumnofecha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="9" name="DatePicker_fecha" control="fecha" wizardSatellite="True" wizardControl="fecha" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="asistenciaalumnoDatePicker_fecha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<CheckBox id="10" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="asistio" fieldSource="asistio" required="False" caption="Asistio" wizardCaption="Asistio" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" PathID="asistenciaalumnoasistio" checkedValue="1" uncheckedValue="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<TextBox id="11" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="idEquipamiento" fieldSource="idEquipamiento" required="False" caption="Id Equipamiento" wizardCaption="Id Equipamiento" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" PathID="asistenciaalumnoidEquipamiento">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="12" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="idInstructor" fieldSource="idInstructor" required="False" caption="Id Instructor" wizardCaption="Id Instructor" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" PathID="asistenciaalumnoidInstructor">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
			</Components>
			<Events/>
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
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="asistenciaalumn_maint.php" forShow="True" url="asistenciaalumn_maint.php" comment="//"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
