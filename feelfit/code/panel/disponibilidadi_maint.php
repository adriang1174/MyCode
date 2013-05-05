<?php
//Include Common Files @1-70B3E7EF
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "disponibilidadi_maint.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecorddisponibilidadinstructor { //disponibilidadinstructor Class @2-A1E07A34

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

//Class_Initialize Event @2-C5223B97
    function clsRecorddisponibilidadinstructor($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record disponibilidadinstructor/Error";
        $this->DataSource = new clsdisponibilidadinstructorDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "disponibilidadinstructor";
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
            $this->idInstructor = & new clsControl(ccsListBox, "idInstructor", "Id Instructor", ccsInteger, "", CCGetRequestParam("idInstructor", $Method, NULL), $this);
            $this->idInstructor->DSType = dsTable;
            $this->idInstructor->DataSource = new clsDBConnection1();
            $this->idInstructor->ds = & $this->idInstructor->DataSource;
            $this->idInstructor->DataSource->SQL = "SELECT * \n" .
"FROM instructor {SQL_Where} {SQL_OrderBy}";
            list($this->idInstructor->BoundColumn, $this->idInstructor->TextColumn, $this->idInstructor->DBFormat) = array("id", "nombre", "");
            $this->idEquipamiento = & new clsControl(ccsListBox, "idEquipamiento", "Id Equipamiento", ccsInteger, "", CCGetRequestParam("idEquipamiento", $Method, NULL), $this);
            $this->idEquipamiento->DSType = dsTable;
            $this->idEquipamiento->DataSource = new clsDBConnection1();
            $this->idEquipamiento->ds = & $this->idEquipamiento->DataSource;
            $this->idEquipamiento->DataSource->SQL = "SELECT * \n" .
"FROM equipamiento {SQL_Where} {SQL_OrderBy}";
            list($this->idEquipamiento->BoundColumn, $this->idEquipamiento->TextColumn, $this->idEquipamiento->DBFormat) = array("id", "descripcion", "");
            $this->rangodias = & new clsControl(ccsHidden, "rangodias", "Rangodias", ccsText, "", CCGetRequestParam("rangodias", $Method, NULL), $this);
            $this->fechaespec = & new clsControl(ccsTextBox, "fechaespec", "Fechaespec", ccsDate, $DefaultDateFormat, CCGetRequestParam("fechaespec", $Method, NULL), $this);
            $this->DatePicker_fechaespec = & new clsDatePicker("DatePicker_fechaespec", "disponibilidadinstructor", "fechaespec", $this);
            $this->horaini = & new clsControl(ccsTextBox, "horaini", "Horaini", ccsText, "", CCGetRequestParam("horaini", $Method, NULL), $this);
            $this->horafin = & new clsControl(ccsTextBox, "horafin", "Horafin", ccsText, "", CCGetRequestParam("horafin", $Method, NULL), $this);
            $this->l = & new clsControl(ccsCheckBox, "l", "l", ccsText, "", CCGetRequestParam("l", $Method, NULL), $this);
            $this->l->CheckedValue = $this->l->GetParsedValue(1);
            $this->l->UncheckedValue = $this->l->GetParsedValue(0);
            $this->m = & new clsControl(ccsCheckBox, "m", "m", ccsText, "", CCGetRequestParam("m", $Method, NULL), $this);
            $this->m->CheckedValue = $this->m->GetParsedValue(1);
            $this->m->UncheckedValue = $this->m->GetParsedValue(0);
            $this->x = & new clsControl(ccsCheckBox, "x", "x", ccsText, "", CCGetRequestParam("x", $Method, NULL), $this);
            $this->x->CheckedValue = $this->x->GetParsedValue(1);
            $this->x->UncheckedValue = $this->x->GetParsedValue(0);
            $this->j = & new clsControl(ccsCheckBox, "j", "j", ccsText, "", CCGetRequestParam("j", $Method, NULL), $this);
            $this->j->CheckedValue = $this->j->GetParsedValue(1);
            $this->j->UncheckedValue = $this->j->GetParsedValue(0);
            $this->v = & new clsControl(ccsCheckBox, "v", "v", ccsText, "", CCGetRequestParam("v", $Method, NULL), $this);
            $this->v->CheckedValue = $this->v->GetParsedValue(1);
            $this->v->UncheckedValue = $this->v->GetParsedValue(0);
            $this->s = & new clsControl(ccsCheckBox, "s", "s", ccsText, "", CCGetRequestParam("s", $Method, NULL), $this);
            $this->s->CheckedValue = $this->s->GetParsedValue(1);
            $this->s->UncheckedValue = $this->s->GetParsedValue(0);
            $this->d = & new clsControl(ccsCheckBox, "d", "d", ccsText, "", CCGetRequestParam("d", $Method, NULL), $this);
            $this->d->CheckedValue = $this->d->GetParsedValue(1);
            $this->d->UncheckedValue = $this->d->GetParsedValue(0);
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

//Validate Method @2-AF9972B0
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->idInstructor->Validate() && $Validation);
        $Validation = ($this->idEquipamiento->Validate() && $Validation);
        $Validation = ($this->rangodias->Validate() && $Validation);
        $Validation = ($this->fechaespec->Validate() && $Validation);
        $Validation = ($this->horaini->Validate() && $Validation);
        $Validation = ($this->horafin->Validate() && $Validation);
        $Validation = ($this->l->Validate() && $Validation);
        $Validation = ($this->m->Validate() && $Validation);
        $Validation = ($this->x->Validate() && $Validation);
        $Validation = ($this->j->Validate() && $Validation);
        $Validation = ($this->v->Validate() && $Validation);
        $Validation = ($this->s->Validate() && $Validation);
        $Validation = ($this->d->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->idInstructor->Errors->Count() == 0);
        $Validation =  $Validation && ($this->idEquipamiento->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rangodias->Errors->Count() == 0);
        $Validation =  $Validation && ($this->fechaespec->Errors->Count() == 0);
        $Validation =  $Validation && ($this->horaini->Errors->Count() == 0);
        $Validation =  $Validation && ($this->horafin->Errors->Count() == 0);
        $Validation =  $Validation && ($this->l->Errors->Count() == 0);
        $Validation =  $Validation && ($this->m->Errors->Count() == 0);
        $Validation =  $Validation && ($this->x->Errors->Count() == 0);
        $Validation =  $Validation && ($this->j->Errors->Count() == 0);
        $Validation =  $Validation && ($this->v->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s->Errors->Count() == 0);
        $Validation =  $Validation && ($this->d->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-B601086E
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->idInstructor->Errors->Count());
        $errors = ($errors || $this->idEquipamiento->Errors->Count());
        $errors = ($errors || $this->rangodias->Errors->Count());
        $errors = ($errors || $this->fechaespec->Errors->Count());
        $errors = ($errors || $this->DatePicker_fechaespec->Errors->Count());
        $errors = ($errors || $this->horaini->Errors->Count());
        $errors = ($errors || $this->horafin->Errors->Count());
        $errors = ($errors || $this->l->Errors->Count());
        $errors = ($errors || $this->m->Errors->Count());
        $errors = ($errors || $this->x->Errors->Count());
        $errors = ($errors || $this->j->Errors->Count());
        $errors = ($errors || $this->v->Errors->Count());
        $errors = ($errors || $this->s->Errors->Count());
        $errors = ($errors || $this->d->Errors->Count());
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

