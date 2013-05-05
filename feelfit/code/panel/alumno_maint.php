<?php
//Include Common Files @1-9FE4CA48
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "alumno_maint.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordalumno { //alumno Class @2-FB98E5F1

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

//Class_Initialize Event @2-B45BE301
    function clsRecordalumno($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record alumno/Error";
        $this->DataSource = new clsalumnoDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "alumno";
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
            $this->nombre = & new clsControl(ccsTextBox, "nombre", "Nombre", ccsText, "", CCGetRequestParam("nombre", $Method, NULL), $this);
            $this->tipodoc = & new clsControl(ccsTextBox, "tipodoc", "Tipodoc", ccsText, "", CCGetRequestParam("tipodoc", $Method, NULL), $this);
            $this->nrodocumento = & new clsControl(ccsTextBox, "nrodocumento", "Nrodocumento", ccsText, "", CCGetRequestParam("nrodocumento", $Method, NULL), $this);
            $this->domicilio = & new clsControl(ccsTextBox, "domicilio", "Domicilio", ccsText, "", CCGetRequestParam("domicilio", $Method, NULL), $this);
            $this->telefono = & new clsControl(ccsTextBox, "telefono", "Telefono", ccsText, "", CCGetRequestParam("telefono", $Method, NULL), $this);
            $this->email = & new clsControl(ccsTextBox, "email", "Email", ccsText, "", CCGetRequestParam("email", $Method, NULL), $this);
            $this->comparte = & new clsControl(ccsCheckBox, "comparte", "Comparte", ccsText, "", CCGetRequestParam("comparte", $Method, NULL), $this);
            $this->comparte->CheckedValue = $this->comparte->GetParsedValue(1);
            $this->comparte->UncheckedValue = $this->comparte->GetParsedValue(0);
            $this->cuota = & new clsControl(ccsTextBox, "cuota", "cuota", ccsInteger, "", CCGetRequestParam("cuota", $Method, NULL), $this);
            $this->activo = & new clsControl(ccsCheckBox, "activo", "activo", ccsInteger, "", CCGetRequestParam("activo", $Method, NULL), $this);
            $this->activo->CheckedValue = $this->activo->GetParsedValue(1);
            $this->activo->UncheckedValue = $this->activo->GetParsedValue(0);
            if(!$this->FormSubmitted) {
                if(!is_array($this->comparte->Value) && !strlen($this->comparte->Value) && $this->comparte->Value !== false)
                    $this->comparte->SetValue(false);
            }
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

//Validate Method @2-22D932C1
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->nombre->Validate() && $Validation);
        $Validation = ($this->tipodoc->Validate() && $Validation);
        $Validation = ($this->nrodocumento->Validate() && $Validation);
        $Validation = ($this->domicilio->Validate() && $Validation);
        $Validation = ($this->telefono->Validate() && $Validation);
        $Validation = ($this->email->Validate() && $Validation);
        $Validation = ($this->comparte->Validate() && $Validation);
        $Validation = ($this->cuota->Validate() && $Validation);
        $Validation = ($this->activo->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->nombre->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tipodoc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nrodocumento->Errors->Count() == 0);
        $Validation =  $Validation && ($this->domicilio->Errors->Count() == 0);
        $Validation =  $Validation && ($this->telefono->Errors->Count() == 0);
        $Validation =  $Validation && ($this->email->Errors->Count() == 0);
        $Validation =  $Validation && ($this->comparte->Errors->Count() == 0);
        $Validation =  $Validation && ($this->cuota->Errors->Count() == 0);
        $Validation =  $Validation && ($this->activo->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-6553D0F4
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->nombre->Errors->Count());
        $errors = ($errors || $this->tipodoc->Errors->Count());
        $errors = ($errors || $this->nrodocumento->Errors->Count());
        $errors = ($errors || $this->domicilio->Errors->Count());
        $errors = ($errors || $this->telefono->Errors->Count());
        $errors = ($errors || $this->email->Errors->Count());
        $errors = ($errors || $this->comparte->Errors->Count());
        $errors = ($errors || $this->cuota->Errors->Count());
        $errors = ($errors || $this->activo->Errors->Count());
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

//Operation Method @2-B0FE0156
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
        $Redirect = "alumno_list.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
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

