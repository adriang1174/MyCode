<?php
//Include Common Files @1-22D886B0
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "asistenciaalumn_list_old.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordasistenciaalumnoSearch { //asistenciaalumnoSearch Class @2-480640FF

//Variables @2-D6FF3E86

    // Public variables
    var $ComponentType = "Record";
    var $ComponentName;
    var $Parent;
    var $HTMLFormAction;
    var $PressedButton;
    var $Errors;
    var $ErrorBlock;
    var $FormSubmitted;
    var $FormEnctype;
    var $Visible;
    var $IsEmpty;

    var $CCSEvents = "";
    var $CCSEventResult;

    var $RelativePath = "";

    var $InsertAllowed = false;
    var $UpdateAllowed = false;
    var $DeleteAllowed = false;
    var $ReadAllowed   = false;
    var $EditMode      = false;
    var $ds;
    var $DataSource;
    var $ValidatingControls;
    var $Controls;
    var $Attributes;

    // Class variables
//End Variables

//Class_Initialize Event @2-2739778B
    function clsRecordasistenciaalumnoSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record asistenciaalumnoSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "asistenciaalumnoSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->s_alumno = & new clsControl(ccsListBox, "s_alumno", "s_alumno", ccsInteger, "", CCGetRequestParam("s_alumno", $Method, NULL), $this);
            $this->s_alumno->DSType = dsTable;
            $this->s_alumno->DataSource = new clsDBConnection1();
            $this->s_alumno->ds = & $this->s_alumno->DataSource;
            $this->s_alumno->DataSource->SQL = "SELECT * \n" .
"FROM alumno {SQL_Where} {SQL_OrderBy}";
            list($this->s_alumno->BoundColumn, $this->s_alumno->TextColumn, $this->s_alumno->DBFormat) = array("id", "nombre", "");
            $this->s_fdesde = & new clsControl(ccsTextBox, "s_fdesde", "s_fdesde", ccsDate, $DefaultDateFormat, CCGetRequestParam("s_fdesde", $Method, NULL), $this);
            $this->s_fhasta = & new clsControl(ccsTextBox, "s_fhasta", "s_fhasta", ccsDate, $DefaultDateFormat, CCGetRequestParam("s_fhasta", $Method, NULL), $this);
            $this->DatePicker_s_fdesde1 = & new clsDatePicker("DatePicker_s_fdesde1", "asistenciaalumnoSearch", "s_fdesde", $this);
            $this->DatePicker_s_fhasta1 = & new clsDatePicker("DatePicker_s_fhasta1", "asistenciaalumnoSearch", "s_fhasta", $this);
        }
    }
//End Class_Initialize Event

