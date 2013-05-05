<?php
//Include Common Files @1-2216263C
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "cuotas_pagadas.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//movimientofacturacion ReportGroup class @2-CB20D6E5
class clsReportGroupmovimientofacturacion {
    var $GroupType;
    var $mode; //1 - open, 2 - close
    var $instructor, $_instructorAttributes;
    var $mes, $_mesAttributes;
    var $anio, $_anioAttributes;
    var $importe, $_importeAttributes;
    var $alumno, $_alumnoAttributes;
    var $idTurno, $_idTurnoAttributes;
    var $Link1, $_Link1Page, $_Link1Parameters, $_Link1Attributes;
    var $id, $_idAttributes;
    var $Sum_importe, $_Sum_importeAttributes;
    var $TotalSum_importe, $_TotalSum_importeAttributes;
    var $Attributes;
    var $ReportTotalIndex = 0;
    var $PageTotalIndex;
    var $PageNumber;
    var $RowNumber;
    var $Parent;
    var $idInstructorTotalIndex;

    function clsReportGroupmovimientofacturacion(& $parent) {
        $this->Parent = & $parent;
        $this->Attributes = $this->Parent->Attributes->GetAsArray();
    }
    function SetControls($PrevGroup = "") {
        $this->instructor = $this->Parent->instructor->Value;
        $this->mes = $this->Parent->mes->Value;
        $this->anio = $this->Parent->anio->Value;
        $this->importe = $this->Parent->importe->Value;
        $this->alumno = $this->Parent->alumno->Value;
        $this->idTurno = $this->Parent->idTurno->Value;
        $this->Link1 = $this->Parent->Link1->Value;
        $this->id = $this->Parent->id->Value;
    }

    function SetTotalControls($mode = "", $PrevGroup = "") {
        $this->Sum_importe = $this->Parent->Sum_importe->GetTotalValue($mode);
        $this->TotalSum_importe = $this->Parent->TotalSum_importe->GetTotalValue($mode);
        $this->_Link1Page = $this->Parent->Link1->Page;
        $this->_Link1Parameters = $this->Parent->Link1->Parameters;
        $this->_instructorAttributes = $this->Parent->instructor->Attributes->GetAsArray();
        $this->_mesAttributes = $this->Parent->mes->Attributes->GetAsArray();
        $this->_anioAttributes = $this->Parent->anio->Attributes->GetAsArray();
        $this->_importeAttributes = $this->Parent->importe->Attributes->GetAsArray();
        $this->_alumnoAttributes = $this->Parent->alumno->Attributes->GetAsArray();
        $this->_idTurnoAttributes = $this->Parent->idTurno->Attributes->GetAsArray();
        $this->_Link1Attributes = $this->Parent->Link1->Attributes->GetAsArray();
        $this->_idAttributes = $this->Parent->id->Attributes->GetAsArray();
        $this->_Sum_importeAttributes = $this->Parent->Sum_importe->Attributes->GetAsArray();
        $this->_TotalSum_importeAttributes = $this->Parent->TotalSum_importe->Attributes->GetAsArray();
        $this->_NavigatorAttributes = $this->Parent->Navigator->Attributes->GetAsArray();
    }
    function SyncWithHeader(& $Header) {
        $Header->Sum_importe = $this->Sum_importe;
        $Header->_Sum_importeAttributes = $this->_Sum_importeAttributes;
        $Header->TotalSum_importe = $this->TotalSum_importe;
        $Header->_TotalSum_importeAttributes = $this->_TotalSum_importeAttributes;
        $this->instructor = $Header->instructor;
        $Header->_instructorAttributes = $this->_instructorAttributes;
        $this->Parent->instructor->Value = $Header->instructor;
        $this->Parent->instructor->Attributes->RestoreFromArray($Header->_instructorAttributes);
        $this->mes = $Header->mes;
        $Header->_mesAttributes = $this->_mesAttributes;
        $this->Parent->mes->Value = $Header->mes;
        $this->Parent->mes->Attributes->RestoreFromArray($Header->_mesAttributes);
        $this->anio = $Header->anio;
        $Header->_anioAttributes = $this->_anioAttributes;
        $this->Parent->anio->Value = $Header->anio;
        $this->Parent->anio->Attributes->RestoreFromArray($Header->_anioAttributes);
        $this->importe = $Header->importe;
        $Header->_importeAttributes = $this->_importeAttributes;
        $this->Parent->importe->Value = $Header->importe;
        $this->Parent->importe->Attributes->RestoreFromArray($Header->_importeAttributes);
        $this->alumno = $Header->alumno;
        $Header->_alumnoAttributes = $this->_alumnoAttributes;
        $this->Parent->alumno->Value = $Header->alumno;
        $this->Parent->alumno->Attributes->RestoreFromArray($Header->_alumnoAttributes);
        $this->idTurno = $Header->idTurno;
        $Header->_idTurnoAttributes = $this->_idTurnoAttributes;
        $this->Parent->idTurno->Value = $Header->idTurno;
        $this->Parent->idTurno->Attributes->RestoreFromArray($Header->_idTurnoAttributes);
        $this->Link1 = $Header->Link1;
        $this->_Link1Page = $Header->_Link1Page;
        $this->_Link1Parameters = $Header->_Link1Parameters;
        $Header->_Link1Attributes = $this->_Link1Attributes;
        $this->Parent->Link1->Value = $Header->Link1;
        $this->Parent->Link1->Attributes->RestoreFromArray($Header->_Link1Attributes);
        $this->id = $Header->id;
        $Header->_idAttributes = $this->_idAttributes;
        $this->Parent->id->Value = $Header->id;
        $this->Parent->id->Attributes->RestoreFromArray($Header->_idAttributes);
    }
    function ChangeTotalControls() {
        $this->Sum_importe = $this->Parent->Sum_importe->GetValue();
        $this->TotalSum_importe = $this->Parent->TotalSum_importe->GetValue();
    }
}
//End movimientofacturacion ReportGroup class

