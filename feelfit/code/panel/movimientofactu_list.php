<?php
//Include Common Files @1-2B82E6B3
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "movimientofactu_list.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridmovimientofacturacion { //movimientofacturacion class @2-A75BD0E2

//Variables @2-20372A0E

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
    var $Sorter_tipomov;
    var $Sorter_mes;
    var $Sorter_anio;
    var $Sorter_importe;
    var $Sorter_idAlumno;
    var $Sorter_idTurno;
    var $Sorter_idInstructor;
//End Variables

//Class_Initialize Event @2-804EED72
    function clsGridmovimientofacturacion($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "movimientofacturacion";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid movimientofacturacion";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsmovimientofacturacionDataSource($this);
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
        $this->SorterName = CCGetParam("movimientofacturacionOrder", "");
        $this->SorterDirection = CCGetParam("movimientofacturacionDir", "");

        $this->id = & new clsControl(ccsLink, "id", "id", ccsInteger, "", CCGetRequestParam("id", ccsGet, NULL), $this);
        $this->id->Page = "movimientofactu_maint.php";
        $this->tipomov = & new clsControl(ccsLabel, "tipomov", "tipomov", ccsText, "", CCGetRequestParam("tipomov", ccsGet, NULL), $this);
        $this->mes = & new clsControl(ccsLabel, "mes", "mes", ccsInteger, "", CCGetRequestParam("mes", ccsGet, NULL), $this);
        $this->anio = & new clsControl(ccsLabel, "anio", "anio", ccsInteger, "", CCGetRequestParam("anio", ccsGet, NULL), $this);
        $this->importe = & new clsControl(ccsLabel, "importe", "importe", ccsText, "", CCGetRequestParam("importe", ccsGet, NULL), $this);
        $this->idAlumno = & new clsControl(ccsLabel, "idAlumno", "idAlumno", ccsInteger, "", CCGetRequestParam("idAlumno", ccsGet, NULL), $this);
        $this->idTurno = & new clsControl(ccsLabel, "idTurno", "idTurno", ccsInteger, "", CCGetRequestParam("idTurno", ccsGet, NULL), $this);
        $this->idInstructor = & new clsControl(ccsLabel, "idInstructor", "idInstructor", ccsInteger, "", CCGetRequestParam("idInstructor", ccsGet, NULL), $this);
        $this->movimientofacturacion_Insert = & new clsControl(ccsLink, "movimientofacturacion_Insert", "movimientofacturacion_Insert", ccsText, "", CCGetRequestParam("movimientofacturacion_Insert", ccsGet, NULL), $this);
        $this->movimientofacturacion_Insert->Parameters = CCGetQueryString("QueryString", array("id", "ccsForm"));
        $this->movimientofacturacion_Insert->Page = "movimientofactu_maint.php";
        $this->Sorter_id = & new clsSorter($this->ComponentName, "Sorter_id", $FileName, $this);
        $this->Sorter_tipomov = & new clsSorter($this->ComponentName, "Sorter_tipomov", $FileName, $this);
        $this->Sorter_mes = & new clsSorter($this->ComponentName, "Sorter_mes", $FileName, $this);
        $this->Sorter_anio = & new clsSorter($this->ComponentName, "Sorter_anio", $FileName, $this);
        $this->Sorter_importe = & new clsSorter($this->ComponentName, "Sorter_importe", $FileName, $this);
        $this->Sorter_idAlumno = & new clsSorter($this->ComponentName, "Sorter_idAlumno", $FileName, $this);
        $this->Sorter_idTurno = & new clsSorter($this->ComponentName, "Sorter_idTurno", $FileName, $this);
        $this->Sorter_idInstructor = & new clsSorter($this->ComponentName, "Sorter_idInstructor", $FileName, $this);
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

//Show Method @2-8E9136A0
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
            $this->ControlsVisible["id"] = $this->id->Visible;
            $this->ControlsVisible["tipomov"] = $this->tipomov->Visible;
            $this->ControlsVisible["mes"] = $this->mes->Visible;
            $this->ControlsVisible["anio"] = $this->anio->Visible;
            $this->ControlsVisible["importe"] = $this->importe->Visible;
            $this->ControlsVisible["idAlumno"] = $this->idAlumno->Visible;
            $this->ControlsVisible["idTurno"] = $this->idTurno->Visible;
            $this->ControlsVisible["idInstructor"] = $this->idInstructor->Visible;
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
                $this->tipomov->SetValue($this->DataSource->tipomov->GetValue());
                $this->mes->SetValue($this->DataSource->mes->GetValue());
                $this->anio->SetValue($this->DataSource->anio->GetValue());
                $this->importe->SetValue($this->DataSource->importe->GetValue());
                $this->idAlumno->SetValue($this->DataSource->idAlumno->GetValue());
                $this->idTurno->SetValue($this->DataSource->idTurno->GetValue());
                $this->idInstructor->SetValue($this->DataSource->idInstructor->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->id->Show();
                $this->tipomov->Show();
                $this->mes->Show();
                $this->anio->Show();
                $this->importe->Show();
                $this->idAlumno->Show();
                $this->idTurno->Show();
                $this->idInstructor->Show();
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
        $this->movimientofacturacion_Insert->Show();
        $this->Sorter_id->Show();
        $this->Sorter_tipomov->Show();
        $this->Sorter_mes->Show();
        $this->Sorter_anio->Show();
        $this->Sorter_importe->Show();
        $this->Sorter_idAlumno->Show();
        $this->Sorter_idTurno->Show();
        $this->Sorter_idInstructor->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-F535882B
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tipomov->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mes->Errors->ToString());
        $errors = ComposeStrings($errors, $this->anio->Errors->ToString());
        $errors = ComposeStrings($errors, $this->importe->Errors->ToString());
        $errors = ComposeStrings($errors, $this->idAlumno->Errors->ToString());
        $errors = ComposeStrings($errors, $this->idTurno->Errors->ToString());
        $errors = ComposeStrings($errors, $this->idInstructor->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End movimientofacturacion Class @2-FCB6E20C

class clsmovimientofacturacionDataSource extends clsDBConnection1 {  //movimientofacturacionDataSource Class @2-BBC2364E

//DataSource Variables @2-D579A696
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $id;
    var $tipomov;
    var $mes;
    var $anio;
    var $importe;
    var $idAlumno;
    var $idTurno;
    var $idInstructor;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-199B7C81
    function clsmovimientofacturacionDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid movimientofacturacion";
        $this->Initialize();
        $this->id = new clsField("id", ccsInteger, "");
        
        $this->tipomov = new clsField("tipomov", ccsText, "");
        
        $this->mes = new clsField("mes", ccsInteger, "");
        
        $this->anio = new clsField("anio", ccsInteger, "");
        
        $this->importe = new clsField("importe", ccsText, "");
        
        $this->idAlumno = new clsField("idAlumno", ccsInteger, "");
        
        $this->idTurno = new clsField("idTurno", ccsInteger, "");
        
        $this->idInstructor = new clsField("idInstructor", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-0318733F
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_id" => array("id", ""), 
            "Sorter_tipomov" => array("tipomov", ""), 
            "Sorter_mes" => array("mes", ""), 
            "Sorter_anio" => array("anio", ""), 
            "Sorter_importe" => array("importe", ""), 
            "Sorter_idAlumno" => array("idAlumno", ""), 
            "Sorter_idTurno" => array("idTurno", ""), 
            "Sorter_idInstructor" => array("idInstructor", "")));
    }
//End SetOrder Method

//Prepare Method @2-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @2-27C6F6F2
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM movimientofacturacion";
        $this->SQL = "SELECT id, tipomov, mes, anio, importe, idAlumno, idTurno, idInstructor \n\n" .
        "FROM movimientofacturacion {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-74256F19
    function SetValues()
    {
        $this->id->SetDBValue(trim($this->f("id")));
        $this->tipomov->SetDBValue($this->f("tipomov"));
        $this->mes->SetDBValue(trim($this->f("mes")));
        $this->anio->SetDBValue(trim($this->f("anio")));
        $this->importe->SetDBValue($this->f("importe"));
        $this->idAlumno->SetDBValue(trim($this->f("idAlumno")));
        $this->idTurno->SetDBValue(trim($this->f("idTurno")));
        $this->idInstructor->SetDBValue(trim($this->f("idInstructor")));
    }
//End SetValues Method

} //End movimientofacturacionDataSource Class @2-FCB6E20C