//Validate Method @2-8A61B1BE
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_alumno->Validate() && $Validation);
        $Validation = ($this->s_fdesde->Validate() && $Validation);
        $Validation = ($this->s_fhasta->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_alumno->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_fdesde->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_fhasta->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-BB07FA77
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_alumno->Errors->Count());
        $errors = ($errors || $this->s_fdesde->Errors->Count());
        $errors = ($errors || $this->s_fhasta->Errors->Count());
        $errors = ($errors || $this->DatePicker_s_fdesde1->Errors->Count());
        $errors = ($errors || $this->DatePicker_s_fhasta1->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @2-ED598703
function SetPrimaryKeys($keyArray)
{
    $this->PrimaryKeys = $keyArray;
}
function GetPrimaryKeys()
{
    return $this->PrimaryKeys;
}
function GetPrimaryKey($keyName)
{
    return $this->PrimaryKeys[$keyName];
}
//End MasterDetail

//Operation Method @2-496EA67E
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        if(!$this->FormSubmitted) {
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = "Button_DoSearch";
            if($this->Button_DoSearch->Pressed) {
                $this->PressedButton = "Button_DoSearch";
            }
        }
        $Redirect = "asistenciaalumn_list_old.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "asistenciaalumn_list_old.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @2-3672BED9
    function Show()
    {
        global $CCSUseAmp;
        global $Tpl;
        global $FileName;
        global $CCSLocales;
        $Error = "";

        if(!$this->Visible)
            return;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->s_alumno->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_alumno->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_fdesde->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_fhasta->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_s_fdesde1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_s_fhasta1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_DoSearch->Show();
        $this->s_alumno->Show();
        $this->s_fdesde->Show();
        $this->s_fhasta->Show();
        $this->DatePicker_s_fdesde1->Show();
        $this->DatePicker_s_fhasta1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End asistenciaalumnoSearch Class @2-FCB6E20C

class clsGridasistenciaalumno { //asistenciaalumno class @5-BC3473C5

//Variables @5-92B296A9

    // Public variables
    var $ComponentType = "Grid";
    var $ComponentName;
    var $Visible;
    var $Errors;
    var $ErrorBlock;
    var $ds;
    var $DataSource;
    var $PageSize;
    var $IsEmpty;
    var $ForceIteration = false;
    var $HasRecord = false;
    var $SorterName = "";
    var $SorterDirection = "";
    var $PageNumber;
    var $RowNumber;
    var $ControlsVisible = array();

    var $CCSEvents = "";
    var $CCSEventResult;

    var $RelativePath = "";
    var $Attributes;

    // Grid Controls
    var $StaticControls;
    var $RowControls;
    var $Sorter_id;
    var $Sorter_idAlumno;
    var $Sorter_fecha;
    var $Sorter_asistio;
    var $Sorter_idEquipamiento;
    var $Sorter_idInstructor;
//End Variables

//Class_Initialize Event @5-439B5506
    function clsGridasistenciaalumno($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "asistenciaalumno";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid asistenciaalumno";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsasistenciaalumnoDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 20;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;
        $this->SorterName = CCGetParam("asistenciaalumnoOrder", "");
        $this->SorterDirection = CCGetParam("asistenciaalumnoDir", "");

        $this->id = & new clsControl(ccsLink, "id", "id", ccsInteger, "", CCGetRequestParam("id", ccsGet, NULL), $this);
        $this->id->Page = "asistenciaalumn_maint.php";
        $this->idAlumno = & new clsControl(ccsHidden, "idAlumno", "idAlumno", ccsInteger, "", CCGetRequestParam("idAlumno", ccsGet, NULL), $this);
        $this->fecha = & new clsControl(ccsLabel, "fecha", "fecha", ccsDate, $DefaultDateFormat, CCGetRequestParam("fecha", ccsGet, NULL), $this);
        $this->asistio = & new clsControl(ccsCheckBox, "asistio", "asistio", ccsText, "", CCGetRequestParam("asistio", ccsGet, NULL), $this);
        $this->asistio->CheckedValue = $this->asistio->GetParsedValue(1);
        $this->asistio->UncheckedValue = $this->asistio->GetParsedValue(0);
        $this->idEquipamiento = & new clsControl(ccsHidden, "idEquipamiento", "idEquipamiento", ccsInteger, "", CCGetRequestParam("idEquipamiento", ccsGet, NULL), $this);
        $this->idInstructor = & new clsControl(ccsHidden, "idInstructor", "idInstructor", ccsInteger, "", CCGetRequestParam("idInstructor", ccsGet, NULL), $this);
        $this->alumno_nombre = & new clsControl(ccsLabel, "alumno_nombre", "alumno_nombre", ccsText, "", CCGetRequestParam("alumno_nombre", ccsGet, NULL), $this);
        $this->descripcion = & new clsControl(ccsLabel, "descripcion", "descripcion", ccsText, "", CCGetRequestParam("descripcion", ccsGet, NULL), $this);
        $this->instructor_nombre = & new clsControl(ccsLabel, "instructor_nombre", "instructor_nombre", ccsText, "", CCGetRequestParam("instructor_nombre", ccsGet, NULL), $this);
        $this->Sorter_id = & new clsSorter($this->ComponentName, "Sorter_id", $FileName, $this);
        $this->Sorter_idAlumno = & new clsSorter($this->ComponentName, "Sorter_idAlumno", $FileName, $this);
        $this->Sorter_fecha = & new clsSorter($this->ComponentName, "Sorter_fecha", $FileName, $this);
        $this->Sorter_asistio = & new clsSorter($this->ComponentName, "Sorter_asistio", $FileName, $this);
        $this->Sorter_idEquipamiento = & new clsSorter($this->ComponentName, "Sorter_idEquipamiento", $FileName, $this);
        $this->Sorter_idInstructor = & new clsSorter($this->ComponentName, "Sorter_idInstructor", $FileName, $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @5-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @5-B906CA2F
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_alumno"] = CCGetFromGet("s_alumno", NULL);
        $this->DataSource->Parameters["urls_fdesde"] = CCGetFromGet("s_fdesde", NULL);
        $this->DataSource->Parameters["urls_fhasta"] = CCGetFromGet("s_fhasta", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();
        $this->HasRecord = $this->DataSource->has_next_record();
        $this->IsEmpty = ! $this->HasRecord;
        $this->Attributes->Show();

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) return;

        $GridBlock = "Grid " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $GridBlock;


        if (!$this->IsEmpty) {
            $this->ControlsVisible["id"] = $this->id->Visible;
            $this->ControlsVisible["idAlumno"] = $this->idAlumno->Visible;
            $this->ControlsVisible["fecha"] = $this->fecha->Visible;
            $this->ControlsVisible["asistio"] = $this->asistio->Visible;
            $this->ControlsVisible["idEquipamiento"] = $this->idEquipamiento->Visible;
            $this->ControlsVisible["idInstructor"] = $this->idInstructor->Visible;
            $this->ControlsVisible["alumno_nombre"] = $this->alumno_nombre->Visible;
            $this->ControlsVisible["descripcion"] = $this->descripcion->Visible;
            $this->ControlsVisible["instructor_nombre"] = $this->instructor_nombre->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->id->SetValue($this->DataSource->id->GetValue());
                $this->id->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->id->Parameters = CCAddParam($this->id->Parameters, "id", $this->DataSource->f("id"));
                $this->idAlumno->SetValue($this->DataSource->idAlumno->GetValue());
                $this->fecha->SetValue($this->DataSource->fecha->GetValue());
                $this->asistio->SetValue($this->DataSource->asistio->GetValue());
                $this->idEquipamiento->SetValue($this->DataSource->idEquipamiento->GetValue());
                $this->idInstructor->SetValue($this->DataSource->idInstructor->GetValue());
                $this->alumno_nombre->SetValue($this->DataSource->alumno_nombre->GetValue());
                $this->descripcion->SetValue($this->DataSource->descripcion->GetValue());
                $this->instructor_nombre->SetValue($this->DataSource->instructor_nombre->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->id->Show();
                $this->idAlumno->Show();
                $this->fecha->Show();
                $this->asistio->Show();
                $this->idEquipamiento->Show();
                $this->idInstructor->Show();
                $this->alumno_nombre->Show();
                $this->descripcion->Show();
                $this->instructor_nombre->Show();
                $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                $Tpl->parse("Row", true);
            }
        }
        else { // Show NoRecords block if no records are found
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $errors = $this->GetErrors();
        if(strlen($errors))
        {
            $Tpl->replaceblock("", $errors);
            $Tpl->block_path = $ParentPath;
            return;
        }
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if ($this->Navigator->TotalPages <= 1) {
            $this->Navigator->Visible = false;
        }
        $this->Sorter_id->Show();
        $this->Sorter_idAlumno->Show();
        $this->Sorter_fecha->Show();
        $this->Sorter_asistio->Show();
        $this->Sorter_idEquipamiento->Show();
        $this->Sorter_idInstructor->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @5-921F0DBE
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->idAlumno->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fecha->Errors->ToString());
        $errors = ComposeStrings($errors, $this->asistio->Errors->ToString());
        $errors = ComposeStrings($errors, $this->idEquipamiento->Errors->ToString());
        $errors = ComposeStrings($errors, $this->idInstructor->Errors->ToString());
        $errors = ComposeStrings($errors, $this->alumno_nombre->Errors->ToString());
        $errors = ComposeStrings($errors, $this->descripcion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->instructor_nombre->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End asistenciaalumno Class @5-FCB6E20C

class clsasistenciaalumnoDataSource extends clsDBConnection1 {  //asistenciaalumnoDataSource Class @5-D3C942DC

//DataSource Variables @5-86D2EDCD
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $id;
    var $idAlumno;
    var $fecha;
    var $asistio;
    var $idEquipamiento;
    var $idInstructor;
    var $alumno_nombre;
    var $descripcion;
    var $instructor_nombre;
//End DataSource Variables

//DataSourceClass_Initialize Event @5-E8E633E8
    function clsasistenciaalumnoDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid asistenciaalumno";
        $this->Initialize();
        $this->id = new clsField("id", ccsInteger, "");
        
        $this->idAlumno = new clsField("idAlumno", ccsInteger, "");
        
        $this->fecha = new clsField("fecha", ccsDate, $this->DateFormat);
        
        $this->asistio = new clsField("asistio", ccsText, "");
        
        $this->idEquipamiento = new clsField("idEquipamiento", ccsInteger, "");
        
        $this->idInstructor = new clsField("idInstructor", ccsInteger, "");
        
        $this->alumno_nombre = new clsField("alumno_nombre", ccsText, "");
        
        $this->descripcion = new clsField("descripcion", ccsText, "");
        
        $this->instructor_nombre = new clsField("instructor_nombre", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @5-D2CC3597
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_id" => array("id", ""), 
            "Sorter_idAlumno" => array("idAlumno", ""), 
            "Sorter_fecha" => array("fecha", ""), 
            "Sorter_asistio" => array("asistio", ""), 
            "Sorter_idEquipamiento" => array("idEquipamiento", ""), 
            "Sorter_idInstructor" => array("idInstructor", "")));
    }
//End SetOrder Method

//Prepare Method @5-7558F11E
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_alumno", ccsInteger, "", "", $this->Parameters["urls_alumno"], 12, false);
        $this->wp->AddParameter("2", "urls_fdesde", ccsDate, $DefaultDateFormat, $this->DateFormat, $this->Parameters["urls_fdesde"], 1901-01-01, false);
        $this->wp->AddParameter("3", "urls_fhasta", ccsDate, $DefaultDateFormat, $this->DateFormat, $this->Parameters["urls_fhasta"], 2100-01-01, false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "asistenciaalumno.idAlumno", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opGreaterThanOrEqual, "asistenciaalumno.fecha", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsDate),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opLessThanOrEqual, "asistenciaalumno.fecha", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsDate),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]);
    }
//End Prepare Method

//Open Method @5-1538A2F4
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM ((asistenciaalumno LEFT JOIN instructor ON\n\n" .
        "asistenciaalumno.idInstructor = instructor.id) LEFT JOIN equipamiento ON\n\n" .
        "asistenciaalumno.idEquipamiento = equipamiento.id) INNER JOIN alumno ON\n\n" .
        "asistenciaalumno.idAlumno = alumno.id";
        $this->SQL = "SELECT asistenciaalumno.id AS asistenciaalumno_id, idAlumno, fecha, asistio, idEquipamiento, idInstructor, instructor.nombre AS instructor_nombre,\n\n" .
        "descripcion, alumno.nombre AS alumno_nombre \n\n" .
        "FROM ((asistenciaalumno LEFT JOIN instructor ON\n\n" .
        "asistenciaalumno.idInstructor = instructor.id) LEFT JOIN equipamiento ON\n\n" .
        "asistenciaalumno.idEquipamiento = equipamiento.id) INNER JOIN alumno ON\n\n" .
        "asistenciaalumno.idAlumno = alumno.id {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @5-4BCBAF7D
    function SetValues()
    {
        $this->id->SetDBValue(trim($this->f("id")));
        $this->idAlumno->SetDBValue(trim($this->f("idAlumno")));
        $this->fecha->SetDBValue(trim($this->f("fecha")));
        $this->asistio->SetDBValue($this->f("asistio"));
        $this->idEquipamiento->SetDBValue(trim($this->f("idEquipamiento")));
        $this->idInstructor->SetDBValue(trim($this->f("idInstructor")));
        $this->alumno_nombre->SetDBValue($this->f("alumno_nombre"));
        $this->descripcion->SetDBValue($this->f("descripcion"));
        $this->instructor_nombre->SetDBValue($this->f("instructor_nombre"));
    }
//End SetValues Method

} //End asistenciaalumnoDataSource Class @5-FCB6E20C

//Include Page implementation @58-8EACA429
include_once(RelativePath . "/header.php");
//End Include Page implementation

//Initialize Page @1-1132D656
// Variables
$FileName = "";
$Redirect = "";
$Tpl = "";
$TemplateFileName = "";
$BlockToParse = "";
$ComponentName = "";
$Attributes = "";

// Events;
$CCSEvents = "";
$CCSEventResult = "";

$FileName = FileName;
$Redirect = "";
$TemplateFileName = "asistenciaalumn_list_old.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Authenticate User @1-89E04E5F
CCSecurityRedirect("", "denegado.php");
//End Authenticate User

//Include events file @1-99DD3F69
include_once("./asistenciaalumn_list_old_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-2B1DC073
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$asistenciaalumnoSearch = & new clsRecordasistenciaalumnoSearch("", $MainPage);
$asistenciaalumno = & new clsGridasistenciaalumno("", $MainPage);
$header = & new clsheader("", "header", $MainPage);
$header->Initialize();
$MainPage->asistenciaalumnoSearch = & $asistenciaalumnoSearch;
$MainPage->asistenciaalumno = & $asistenciaalumno;
$MainPage->header = & $header;
$asistenciaalumno->Initialize();

BindEvents();

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize", $MainPage);

if ($Charset) {
    header("Content-Type: " . $ContentType . "; charset=" . $Charset);
} else {
    header("Content-Type: " . $ContentType);
}
//End Initialize Objects

//Initialize HTML Template @1-BBAEC725
$CCSEventResult = CCGetEvent($CCSEvents, "OnInitializeView", $MainPage);
$Tpl = new clsTemplate();
$Tpl->LoadTemplate(PathToCurrentPage . $TemplateFileName, $BlockToParse, "CP1252");
$Tpl->block_path = "/$BlockToParse";
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeShow", $MainPage);
$Attributes->SetValue("pathToRoot", "");
$Attributes->Show();
//End Initialize HTML Template

//Execute Components @1-48A1D781
$asistenciaalumnoSearch->Operation();
$header->Operations();
//End Execute Components

//Go to destination page @1-DF11ED6D
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    unset($asistenciaalumnoSearch);
    unset($asistenciaalumno);
    $header->Class_Terminate();
    unset($header);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-50B921E2
$asistenciaalumnoSearch->Show();
$asistenciaalumno->Show();
$header->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-6CA3E50E
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
unset($asistenciaalumnoSearch);
unset($asistenciaalumno);
$header->Class_Terminate();
unset($header);
unset($Tpl);
//End Unload Page


?>
