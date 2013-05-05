<?php
//Include Common Files @1-9110CF0A
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "movimientofactu_maint.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordmovimientofacturacion { //movimientofacturacion Class @2-8A73A514

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

//Class_Initialize Event @2-E9C58226
    function clsRecordmovimientofacturacion($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record movimientofacturacion/Error";
        $this->DataSource = new clsmovimientofacturacionDataSource($this);
        $this->ds = & $this->DataSource;
        $this->ReadAllowed = true;
        $this->Visible = (CCSecurityAccessCheck("1;100") == "success");
        if($this->Visible)
        {
            $this->ReadAllowed = $this->ReadAllowed && CCUserInGroups(CCGetGroupID(), "1;100");
            $this->InsertAllowed = CCUserInGroups(CCGetGroupID(), "1;100");
            $this->UpdateAllowed = CCUserInGroups(CCGetGroupID(), "1;100");
            $this->DeleteAllowed = CCUserInGroups(CCGetGroupID(), "1;100");
            $this->ComponentName = "movimientofacturacion";
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
            $this->mes = & new clsControl(ccsListBox, "mes", "Mes", ccsInteger, "", CCGetRequestParam("mes", $Method, NULL), $this);
            $this->mes->DSType = dsTable;
            $this->mes->DataSource = new clsDBConnection1();
            $this->mes->ds = & $this->mes->DataSource;
            $this->mes->DataSource->SQL = "SELECT * \n" .
"FROM meses {SQL_Where} {SQL_OrderBy}";
            list($this->mes->BoundColumn, $this->mes->TextColumn, $this->mes->DBFormat) = array("nro", "nombre", "");
            $this->anio = & new clsControl(ccsTextBox, "anio", "Anio", ccsInteger, "", CCGetRequestParam("anio", $Method, NULL), $this);
            $this->importe = & new clsControl(ccsTextBox, "importe", "Importe", ccsInteger, "", CCGetRequestParam("importe", $Method, NULL), $this);
            $this->idAlumno = & new clsControl(ccsListBox, "idAlumno", "Id Alumno", ccsInteger, "", CCGetRequestParam("idAlumno", $Method, NULL), $this);
            $this->idAlumno->DSType = dsTable;
            $this->idAlumno->DataSource = new clsDBConnection1();
            $this->idAlumno->ds = & $this->idAlumno->DataSource;
            $this->idAlumno->DataSource->SQL = "SELECT * \n" .
"FROM alumno {SQL_Where} {SQL_OrderBy}";
            list($this->idAlumno->BoundColumn, $this->idAlumno->TextColumn, $this->idAlumno->DBFormat) = array("id", "nombre", "");
            $this->tipomov = & new clsControl(ccsHidden, "tipomov", "Tipomov", ccsText, "", CCGetRequestParam("tipomov", $Method, NULL), $this);
            $this->instructor = & new clsControl(ccsListBox, "instructor", "instructor", ccsInteger, "", CCGetRequestParam("instructor", $Method, NULL), $this);
            $this->instructor->DSType = dsTable;
            $this->instructor->DataSource = new clsDBConnection1();
            $this->instructor->ds = & $this->instructor->DataSource;
            $this->instructor->DataSource->SQL = "SELECT * \n" .
"FROM instructor {SQL_Where} {SQL_OrderBy}";
            list($this->instructor->BoundColumn, $this->instructor->TextColumn, $this->instructor->DBFormat) = array("id", "nombre", "");
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

//Validate Method @2-35C4B89C
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->mes->Validate() && $Validation);
        $Validation = ($this->anio->Validate() && $Validation);
        $Validation = ($this->importe->Validate() && $Validation);
        $Validation = ($this->idAlumno->Validate() && $Validation);
        $Validation = ($this->tipomov->Validate() && $Validation);
        $Validation = ($this->instructor->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->mes->Errors->Count() == 0);
        $Validation =  $Validation && ($this->anio->Errors->Count() == 0);
        $Validation =  $Validation && ($this->importe->Errors->Count() == 0);
        $Validation =  $Validation && ($this->idAlumno->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tipomov->Errors->Count() == 0);
        $Validation =  $Validation && ($this->instructor->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-ECE58EFF
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->mes->Errors->Count());
        $errors = ($errors || $this->anio->Errors->Count());
        $errors = ($errors || $this->importe->Errors->Count());
        $errors = ($errors || $this->idAlumno->Errors->Count());
        $errors = ($errors || $this->tipomov->Errors->Count());
        $errors = ($errors || $this->instructor->Errors->Count());
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

//Operation Method @2-D712303A
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
        $Redirect = "cuotas_pagadas.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete" && $this->DeleteAllowed) {
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert" && $this->InsertAllowed) {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update" && $this->UpdateAllowed) {
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

//InsertRow Method @2-A03620CA
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->mes->SetValue($this->mes->GetValue(true));
        $this->DataSource->anio->SetValue($this->anio->GetValue(true));
        $this->DataSource->importe->SetValue($this->importe->GetValue(true));
        $this->DataSource->idAlumno->SetValue($this->idAlumno->GetValue(true));
        $this->DataSource->tipomov->SetValue($this->tipomov->GetValue(true));
        $this->DataSource->instructor->SetValue($this->instructor->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @2-33FE0F44
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->mes->SetValue($this->mes->GetValue(true));
        $this->DataSource->anio->SetValue($this->anio->GetValue(true));
        $this->DataSource->importe->SetValue($this->importe->GetValue(true));
        $this->DataSource->idAlumno->SetValue($this->idAlumno->GetValue(true));
        $this->DataSource->tipomov->SetValue($this->tipomov->GetValue(true));
        $this->DataSource->instructor->SetValue($this->instructor->GetValue(true));
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

//Show Method @2-E8AEDB82
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

        $this->mes->Prepare();
        $this->idAlumno->Prepare();
        $this->instructor->Prepare();

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
                    $this->mes->SetValue($this->DataSource->mes->GetValue());
                    $this->anio->SetValue($this->DataSource->anio->GetValue());
                    $this->importe->SetValue($this->DataSource->importe->GetValue());
                    $this->idAlumno->SetValue($this->DataSource->idAlumno->GetValue());
                    $this->tipomov->SetValue($this->DataSource->tipomov->GetValue());
                    $this->instructor->SetValue($this->DataSource->instructor->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->mes->Errors->ToString());
            $Error = ComposeStrings($Error, $this->anio->Errors->ToString());
            $Error = ComposeStrings($Error, $this->importe->Errors->ToString());
            $Error = ComposeStrings($Error, $this->idAlumno->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tipomov->Errors->ToString());
            $Error = ComposeStrings($Error, $this->instructor->Errors->ToString());
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
        $this->mes->Show();
        $this->anio->Show();
        $this->importe->Show();
        $this->idAlumno->Show();
        $this->tipomov->Show();
        $this->instructor->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End movimientofacturacion Class @2-FCB6E20C

class clsmovimientofacturacionDataSource extends clsDBConnection1 {  //movimientofacturacionDataSource Class @2-BBC2364E

//DataSource Variables @2-05C3195B
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
    var $mes;
    var $anio;
    var $importe;
    var $idAlumno;
    var $tipomov;
    var $instructor;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-26066526
    function clsmovimientofacturacionDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record movimientofacturacion/Error";
        $this->Initialize();
        $this->mes = new clsField("mes", ccsInteger, "");
        
        $this->anio = new clsField("anio", ccsInteger, "");
        
        $this->importe = new clsField("importe", ccsInteger, "");
        
        $this->idAlumno = new clsField("idAlumno", ccsInteger, "");
        
        $this->tipomov = new clsField("tipomov", ccsText, "");
        
        $this->instructor = new clsField("instructor", ccsInteger, "");
        

        $this->InsertFields["mes"] = array("Name" => "mes", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["anio"] = array("Name" => "anio", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["importe"] = array("Name" => "importe", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["idAlumno"] = array("Name" => "idAlumno", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["tipomov"] = array("Name" => "tipomov", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["idInstructor"] = array("Name" => "idInstructor", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["mes"] = array("Name" => "mes", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["anio"] = array("Name" => "anio", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["importe"] = array("Name" => "importe", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["idAlumno"] = array("Name" => "idAlumno", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["tipomov"] = array("Name" => "tipomov", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
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

//Open Method @2-61424526
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM movimientofacturacion {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-E3995E00
    function SetValues()
    {
        $this->mes->SetDBValue(trim($this->f("mes")));
        $this->anio->SetDBValue(trim($this->f("anio")));
        $this->importe->SetDBValue(trim($this->f("importe")));
        $this->idAlumno->SetDBValue(trim($this->f("idAlumno")));
        $this->tipomov->SetDBValue($this->f("tipomov"));
        $this->instructor->SetDBValue(trim($this->f("idInstructor")));
    }
//End SetValues Method

//Insert Method @2-B70FF66A
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["mes"]["Value"] = $this->mes->GetDBValue(true);
        $this->InsertFields["anio"]["Value"] = $this->anio->GetDBValue(true);
        $this->InsertFields["importe"]["Value"] = $this->importe->GetDBValue(true);
        $this->InsertFields["idAlumno"]["Value"] = $this->idAlumno->GetDBValue(true);
        $this->InsertFields["tipomov"]["Value"] = $this->tipomov->GetDBValue(true);
        $this->InsertFields["idInstructor"]["Value"] = $this->instructor->GetDBValue(true);
        $this->SQL = CCBuildInsert("movimientofacturacion", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-E2D7E1DC
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["mes"]["Value"] = $this->mes->GetDBValue(true);
        $this->UpdateFields["anio"]["Value"] = $this->anio->GetDBValue(true);
        $this->UpdateFields["importe"]["Value"] = $this->importe->GetDBValue(true);
        $this->UpdateFields["idAlumno"]["Value"] = $this->idAlumno->GetDBValue(true);
        $this->UpdateFields["tipomov"]["Value"] = $this->tipomov->GetDBValue(true);
        $this->UpdateFields["idInstructor"]["Value"] = $this->instructor->GetDBValue(true);
        $this->SQL = CCBuildUpdate("movimientofacturacion", $this->UpdateFields, $this);
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

//Delete Method @2-D5322E14
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM movimientofacturacion";
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

} //End movimientofacturacionDataSource Class @2-FCB6E20C

//Include Page implementation @16-8EACA429
include_once(RelativePath . "/header.php");
//End Include Page implementation

//Initialize Page @1-BF5B8DC3
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
$TemplateFileName = "movimientofactu_maint.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Authenticate User @1-5CB846BC
CCSecurityRedirect("1;100", "denegado.php");
//End Authenticate User

//Include events file @1-C5C6692F
include_once("./movimientofactu_maint_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-A33864B2
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$movimientofacturacion = & new clsRecordmovimientofacturacion("", $MainPage);
$header = & new clsheader("", "header", $MainPage);
$header->Initialize();
$MainPage->movimientofacturacion = & $movimientofacturacion;
$MainPage->header = & $header;
$movimientofacturacion->Initialize();

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

//Execute Components @1-53D89A15
$movimientofacturacion->Operation();
$header->Operations();
//End Execute Components

//Go to destination page @1-5ACB02A9
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    unset($movimientofacturacion);
    $header->Class_Terminate();
    unset($header);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-54765B9B
$movimientofacturacion->Show();
$header->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-FA6DA1F0
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
unset($movimientofacturacion);
$header->Class_Terminate();
unset($header);
unset($Tpl);
//End Unload Page


?>