//Initialize Page @1-B2CAA447
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
$TemplateFileName = "movimientofactu_list.html";
$BlockToParse = "main";
$TemplateEncoding = "UTF-8";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "utf-8";
//End Initialize Page

//Include events file @1-BD6E0154
include_once("./movimientofactu_list_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-D245906D
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$movimientofacturacion = & new clsGridmovimientofacturacion("", $MainPage);
$MainPage->movimientofacturacion = & $movimientofacturacion;
$movimientofacturacion->Initialize();

BindEvents();

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize", $MainPage);

if ($Charset) {
    header("Content-Type: " . $ContentType . "; charset=" . $Charset);
} else {
    header("Content-Type: " . $ContentType);
}
//End Initialize Objects

//Initialize HTML Template @1-5C9A11E6
$CCSEventResult = CCGetEvent($CCSEvents, "OnInitializeView", $MainPage);
$Tpl = new clsTemplate();
$Tpl->LoadTemplate(PathToCurrentPage . $TemplateFileName, $BlockToParse, "UTF-8");
$Tpl->block_path = "/$BlockToParse";
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeShow", $MainPage);
$Attributes->SetValue("pathToRoot", "");
$Attributes->Show();
//End Initialize HTML Template

//Go to destination page @1-8C799D62
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    unset($movimientofacturacion);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-FA1B373F
$movimientofacturacion->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-BE8B977F
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
unset($movimientofacturacion);
unset($Tpl);
//End Unload Page


?>