//movimientofacturacion GroupsCollection class @2-D0629755
class clsGroupsCollectionmovimientofacturacion {
    var $Groups;
    var $mPageCurrentHeaderIndex;
    var $midInstructorCurrentHeaderIndex;
    var $PageSize;
    var $TotalPages = 0;
    var $TotalRows = 0;
    var $CurrentPageSize = 0;
    var $Pages;
    var $Parent;
    var $LastDetailIndex;

    function clsGroupsCollectionmovimientofacturacion(& $parent) {
        $this->Parent = & $parent;
        $this->Groups = array();
        $this->Pages  = array();
        $this->midInstructorCurrentHeaderIndex = 1;
        $this->mReportTotalIndex = 0;
        $this->mPageTotalIndex = 1;
    }

    function & InitGroup() {
        $group = new clsReportGroupmovimientofacturacion($this->Parent);
        $group->RowNumber = $this->TotalRows + 1;
        $group->PageNumber = $this->TotalPages;
        $group->PageTotalIndex = $this->mPageCurrentHeaderIndex;
        $group->idInstructorTotalIndex = $this->midInstructorCurrentHeaderIndex;
        return $group;
    }

    function RestoreValues() {
        $this->Parent->instructor->Value = $this->Parent->instructor->initialValue;
        $this->Parent->mes->Value = $this->Parent->mes->initialValue;
        $this->Parent->anio->Value = $this->Parent->anio->initialValue;
        $this->Parent->importe->Value = $this->Parent->importe->initialValue;
        $this->Parent->alumno->Value = $this->Parent->alumno->initialValue;
        $this->Parent->idTurno->Value = $this->Parent->idTurno->initialValue;
        $this->Parent->Link1->Value = $this->Parent->Link1->initialValue;
        $this->Parent->id->Value = $this->Parent->id->initialValue;
        $this->Parent->Sum_importe->Value = $this->Parent->Sum_importe->initialValue;
        $this->Parent->TotalSum_importe->Value = $this->Parent->TotalSum_importe->initialValue;
    }

    function OpenPage() {
        $this->TotalPages++;
        $Group = & $this->InitGroup();
        $this->Parent->Page_Header->CCSEventResult = CCGetEvent($this->Parent->Page_Header->CCSEvents, "OnInitialize", $this->Parent->Page_Header);
        if ($this->Parent->Page_Header->Visible)
            $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->Page_Header->Height;
        $Group->SetTotalControls("GetNextValue");
        $this->Parent->Page_Header->CCSEventResult = CCGetEvent($this->Parent->Page_Header->CCSEvents, "OnCalculate", $this->Parent->Page_Header);
        $Group->SetControls();
        $Group->Mode = 1;
        $Group->GroupType = "Page";
        $Group->PageTotalIndex = count($this->Groups);
        $this->mPageCurrentHeaderIndex = count($this->Groups);
        $this->Groups[] =  & $Group;
        $this->Pages[] =  count($this->Groups) == 2 ? 0 : count($this->Groups) - 1;
    }

