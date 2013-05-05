<?php
//Include Common Files @1-9E850546
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "gastos_list.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridgastos { //gastos class @2-357B182B

//Variables @2-5342C02D

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
    var $Sorter_detalle;
    var $Sorter_importe;
//End Variables

//Class_Initialize Event @2-73F030A6
    function clsGridgastos($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "gastos";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid gastos";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsgastosDataSource($this);
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
        $this->SorterName = CCGetParam("gastosOrder", "");
        $this->SorterDirection = CCGetParam("gastosDir", "");

        $this->id = & new clsControl(ccsLink, "id", "id", ccsInteger, "", CCGetRequestParam("id", ccsGet, NULL), $this);
        $this->id->Page = "gastos_maint.php";
        $this->detalle = & new clsControl(ccsLabel, "detalle", "detalle", ccsText, "", CCGetRequestParam("detalle", ccsGet, NULL), $this);
        $this->importe = & new clsControl(ccsLabel, "importe", "importe", ccsFloat, "", CCGetRequestParam("importe", ccsGet, NULL), $this);
        $this->mes = & new clsControl(ccsLabel, "mes", "mes", ccsText, "", CCGetRequestParam("mes", ccsGet, NULL), $this);
        $this->anio = & new clsControl(ccsLabel, "anio", "anio", ccsText, "", CCGetRequestParam("anio", ccsGet, NULL), $this);
        $this->gastos_Insert = & new clsControl(ccsLink, "gastos_Insert", "gastos_Insert", ccsText, "", CCGetRequestParam("gastos_Insert", ccsGet, NULL), $this);
        $this->gastos_Insert->Parameters = CCGetQueryString("QueryString", array("id", "ccsForm"));
        $this->gastos_Insert->Page = "gastos_maint.php";
        $this->Sorter_id = & new clsSorter($this->ComponentName, "Sorter_id", $FileName, $this);
        $this->Sorter_detalle = & new clsSorter($this->ComponentName, "Sorter_detalle", $FileName, $this);
        $this->Sorter_importe = & new clsSorter($this->ComponentName, "Sorter_importe", $FileName, $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @2-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @2-562CCD96
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_mes"] = CCGetFromGet("s_mes", NULL);
        $this->DataSource->Parameters["urls_anio"] = CCGetFromGet("s_anio", NULL);

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
            $this->ControlsVisible["detalle"] = $this->detalle->Visible;
            $this->ControlsVisible["importe"] = $this->importe->Visible;
            $this->ControlsVisible["mes"] = $this->mes->Visible;
            $this->ControlsVisible["anio"] = $this->anio->Visible;
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
                $this->detalle->SetValue($this->DataSource->detalle->GetValue());
                $this->importe->SetValue($this->DataSource->importe->GetValue());
                $this->mes->SetValue($this->DataSource->mes->GetValue());
                $this->anio->SetValue($this->DataSource->anio->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->id->Show();
                $this->detalle->Show();
                $this->importe->Show();
                $this->mes->Show();
                $this->anio->Show();
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
        $this->gastos_Insert->Show();
        $this->Sorter_id->Show();
        $this->Sorter_detalle->Show();
        $this->Sorter_importe->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-B75C971A
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->detalle->Errors->ToString());
        $errors = ComposeStrings($errors, $this->importe->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mes->Errors->ToString());
        $errors = ComposeStrings($errors, $this->anio->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End gastos Class @2-FCB6E20C

class clsgastosDataSource extends clsDBConnection1 {  //gastosDataSource Class @2-6F594A5E

//DataSource Variables @2-C86BC964
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $id;
    var $detalle;
    var $importe;
    var $mes;
    var $anio;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-BF00A280
    function clsgastosDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid gastos";
        $this->Initialize();
        $this->id = new clsField("id", ccsInteger, "");
        
        $this->detalle = new clsField("detalle", ccsText, "");
        
        $this->importe = new clsField("importe", ccsFloat, "");
        
        $this->mes = new clsField("mes", ccsText, "");
        
        $this->anio = new clsField("anio", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-3971025C
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "anio, mes";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_id" => array("id", ""), 
            "Sorter_detalle" => array("detalle", ""), 
            "Sorter_importe" => array("importe", "")));
    }
//End SetOrder Method

//Prepare Method @2-ACAFA5CF
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_mes", ccsInteger, "", "", $this->Parameters["urls_mes"], "", false);
        $this->wp->AddParameter("2", "urls_anio", ccsInteger, "", "", $this->Parameters["urls_anio"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "mes", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "anio", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsInteger),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @2-EBA4F3C6
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM gastos";
        $this->SQL = "SELECT id, detalle, importe, mes, anio \n\n" .
        "FROM gastos {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-968F1CF3
    function SetValues()
    {
        $this->id->SetDBValue(trim($this->f("id")));
        $this->detalle->SetDBValue($this->f("detalle"));
        $this->importe->SetDBValue(trim($this->f("importe")));
        $this->mes->SetDBValue($this->f("mes"));
        $this->anio->SetDBValue($this->f("anio"));
    }
//End SetValues Method

} //End gastosDataSource Class @2-FCB6E20C

//Include Page implementation @18-8EACA429
include_once(RelativePath . "/header.php");
//End Include Page implementation

class clsRecordgastos1 { //gastos1 Class @20-6493F901

//Variables @20-D6FF3E86

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

//Class_Initialize Event @20-3EA9709C
    function clsRecordgastos1($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record gastos1/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "gastos1";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->s_mes = & new clsControl(ccsListBox, "s_mes", "s_mes", ccsInteger, "", CCGetRequestParam("s_mes", $Method, NULL), $this);
            $this->s_mes->DSType = dsTable;
            $this->s_mes->DataSource = new clsDBConnection1();
            $this->s_mes->ds = & $this->s_mes->DataSource;
            $this->s_mes->DataSource->SQL = "SELECT * \n" .
"FROM meses {SQL_Where} {SQL_OrderBy}";
            list($this->s_mes->BoundColumn, $this->s_mes->TextColumn, $this->s_mes->DBFormat) = array("nro", "nombre", "");
            $this->s_anio = & new clsControl(ccsTextBox, "s_anio", "s_anio", ccsInteger, "", CCGetRequestParam("s_anio", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @20-81F44B88
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_mes->Validate() && $Validation);
        $Validation = ($this->s_anio->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_mes->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_anio->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @20-CA62B8E4
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_mes->Errors->Count());
        $errors = ($errors || $this->s_anio->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @20-ED598703
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

//Operation Method @20-AD6BDC62
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
        $Redirect = "gastos_list.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "gastos_list.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @20-700AC7A3
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

        $this->s_mes->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_mes->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_anio->Errors->ToString());
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
        $this->s_mes->Show();
        $this->s_anio->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End gastos1 Class @20-FCB6E20C

//Initialize Page @1-2A87C580
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
$TemplateFileName = "gastos_list.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Authenticate User @1-403368F4
CCSecurityRedirect("1", "denegado.php");
//End Authenticate User

//Include events file @1-1546E846
include_once("./gastos_list_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-1E21B090
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$gastos = & new clsGridgastos("", $MainPage);
$header = & new clsheader("", "header", $MainPage);
$header->Initialize();
$gastos1 = & new clsRecordgastos1("", $MainPage);
$MainPage->gastos = & $gastos;
$MainPage->header = & $header;
$MainPage->gastos1 = & $gastos1;
$gastos->Initialize();

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

//Execute Components @1-2A64CA9F
$header->Operations();
$gastos1->Operation();
//End Execute Components

//Go to destination page @1-EEDE1187
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    unset($gastos);
    $header->Class_Terminate();
    unset($header);
    unset($gastos1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-413C8B69
$gastos->Show();
$header->Show();
$gastos1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-404BA97A
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
unset($gastos);
$header->Class_Terminate();
unset($header);
unset($gastos1);
unset($Tpl);
//End Unload Page


?>
