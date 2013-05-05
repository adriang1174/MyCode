<?php
//Include Common Files @1-00F76C5C
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "asistenciaalumn_maint.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordasistenciaalumno { //asistenciaalumno Class @2-922715AB

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

//Class_Initialize Event @2-A5B1A919
    function clsRecordasistenciaalumno($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record asistenciaalumno/Error";
        $this->DataSource = new clsasistenciaalumnoDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "asistenciaalumno";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Insert = & new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = & new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = & new clsButton("Button_Delete", $Method, $this);
            $this->idAlumno = & new clsControl(ccsTextBox, "idAlumno", "Id Alumno", ccsInteger, "", CCGetRequestParam("idAlumno", $Method, NULL), $this);
            $this->fecha = & new clsControl(ccsTextBox, "fecha", "Fecha", ccsDate, $DefaultDateFormat, CCGetRequestParam("fecha", $Method, NULL), $this);
            $this->DatePicker_fecha = & new clsDatePicker("DatePicker_fecha", "asistenciaalumno", "fecha", $this);
            $this->asistio = & new clsControl(ccsCheckBox, "asistio", "Asistio", ccsText, "", CCGetRequestParam("asistio", $Method, NULL), $this);
            $this->asistio->CheckedValue = $this->asistio->GetParsedValue(1);
            $this->asistio->UncheckedValue = $this->asistio->GetParsedValue(0);
            $this->idEquipamiento = & new clsControl(ccsTextBox, "idEquipamiento", "Id Equipamiento", ccsInteger, "", CCGetRequestParam("idEquipamiento", $Method, NULL), $this);
            $this->idInstructor = & new clsControl(ccsTextBox, "idInstructor", "Id Instructor", ccsInteger, "", CCGetRequestParam("idInstructor", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @2-2832F4DC
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlid"] = CCGetFromGet("id", NULL);
    }
//End Initialize Method

//Validate Method @2-C4EE628A
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->idAlumno->Validate() && $Validation);
        $Validation = ($this->fecha->Validate() && $Validation);
        $Validation = ($this->asistio->Validate() && $Validation);
        $Validation = ($this->idEquipamiento->Validate() && $Validation);
        $Validation = ($this->idInstructor->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->idAlumno->Errors->Count() == 0);
        $Validation =  $Validation && ($this->fecha->Errors->Count() == 0);
        $Validation =  $Validation && ($this->asistio->Errors->Count() == 0);
        $Validation =  $Validation && ($this->idEquipamiento->Errors->Count() == 0);
        $Validation =  $Validation && ($this->idInstructor->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-6D9A0EC1
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->idAlumno->Errors->Count());
        $errors = ($errors || $this->fecha->Errors->Count());
        $errors = ($errors || $this->DatePicker_fecha->Errors->Count());
        $errors = ($errors || $this->asistio->Errors->Count());
        $errors = ($errors || $this->idEquipamiento->Errors->Count());
        $errors = ($errors || $this->idInstructor->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
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

//Operation Method @2-1B67A00D
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted) {
            $this->EditMode = $this->DataSource->AllParametersSet;
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = $this->EditMode ? "Button_Update" : "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            } else if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            } else if($this->Button_Delete->Pressed) {
                $this->PressedButton = "Button_Delete";
            }
        }
        $Redirect = "asistenciaalumn_list.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update) || !$this->UpdateRow()) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//InsertRow Method @2-1308D0AE
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->idAlumno->SetValue($this->idAlumno->GetValue(true));
        $this->DataSource->fecha->SetValue($this->fecha->GetValue(true));
        $this->DataSource->asistio->SetValue($this->asistio->GetValue(true));
        $this->DataSource->idEquipamiento->SetValue($this->idEquipamiento->GetValue(true));
        $this->DataSource->idInstructor->SetValue($this->idInstructor->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @2-E7EF2464
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->idAlumno->SetValue($this->idAlumno->GetValue(true));
        $this->DataSource->fecha->SetValue($this->fecha->GetValue(true));
        $this->DataSource->asistio->SetValue($this->asistio->GetValue(true));
        $this->DataSource->idEquipamiento->SetValue($this->idEquipamiento->GetValue(true));
        $this->DataSource->idInstructor->SetValue($this->idInstructor->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @2-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @2-029FDE81
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


        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if($this->EditMode) {
            if($this->DataSource->Errors->Count()){
                $this->Errors->AddErrors($this->DataSource->Errors);
                $this->DataSource->Errors->clear();
            }
            $this->DataSource->Open();
            if($this->DataSource->Errors->Count() == 0 && $this->DataSource->next_record()) {
                $this->DataSource->SetValues();
                if(!$this->FormSubmitted){
                    $this->idAlumno->SetValue($this->DataSource->idAlumno->GetValue());
                    $this->fecha->SetValue($this->DataSource->fecha->GetValue());
                    $this->asistio->SetValue($this->DataSource->asistio->GetValue());
                    $this->idEquipamiento->SetValue($this->DataSource->idEquipamiento->GetValue());
                    $this->idInstructor->SetValue($this->DataSource->idInstructor->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->idAlumno->Errors->ToString());
            $Error = ComposeStrings($Error, $this->fecha->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_fecha->Errors->ToString());
            $Error = ComposeStrings($Error, $this->asistio->Errors->ToString());
            $Error = ComposeStrings($Error, $this->idEquipamiento->Errors->ToString());
            $Error = ComposeStrings($Error, $this->idInstructor->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);
        $this->Button_Insert->Visible = !$this->EditMode && $this->InsertAllowed;
        $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;
        $this->Button_Delete->Visible = $this->EditMode && $this->DeleteAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->Button_Delete->Show();
        $this->idAlumno->Show();
        $this->fecha->Show();
        $this->DatePicker_fecha->Show();
        $this->asistio->Show();
        $this->idEquipamiento->Show();
        $this->idInstructor->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End asistenciaalumno Class @2-FCB6E20C

class clsasistenciaalumnoDataSource extends clsDBConnection1 {  //asistenciaalumnoDataSource Class @2-D3C942DC

//DataSource Variables @2-E71E9096
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $InsertParameters;
    var $UpdateParameters;
    var $DeleteParameters;
    var $wp;
    var $AllParametersSet;

    var $InsertFields = array();
    var $UpdateFields = array();

    // Datasource fields
    var $idAlumno;
    var $fecha;
    var $asistio;
    var $idEquipamiento;
    var $idInstructor;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-FF47CB58
    function clsasistenciaalumnoDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record asistenciaalumno/Error";
        $this->Initialize();
        $this->idAlumno = new clsField("idAlumno", ccsInteger, "");
        
        $this->fecha = new clsField("fecha", ccsDate, $this->DateFormat);
        
        $this->asistio = new clsField("asistio", ccsText, "");
        
        $this->idEquipamiento = new clsField("idEquipamiento", ccsInteger, "");
        
        $this->idInstructor = new clsField("idInstructor", ccsInteger, "");
        

        $this->InsertFields["idAlumno"] = array("Name" => "idAlumno", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["fecha"] = array("Name" => "fecha", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["asistio"] = array("Name" => "asistio", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["idEquipamiento"] = array("Name" => "idEquipamiento", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["idInstructor"] = array("Name" => "idInstructor", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["idAlumno"] = array("Name" => "idAlumno", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["fecha"] = array("Name" => "fecha", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["asistio"] = array("Name" => "asistio", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["idEquipamiento"] = array("Name" => "idEquipamiento", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["idInstructor"] = array("Name" => "idInstructor", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-35B33087
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlid", ccsInteger, "", "", $this->Parameters["urlid"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-93539454
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM asistenciaalumno {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-D6455996
    function SetValues()
    {
        $this->idAlumno->SetDBValue(trim($this->f("idAlumno")));
        $this->fecha->SetDBValue(trim($this->f("fecha")));
        $this->asistio->SetDBValue($this->f("asistio"));
        $this->idEquipamiento->SetDBValue(trim($this->f("idEquipamiento")));
        $this->idInstructor->SetDBValue(trim($this->f("idInstructor")));
    }
//End SetValues Method

//Insert Method @2-56C84115
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["idAlumno"]["Value"] = $this->idAlumno->GetDBValue(true);
        $this->InsertFields["fecha"]["Value"] = $this->fecha->GetDBValue(true);
        $this->InsertFields["asistio"]["Value"] = $this->asistio->GetDBValue(true);
        $this->InsertFields["idEquipamiento"]["Value"] = $this->idEquipamiento->GetDBValue(true);
        $this->InsertFields["idInstructor"]["Value"] = $this->idInstructor->GetDBValue(true);
        $this->SQL = CCBuildInsert("asistenciaalumno", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-1E6CE7B0
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["idAlumno"]["Value"] = $this->idAlumno->GetDBValue(true);
        $this->UpdateFields["fecha"]["Value"] = $this->fecha->GetDBValue(true);
        $this->UpdateFields["asistio"]["Value"] = $this->asistio->GetDBValue(true);
        $this->UpdateFields["idEquipamiento"]["Value"] = $this->idEquipamiento->GetDBValue(true);
        $this->UpdateFields["idInstructor"]["Value"] = $this->idInstructor->GetDBValue(true);
        $this->SQL = CCBuildUpdate("asistenciaalumno", $this->UpdateFields, $this);
        $this->SQL .= strlen($this->Where) ? " WHERE " . $this->Where : $this->Where;
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @2-A9657EDF
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM asistenciaalumno";
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End asistenciaalumnoDataSource Class @2-FCB6E20C

//Initialize Page @1-1F6A9E86
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
$TemplateFileName = "asistenciaalumn_maint.html";
$BlockToParse = "main";
$TemplateEncoding = "UTF-8";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "utf-8";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-7C2E20D5
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$asistenciaalumno = & new clsRecordasistenciaalumno("", $MainPage);
$MainPage->asistenciaalumno = & $asistenciaalumno;
$asistenciaalumno->Initialize();

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize", $MainPage);

if ($Charset) {
    header("Content-Type: " . $ContentType . "; charset=" . $Charset);
} else {
    header("Content-Type: " . $ContentType);
}
//End Initialize Objects

//Initialize HTML Template @1-5C9A11E6
$CCSEventResult = CCGetEvent($CCSEvents, "OnInitializeView", $MainPage);
$Tpl = new clsTemplate();
$Tpl->LoadTemplate(PathToCurrentPage . $TemplateFileName, $BlockToParse, "UTF-8");
$Tpl->block_path = "/$BlockToParse";
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeShow", $MainPage);
$Attributes->SetValue("pathToRoot", "");
$Attributes->Show();
//End Initialize HTML Template

//Execute Components @1-8A077A66
$asistenciaalumno->Operation();
//End Execute Components

//Go to destination page @1-E97574F4
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    unset($asistenciaalumno);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-A5A3EC17
$asistenciaalumno->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-833CF8C2
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
unset($asistenciaalumno);
unset($Tpl);
//End Unload Page


?>