    function OpenGroup($groupName) {
        $Group = "";
        $OpenFlag = false;
        if ($groupName == "Report") {
            $Group = & $this->InitGroup(true);
            $this->Parent->Report_Header->CCSEventResult = CCGetEvent($this->Parent->Report_Header->CCSEvents, "OnInitialize", $this->Parent->Report_Header);
            if ($this->Parent->Report_Header->Visible) 
                $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->Report_Header->Height;
                $Group->SetTotalControls("GetNextValue");
            $this->Parent->Report_Header->CCSEventResult = CCGetEvent($this->Parent->Report_Header->CCSEvents, "OnCalculate", $this->Parent->Report_Header);
            $Group->SetControls();
            $Group->Mode = 1;
            $Group->GroupType = "Report";
            $this->Groups[] = & $Group;
            $this->OpenPage();
        }
        if ($groupName == "idInstructor") {
            $GroupidInstructor = & $this->InitGroup(true);
            $this->Parent->idInstructor_Header->CCSEventResult = CCGetEvent($this->Parent->idInstructor_Header->CCSEvents, "OnInitialize", $this->Parent->idInstructor_Header);
            if ($this->Parent->Page_Footer->Visible) 
                $OverSize = $this->Parent->idInstructor_Header->Height + $this->Parent->Page_Footer->Height;
            else
                $OverSize = $this->Parent->idInstructor_Header->Height;
            if (($this->PageSize > 0) and $this->Parent->idInstructor_Header->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
                $this->ClosePage();
                $this->OpenPage();
            }
            if ($this->Parent->idInstructor_Header->Visible)
                $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->idInstructor_Header->Height;
                $GroupidInstructor->SetTotalControls("GetNextValue");
            $this->Parent->idInstructor_Header->CCSEventResult = CCGetEvent($this->Parent->idInstructor_Header->CCSEvents, "OnCalculate", $this->Parent->idInstructor_Header);
            $GroupidInstructor->SetControls();
            $GroupidInstructor->Mode = 1;
            $GroupidInstructor->GroupType = "idInstructor";
            $this->midInstructorCurrentHeaderIndex = count($this->Groups);
            $this->Groups[] = & $GroupidInstructor;
            $this->Parent->Sum_importe->Reset();
        }
    }

    function ClosePage() {
        $Group = & $this->InitGroup();
        $this->Parent->Page_Footer->CCSEventResult = CCGetEvent($this->Parent->Page_Footer->CCSEvents, "OnInitialize", $this->Parent->Page_Footer);
        $Group->SetTotalControls("GetPrevValue");
        $Group->SyncWithHeader($this->Groups[$this->mPageCurrentHeaderIndex]);
        $this->Parent->Page_Footer->CCSEventResult = CCGetEvent($this->Parent->Page_Footer->CCSEvents, "OnCalculate", $this->Parent->Page_Footer);
        $Group->SetControls();
        $this->RestoreValues();
        $this->CurrentPageSize = 0;
        $Group->Mode = 2;
        $Group->GroupType = "Page";
        $this->Groups[] = & $Group;
    }

    function CloseGroup($groupName)
    {
        $Group = "";
        if ($groupName == "Report") {
            $Group = & $this->InitGroup(true);
            $this->Parent->Report_Footer->CCSEventResult = CCGetEvent($this->Parent->Report_Footer->CCSEvents, "OnInitialize", $this->Parent->Report_Footer);
            if ($this->Parent->Page_Footer->Visible) 
                $OverSize = $this->Parent->Report_Footer->Height + $this->Parent->Page_Footer->Height;
            else
                $OverSize = $this->Parent->Report_Footer->Height;
            if (($this->PageSize > 0) and $this->Parent->Report_Footer->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
                $this->ClosePage();
                $this->OpenPage();
            }
            $Group->SetTotalControls("GetPrevValue");
            $Group->SyncWithHeader($this->Groups[0]);
            if ($this->Parent->Report_Footer->Visible)
                $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->Report_Footer->Height;
            $this->Parent->Report_Footer->CCSEventResult = CCGetEvent($this->Parent->Report_Footer->CCSEvents, "OnCalculate", $this->Parent->Report_Footer);
            $Group->SetControls();
            $this->RestoreValues();
            $Group->Mode = 2;
            $Group->GroupType = "Report";
            $this->Groups[] = & $Group;
            $this->ClosePage();
            return;
        }
        $GroupidInstructor = & $this->InitGroup(true);
        $this->Parent->idInstructor_Footer->CCSEventResult = CCGetEvent($this->Parent->idInstructor_Footer->CCSEvents, "OnInitialize", $this->Parent->idInstructor_Footer);
        if ($this->Parent->Page_Footer->Visible) 
            $OverSize = $this->Parent->idInstructor_Footer->Height + $this->Parent->Page_Footer->Height;
        else
            $OverSize = $this->Parent->idInstructor_Footer->Height;
        if (($this->PageSize > 0) and $this->Parent->idInstructor_Footer->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
            $this->ClosePage();
            $this->OpenPage();
        }
        $GroupidInstructor->SetTotalControls("GetPrevValue");
        $GroupidInstructor->SyncWithHeader($this->Groups[$this->midInstructorCurrentHeaderIndex]);
        if ($this->Parent->idInstructor_Footer->Visible)
            $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->idInstructor_Footer->Height;
        $this->Parent->idInstructor_Footer->CCSEventResult = CCGetEvent($this->Parent->idInstructor_Footer->CCSEvents, "OnCalculate", $this->Parent->idInstructor_Footer);
        $GroupidInstructor->SetControls();
        $this->Parent->Sum_importe->Reset();
        $this->RestoreValues();
        $GroupidInstructor->Mode = 2;
        $GroupidInstructor->GroupType ="idInstructor";
        $this->Groups[] = & $GroupidInstructor;
    }

