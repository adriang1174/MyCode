<?php
//Include Common Files @1-5C47FD99
define("RelativePath", "..");
define("PathToCurrentPage", "/services/");
define("FileName", "SetScheduleDetail.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridagenda { //agenda class @2-245784E7

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

//Class_Initialize Event @2-68D5DB23
    function clsGridagenda($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "agenda";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid agenda";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsagendaDataSource($this);
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
        $this->idAlumno = & new clsControl(ccsLabel, "idAlumno", "idAlumno", ccsInteger, "", CCGetRequestParam("idAlumno", ccsGet, NULL), $this);
        $this->idEquipamiento = & new clsControl(ccsLabel, "idEquipamiento", "idEquipamiento", ccsInteger, "", CCGetRequestParam("idEquipamiento", ccsGet, NULL), $this);
        $this->rangodias = & new clsControl(ccsLabel, "rangodias", "rangodias", ccsText, "", CCGetRequestParam("rangodias", ccsGet, NULL), $this);
        $this->fechaespec = & new clsControl(ccsLabel, "fechaespec", "fechaespec", ccsDate, $DefaultDateFormat, CCGetRequestParam("fechaespec", ccsGet, NULL), $this);
        $this->horaini = & new clsControl(ccsLabel, "horaini", "horaini", ccsText, "", CCGetRequestParam("horaini", ccsGet, NULL), $this);
        $this->horafin = & new clsControl(ccsLabel, "horafin", "horafin", ccsText, "", CCGetRequestParam("horafin", ccsGet, NULL), $this);
        $this->mediahora = & new clsControl(ccsLabel, "mediahora", "mediahora", ccsInteger, "", CCGetRequestParam("mediahora", ccsGet, NULL), $this);
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

//Show Method @2-877DCD84
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urla"] = CCGetFromGet("a", NULL);
        $this->DataSource->Parameters["urle"] = CCGetFromGet("e", NULL);
        $this->DataSource->Parameters["urlf"] = CCGetFromGet("f", NULL);
        $this->DataSource->Parameters["urlhi"] = CCGetFromGet("hi", NULL);

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
            $this->ControlsVisible["idEquipamiento"] = $this->idEquipamiento->Visible;
            $this->ControlsVisible["rangodias"] = $this->rangodias->Visible;
            $this->ControlsVisible["fechaespec"] = $this->fechaespec->Visible;
            $this->ControlsVisible["horaini"] = $this->horaini->Visible;
            $this->ControlsVisible["horafin"] = $this->horafin->Visible;
            $this->ControlsVisible["mediahora"] = $this->mediahora->Visible;
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
                $this->idAlumno->SetValue($this->DataSource->idAlumno->GetValue());
                $this->idEquipamiento->SetValue($this->DataSource->idEquipamiento->GetValue());
                $this->rangodias->SetValue($this->DataSource->rangodias->GetValue());
                $this->fechaespec->SetValue($this->DataSource->fechaespec->GetValue());
                $this->horaini->SetValue($this->DataSource->horaini->GetValue());
                $this->horafin->SetValue($this->DataSource->horafin->GetValue());
                $this->mediahora->SetValue($this->DataSource->mediahora->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->id->Show();
                $this->idAlumno->Show();
                $this->idEquipamiento->Show();
                $this->rangodias->Show();
                $this->fechaespec->Show();
                $this->horaini->Show();
                $this->horafin->Show();
                $this->mediahora->Show();
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

//GetErrors Method @2-CE1AAC1C
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->idAlumno->Errors->ToString());
        $errors = ComposeStrings($errors, $this->idEquipamiento->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rangodias->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fechaespec->Errors->ToString());
        $errors = ComposeStrings($errors, $this->horaini->Errors->ToString());
        $errors = ComposeStrings($errors, $this->horafin->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mediahora->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End agenda Class @2-FCB6E20C

class clsagendaDataSource extends clsDBConnection1 {  //agendaDataSource Class @2-13F999AC

//DataSource Variables @2-B5F3BF5C
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
    var $idEquipamiento;
    var $rangodias;
    var $fechaespec;
    var $horaini;
    var $horafin;
    var $mediahora;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-A00E45C2
    function clsagendaDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid agenda";
        $this->Initialize();
        $this->id = new clsField("id", ccsInteger, "");
        
        $this->idAlumno = new clsField("idAlumno", ccsInteger, "");
        
        $this->idEquipamiento = new clsField("idEquipamiento", ccsInteger, "");
        
        $this->rangodias = new clsField("rangodias", ccsText, "");
        
        $this->fechaespec = new clsField("fechaespec", ccsDate, $this->DateFormat);
        
        $this->horaini = new clsField("horaini", ccsText, "");
        
        $this->horafin = new clsField("horafin", ccsText, "");
        
        $this->mediahora = new clsField("mediahora", ccsInteger, "");
        

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

//Prepare Method @2-278490DE
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urla", ccsInteger, "", "", $this->Parameters["urla"], 0, false);
        $this->wp->AddParameter("2", "urle", ccsInteger, "", "", $this->Parameters["urle"], 0, false);
        $this->wp->AddParameter("3", "urlf", ccsText, "", "", $this->Parameters["urlf"], "", false);
        $this->wp->AddParameter("4", "urlhi", ccsText, "", "", $this->Parameters["urlhi"], "", false);
    }
//End Prepare Method

//Open Method @2-86F17DDB
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM agenda\n" .
        "WHERE idAlumno = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "AND idEquipamiento = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . " \n" .
        "and (substring( rangodias, DAYOFWEEK( '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "' ) , 1 ) = '1'\n" .
        "OR fechaespec = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "')\n" .
        "and horaini = '" . $this->SQLValue($this->wp->GetDBValue("4"), ccsText) . "'\n" .
        "and fechavig > current_date";
        $this->SQL = "SELECT * \n" .
        "FROM agenda\n" .
        "WHERE idAlumno = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "AND idEquipamiento = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . " \n" .
        "and (substring( rangodias, DAYOFWEEK( '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "' ) , 1 ) = '1'\n" .
        "OR fechaespec = '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "')\n" .
        "and horaini = '" . $this->SQLValue($this->wp->GetDBValue("4"), ccsText) . "'\n" .
        "and fechavig > current_date";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-1E638DDC
    function SetValues()
    {
        $this->id->SetDBValue(trim($this->f("id")));
        $this->idAlumno->SetDBValue(trim($this->f("idAlumno")));
        $this->idEquipamiento->SetDBValue(trim($this->f("idEquipamiento")));
        $this->rangodias->SetDBValue($this->f("rangodias"));
        $this->fechaespec->SetDBValue(trim($this->f("fechaespec")));
        $this->horaini->SetDBValue($this->f("horaini"));
        $this->horafin->SetDBValue($this->f("horafin"));
        $this->mediahora->SetDBValue(trim($this->f("mediahora")));
    }
//End SetValues Method

} //End agendaDataSource Class @2-FCB6E20C

//Initialize Page @1-FE836378
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
$TemplateFileName = "SetScheduleDetail.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
//End Initialize Page

//Include events file @1-3A4B7C94
include_once("./SetScheduleDetail_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-B753F5FE
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$agenda = & new clsGridagenda("", $MainPage);
$respuesta = & new clsControl(ccsLabel, "respuesta", "respuesta", ccsText, "", CCGetRequestParam("respuesta", ccsGet, NULL), $MainPage);
$idr = & new clsControl(ccsLabel, "idr", "idr", ccsText, "", CCGetRequestParam("idr", ccsGet, NULL), $MainPage);
$descripcion = & new clsControl(ccsLabel, "descripcion", "descripcion", ccsText, "", CCGetRequestParam("descripcion", ccsGet, NULL), $MainPage);
$MainPage->agenda = & $agenda;
$MainPage->respuesta = & $respuesta;
$MainPage->idr = & $idr;
$MainPage->descripcion = & $descripcion;
$agenda->Initialize();

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

//Go to destination page @1-4A6298CD
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    unset($agenda);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-973A4BA7
$agenda->Show();
$respuesta->Show();
$idr->Show();
$descripcion->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-E5292BE6
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
unset($agenda);
unset($Tpl);
//End Unload Page


?>
