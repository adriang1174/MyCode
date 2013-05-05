<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" needGeneration="0" accessDeniedPage="denegado.ccp">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Connection1" name="alumno" dataSource="alumno" errorSummator="Error" wizardCaption="Agregar/Editar Alumno " wizardFormMethod="post" returnPage="alumno_list.ccp" PathID="alumno">
			<Components>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Agregar" PathID="alumnoButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Enviar" PathID="alumnoButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="5" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Borrar" PathID="alumnoButton_Delete">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="nombre" fieldSource="nombre" required="False" caption="Nombre" wizardCaption="Nombre" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" PathID="alumnonombre">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="8" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="tipodoc" fieldSource="tipodoc" required="False" caption="Tipodoc" wizardCaption="Tipodoc" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" PathID="alumnotipodoc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="9" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="nrodocumento" fieldSource="nrodocumento" required="False" caption="Nrodocumento" wizardCaption="Nrodocumento" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" PathID="alumnonrodocumento">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="10" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="domicilio" fieldSource="domicilio" required="False" caption="Domicilio" wizardCaption="Domicilio" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" PathID="alumnodomicilio">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="11" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="telefono" fieldSource="telefono" required="False" caption="Telefono" wizardCaption="Telefono" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" PathID="alumnotelefono">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="12" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="email" fieldSource="email" required="False" caption="Email" wizardCaption="Email" wizardSize="50" wizardMaxLength="128" wizardIsPassword="False" PathID="alumnoemail">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<CheckBox id="13" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="comparte" fieldSource="comparte" required="False" caption="Comparte" wizardCaption="Comparte" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" PathID="alumnocomparte" checkedValue="1" uncheckedValue="0" defaultValue="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<TextBox id="15" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="cuota" PathID="alumnocuota" fieldSource="cuota">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<CheckBox id="16" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="activo" PathID="alumnoactivo" checkedValue="1" uncheckedValue="0" fieldSource="activo">
<Components/>
<Events/>
<Attributes/>
<Features/>
</CheckBox>
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
		<IncludePage id="14" name="header" PathID="header" page="header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="alumno_maint.php" forShow="True" url="alumno_maint.php" comment="//"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