    function AddItem()
    {
        $Group = & $this->InitGroup(true);
        $this->Parent->Detail->CCSEventResult = CCGetEvent($this->Parent->Detail->CCSEvents, "OnInitialize", $this->Parent->Detail);
        if ($this->Parent->Page_Footer->Visible) 
            $OverSize = $this->Parent->Detail->Height + $this->Parent->Page_Footer->Height;
        else
            $OverSize = $this->Parent->Detail->Height;
        if (($this->PageSize > 0) and $this->Parent->Detail->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
            $this->ClosePage();
            $this->OpenPage();
        }
        $this->TotalRows++;
        if ($this->LastDetailIndex)
            $PrevGroup = & $this->Groups[$this->LastDetailIndex];
        else
            $PrevGroup = "";
        $Group->SetTotalControls("", $PrevGroup);
        if ($this->Parent->Detail->Visible)
            $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->Detail->Height;
        $this->Parent->Detail->CCSEventResult = CCGetEvent($this->Parent->Detail->CCSEvents, "OnCalculate", $this->Parent->Detail);
        $Group->SetControls($PrevGroup);
        $this->LastDetailIndex = count($this->Groups);
        $this->Groups[] = & $Group;
    }
}
//End movimientofacturacion GroupsCollection class

class clsReportmovimientofacturacion { //movimientofacturacion Class @2-D30495D8

//movimientofacturacion Variables @2-A598745C

    var $ComponentType = "Report";
    var $PageSize;
    var $ComponentName;
    var $Visible;
    var $Errors;
    var $CCSEvents = array();
    var $CCSEventResult;
    var $RelativePath = "";
    var $ViewMode = "Web";
    var $TemplateBlock;
    var $PageNumber;
    var $RowNumber;
    var $TotalRows;
    var $TotalPages;
    var $ControlsVisible = array();
    var $IsEmpty;
    var $Attributes;
    var $DetailBlock, $Detail;
    var $Report_FooterBlock, $Report_Footer;
    var $Report_HeaderBlock, $Report_Header;
    var $Page_FooterBlock, $Page_Footer;
    var $Page_HeaderBlock, $Page_Header;
    var $idInstructor_HeaderBlock, $idInstructor_Header;
    var $idInstructor_FooterBlock, $idInstructor_Footer;
    var $SorterName, $SorterDirection;

    var $ds;
    var $DataSource;
    var $UseClientPaging = false;

