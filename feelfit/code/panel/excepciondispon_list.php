<?php
//Include Common Files @1-8A5772E8
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "excepciondispon_list.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridexcepciondisponibilidadin { //excepciondisponibilidadin class @2-48B179C2

//Variables @2-A9AC47E2

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
    var $Sorter_idInstructor;
    var $Sorter_fecha;
//End Variables

//Class_Initialize Event @2-D97AAF67
    function clsGridexcepciondisponibilidadin($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "excepciondisponibilidadin";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid excepciondisponibilidadin";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsexcepciondisponibilidadinDataSource($this);
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
        $this->SorterName = CCGetParam("excepciondisponibilidadinOrder", "");
        $this->SorterDirection = CCGetParam("excepciondisponibilidadinDir", "");

        $this->link1 = & new clsControl(ccsLink, "link1", "link1", ccsInteger, "", CCGetRequestParam("link1", ccsGet, NULL), $this);
        $this->link1->Page = "excepciondispon_maint.php";
        $this->instructor = & new clsControl(ccsLabel, "instructor", "instructor", ccsText, "", CCGetRequestParam("instructor", ccsGet, NULL), $this);
        $this->fecha = & new clsControl(ccsLabel, "fecha", "fecha", ccsDate, $DefaultDateFormat, CCGetRequestParam("fecha", ccsGet, NULL), $this);
        $this->id = & new clsControl(ccsHidden, "id", "id", ccsInteger, "", CCGetRequestParam("id", ccsGet, NULL), $this);
        $this->excepciondisponibilidadin_Insert = & new clsControl(ccsLink, "excepciondisponibilidadin_Insert", "excepciondisponibilidadin_Insert", ccsText, "", CCGetRequestParam("excepciondisponibilidadin_Insert", ccsGet, NULL), $this);
        $this->excepciondisponibilidadin_Insert->Parameters = CCGetQueryString("QueryString", array("id", "ccsForm"));
        $this->excepciondisponibilidadin_Insert->Page = "excepciondispon_maint.php";
        $this->Sorter_idInstructor = & new clsSorter($this->ComponentName, "Sorter_idInstructor", $FileName, $this);
        $this->Sorter_fecha = & new clsSorter($this->ComponentName, "Sorter_fecha", $FileName, $this);
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

//Show Method @2-0E452736
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;


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
            $this->ControlsVisible["link1"] = $this->link1->Visible;
            $this->ControlsVisible["instructor"] = $this->instructor->Visible;
            $this->ControlsVisible["fecha"] = $this->fecha->Visible;
            $this->ControlsVisible["id"] = $this->id->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->link1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->link1->Parameters = CCAddParam($this->link1->Parameters, "id", $this->DataSource->f("excepciondisponibilidadinstructor_id"));
                $this->instructor->SetValue($this->DataSource->instructor->GetValue());
                $this->fecha->SetValue($this->DataSource->fecha->GetValue());
                $this->id->SetValue($this->DataSource->id->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->link1->Show();
                $this->instructor->Show();
                $this->fecha->Show();
                $this->id->Show();
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
        $this->excepciondisponibilidadin_Insert->Show();
        $this->Sorter_idInstructor->Show();
        $this->Sorter_fecha->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-2C2B2C4C
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->link1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->instructor->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fecha->Errors->ToString());
        $errors = ComposeStrings($errors, $this->id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End excepciondisponibilidadin Class @2-FCB6E20C

class clsexcepciondisponibilidadinDataSource extends clsDBConnection1 {  //excepciondisponibilidadinDataSource Class @2-1424C085

//DataSource Variables @2-AFCBD7E9
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $instructor;
    var $fecha;
    var $id;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-E39EF6CC
    function clsexcepciondisponibilidadinDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid excepciondisponibilidadin";
        $this->Initialize();
        $this->instructor = new clsField("instructor", ccsText, "");
        
        $this->fecha = new clsField("fecha", ccsDate, $this->DateFormat);
        
        $this->id = new clsField("id", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-067ACCC3
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_idInstructor" => array("nombre", ""), 
            "Sorter_fecha" => array("fecha", "")));
    }
//End SetOrder Method

//Prepare Method @2-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @2-B8A56958
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM excepciondisponibilidadinstructor INNER JOIN instructor ON\n\n" .
        "excepciondisponibilidadinstructor.idInstructor = instructor.id";
        $this->SQL = "SELECT idInstructor, fecha, nombre, excepciondisponibilidadinstructor.id AS excepciondisponibilidadinstructor_id \n\n" .
        "FROM excepciondisponibilidadinstructor INNER JOIN instructor ON\n\n" .
        "excepciondisponibilidadinstructor.idInstructor = instructor.id {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-C5B59881
    function SetValues()
    {
        $this->instructor->SetDBValue($this->f("nombre"));
        $this->fecha->SetDBValue(trim($this->f("fecha")));
        $this->id->SetDBValue(trim($this->f("id")));
    }
//End SetValues Method

} //End excepciondisponibilidadinDataSource Class @2-FCB6E20C

//Include Page implementation @22-8EACA429
include_once(RelativePath . "/header.php");
//End Include Page implementation

//Initialize Page @1-63EC1FDC
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
$TemplateFileName = "excepciondispon_list.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Authenticate User @1-89E04E5F
CCSecurityRedirect("", "denegado.php");
//End Authenticate User

//Include events file @1-E9F9DE71
include_once("./excepciondispon_list_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-5D3D2DCC
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$excepciondisponibilidadin = & new clsGridexcepciondisponibilidadin("", $MainPage);
$header = & new clsheader("", "header", $MainPage);
$header->Initialize();
$MainPage->excepciondisponibilidadin = & $excepciondisponibilidadin;
$MainPage->header = & $header;
$excepciondisponibilidadin->Initialize();

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

//Execute Components @1-D0D9375A
$header->Operations();
//End Execute Components

//Go to destination page @1-BB35119E
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    unset($excepciondisponibilidadin);
    $header->Class_Terminate();
    unset($header);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-A8095F45
$excepciondisponibilidadin->Show();
$header->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-60796405
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
unset($excepciondisponibilidadin);
$header->Class_Terminate();
unset($header);
unset($Tpl);
//End Unload Page


?>