//Operation Method @2-B3E33E60
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
        $Redirect = "disponibilidadi_list.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
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

//InsertRow Method @2-BA7A4102
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->idInstructor->SetValue($this->idInstructor->GetValue(true));
        $this->DataSource->idEquipamiento->SetValue($this->idEquipamiento->GetValue(true));
        $this->DataSource->rangodias->SetValue($this->rangodias->GetValue(true));
        $this->DataSource->fechaespec->SetValue($this->fechaespec->GetValue(true));
        $this->DataSource->horaini->SetValue($this->horaini->GetValue(true));
        $this->DataSource->horafin->SetValue($this->horafin->GetValue(true));
        $this->DataSource->l->SetValue($this->l->GetValue(true));
        $this->DataSource->m->SetValue($this->m->GetValue(true));
        $this->DataSource->x->SetValue($this->x->GetValue(true));
        $this->DataSource->j->SetValue($this->j->GetValue(true));
        $this->DataSource->v->SetValue($this->v->GetValue(true));
        $this->DataSource->s->SetValue($this->s->GetValue(true));
        $this->DataSource->d->SetValue($this->d->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @2-3DDF846C
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->idInstructor->SetValue($this->idInstructor->GetValue(true));
        $this->DataSource->idEquipamiento->SetValue($this->idEquipamiento->GetValue(true));
        $this->DataSource->rangodias->SetValue($this->rangodias->GetValue(true));
        $this->DataSource->fechaespec->SetValue($this->fechaespec->GetValue(true));
        $this->DataSource->horaini->SetValue($this->horaini->GetValue(true));
        $this->DataSource->horafin->SetValue($this->horafin->GetValue(true));
        $this->DataSource->l->SetValue($this->l->GetValue(true));
        $this->DataSource->m->SetValue($this->m->GetValue(true));
        $this->DataSource->x->SetValue($this->x->GetValue(true));
        $this->DataSource->j->SetValue($this->j->GetValue(true));
        $this->DataSource->v->SetValue($this->v->GetValue(true));
        $this->DataSource->s->SetValue($this->s->GetValue(true));
        $this->DataSource->d->SetValue($this->d->GetValue(true));
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

//Show Method @2-D2C7EA74
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

        $this->idInstructor->Prepare();
        $this->idEquipamiento->Prepare();

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
                    $this->idInstructor->SetValue($this->DataSource->idInstructor->GetValue());
                    $this->idEquipamiento->SetValue($this->DataSource->idEquipamiento->GetValue());
                    $this->rangodias->SetValue($this->DataSource->rangodias->GetValue());
                    $this->fechaespec->SetValue($this->DataSource->fechaespec->GetValue());
                    $this->horaini->SetValue($this->DataSource->horaini->GetValue());
                    $this->horafin->SetValue($this->DataSource->horafin->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->idInstructor->Errors->ToString());
            $Error = ComposeStrings($Error, $this->idEquipamiento->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rangodias->Errors->ToString());
            $Error = ComposeStrings($Error, $this->fechaespec->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_fechaespec->Errors->ToString());
            $Error = ComposeStrings($Error, $this->horaini->Errors->ToString());
            $Error = ComposeStrings($Error, $this->horafin->Errors->ToString());
            $Error = ComposeStrings($Error, $this->l->Errors->ToString());
            $Error = ComposeStrings($Error, $this->m->Errors->ToString());
            $Error = ComposeStrings($Error, $this->x->Errors->ToString());
            $Error = ComposeStrings($Error, $this->j->Errors->ToString());
            $Error = ComposeStrings($Error, $this->v->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s->Errors->ToString());
            $Error = ComposeStrings($Error, $this->d->Errors->ToString());
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
        $this->idInstructor->Show();
        $this->idEquipamiento->Show();
        $this->rangodias->Show();
        $this->fechaespec->Show();
        $this->DatePicker_fechaespec->Show();
        $this->horaini->Show();
        $this->horafin->Show();
        $this->l->Show();
        $this->m->Show();
        $this->x->Show();
        $this->j->Show();
        $this->v->Show();
        $this->s->Show();
        $this->d->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End disponibilidadinstructor Class @2-FCB6E20C

class clsdisponibilidadinstructorDataSource extends clsDBConnection1 {  //disponibilidadinstructorDataSource Class @2-3FFDFE01

//DataSource Variables @2-FA4A0412
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
    var $idInstructor;
    var $idEquipamiento;
    var $rangodias;
    var $fechaespec;
    var $horaini;
    var $horafin;
    var $l;
    var $m;
    var $x;
    var $j;
    var $v;
    var $s;
    var $d;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-47138103
    function clsdisponibilidadinstructorDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record disponibilidadinstructor/Error";
        $this->Initialize();
        $this->idInstructor = new clsField("idInstructor", ccsInteger, "");
        
        $this->idEquipamiento = new clsField("idEquipamiento", ccsInteger, "");
        
        $this->rangodias = new clsField("rangodias", ccsText, "");
        
        $this->fechaespec = new clsField("fechaespec", ccsDate, $this->DateFormat);
        
        $this->horaini = new clsField("horaini", ccsText, "");
        
        $this->horafin = new clsField("horafin", ccsText, "");
        
        $this->l = new clsField("l", ccsText, "");
        
        $this->m = new clsField("m", ccsText, "");
        
        $this->x = new clsField("x", ccsText, "");
        
        $this->j = new clsField("j", ccsText, "");
        
        $this->v = new clsField("v", ccsText, "");
        
        $this->s = new clsField("s", ccsText, "");
        
        $this->d = new clsField("d", ccsText, "");
        

        $this->InsertFields["idInstructor"] = array("Name" => "idInstructor", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["idEquipamiento"] = array("Name" => "idEquipamiento", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["rangodias"] = array("Name" => "rangodias", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["fechaespec"] = array("Name" => "fechaespec", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["horaini"] = array("Name" => "horaini", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["horafin"] = array("Name" => "horafin", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["idInstructor"] = array("Name" => "idInstructor", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["idEquipamiento"] = array("Name" => "idEquipamiento", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["rangodias"] = array("Name" => "rangodias", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["fechaespec"] = array("Name" => "fechaespec", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["horaini"] = array("Name" => "horaini", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["horafin"] = array("Name" => "horafin", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
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

//Open Method @2-8571213F
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM disponibilidadinstructor {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-4A15DD0D
    function SetValues()
    {
        $this->idInstructor->SetDBValue(trim($this->f("idInstructor")));
        $this->idEquipamiento->SetDBValue(trim($this->f("idEquipamiento")));
        $this->rangodias->SetDBValue($this->f("rangodias"));
        $this->fechaespec->SetDBValue(trim($this->f("fechaespec")));
        $this->horaini->SetDBValue($this->f("horaini"));
        $this->horafin->SetDBValue($this->f("horafin"));
    }
//End SetValues Method

//Insert Method @2-75FE5B0B
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["idInstructor"]["Value"] = $this->idInstructor->GetDBValue(true);
        $this->InsertFields["idEquipamiento"]["Value"] = $this->idEquipamiento->GetDBValue(true);
        $this->InsertFields["rangodias"]["Value"] = $this->rangodias->GetDBValue(true);
        $this->InsertFields["fechaespec"]["Value"] = $this->fechaespec->GetDBValue(true);
        $this->InsertFields["horaini"]["Value"] = $this->horaini->GetDBValue(true);
        $this->InsertFields["horafin"]["Value"] = $this->horafin->GetDBValue(true);
        $this->SQL = CCBuildInsert("disponibilidadinstructor", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-550845AD
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["idInstructor"]["Value"] = $this->idInstructor->GetDBValue(true);
        $this->UpdateFields["idEquipamiento"]["Value"] = $this->idEquipamiento->GetDBValue(true);
        $this->UpdateFields["rangodias"]["Value"] = $this->rangodias->GetDBValue(true);
        $this->UpdateFields["fechaespec"]["Value"] = $this->fechaespec->GetDBValue(true);
        $this->UpdateFields["horaini"]["Value"] = $this->horaini->GetDBValue(true);
        $this->UpdateFields["horafin"]["Value"] = $this->horafin->GetDBValue(true);
        $this->SQL = CCBuildUpdate("disponibilidadinstructor", $this->UpdateFields, $this);
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

//Delete Method @2-A69CC69F
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM disponibilidadinstructor";
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

} //End disponibilidadinstructorDataSource Class @2-FCB6E20C

//Include Page implementation @24-8EACA429
include_once(RelativePath . "/header.php");
//End Include Page implementation

//Initialize Page @1-D2AA4355
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
$TemplateFileName = "disponibilidadi_maint.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Authenticate User @1-89E04E5F
CCSecurityRedirect("", "denegado.php");
//End Authenticate User

//Include events file @1-F00284C6
include_once("./disponibilidadi_maint_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-28B23841
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$disponibilidadinstructor = & new clsRecorddisponibilidadinstructor("", $MainPage);
$header = & new clsheader("", "header", $MainPage);
$header->Initialize();
$MainPage->disponibilidadinstructor = & $disponibilidadinstructor;
$MainPage->header = & $header;
$disponibilidadinstructor->Initialize();

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

//Execute Components @1-FCE59FE7
$disponibilidadinstructor->Operation();
$header->Operations();
//End Execute Components

//Go to destination page @1-DDC0AFC4
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    unset($disponibilidadinstructor);
    $header->Class_Terminate();
    unset($header);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-CF7AE0E7
$disponibilidadinstructor->Show();
$header->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-181F8A9F
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
unset($disponibilidadinstructor);
$header->Class_Terminate();
unset($header);
unset($Tpl);
//End Unload Page


?>
