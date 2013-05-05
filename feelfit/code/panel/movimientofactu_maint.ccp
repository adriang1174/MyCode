<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" needGeneration="0" accessDeniedPage="denegado.ccp">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="True" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Connection1" name="movimientofacturacion" dataSource="movimientofacturacion" errorSummator="Error" wizardCaption="Agregar/Editar Movimientofacturacion " wizardFormMethod="post" returnPage="cuotas_pagadas.ccp" PathID="movimientofacturacion" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions">
			<Components>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Agregar" PathID="movimientofacturacionButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Enviar" PathID="movimientofacturacionButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="5" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Borrar" PathID="movimientofacturacionButton_Delete">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<ListBox id="8" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="mes" fieldSource="mes" required="False" caption="Mes" wizardCaption="Mes" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" PathID="movimientofacturacionmes" sourceType="Table" connection="Connection1" dataSource="meses" boundColumn="nro" textColumn="nombre">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="14" tableName="meses" posLeft="10" posTop="10" posWidth="95" posHeight="88"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
				</ListBox>
				<TextBox id="9" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="anio" fieldSource="anio" required="False" caption="Anio" wizardCaption="Anio" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" PathID="movimientofacturacionanio">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="10" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="importe" fieldSource="importe" required="False" caption="Importe" wizardCaption="Importe" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" PathID="movimientofacturacionimporte">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="11" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="idAlumno" fieldSource="idAlumno" required="False" caption="Id Alumno" wizardCaption="Id Alumno" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" PathID="movimientofacturacionidAlumno" sourceType="Table" connection="Connection1" dataSource="alumno" boundColumn="id" textColumn="nombre">
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
				<Hidden id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="tipomov" fieldSource="tipomov" required="False" caption="Tipomov" wizardCaption="Tipomov" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" PathID="movimientofacturaciontipomov">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="15"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Hidden>
				<ListBox id="17" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" returnValueType="Number" name="instructor" wizardEmptyCaption="Seleccionar Valor" PathID="movimientofacturacioninstructor" fieldSource="idInstructor" connection="Connection1" dataSource="instructor" boundColumn="id" textColumn="nombre">
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
			<SecurityGroups>
				<Group id="21" groupID="1" read="True" insert="True" update="True" delete="True"/>
<Group id="22" groupID="100" read="True" insert="True" update="True" delete="True"/>
</SecurityGroups>
			<Attributes/>
			<Features/>
		</Record>
		<IncludePage id="16" name="header" page="header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="movimientofactu_maint_events.php" forShow="False" comment="//"/>
		<CodeFile id="Code" language="PHPTemplates" name="movimientofactu_maint.php" forShow="True" url="movimientofactu_maint.php" comment="//"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="19" groupID="1"/>
<Group id="20" groupID="100"/>
</SecurityGroups>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
