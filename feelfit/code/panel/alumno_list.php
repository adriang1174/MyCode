<?php
//Include Common Files @1-040F96BB
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "alumno_list.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordalumnoSearch { //alumnoSearch Class @2-AF309550

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

//Class_Initialize Event @2-C7FA090E
    function clsRecordalumnoSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record alumnoSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "alumnoSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->s_nombre = & new clsControl(ccsTextBox, "s_nombre", "s_nombre", ccsText, "", CCGetRequestParam("s_nombre", $Method, NULL), $this);
            $this->s_domicilio = & new clsControl(ccsTextBox, "s_domicilio", "s_domicilio", ccsText, "", CCGetRequestParam("s_domicilio", $Method, NULL), $this);
            $this->s_telefono = & new clsControl(ccsTextBox, "s_telefono", "s_telefono", ccsText, "", CCGetRequestParam("s_telefono", $Method, NULL), $this);
            $this->s_email = & new clsControl(ccsTextBox, "s_email", "s_email", ccsText, "", CCGetRequestParam("s_email", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @2-D906F57A
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_nombre->Validate() && $Validation);
        $Validation = ($this->s_domicilio->Validate() && $Validation);
        $Validation = ($this->s_telefono->Validate() && $Validation);
        $Validation = ($this->s_email->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_nombre->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_domicilio->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_telefono->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_email->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-3FC02A9B
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_nombre->Errors->Count());
        $errors = ($errors || $this->s_domicilio->Errors->Count());
        $errors = ($errors || $this->s_telefono->Errors->Count());
        $errors = ($errors || $this->s_email->Errors->Count());
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

//Operation Method @2-7DA8F0F8
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
        $Redirect = "alumno_list.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "alumno_list.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @2-340F9A89
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
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_nombre->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_domicilio->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_telefono->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_email->Errors->ToString());
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
        $this->s_nombre->Show();
        $this->s_domicilio->Show();
        $this->s_telefono->Show();
        $this->s_email->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End alumnoSearch Class @2-FCB6E20C

