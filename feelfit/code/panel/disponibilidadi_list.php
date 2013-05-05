<?php
//Include Common Files @1-86321BF8
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "disponibilidadi_list.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGriddisponibilidadinstructor { //disponibilidadinstructor class @2-77545032

//Variables @2-63C5954A

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
    var $Sorter_idEquipamiento;
    var $Sorter_horaini;
    var $Sorter_horafin;
//End Variables

//Class_Initialize Event @2-AD4EBCED
    function clsGriddisponibilidadinstructor($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "disponibilidadinstructor";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid disponibilidadinstructor";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsdisponibilidadinstructorDataSource($this);
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
        $this->SorterName = CCGetParam("disponibilidadinstructorOrder", "");
        $this->SorterDirection = CCGetParam("disponibilidadinstructorDir", "");

        $this->link1 = & new clsControl(ccsLink, "link1", "link1", ccsInteger, "", CCGetRequestParam("link1", ccsGet, NULL), $this);
        $this->link1->Page = "disponibilidadi_maint.php";
        $this->instructor = & new clsControl(ccsLabel, "instructor", "instructor", ccsText, "", CCGetRequestParam("instructor", ccsGet, NULL), $this);
        $this->equipamiento = & new clsControl(ccsLabel, "equipamiento", "equipamiento", ccsText, "", CCGetRequestParam("equipamiento", ccsGet, NULL), $this);
        $this->rangodias = & new clsControl(ccsLabel, "rangodias", "rangodias", ccsText, "", CCGetRequestParam("rangodias", ccsGet, NULL), $this);
        $this->horaini = & new clsControl(ccsLabel, "horaini", "horaini", ccsText, "", CCGetRequestParam("horaini", ccsGet, NULL), $this);
        $this->horafin = & new clsControl(ccsLabel, "horafin", "horafin", ccsText, "", CCGetRequestParam("horafin", ccsGet, NULL), $this);
        $this->fechaespec = & new clsControl(ccsLabel, "fechaespec", "fechaespec", ccsDate, $DefaultDateFormat, CCGetRequestParam("fechaespec", ccsGet, NULL), $this);
        $this->id = & new clsControl(ccsHidden, "id", "id", ccsInteger, "", CCGetRequestParam("id", ccsGet, NULL), $this);
        $this->disponibilidadinstructor_Insert = & new clsControl(ccsLink, "disponibilidadinstructor_Insert", "disponibilidadinstructor_Insert", ccsText, "", CCGetRequestParam("disponibilidadinstructor_Insert", ccsGet, NULL), $this);
        $this->disponibilidadinstructor_Insert->Parameters = CCGetQueryString("QueryString", array("id", "ccsForm"));
        $this->disponibilidadinstructor_Insert->Page = "disponibilidadi_maint.php";
        $this->Sorter_idInstructor = & new clsSorter($this->ComponentName, "Sorter_idInstructor", $FileName, $this);
        $this->Sorter_idEquipamiento = & new clsSorter($this->ComponentName, "Sorter_idEquipamiento", $FileName, $this);
        $this->Sorter_horaini = & new clsSorter($this->ComponentName, "Sorter_horaini", $FileName, $this);
        $this->Sorter_horafin = & new clsSorter($this->ComponentName, "Sorter_horafin", $FileName, $this);
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

//Show Method @2-F9588D93
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
            $this->ControlsVisible["equipamiento"] = $this->equipamiento->Visible;
            $this->ControlsVisible["rangodias"] = $this->rangodias->Visible;
            $this->ControlsVisible["horaini"] = $this->horaini->Visible;
            $this->ControlsVisible["horafin"] = $this->horafin->Visible;
            $this->ControlsVisible["fechaespec"] = $this->fechaespec->Visible;
            $this->ControlsVisible["id"] = $this->id->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->link1->SetValue($this->DataSource->link1->GetValue());
                $this->link1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->link1->Parameters = CCAddParam($this->link1->Parameters, "id", $this->DataSource->f("disponibilidadinstructor_id"));
                $this->instructor->SetValue($this->DataSource->instructor->GetValue());
                $this->equipamiento->SetValue($this->DataSource->equipamiento->GetValue());
                $this->rangodias->SetValue($this->DataSource->rangodias->GetValue());
                $this->horaini->SetValue($this->DataSource->horaini->GetValue());
                $this->horafin->SetValue($this->DataSource->horafin->GetValue());
                $this->fechaespec->SetValue($this->DataSource->fechaespec->GetValue());
                $this->id->SetValue($this->DataSource->id->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->link1->Show();
                $this->instructor->Show();
                $this->equipamiento->Show();
                $this->rangodias->Show();
                $this->horaini->Show();
                $this->horafin->Show();
                $this->fechaespec->Show();
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
        $this->disponibilidadinstructor_Insert->Show();
        $this->Sorter_idInstructor->Show();
        $this->Sorter_idEquipamiento->Show();
        $this->Sorter_horaini->Show();
        $this->Sorter_horafin->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-FF9EC6BD
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->link1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->instructor->Errors->ToString());
        $errors = ComposeStrings($errors, $this->equipamiento->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rangodias->Errors->ToString());
        $errors = ComposeStrings($errors, $this->horaini->Errors->ToString());
        $errors = ComposeStrings($errors, $this->horafin->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fechaespec->Errors->ToString());
        $errors = ComposeStrings($errors, $this->id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End disponibilidadinstructor Class @2-FCB6E20C

class clsdisponibilidadinstructorDataSource extends clsDBConnection1 {  //disponibilidadinstructorDataSource Class @2-3FFDFE01

//DataSource Variables @2-4CF0502A
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $link1;
    var $instructor;
    var $equipamiento;
    var $rangodias;
    var $horaini;
    var $horafin;
    var $fechaespec;
    var $id;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-08C442BA
    function clsdisponibilidadinstructorDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid disponibilidadinstructor";
        $this->Initialize();
        $this->link1 = new clsField("link1", ccsInteger, "");
        
        $this->instructor = new clsField("instructor", ccsText, "");
        
        $this->equipamiento = new clsField("equipamiento", ccsText, "");
        
        $this->rangodias = new clsField("rangodias", ccsText, "");
        
        $this->horaini = new clsField("horaini", ccsText, "");
        
        $this->horafin = new clsField("horafin", ccsText, "");
        
        $this->fechaespec = new clsField("fechaespec", ccsDate, $this->DateFormat);
        
        $this->id = new clsField("id", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-C8125EDC
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_idInstructor" => array("nombre", ""), 
            "Sorter_idEquipamiento" => array("idEquipamiento", ""), 
            "Sorter_horaini" => array("horaini", ""), 
            "Sorter_horafin" => array("horafin", "")));
    }
//End SetOrder Method

//Prepare Method @2-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @2-1426F75D
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM (disponibilidadinstructor INNER JOIN instructor ON\n\n" .
        "disponibilidadinstructor.idInstructor = instructor.id) INNER JOIN equipamiento ON\n\n" .
        "disponibilidadinstructor.idEquipamiento = equipamiento.id";
        $this->SQL = "SELECT disponibilidadinstructor.id AS disponibilidadinstructor_id, idInstructor, idEquipamiento, rangodias, fechaespec, horaini, horafin,\n\n" .
        "nombre, descripcion \n\n" .
        "FROM (disponibilidadinstructor INNER JOIN instructor ON\n\n" .
        "disponibilidadinstructor.idInstructor = instructor.id) INNER JOIN equipamiento ON\n\n" .
        "disponibilidadinstructor.idEquipamiento = equipamiento.id {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-1C0E5243
    function SetValues()
    {
        $this->link1->SetDBValue(trim($this->f("disponibilidadinstructor_id")));
        $this->instructor->SetDBValue($this->f("nombre"));
        $this->equipamiento->SetDBValue($this->f("descripcion"));
        $this->rangodias->SetDBValue($this->f("rangodias"));
        $this->horaini->SetDBValue($this->f("horaini"));
        $this->horafin->SetDBValue($this->f("horafin"));
        $this->fechaespec->SetDBValue(trim($this->f("fechaespec")));
        $this->id->SetDBValue(trim($this->f("disponibilidadinstructor_id")));
    }
//End SetValues Method

} //End disponibilidadinstructorDataSource Class @2-FCB6E20C

//Include Page implementation @40-8EACA429
include_once(RelativePath . "/header.php");
//End Include Page implementation

//Initialize Page @1-6690E00E
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
$TemplateFileName = "disponibilidadi_list.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Authenticate User @1-89E04E5F
CCSecurityRedirect("", "denegado.php");
//End Authenticate User

//Include events file @1-CC2B127C
include_once("./disponibilidadi_list_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-19D38DED
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$disponibilidadinstructor = & new clsGriddisponibilidadinstructor("", $MainPage);
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

//Execute Components @1-D0D9375A
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
