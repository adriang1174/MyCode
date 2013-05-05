<?php
//Include Common Files @1-722DE272
define("RelativePath", "..");
define("PathToCurrentPage", "/services/");
define("FileName", "getScheduleDetail.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridSELECT_alumno_nombre_hora { //SELECT_alumno_nombre_hora class @2-4869DB50

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

//Class_Initialize Event @2-10F5D9CF
    function clsGridSELECT_alumno_nombre_hora($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "SELECT_alumno_nombre_hora";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid SELECT_alumno_nombre_hora";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsSELECT_alumno_nombre_horaDataSource($this);
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
        $this->nombre = & new clsControl(ccsLabel, "nombre", "nombre", ccsMemo, "", CCGetRequestParam("nombre", ccsGet, NULL), $this);
        $this->horario = & new clsControl(ccsLabel, "horario", "horario", ccsText, "", CCGetRequestParam("horario", ccsGet, NULL), $this);
        $this->descripcion1 = & new clsControl(ccsLabel, "descripcion1", "descripcion1", ccsMemo, "", CCGetRequestParam("descripcion1", ccsGet, NULL), $this);
        $this->instructor1 = & new clsControl(ccsLabel, "instructor1", "instructor1", ccsMemo, "", CCGetRequestParam("instructor1", ccsGet, NULL), $this);
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

//Show Method @2-E2525918
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlf"] = CCGetFromGet("f", NULL);
        $this->DataSource->Parameters["urlh"] = CCGetFromGet("h", NULL);

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
            $this->ControlsVisible["horario"] = $this->horario->Visible;
            $this->ControlsVisible["descripcion1"] = $this->descripcion1->Visible;
            $this->ControlsVisible["instructor1"] = $this->instructor1->Visible;
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
                $this->horario->SetValue($this->DataSource->horario->GetValue());
                $this->descripcion1->SetValue($this->DataSource->descripcion1->GetValue());
                $this->instructor1->SetValue($this->DataSource->instructor1->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->id->Show();
                $this->nombre->Show();
                $this->horario->Show();
                $this->descripcion1->Show();
                $this->instructor1->Show();
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

//GetErrors Method @2-3BE5351F
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nombre->Errors->ToString());
        $errors = ComposeStrings($errors, $this->horario->Errors->ToString());
        $errors = ComposeStrings($errors, $this->descripcion1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->instructor1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End SELECT_alumno_nombre_hora Class @2-FCB6E20C

class clsSELECT_alumno_nombre_horaDataSource extends clsDBConnection1 {  //SELECT_alumno_nombre_horaDataSource Class @2-B832C555

//DataSource Variables @2-8CFD0EAC
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
    var $horario;
    var $descripcion1;
    var $instructor1;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-8A74B204
    function clsSELECT_alumno_nombre_horaDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid SELECT_alumno_nombre_hora";
        $this->Initialize();
        $this->id = new clsField("id", ccsInteger, "");
        
        $this->nombre = new clsField("nombre", ccsMemo, "");
        
        $this->horario = new clsField("horario", ccsText, "");
        
        $this->descripcion1 = new clsField("descripcion1", ccsMemo, "");
        
        $this->instructor1 = new clsField("instructor1", ccsMemo, "");
        

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

//Prepare Method @2-43BA696F
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlf", ccsText, "", "", $this->Parameters["urlf"], "", false);
        $this->wp->AddParameter("2", "urlh", ccsText, "", "", $this->Parameters["urlh"], "", false);
    }
//End Prepare Method

//Open Method @2-69D6A9A0
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM agenda\n" .
        "LEFT JOIN alumno ON ( agenda.idAlumno = alumno.id ) \n" .
        "LEFT JOIN equipamiento ON ( agenda.idEquipamiento = equipamiento.id ) \n" .
        "WHERE (\n" .
        "substring( rangodias, DAYOFWEEK( '" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "' ) , 1 ) = '1'\n" .
        "OR fechaespec = '" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "'\n" .
        ")\n" .
        "AND horaini = '" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "'";
        $this->SQL = "SELECT agenda.id,alumno.nombre, \n" .
        "CASE WHEN mediahora = '1'\n" .
        "THEN concat( horaini, ' - ', concat( substr( horaini, 1, 2 ) , ':30' ) ) \n" .
        "ELSE concat( concat( substr( horaini, 1, 2 ) , ':30' ) , ' - ', horafin ) \n" .
        "END as horario\n" .
        ", equipamiento.descripcion, 'aa' as instructor\n" .
        "FROM agenda\n" .
        "LEFT JOIN alumno ON ( agenda.idAlumno = alumno.id ) \n" .
        "LEFT JOIN equipamiento ON ( agenda.idEquipamiento = equipamiento.id ) \n" .
        "WHERE (\n" .
        "substring( rangodias, DAYOFWEEK( '" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "' ) , 1 ) = '1'\n" .
        "OR fechaespec = '" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "'\n" .
        ")\n" .
        "AND horaini = '" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "'";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-20E7CF4C
    function SetValues()
    {
        $this->id->SetDBValue(trim($this->f("id")));
        $this->nombre->SetDBValue($this->f("nombre"));
        $this->horario->SetDBValue($this->f("horario"));
        $this->descripcion1->SetDBValue($this->f("descripcion"));
        $this->instructor1->SetDBValue($this->f("instructor"));
    }
//End SetValues Method

} //End SELECT_alumno_nombre_horaDataSource Class @2-FCB6E20C

//Initialize Page @1-CC35C8C6
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
$TemplateFileName = "getScheduleDetail.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-BB35F57E
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$SELECT_alumno_nombre_hora = & new clsGridSELECT_alumno_nombre_hora("", $MainPage);
$MainPage->SELECT_alumno_nombre_hora = & $SELECT_alumno_nombre_hora;
$SELECT_alumno_nombre_hora->Initialize();

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

//Go to destination page @1-F360E166
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    unset($SELECT_alumno_nombre_hora);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-97929400
$SELECT_alumno_nombre_hora->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-9707415C
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
unset($SELECT_alumno_nombre_hora);
unset($Tpl);
//End Unload Page


?>