    //Report Controls
    var $StaticControls, $RowControls, $Report_FooterControls, $Report_HeaderControls;
    var $Page_FooterControls, $Page_HeaderControls;
    var $idInstructor_HeaderControls, $idInstructor_FooterControls;
//End movimientofacturacion Variables

//Class_Initialize Event @2-1AEE66A1
    function clsReportmovimientofacturacion($RelativePath = "", & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "movimientofacturacion";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->Detail = new clsSection($this);
        $MinPageSize = 0;
        $MaxSectionSize = 0;
        $this->Detail->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->Detail->Height);
        $this->Report_Footer = new clsSection($this);
        $this->Report_Footer->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->Report_Footer->Height);
        $this->Report_Header = new clsSection($this);
        $this->Page_Footer = new clsSection($this);
        $this->Page_Footer->Height = 1;
        $MinPageSize += $this->Page_Footer->Height;
        $this->Page_Header = new clsSection($this);
        $this->Page_Header->Height = 1;
        $MinPageSize += $this->Page_Header->Height;
        $this->idInstructor_Footer = new clsSection($this);
        $this->idInstructor_Footer->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->idInstructor_Footer->Height);
        $this->idInstructor_Header = new clsSection($this);
        $this->idInstructor_Header->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->idInstructor_Header->Height);
        $this->Errors = new clsErrors();
        $this->DataSource = new clsmovimientofacturacionDataSource($this);
        $this->ds = & $this->DataSource;
        $PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(is_numeric($PageSize) && $PageSize > 0) {
            $this->PageSize = $PageSize;
        } else {
            if (!is_numeric($PageSize) || $PageSize < 0)
                $this->PageSize = 40;
             else if ($PageSize == "0")
                $this->PageSize = 100;
             else 
                $this->PageSize = min(100, $PageSize);
        }
        $MinPageSize += $MaxSectionSize;
        if ($this->PageSize && $MinPageSize && $this->PageSize < $MinPageSize)
            $this->PageSize = $MinPageSize;
        $this->PageNumber = $this->ViewMode == "Print" ? 1 : intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0 ) {
            $this->PageNumber = 1;
        }

        $this->instructor = & new clsControl(ccsReportLabel, "instructor", "instructor", ccsText, "", "", $this);
        $this->mes = & new clsControl(ccsReportLabel, "mes", "mes", ccsInteger, "", "", $this);
        $this->anio = & new clsControl(ccsReportLabel, "anio", "anio", ccsInteger, "", "", $this);
        $this->importe = & new clsControl(ccsReportLabel, "importe", "importe", ccsInteger, "", "", $this);
        $this->alumno = & new clsControl(ccsReportLabel, "alumno", "alumno", ccsText, "", "", $this);
        $this->idTurno = & new clsControl(ccsReportLabel, "idTurno", "idTurno", ccsText, "", "", $this);
        $this->Link1 = & new clsControl(ccsLink, "Link1", "Link1", ccsText, "", CCGetRequestParam("Link1", ccsGet, NULL), $this);
        $this->Link1->Page = "movimientofactu_maint.php";
        $this->id = & new clsControl(ccsHidden, "id", "id", ccsInteger, "", CCGetRequestParam("id", ccsGet, NULL), $this);
        $this->Sum_importe = & new clsControl(ccsReportLabel, "Sum_importe", "Sum_importe", ccsInteger, "", "", $this);
        $this->Sum_importe->TotalFunction = "Sum";
        $this->NoRecords = & new clsPanel("NoRecords", $this);
        $this->TotalSum_importe = & new clsControl(ccsReportLabel, "TotalSum_importe", "TotalSum_importe", ccsInteger, "", "", $this);
        $this->TotalSum_importe->TotalFunction = "Sum";
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @2-6C59EE65
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = $this->PageSize;
        $this->DataSource->AbsolutePage = $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//CheckErrors Method @2-2B08E72B
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->instructor->Errors->Count());
        $errors = ($errors || $this->mes->Errors->Count());
        $errors = ($errors || $this->anio->Errors->Count());
        $errors = ($errors || $this->importe->Errors->Count());
        $errors = ($errors || $this->alumno->Errors->Count());
        $errors = ($errors || $this->idTurno->Errors->Count());
        $errors = ($errors || $this->Link1->Errors->Count());
        $errors = ($errors || $this->id->Errors->Count());
        $errors = ($errors || $this->Sum_importe->Errors->Count());
        $errors = ($errors || $this->TotalSum_importe->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//GetErrors Method @2-5F5AFD09
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->instructor->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mes->Errors->ToString());
        $errors = ComposeStrings($errors, $this->anio->Errors->ToString());
        $errors = ComposeStrings($errors, $this->importe->Errors->ToString());
        $errors = ComposeStrings($errors, $this->alumno->Errors->ToString());
        $errors = ComposeStrings($errors, $this->idTurno->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Link1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Sum_importe->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TotalSum_importe->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

//Show Method @2-EC896780
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $ShownRecords = 0;

        $this->DataSource->Parameters["urls_idAlumno"] = CCGetFromGet("s_idAlumno", NULL);
        $this->DataSource->Parameters["urls_anio"] = CCGetFromGet("s_anio", NULL);
        $this->DataSource->Parameters["urls_mes"] = CCGetFromGet("s_mes", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();

        $idInstructorKey = "";
        $Groups = new clsGroupsCollectionmovimientofacturacion($this);
        $Groups->PageSize = $this->PageSize > 0 ? $this->PageSize : 0;

        $is_next_record = $this->DataSource->next_record();
        $this->IsEmpty = ! $is_next_record;
        while($is_next_record) {
            $this->DataSource->SetValues();
            $this->instructor->SetValue($this->DataSource->instructor->GetValue());
            $this->mes->SetValue($this->DataSource->mes->GetValue());
            $this->anio->SetValue($this->DataSource->anio->GetValue());
            $this->importe->SetValue($this->DataSource->importe->GetValue());
            $this->alumno->SetValue($this->DataSource->alumno->GetValue());
            $this->idTurno->SetValue($this->DataSource->idTurno->GetValue());
            $this->id->SetValue($this->DataSource->id->GetValue());
            $this->Sum_importe->SetValue($this->DataSource->Sum_importe->GetValue());
            $this->TotalSum_importe->SetValue($this->DataSource->TotalSum_importe->GetValue());
            $this->Link1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->Link1->Parameters = CCAddParam($this->Link1->Parameters, "id", $this->DataSource->f("id"));
            if (count($Groups->Groups) == 0) $Groups->OpenGroup("Report");
            if (count($Groups->Groups) == 2 or $idInstructorKey != $this->DataSource->f("idInstructor")) {
                $Groups->OpenGroup("idInstructor");
            }
            $Groups->AddItem();
            $idInstructorKey = $this->DataSource->f("idInstructor");
            $is_next_record = $this->DataSource->next_record();
            if (!$is_next_record || $idInstructorKey != $this->DataSource->f("idInstructor")) {
                $Groups->CloseGroup("idInstructor");
            }
        }
        if (!count($Groups->Groups)) 
            $Groups->OpenGroup("Report");
        else
            $this->NoRecords->Visible = false;
        $Groups->CloseGroup("Report");
        $this->TotalPages = $Groups->TotalPages;
        $this->TotalRows = $Groups->TotalRows;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) return;

        $this->Attributes->Show();
        $ReportBlock = "Report " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $ReportBlock;

        if($this->CheckErrors()) {
            $Tpl->replaceblock("", $this->GetErrors());
            $Tpl->block_path = $ParentPath;
            return;
        } else {
            $items = & $Groups->Groups;
            $i = $Groups->Pages[min($this->PageNumber, $Groups->TotalPages) - 1];
            $this->ControlsVisible["instructor"] = $this->instructor->Visible;
            $this->ControlsVisible["mes"] = $this->mes->Visible;
            $this->ControlsVisible["anio"] = $this->anio->Visible;
            $this->ControlsVisible["importe"] = $this->importe->Visible;
            $this->ControlsVisible["alumno"] = $this->alumno->Visible;
            $this->ControlsVisible["idTurno"] = $this->idTurno->Visible;
            $this->ControlsVisible["Link1"] = $this->Link1->Visible;
            $this->ControlsVisible["id"] = $this->id->Visible;
            $this->ControlsVisible["Sum_importe"] = $this->Sum_importe->Visible;
            do {
                $this->Attributes->RestoreFromArray($items[$i]->Attributes);
                $this->RowNumber = $items[$i]->RowNumber;
                switch ($items[$i]->GroupType) {
                    Case "":
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Detail";
                        $this->mes->SetValue($items[$i]->mes);
                        $this->mes->Attributes->RestoreFromArray($items[$i]->_mesAttributes);
                        $this->anio->SetValue($items[$i]->anio);
                        $this->anio->Attributes->RestoreFromArray($items[$i]->_anioAttributes);
                        $this->importe->SetValue($items[$i]->importe);
                        $this->importe->Attributes->RestoreFromArray($items[$i]->_importeAttributes);
                        $this->alumno->SetValue($items[$i]->alumno);
                        $this->alumno->Attributes->RestoreFromArray($items[$i]->_alumnoAttributes);
                        $this->idTurno->SetValue($items[$i]->idTurno);
                        $this->idTurno->Attributes->RestoreFromArray($items[$i]->_idTurnoAttributes);
                        $this->Link1->SetValue($items[$i]->Link1);
                        $this->Link1->Page = $items[$i]->_Link1Page;
                        $this->Link1->Parameters = $items[$i]->_Link1Parameters;
                        $this->Link1->Attributes->RestoreFromArray($items[$i]->_Link1Attributes);
                        $this->id->SetValue($items[$i]->id);
                        $this->id->Attributes->RestoreFromArray($items[$i]->_idAttributes);
                        $this->Detail->CCSEventResult = CCGetEvent($this->Detail->CCSEvents, "BeforeShow", $this->Detail);
                        $this->Attributes->Show();
                        $this->mes->Show();
                        $this->anio->Show();
                        $this->importe->Show();
                        $this->alumno->Show();
                        $this->idTurno->Show();
                        $this->Link1->Show();
                        $this->id->Show();
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                        if ($this->Detail->Visible)
                            $Tpl->parseto("Section Detail", true, "Section Detail");
                        break;
                    case "Report":
                        if ($items[$i]->Mode == 1) {
                            $this->Report_Header->CCSEventResult = CCGetEvent($this->Report_Header->CCSEvents, "BeforeShow", $this->Report_Header);
                            if ($this->Report_Header->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Report_Header";
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section Report_Header", true, "Section Detail");
                            }
                        }
                        if ($items[$i]->Mode == 2) {
                            $this->TotalSum_importe->SetValue($items[$i]->TotalSum_importe);
                            $this->TotalSum_importe->Attributes->RestoreFromArray($items[$i]->_TotalSum_importeAttributes);
                            $this->Report_Footer->CCSEventResult = CCGetEvent($this->Report_Footer->CCSEvents, "BeforeShow", $this->Report_Footer);
                            if ($this->Report_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Report_Footer";
                                $this->NoRecords->Show();
                                $this->TotalSum_importe->Show();
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section Report_Footer", true, "Section Detail");
                            }
                        }
                        break;
                    case "Page":
                        if ($items[$i]->Mode == 1) {
                            $this->Page_Header->CCSEventResult = CCGetEvent($this->Page_Header->CCSEvents, "BeforeShow", $this->Page_Header);
                            if ($this->Page_Header->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Page_Header";
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section Page_Header", true, "Section Detail");
                            }
                        }
                        if ($items[$i]->Mode == 2 && !$this->UseClientPaging || $items[$i]->Mode == 1 && $this->UseClientPaging) {
                            $this->Navigator->PageNumber = $items[$i]->PageNumber;
                            $this->Navigator->TotalPages = $Groups->TotalPages;
                            $this->Navigator->Visible = ("Print" != $this->ViewMode);
                            $this->Page_Footer->CCSEventResult = CCGetEvent($this->Page_Footer->CCSEvents, "BeforeShow", $this->Page_Footer);
                            if ($this->Page_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Page_Footer";
                                $this->Navigator->Show();
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section Page_Footer", true, "Section Detail");
                            }
                        }
                        break;
                    case "idInstructor":
                        if ($items[$i]->Mode == 1) {
                            $this->instructor->SetValue($items[$i]->instructor);
                            $this->instructor->Attributes->RestoreFromArray($items[$i]->_instructorAttributes);
                            $this->idInstructor_Header->CCSEventResult = CCGetEvent($this->idInstructor_Header->CCSEvents, "BeforeShow", $this->idInstructor_Header);
                            if ($this->idInstructor_Header->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section idInstructor_Header";
                                $this->Attributes->Show();
                                $this->instructor->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section idInstructor_Header", true, "Section Detail");
                            }
                        }
                        if ($items[$i]->Mode == 2) {
                            $this->Sum_importe->SetValue($items[$i]->Sum_importe);
                            $this->Sum_importe->Attributes->RestoreFromArray($items[$i]->_Sum_importeAttributes);
                            $this->idInstructor_Footer->CCSEventResult = CCGetEvent($this->idInstructor_Footer->CCSEvents, "BeforeShow", $this->idInstructor_Footer);
                            if ($this->idInstructor_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section idInstructor_Footer";
                                $this->Sum_importe->Show();
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section idInstructor_Footer", true, "Section Detail");
                            }
                        }
                        break;
                }
                $i++;
            } while ($i < count($items) && ($this->ViewMode == "Print" ||  !($i > 1 && $items[$i]->GroupType == 'Page' && $items[$i]->Mode == 1)));
            $Tpl->block_path = $ParentPath;
            $Tpl->parse($ReportBlock);
            $this->DataSource->close();
        }

    }