class clsGridalumno { //alumno class @11-AFD1E410

//Variables @11-F2BFC3DE

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
    var $Sorter_nombre;
    var $Sorter_tipodoc;
    var $Sorter_nrodocumento;
    var $Sorter_domicilio;
    var $Sorter_telefono;
    var $Sorter_email;
    var $Sorter_comparte;
//End Variables

//Class_Initialize Event @11-20702DCA
    function clsGridalumno($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "alumno";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid alumno";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsalumnoDataSource($this);
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
        $this->SorterName = CCGetParam("alumnoOrder", "");
        $this->SorterDirection = CCGetParam("alumnoDir", "");

        $this->id = & new clsControl(ccsLink, "id", "id", ccsInteger, "", CCGetRequestParam("id", ccsGet, NULL), $this);
        $this->id->Page = "alumno_maint.php";
        $this->nombre = & new clsControl(ccsLabel, "nombre", "nombre", ccsText, "", CCGetRequestParam("nombre", ccsGet, NULL), $this);
        $this->tipodoc = & new clsControl(ccsLabel, "tipodoc", "tipodoc", ccsText, "", CCGetRequestParam("tipodoc", ccsGet, NULL), $this);
        $this->nrodocumento = & new clsControl(ccsLabel, "nrodocumento", "nrodocumento", ccsText, "", CCGetRequestParam("nrodocumento", ccsGet, NULL), $this);
        $this->domicilio = & new clsControl(ccsLabel, "domicilio", "domicilio", ccsText, "", CCGetRequestParam("domicilio", ccsGet, NULL), $this);
        $this->telefono = & new clsControl(ccsLabel, "telefono", "telefono", ccsText, "", CCGetRequestParam("telefono", ccsGet, NULL), $this);
        $this->email = & new clsControl(ccsLabel, "email", "email", ccsText, "", CCGetRequestParam("email", ccsGet, NULL), $this);
        $this->comparte = & new clsControl(ccsLabel, "comparte", "comparte", ccsText, "", CCGetRequestParam("comparte", ccsGet, NULL), $this);
        $this->cuota = & new clsControl(ccsLabel, "cuota", "cuota", ccsInteger, "", CCGetRequestParam("cuota", ccsGet, NULL), $this);
        $this->negrita = & new clsControl(ccsLabel, "negrita", "negrita", ccsText, "", CCGetRequestParam("negrita", ccsGet, NULL), $this);
        $this->activo = & new clsControl(ccsLabel, "activo", "activo", ccsText, "", CCGetRequestParam("activo", ccsGet, NULL), $this);
        $this->alumno_Insert = & new clsControl(ccsLink, "alumno_Insert", "alumno_Insert", ccsText, "", CCGetRequestParam("alumno_Insert", ccsGet, NULL), $this);
        $this->alumno_Insert->Parameters = CCGetQueryString("QueryString", array("id", "ccsForm"));
        $this->alumno_Insert->Page = "alumno_maint.php";
        $this->Sorter_id = & new clsSorter($this->ComponentName, "Sorter_id", $FileName, $this);
        $this->Sorter_nombre = & new clsSorter($this->ComponentName, "Sorter_nombre", $FileName, $this);
        $this->Sorter_tipodoc = & new clsSorter($this->ComponentName, "Sorter_tipodoc", $FileName, $this);
        $this->Sorter_nrodocumento = & new clsSorter($this->ComponentName, "Sorter_nrodocumento", $FileName, $this);
        $this->Sorter_domicilio = & new clsSorter($this->ComponentName, "Sorter_domicilio", $FileName, $this);
        $this->Sorter_telefono = & new clsSorter($this->ComponentName, "Sorter_telefono", $FileName, $this);
        $this->Sorter_email = & new clsSorter($this->ComponentName, "Sorter_email", $FileName, $this);
        $this->Sorter_comparte = & new clsSorter($this->ComponentName, "Sorter_comparte", $FileName, $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->cont = & new clsControl(ccsLabel, "cont", "cont", ccsText, "", CCGetRequestParam("cont", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @11-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @11-64872C27
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_nombre"] = CCGetFromGet("s_nombre", NULL);
        $this->DataSource->Parameters["urls_domicilio"] = CCGetFromGet("s_domicilio", NULL);
        $this->DataSource->Parameters["urls_telefono"] = CCGetFromGet("s_telefono", NULL);
        $this->DataSource->Parameters["urls_email"] = CCGetFromGet("s_email", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();
        $this->HasRecord = $this->DataSource->has_next_record();
        $this->IsEmpty = ! $this->HasRecord;
        $this->Attributes->SetValue("negrita", "");
        $this->Attributes->Show();

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) return;

        $GridBlock = "Grid " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $GridBlock;


        if (!$this->IsEmpty) {
            $this->ControlsVisible["id"] = $this->id->Visible;
            $this->ControlsVisible["nombre"] = $this->nombre->Visible;
            $this->ControlsVisible["tipodoc"] = $this->tipodoc->Visible;
            $this->ControlsVisible["nrodocumento"] = $this->nrodocumento->Visible;
            $this->ControlsVisible["domicilio"] = $this->domicilio->Visible;
            $this->ControlsVisible["telefono"] = $this->telefono->Visible;
            $this->ControlsVisible["email"] = $this->email->Visible;
            $this->ControlsVisible["comparte"] = $this->comparte->Visible;
            $this->ControlsVisible["cuota"] = $this->cuota->Visible;
            $this->ControlsVisible["negrita"] = $this->negrita->Visible;
            $this->ControlsVisible["activo"] = $this->activo->Visible;
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
                $this->nombre->SetValue($this->DataSource->nombre->GetValue());
                $this->tipodoc->SetValue($this->DataSource->tipodoc->GetValue());
                $this->nrodocumento->SetValue($this->DataSource->nrodocumento->GetValue());
                $this->domicilio->SetValue($this->DataSource->domicilio->GetValue());
                $this->telefono->SetValue($this->DataSource->telefono->GetValue());
                $this->email->SetValue($this->DataSource->email->GetValue());
                $this->comparte->SetValue($this->DataSource->comparte->GetValue());
                $this->cuota->SetValue($this->DataSource->cuota->GetValue());
                $this->activo->SetValue($this->DataSource->activo->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->id->Show();
                $this->nombre->Show();
                $this->tipodoc->Show();
                $this->nrodocumento->Show();
                $this->domicilio->Show();
                $this->telefono->Show();
                $this->email->Show();
                $this->comparte->Show();
                $this->cuota->Show();
                $this->negrita->Show();
                $this->activo->Show();
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
        $this->alumno_Insert->Show();
        $this->Sorter_id->Show();
        $this->Sorter_nombre->Show();
        $this->Sorter_tipodoc->Show();
        $this->Sorter_nrodocumento->Show();
        $this->Sorter_domicilio->Show();
        $this->Sorter_telefono->Show();
        $this->Sorter_email->Show();
        $this->Sorter_comparte->Show();
        $this->Navigator->Show();
        $this->cont->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @11-8AD43D43
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nombre->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tipodoc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nrodocumento->Errors->ToString());
        $errors = ComposeStrings($errors, $this->domicilio->Errors->ToString());
        $errors = ComposeStrings($errors, $this->telefono->Errors->ToString());
        $errors = ComposeStrings($errors, $this->email->Errors->ToString());
        $errors = ComposeStrings($errors, $this->comparte->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cuota->Errors->ToString());
        $errors = ComposeStrings($errors, $this->negrita->Errors->ToString());
        $errors = ComposeStrings($errors, $this->activo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End alumno Class @11-FCB6E20C

class clsalumnoDataSource extends clsDBConnection1 {  //alumnoDataSource Class @11-B1C8DBE2

//DataSource Variables @11-F8530F37
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $id;
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

//DataSourceClass_Initialize Event @11-E38D4576
    function clsalumnoDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid alumno";
        $this->Initialize();
        $this->id = new clsField("id", ccsInteger, "");
        
        $this->nombre = new clsField("nombre", ccsText, "");
        
        $this->tipodoc = new clsField("tipodoc", ccsText, "");
        
        $this->nrodocumento = new clsField("nrodocumento", ccsText, "");
        
        $this->domicilio = new clsField("domicilio", ccsText, "");
        
        $this->telefono = new clsField("telefono", ccsText, "");
        
        $this->email = new clsField("email", ccsText, "");
        
        $this->comparte = new clsField("comparte", ccsText, "");
        
        $this->cuota = new clsField("cuota", ccsInteger, "");
        
        $this->activo = new clsField("activo", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @11-17F6DE43
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_id" => array("id", ""), 
            "Sorter_nombre" => array("nombre", ""), 
            "Sorter_tipodoc" => array("tipodoc", ""), 
            "Sorter_nrodocumento" => array("nrodocumento", ""), 
            "Sorter_domicilio" => array("domicilio", ""), 
            "Sorter_telefono" => array("telefono", ""), 
            "Sorter_email" => array("email", ""), 
            "Sorter_comparte" => array("comparte", "")));
    }
//End SetOrder Method

//Prepare Method @11-7EEF3377
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_nombre", ccsText, "", "", $this->Parameters["urls_nombre"], "", false);
        $this->wp->AddParameter("2", "urls_domicilio", ccsText, "", "", $this->Parameters["urls_domicilio"], "", false);
        $this->wp->AddParameter("3", "urls_telefono", ccsText, "", "", $this->Parameters["urls_telefono"], "", false);
        $this->wp->AddParameter("4", "urls_email", ccsText, "", "", $this->Parameters["urls_email"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "nombre", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "domicilio", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opContains, "telefono", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opContains, "email", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]), 
             $this->wp->Criterion[4]);
    }
//End Prepare Method

//Open Method @11-32DA7588
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM alumno";
        $this->SQL = "SELECT id, nombre, tipodoc, nrodocumento, domicilio, telefono, email, comparte, cuota, activo \n\n" .
        "FROM alumno {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @11-FC5D9449
    function SetValues()
    {
        $this->id->SetDBValue(trim($this->f("id")));
        $this->nombre->SetDBValue($this->f("nombre"));
        $this->tipodoc->SetDBValue($this->f("tipodoc"));
        $this->nrodocumento->SetDBValue($this->f("nrodocumento"));
        $this->domicilio->SetDBValue($this->f("domicilio"));
        $this->telefono->SetDBValue($this->f("telefono"));
        $this->email->SetDBValue($this->f("email"));
        $this->comparte->SetDBValue($this->f("comparte"));
        $this->cuota->SetDBValue(trim($this->f("cuota")));
        $this->activo->SetDBValue($this->f("activo"));
    }
//End SetValues Method

} //End alumnoDataSource Class @11-FCB6E20C

//Include Page implementation @49-8EACA429
include_once(RelativePath . "/header.php");
//End Include Page implementation

//Initialize Page @1-E65FE110
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
$TemplateFileName = "alumno_list.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Authenticate User @1-89E04E5F
CCSecurityRedirect("", "denegado.php");
//End Authenticate User

//Include events file @1-02CF2C8D
include_once("./alumno_list_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-871B6CBD
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$alumnoSearch = & new clsRecordalumnoSearch("", $MainPage);
$alumno = & new clsGridalumno("", $MainPage);
$header = & new clsheader("", "header", $MainPage);
$header->Initialize();
$MainPage->alumnoSearch = & $alumnoSearch;
$MainPage->alumno = & $alumno;
$MainPage->header = & $header;
$alumno->Initialize();

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

//Execute Components @1-1231540F
$alumnoSearch->Operation();
$header->Operations();
//End Execute Components

//Go to destination page @1-537314A4
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    unset($alumnoSearch);
    unset($alumno);
    $header->Class_Terminate();
    unset($header);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-4120490C
$alumnoSearch->Show();
$alumno->Show();
$header->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-8C58B36F
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
unset($alumnoSearch);
unset($alumno);
$header->Class_Terminate();
unset($header);
unset($Tpl);
//End Unload Page


?>
