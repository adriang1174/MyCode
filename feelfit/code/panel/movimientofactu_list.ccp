<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="20" name="movimientofacturacion" connection="Connection1" pageSizeLimit="100" wizardCaption=" Movimientofacturacion Lista de" wizardGridType="Tabular" wizardAllowSorting="True" wizardSortingType="SimpleDir" wizardUsePageScroller="True" wizardAllowInsert="True" wizardAltRecord="False" wizardRecordSeparator="False" wizardAltRecordType="Controls" dataSource="movimientofacturacion">
			<Components>
				<Link id="4" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="movimientofacturacion_Insert" hrefSource="movimientofactu_maint.ccp" removeParameters="id" wizardThemeItem="NavigatorLink" wizardDefaultValue="Agregar Nuevo" parentName="movimientofacturacion" PathID="movimientofacturacionmovimientofacturacion_Insert">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
				<Sorter id="5" visible="True" name="Sorter_id" column="id" wizardCaption="Id" wizardSortingType="SimpleDir" wizardControl="id" wizardAddNbsp="False" PathID="movimientofacturacionSorter_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="6" visible="True" name="Sorter_tipomov" column="tipomov" wizardCaption="Tipomov" wizardSortingType="SimpleDir" wizardControl="tipomov" wizardAddNbsp="False" PathID="movimientofacturacionSorter_tipomov">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="7" visible="True" name="Sorter_mes" column="mes" wizardCaption="Mes" wizardSortingType="SimpleDir" wizardControl="mes" wizardAddNbsp="False" PathID="movimientofacturacionSorter_mes">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="8" visible="True" name="Sorter_anio" column="anio" wizardCaption="Anio" wizardSortingType="SimpleDir" wizardControl="anio" wizardAddNbsp="False" PathID="movimientofacturacionSorter_anio">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="9" visible="True" name="Sorter_importe" column="importe" wizardCaption="Importe" wizardSortingType="SimpleDir" wizardControl="importe" wizardAddNbsp="False" PathID="movimientofacturacionSorter_importe">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="10" visible="True" name="Sorter_idAlumno" column="idAlumno" wizardCaption="Id Alumno" wizardSortingType="SimpleDir" wizardControl="idAlumno" wizardAddNbsp="False" PathID="movimientofacturacionSorter_idAlumno">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="11" visible="True" name="Sorter_idTurno" column="idTurno" wizardCaption="Id Turno" wizardSortingType="SimpleDir" wizardControl="idTurno" wizardAddNbsp="False" PathID="movimientofacturacionSorter_idTurno">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="12" visible="True" name="Sorter_idInstructor" column="idInstructor" wizardCaption="Id Instructor" wizardSortingType="SimpleDir" wizardControl="idInstructor" wizardAddNbsp="False" PathID="movimientofacturacionSorter_idInstructor">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Link id="14" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="id" fieldSource="id" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" hrefSource="movimientofactu_maint.ccp" parentName="movimientofacturacion" rowNumber="1" PathID="movimientofacturacionid">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="15" sourceType="DataField" format="yyyy-mm-dd" name="id" source="id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" name="tipomov" fieldSource="tipomov" wizardCaption="Tipomov" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" wizardAddNbsp="True" parentName="movimientofacturacion" rowNumber="1" PathID="movimientofacturaciontipomov">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="19" fieldSourceType="DBColumn" dataType="Integer" html="False" name="mes" fieldSource="mes" wizardCaption="Mes" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" parentName="movimientofacturacion" rowNumber="1" PathID="movimientofacturacionmes">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="21" fieldSourceType="DBColumn" dataType="Integer" html="False" name="anio" fieldSource="anio" wizardCaption="Anio" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" parentName="movimientofacturacion" rowNumber="1" PathID="movimientofacturacionanio">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="23" fieldSourceType="DBColumn" dataType="Text" html="False" name="importe" fieldSource="importe" wizardCaption="Importe" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" wizardAddNbsp="True" parentName="movimientofacturacion" rowNumber="1" PathID="movimientofacturacionimporte">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="25" fieldSourceType="DBColumn" dataType="Integer" html="False" name="idAlumno" fieldSource="idAlumno" wizardCaption="Id Alumno" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" parentName="movimientofacturacion" rowNumber="1" PathID="movimientofacturacionidAlumno">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="27" fieldSourceType="DBColumn" dataType="Integer" html="False" name="idTurno" fieldSource="idTurno" wizardCaption="Id Turno" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" parentName="movimientofacturacion" rowNumber="1" PathID="movimientofacturacionidTurno">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="29" fieldSourceType="DBColumn" dataType="Integer" html="False" name="idInstructor" fieldSource="idInstructor" wizardCaption="Id Instructor" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" parentName="movimientofacturacion" rowNumber="1" PathID="movimientofacturacionidInstructor">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="30" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardFirst="True" wizardPrev="True" wizardFirstText="|&lt;" wizardPrevText="&lt;&lt;" wizardNextText="&gt;&gt;" wizardLastText="&gt;|" wizardNext="True" wizardLast="True" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="True" wizardOfText="de" wizardImagesScheme="{ccs_style}">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Hide-Show Component" actionCategory="General" id="31" action="Hide" conditionType="Parameter" dataType="Integer" condition="LessThan" name1="TotalPages" sourceType1="SpecialValue" name2="2" sourceType2="Expression"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events/>
			<TableParameters/>
			<JoinTables>
				<JoinTable id="3" tableName="movimientofacturacion" posWidth="-1" posHeight="-1" posLeft="-1" posRight="-1"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="13" tableName="movimientofacturacion" fieldName="id"/>
				<Field id="16" tableName="movimientofacturacion" fieldName="tipomov"/>
				<Field id="18" tableName="movimientofacturacion" fieldName="mes"/>
				<Field id="20" tableName="movimientofacturacion" fieldName="anio"/>
				<Field id="22" tableName="movimientofacturacion" fieldName="importe"/>
				<Field id="24" tableName="movimientofacturacion" fieldName="idAlumno"/>
				<Field id="26" tableName="movimientofacturacion" fieldName="idTurno"/>
				<Field id="28" tableName="movimientofacturacion" fieldName="idInstructor"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="movimientofactu_list_events.php" forShow="False" comment="//"/>
		<CodeFile id="Code" language="PHPTemplates" name="movimientofactu_list.php" forShow="True" url="movimientofactu_list.php" comment="//"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
