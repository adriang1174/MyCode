<?php
//Include Common Files @1-F2243BB4
define("RelativePath", "..");
define("PathToCurrentPage", "/services/");
define("FileName", "lookupAlumnos.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridalumno { //alumno class @2-AFD1E410

//Variables @2-AC1EDBB9

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
//End Variables

//Class_Initialize Event @2-6FBC3629
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
            $this->PageSize = 10;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->id = & new clsControl(ccsLabel, "id", "id", ccsInteger, "", CCGetRequestParam("id", ccsGet, NULL), $this);
        $this->nombre = & new clsControl(ccsLabel, "nombre", "nombre", ccsText, "", CCGetRequestParam("nombre", ccsGet, NULL), $this);
        $this->tipodoc = & new clsControl(ccsLabel, "tipodoc", "tipodoc", ccsText, "", CCGetRequestParam("tipodoc", ccsGet, NULL), $this);
        $this->nrodocumento = & new clsControl(ccsLabel, "nrodocumento", "nrodocumento", ccsText, "", CCGetRequestParam("nrodocumento", ccsGet, NULL), $this);
        $this->domicilio = & new clsControl(ccsLabel, "domicilio", "domicilio", ccsText, "", CCGetRequestParam("domicilio", ccsGet, NULL), $this);
        $this->telefono = & new clsControl(ccsLabel, "telefono", "telefono", ccsText, "", CCGetRequestParam("telefono", ccsGet, NULL), $this);
        $this->email = & new clsControl(ccsLabel, "email", "email", ccsText, "", CCGetRequestParam("email", ccsGet, NULL), $this);
        $this->comparte = & new clsControl(ccsLabel, "comparte", "comparte", ccsText, "", CCGetRequestParam("comparte", ccsGet, NULL), $this);
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

//Show Method @2-33FDAE3B
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urltxt"] = CCGetFromGet("txt", NULL);

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
            $this->ControlsVisible["nombre"] = $this->nombre->Visible;
            $this->ControlsVisible["tipodoc"] = $this->tipodoc->Visible;
            $this->ControlsVisible["nrodocumento"] = $this->nrodocumento->Visible;
            $this->ControlsVisible["domicilio"] = $this->domicilio->Visible;
            $this->ControlsVisible["telefono"] = $this->telefono->Visible;
            $this->ControlsVisible["email"] = $this->email->Visible;
            $this->ControlsVisible["comparte"] = $this->comparte->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                // Parse Separator
                if($this->RowNumber) {
                    $this->Attributes->Show();
                    $Tpl->parseto("Separator", true, "Row");
                }
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->id->SetValue($this->DataSource->id->GetValue());
                $this->nombre->SetValue($this->DataSource->nombre->GetValue());
                $this->tipodoc->SetValue($this->DataSource->tipodoc->GetValue());
                $this->nrodocumento->SetValue($this->DataSource->nrodocumento->GetValue());
                $this->domicilio->SetValue($this->DataSource->domicilio->GetValue());
                $this->telefono->SetValue($this->DataSource->telefono->GetValue());
                $this->email->SetValue($this->DataSource->email->GetValue());
                $this->comparte->SetValue($this->DataSource->comparte->GetValue());
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
                $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                $Tpl->parse("Row", true);
            }
        }

        $errors = $this->GetErrors();
        if(strlen($errors))
        {
            $Tpl->replaceblock("", $errors);
            $Tpl->block_path = $ParentPath;
            return;
        }
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-6B60781D
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
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End alumno Class @2-FCB6E20C

class clsalumnoDataSource extends clsDBConnection1 {  //alumnoDataSource Class @2-B1C8DBE2

//DataSource Variables @2-E5D265BC
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
//End DataSource Variables

//DataSourceClass_Initialize Event @2-FEBCBBD0
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
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-76449ECE
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urltxt", ccsText, "", "", $this->Parameters["urltxt"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "nombre", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-E0668599
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM alumno";
        $this->SQL = "SELECT * \n\n" .
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

//SetValues Method @2-DFFC1947
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
    }
//End SetValues Method

} //End alumnoDataSource Class @2-FCB6E20C

//Initialize Page @1-EC55E510
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
$TemplateFileName = "lookupAlumnos.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
//End Initialize Page

//Include events file @1-A239E38A
include_once("./lookupAlumnos_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-5C3D148F
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$alumno = & new clsGridalumno("", $MainPage);
$MainPage->alumno = & $alumno;
$alumno->Initialize();

BindEvents();

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize", $MainPage);

if ($Charset) {
    header("Content-Type: " . $ContentType . "; charset=" . $Charset);
} else {
    header("Content-Type: " . $ContentType);
}
//End Initialize Objects

//Initialize HTML Template @1-9A11BEC1
$CCSEventResult = CCGetEvent($CCSEvents, "OnInitializeView", $MainPage);
$Tpl = new clsTemplate();
$Tpl->LoadTemplate(PathToCurrentPage . $TemplateFileName, $BlockToParse, "CP1252");
$Tpl->block_path = "/$BlockToParse";
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeShow", $MainPage);
$Attributes->SetValue("pathToRoot", "../");
$Attributes->Show();
//End Initialize HTML Template

//Go to destination page @1-1ED61819
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    unset($alumno);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-8B60E806
$alumno->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-2B27150F
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
unset($alumno);
unset($Tpl);
//End Unload Page


?>