//InsertRow Method @2-32015A64
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->nombre->SetValue($this->nombre->GetValue(true));
        $this->DataSource->tipodoc->SetValue($this->tipodoc->GetValue(true));
        $this->DataSource->nrodocumento->SetValue($this->nrodocumento->GetValue(true));
        $this->DataSource->domicilio->SetValue($this->domicilio->GetValue(true));
        $this->DataSource->telefono->SetValue($this->telefono->GetValue(true));
        $this->DataSource->email->SetValue($this->email->GetValue(true));
        $this->DataSource->comparte->SetValue($this->comparte->GetValue(true));
        $this->DataSource->cuota->SetValue($this->cuota->GetValue(true));
        $this->DataSource->activo->SetValue($this->activo->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @2-F9A2E584
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->nombre->SetValue($this->nombre->GetValue(true));
        $this->DataSource->tipodoc->SetValue($this->tipodoc->GetValue(true));
        $this->DataSource->nrodocumento->SetValue($this->nrodocumento->GetValue(true));
        $this->DataSource->domicilio->SetValue($this->domicilio->GetValue(true));
        $this->DataSource->telefono->SetValue($this->telefono->GetValue(true));
        $this->DataSource->email->SetValue($this->email->GetValue(true));
        $this->DataSource->comparte->SetValue($this->comparte->GetValue(true));
        $this->DataSource->cuota->SetValue($this->cuota->GetValue(true));
        $this->DataSource->activo->SetValue($this->activo->GetValue(true));
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

//Show Method @2-E7622416
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
                    $this->nombre->SetValue($this->DataSource->nombre->GetValue());
                    $this->tipodoc->SetValue($this->DataSource->tipodoc->GetValue());
                    $this->nrodocumento->SetValue($this->DataSource->nrodocumento->GetValue());
                    $this->domicilio->SetValue($this->DataSource->domicilio->GetValue());
                    $this->telefono->SetValue($this->DataSource->telefono->GetValue());
                    $this->email->SetValue($this->DataSource->email->GetValue());
                    $this->comparte->SetValue($this->DataSource->comparte->GetValue());
                    $this->cuota->SetValue($this->DataSource->cuota->GetValue());
                    $this->activo->SetValue($this->DataSource->activo->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->nombre->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tipodoc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nrodocumento->Errors->ToString());
            $Error = ComposeStrings($Error, $this->domicilio->Errors->ToString());
            $Error = ComposeStrings($Error, $this->telefono->Errors->ToString());
            $Error = ComposeStrings($Error, $this->email->Errors->ToString());
            $Error = ComposeStrings($Error, $this->comparte->Errors->ToString());
            $Error = ComposeStrings($Error, $this->cuota->Errors->ToString());
            $Error = ComposeStrings($Error, $this->activo->Errors->ToString());
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
        $this->nombre->Show();
        $this->tipodoc->Show();
        $this->nrodocumento->Show();
        $this->domicilio->Show();
        $this->telefono->Show();
        $this->email->Show();
        $this->comparte->Show();
        $this->cuota->Show();
        $this->activo->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End alumno Class @2-FCB6E20C

class clsalumnoDataSource extends clsDBConnection1 {  //alumnoDataSource Class @2-B1C8DBE2

//DataSource Variables @2-C8FFD51B
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
    var $nombre;
    var $tipodoc;
    var $nrodocumento;
    var $domicilio;
    var $telefono;
    var $email;
    var $comparte;
    var $cuota;
    var $activo;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-65FB701D
    function clsalumnoDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record alumno/Error";
        $this->Initialize();
        $this->nombre = new clsField("nombre", ccsText, "");
        
        $this->tipodoc = new clsField("tipodoc", ccsText, "");
        
        $this->nrodocumento = new clsField("nrodocumento", ccsText, "");
        
        $this->domicilio = new clsField("domicilio", ccsText, "");
        
        $this->telefono = new clsField("telefono", ccsText, "");
        
        $this->email = new clsField("email", ccsText, "");
        
        $this->comparte = new clsField("comparte", ccsText, "");
        
        $this->cuota = new clsField("cuota", ccsInteger, "");
        
        $this->activo = new clsField("activo", ccsInteger, "");
        

        $this->InsertFields["nombre"] = array("Name" => "nombre", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["tipodoc"] = array("Name" => "tipodoc", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["nrodocumento"] = array("Name" => "nrodocumento", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["domicilio"] = array("Name" => "domicilio", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["telefono"] = array("Name" => "telefono", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["email"] = array("Name" => "email", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["comparte"] = array("Name" => "comparte", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["cuota"] = array("Name" => "cuota", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["activo"] = array("Name" => "activo", "Value" => "", "DataType" => ccsInteger);
        $this->UpdateFields["nombre"] = array("Name" => "nombre", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["tipodoc"] = array("Name" => "tipodoc", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["nrodocumento"] = array("Name" => "nrodocumento", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["domicilio"] = array("Name" => "domicilio", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["telefono"] = array("Name" => "telefono", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["email"] = array("Name" => "email", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["comparte"] = array("Name" => "comparte", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["cuota"] = array("Name" => "cuota", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["activo"] = array("Name" => "activo", "Value" => "", "DataType" => ccsInteger);
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

//Open Method @2-7D58052A
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM alumno {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-DC95B3A6
    function SetValues()
    {
        $this->nombre->SetDBValue($this->f("nombre"));
        $this->tipodoc->SetDBValue($this->f("tipodoc"));
        $this->nrodocumento->SetDBValue($this->f("nrodocumento"));
        $this->domicilio->SetDBValue($this->f("domicilio"));
        $this->telefono->SetDBValue($this->f("telefono"));
        $this->email->SetDBValue($this->f("email"));
        $this->comparte->SetDBValue($this->f("comparte"));
        $this->cuota->SetDBValue(trim($this->f("cuota")));
        $this->activo->SetDBValue(trim($this->f("activo")));
    }
//End SetValues Method

//Insert Method @2-90B4EE3F
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["nombre"]["Value"] = $this->nombre->GetDBValue(true);
        $this->InsertFields["tipodoc"]["Value"] = $this->tipodoc->GetDBValue(true);
        $this->InsertFields["nrodocumento"]["Value"] = $this->nrodocumento->GetDBValue(true);
        $this->InsertFields["domicilio"]["Value"] = $this->domicilio->GetDBValue(true);
        $this->InsertFields["telefono"]["Value"] = $this->telefono->GetDBValue(true);
        $this->InsertFields["email"]["Value"] = $this->email->GetDBValue(true);
        $this->InsertFields["comparte"]["Value"] = $this->comparte->GetDBValue(true);
        $this->InsertFields["cuota"]["Value"] = $this->cuota->GetDBValue(true);
        $this->InsertFields["activo"]["Value"] = $this->activo->GetDBValue(true);
        $this->SQL = CCBuildInsert("alumno", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-36AB1876
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["nombre"]["Value"] = $this->nombre->GetDBValue(true);
        $this->UpdateFields["tipodoc"]["Value"] = $this->tipodoc->GetDBValue(true);
        $this->UpdateFields["nrodocumento"]["Value"] = $this->nrodocumento->GetDBValue(true);
        $this->UpdateFields["domicilio"]["Value"] = $this->domicilio->GetDBValue(true);
        $this->UpdateFields["telefono"]["Value"] = $this->telefono->GetDBValue(true);
        $this->UpdateFields["email"]["Value"] = $this->email->GetDBValue(true);
        $this->UpdateFields["comparte"]["Value"] = $this->comparte->GetDBValue(true);
        $this->UpdateFields["cuota"]["Value"] = $this->cuota->GetDBValue(true);
        $this->UpdateFields["activo"]["Value"] = $this->activo->GetDBValue(true);
        $this->SQL = CCBuildUpdate("alumno", $this->UpdateFields, $this);
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

//Delete Method @2-82BACFB9
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM alumno";
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

} //End alumnoDataSource Class @2-FCB6E20C

//Include Page implementation @14-8EACA429
include_once(RelativePath . "/header.php");
//End Include Page implementation

//Initialize Page @1-2825B137
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
$TemplateFileName = "alumno_maint.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Authenticate User @1-89E04E5F
CCSecurityRedirect("", "denegado.php");
//End Authenticate User

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-811B3B77
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$alumno = & new clsRecordalumno("", $MainPage);
$header = & new clsheader("", "header", $MainPage);
$header->Initialize();
$MainPage->alumno = & $alumno;
$MainPage->header = & $header;
$alumno->Initialize();

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

//Execute Components @1-FEE3019A
$alumno->Operation();
$header->Operations();
//End Execute Components

//Go to destination page @1-C6340497
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    unset($alumno);
    $header->Class_Terminate();
    unset($header);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-2EB6EA1B
$alumno->Show();
$header->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-BAB56538
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
unset($alumno);
$header->Class_Terminate();
unset($header);
unset($Tpl);
//End Unload Page


?>