//End Show Method

} //End movimientofacturacion Class @2-FCB6E20C

class clsmovimientofacturacionDataSource extends clsDBConnection1 {  //movimientofacturacionDataSource Class @2-BBC2364E

//DataSource Variables @2-6A75FC63
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $wp;


    // Datasource fields
    var $instructor;
    var $mes;
    var $anio;
    var $importe;
    var $alumno;
    var $idTurno;
    var $id;
    var $Sum_importe;
    var $TotalSum_importe;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-8410E1F6
    function clsmovimientofacturacionDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Report movimientofacturacion";
        $this->Initialize();
        $this->instructor = new clsField("instructor", ccsText, "");
        
        $this->mes = new clsField("mes", ccsInteger, "");
        
        $this->anio = new clsField("anio", ccsInteger, "");
        
        $this->importe = new clsField("importe", ccsInteger, "");
        
        $this->alumno = new clsField("alumno", ccsText, "");
        
        $this->idTurno = new clsField("idTurno", ccsText, "");
        
        $this->id = new clsField("id", ccsInteger, "");
        
        $this->Sum_importe = new clsField("Sum_importe", ccsInteger, "");
        
        $this->TotalSum_importe = new clsField("TotalSum_importe", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-A3CFF580
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "movimientofacturacion.id";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-0CFE02B3
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_idAlumno", ccsInteger, "", "", $this->Parameters["urls_idAlumno"], 0, false);
        $this->wp->AddParameter("2", "urls_anio", ccsInteger, "", "", $this->Parameters["urls_anio"], 0, false);
        $this->wp->AddParameter("3", "urls_mes", ccsText, "", "", $this->Parameters["urls_mes"], "", false);
    }
//End Prepare Method

//Open Method @2-FAD4286A
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT instructor.nombre AS instructor_nombre, movimientofacturacion.*, alumno.nombre AS alumno_nombre \n" .
        "FROM (movimientofacturacion LEFT JOIN alumno ON\n" .
        "movimientofacturacion.idAlumno = alumno.id) LEFT JOIN instructor ON\n" .
        "movimientofacturacion.idInstructor = instructor.id\n" .
        "WHERE ( tipomov = 'C' )\n" .
        "AND movimientofacturacion.idAlumno LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "%'\n" .
        "AND movimientofacturacion.anio LIKE '%" . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "%'\n" .
        "AND ( alumno.activo = 1 )\n" .
        "AND ( lpad(movimientofacturacion.mes,2,'0') like '%" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "%' )  {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, "idInstructor asc" .  ($this->Order ? ", " . $this->Order: "")));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-BD01AB75
    function SetValues()
    {
        $this->instructor->SetDBValue($this->f("instructor_nombre"));
        $this->mes->SetDBValue(trim($this->f("mes")));
        $this->anio->SetDBValue(trim($this->f("anio")));
        $this->importe->SetDBValue(trim($this->f("importe")));
        $this->alumno->SetDBValue($this->f("alumno_nombre"));
        $this->idTurno->SetDBValue($this->f("idTurno"));
        $this->id->SetDBValue(trim($this->f("id")));
        $this->Sum_importe->SetDBValue(trim($this->f("importe")));
        $this->TotalSum_importe->SetDBValue(trim($this->f("importe")));
    }
//End SetValues Method

} //End movimientofacturacionDataSource Class @2-FCB6E20C

class clsRecordmovimientofacturacionSearch { //movimientofacturacionSearch Class @3-E5078376

//Variables @3-D6FF3E86

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

//Class_Initialize Event @3-4219D9A4
    function clsRecordmovimientofacturacionSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record movimientofacturacionSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "movimientofacturacionSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->s_anio = & new clsControl(ccsTextBox, "s_anio", "s_anio", ccsInteger, "", CCGetRequestParam("s_anio", $Method, NULL), $this);
            $this->s_idAlumno = & new clsControl(ccsListBox, "s_idAlumno", "s_idAlumno", ccsInteger, "", CCGetRequestParam("s_idAlumno", $Method, NULL), $this);
            $this->s_idAlumno->DSType = dsTable;
            $this->s_idAlumno->DataSource = new clsDBConnection1();
            $this->s_idAlumno->ds = & $this->s_idAlumno->DataSource;
            $this->s_idAlumno->DataSource->SQL = "SELECT * \n" .
"FROM alumno {SQL_Where} {SQL_OrderBy}";
            list($this->s_idAlumno->BoundColumn, $this->s_idAlumno->TextColumn, $this->s_idAlumno->DBFormat) = array("id", "nombre", "");
            $this->s_idAlumno->DataSource->wp = new clsSQLParameters();
            $this->s_idAlumno->DataSource->wp->Criterion[1] = "( activo=1 )";
            $this->s_idAlumno->DataSource->Where = 
                 $this->s_idAlumno->DataSource->wp->Criterion[1];
            $this->s_mes = & new clsControl(ccsListBox, "s_mes", "s_mes", ccsText, "", CCGetRequestParam("s_mes", $Method, NULL), $this);
            $this->s_mes->DSType = dsTable;
            $this->s_mes->DataSource = new clsDBConnection1();
            $this->s_mes->ds = & $this->s_mes->DataSource;
            $this->s_mes->DataSource->SQL = "SELECT lpad(nro,2,'0') AS nro, nombre, nro AS meses_nro \n" .
"FROM meses {SQL_Where} {SQL_OrderBy}";
            list($this->s_mes->BoundColumn, $this->s_mes->TextColumn, $this->s_mes->DBFormat) = array("nro", "nombre", "");
        }
    }
//End Class_Initialize Event

//Validate Method @3-F5F12A9C
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_anio->Validate() && $Validation);
        $Validation = ($this->s_idAlumno->Validate() && $Validation);
        $Validation = ($this->s_mes->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_anio->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_idAlumno->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_mes->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-CD870CEA
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_anio->Errors->Count());
        $errors = ($errors || $this->s_idAlumno->Errors->Count());
        $errors = ($errors || $this->s_mes->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @3-ED598703
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

//Operation Method @3-0DCB6906
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
        $Redirect = "cuotas_pagadas.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "cuotas_pagadas.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-A21E39AC
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

        $this->s_idAlumno->Prepare();
        $this->s_mes->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_anio->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_idAlumno->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_mes->Errors->ToString());
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
        $this->s_anio->Show();
        $this->s_idAlumno->Show();
        $this->s_mes->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End movimientofacturacionSearch Class @3-FCB6E20C

//Include Page implementation @47-8EACA429
include_once(RelativePath . "/header.php");
//End Include Page implementation

//Initialize Page @1-E4D10060
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
$TemplateFileName = "cuotas_pagadas.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Authenticate User @1-5CB846BC
CCSecurityRedirect("1;100", "denegado.php");
//End Authenticate User

//Include events file @1-B5833B69
include_once("./cuotas_pagadas_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-854A996A
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$movimientofacturacion = & new clsReportmovimientofacturacion("", $MainPage);
$movimientofacturacionSearch = & new clsRecordmovimientofacturacionSearch("", $MainPage);
$header = & new clsheader("", "header", $MainPage);
$header->Initialize();
$MainPage->movimientofacturacion = & $movimientofacturacion;
$MainPage->movimientofacturacionSearch = & $movimientofacturacionSearch;
$MainPage->header = & $header;
$movimientofacturacion->Initialize();

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

//Execute Components @1-AD8B5590
$movimientofacturacionSearch->Operation();
$header->Operations();
//End Execute Components

//Go to destination page @1-97DE08B0
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    unset($movimientofacturacion);
    unset($movimientofacturacionSearch);
    $header->Class_Terminate();
    unset($header);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-C93777B0
$movimientofacturacion->Show();
$movimientofacturacionSearch->Show();
$header->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-4002B7D8
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
unset($movimientofacturacion);
unset($movimientofacturacionSearch);
$header->Class_Terminate();
unset($header);
unset($Tpl);
//End Unload Page


?>
