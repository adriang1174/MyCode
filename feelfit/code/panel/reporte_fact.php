<?php
//Include Common Files @1-1D399A6F
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "reporte_fact.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files



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

//Class_Initialize Event @3-F48AD951
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
            $this->s_mes = & new clsControl(ccsListBox, "s_mes", "s_mes", ccsInteger, "", CCGetRequestParam("s_mes", $Method, NULL), $this);
            $this->s_mes->DSType = dsTable;
            $this->s_mes->DataSource = new clsDBConnection1();
            $this->s_mes->ds = & $this->s_mes->DataSource;
            $this->s_mes->DataSource->SQL = "SELECT * \n" .
"FROM meses {SQL_Where} {SQL_OrderBy}";
            list($this->s_mes->BoundColumn, $this->s_mes->TextColumn, $this->s_mes->DBFormat) = array("nro", "nombre", "");
        }
    }
//End Class_Initialize Event

//Validate Method @3-28D8FDD4
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_anio->Validate() && $Validation);
        $Validation = ($this->s_mes->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_anio->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_mes->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-87F853AD
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_anio->Errors->Count());
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

//Operation Method @3-4DE3BF5D
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
        $Redirect = "reporte_fact.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "reporte_fact.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-75B66346
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
            $Error = ComposeStrings($Error, $this->s_anio->Errors->ToString());
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
        $this->s_mes->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End movimientofacturacionSearch Class @3-FCB6E20C

//Include Page implementation @47-8EACA429
include_once(RelativePath . "/header.php");
//End Include Page implementation

//Report1 ReportGroup class @54-AF07EB78
class clsReportGroupReport1 {
    var $GroupType;
    var $mode; //1 - open, 2 - close
    var $anio, $anioDup, $_anioAttributes;
    var $mes, $mesDup, $_mesAttributes;
    var $sum_m_importe_1, $_sum_m_importe_1Attributes;
    var $importe, $_importeAttributes;
    var $rentabilidad, $_rentabilidadAttributes;
    var $Attributes;
    var $ReportTotalIndex = 0;
    var $PageTotalIndex;
    var $PageNumber;
    var $RowNumber;
    var $Parent;
    var $anioTotalIndex;
    var $mesTotalIndex;

    function clsReportGroupReport1(& $parent) {
        $this->Parent = & $parent;
        $this->Attributes = $this->Parent->Attributes->GetAsArray();
    }
    function SetControls($PrevGroup = "") {
        $this->anio = $this->Parent->anio->Value;
        $this->mes = $this->Parent->mes->Value;
        $this->sum_m_importe_1 = $this->Parent->sum_m_importe_1->Value;
        $this->importe = $this->Parent->importe->Value;
        $this->rentabilidad = $this->Parent->rentabilidad->Value;
        if ($PrevGroup) {
            $this->anioDup =  CCCompareValues($this->anio, $PrevGroup->anio, $this->Parent->anio->DataType) == 0;
            $this->mesDup =  CCCompareValues($this->mes, $PrevGroup->mes, $this->Parent->mes->DataType) == 0;
        }
    }

    function SetTotalControls($mode = "", $PrevGroup = "") {
        $this->_anioAttributes = $this->Parent->anio->Attributes->GetAsArray();
        $this->_mesAttributes = $this->Parent->mes->Attributes->GetAsArray();
        $this->_sum_m_importe_1Attributes = $this->Parent->sum_m_importe_1->Attributes->GetAsArray();
        $this->_importeAttributes = $this->Parent->importe->Attributes->GetAsArray();
        $this->_rentabilidadAttributes = $this->Parent->rentabilidad->Attributes->GetAsArray();
        $this->_NavigatorAttributes = $this->Parent->Navigator->Attributes->GetAsArray();
    }
    function SyncWithHeader(& $Header) {
        $this->anio = $Header->anio;
        $Header->_anioAttributes = $this->_anioAttributes;
        $this->Parent->anio->Value = $Header->anio;
        $this->Parent->anio->Attributes->RestoreFromArray($Header->_anioAttributes);
        $this->mes = $Header->mes;
        $Header->_mesAttributes = $this->_mesAttributes;
        $this->Parent->mes->Value = $Header->mes;
        $this->Parent->mes->Attributes->RestoreFromArray($Header->_mesAttributes);
        $this->sum_m_importe_1 = $Header->sum_m_importe_1;
        $Header->_sum_m_importe_1Attributes = $this->_sum_m_importe_1Attributes;
        $this->Parent->sum_m_importe_1->Value = $Header->sum_m_importe_1;
        $this->Parent->sum_m_importe_1->Attributes->RestoreFromArray($Header->_sum_m_importe_1Attributes);
        $this->importe = $Header->importe;
        $Header->_importeAttributes = $this->_importeAttributes;
        $this->Parent->importe->Value = $Header->importe;
        $this->Parent->importe->Attributes->RestoreFromArray($Header->_importeAttributes);
        $this->rentabilidad = $Header->rentabilidad;
        $Header->_rentabilidadAttributes = $this->_rentabilidadAttributes;
        $this->Parent->rentabilidad->Value = $Header->rentabilidad;
        $this->Parent->rentabilidad->Attributes->RestoreFromArray($Header->_rentabilidadAttributes);
    }
    function ChangeTotalControls() {
    }
}
//End Report1 ReportGroup class

//Report1 GroupsCollection class @54-5A990267
class clsGroupsCollectionReport1 {
    var $Groups;
    var $mPageCurrentHeaderIndex;
    var $manioCurrentHeaderIndex;
    var $mmesCurrentHeaderIndex;
    var $PageSize;
    var $TotalPages = 0;
    var $TotalRows = 0;
    var $CurrentPageSize = 0;
    var $Pages;
    var $Parent;
    var $LastDetailIndex;

    function clsGroupsCollectionReport1(& $parent) {
        $this->Parent = & $parent;
        $this->Groups = array();
        $this->Pages  = array();
        $this->manioCurrentHeaderIndex = 1;
        $this->mmesCurrentHeaderIndex = 2;
        $this->mReportTotalIndex = 0;
        $this->mPageTotalIndex = 1;
    }

    function & InitGroup() {
        $group = new clsReportGroupReport1($this->Parent);
        $group->RowNumber = $this->TotalRows + 1;
        $group->PageNumber = $this->TotalPages;
        $group->PageTotalIndex = $this->mPageCurrentHeaderIndex;
        $group->anioTotalIndex = $this->manioCurrentHeaderIndex;
        $group->mesTotalIndex = $this->mmesCurrentHeaderIndex;
        return $group;
    }

    function RestoreValues() {
        $this->Parent->anio->Value = $this->Parent->anio->initialValue;
        $this->Parent->mes->Value = $this->Parent->mes->initialValue;
        $this->Parent->sum_m_importe_1->Value = $this->Parent->sum_m_importe_1->initialValue;
        $this->Parent->importe->Value = $this->Parent->importe->initialValue;
        $this->Parent->rentabilidad->Value = $this->Parent->rentabilidad->initialValue;
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
        if ($groupName == "anio") {
            $Groupanio = & $this->InitGroup(true);
            $this->Parent->anio_Header->CCSEventResult = CCGetEvent($this->Parent->anio_Header->CCSEvents, "OnInitialize", $this->Parent->anio_Header);
            if ($this->Parent->Page_Footer->Visible) 
                $OverSize = $this->Parent->anio_Header->Height + $this->Parent->Page_Footer->Height;
            else
                $OverSize = $this->Parent->anio_Header->Height;
            if (($this->PageSize > 0) and $this->Parent->anio_Header->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
                $this->ClosePage();
                $this->OpenPage();
            }
            if ($this->Parent->anio_Header->Visible)
                $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->anio_Header->Height;
                $Groupanio->SetTotalControls("GetNextValue");
            $this->Parent->anio_Header->CCSEventResult = CCGetEvent($this->Parent->anio_Header->CCSEvents, "OnCalculate", $this->Parent->anio_Header);
            $Groupanio->SetControls();
            $Groupanio->Mode = 1;
            $OpenFlag = true;
            $Groupanio->GroupType = "anio";
            $this->manioCurrentHeaderIndex = count($this->Groups);
            $this->Groups[] = & $Groupanio;
        }
        if ($groupName == "mes" or $OpenFlag) {
            $Groupmes = & $this->InitGroup(true);
            $this->Parent->mes_Header->CCSEventResult = CCGetEvent($this->Parent->mes_Header->CCSEvents, "OnInitialize", $this->Parent->mes_Header);
            if ($this->Parent->Page_Footer->Visible) 
                $OverSize = $this->Parent->mes_Header->Height + $this->Parent->Page_Footer->Height;
            else
                $OverSize = $this->Parent->mes_Header->Height;
            if (($this->PageSize > 0) and $this->Parent->mes_Header->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
                $this->ClosePage();
                $this->OpenPage();
            }
            if ($this->Parent->mes_Header->Visible)
                $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->mes_Header->Height;
                $Groupmes->SetTotalControls("GetNextValue");
            $this->Parent->mes_Header->CCSEventResult = CCGetEvent($this->Parent->mes_Header->CCSEvents, "OnCalculate", $this->Parent->mes_Header);
            $Groupmes->SetControls();
            $Groupmes->Mode = 1;
            $Groupmes->GroupType = "mes";
            $this->mmesCurrentHeaderIndex = count($this->Groups);
            $this->Groups[] = & $Groupmes;
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
        $Groupmes = & $this->InitGroup(true);
        $this->Parent->mes_Footer->CCSEventResult = CCGetEvent($this->Parent->mes_Footer->CCSEvents, "OnInitialize", $this->Parent->mes_Footer);
        if ($this->Parent->Page_Footer->Visible) 
            $OverSize = $this->Parent->mes_Footer->Height + $this->Parent->Page_Footer->Height;
        else
            $OverSize = $this->Parent->mes_Footer->Height;
        if (($this->PageSize > 0) and $this->Parent->mes_Footer->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
            $this->ClosePage();
            $this->OpenPage();
        }
        $Groupmes->SetTotalControls("GetPrevValue");
        $Groupmes->SyncWithHeader($this->Groups[$this->mmesCurrentHeaderIndex]);
        if ($this->Parent->mes_Footer->Visible)
            $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->mes_Footer->Height;
        $this->Parent->mes_Footer->CCSEventResult = CCGetEvent($this->Parent->mes_Footer->CCSEvents, "OnCalculate", $this->Parent->mes_Footer);
        $Groupmes->SetControls();
        $this->RestoreValues();
        $Groupmes->Mode = 2;
        $Groupmes->GroupType ="mes";
        $this->Groups[] = & $Groupmes;
        if ($groupName == "mes") return;
        $Groupanio = & $this->InitGroup(true);
        $this->Parent->anio_Footer->CCSEventResult = CCGetEvent($this->Parent->anio_Footer->CCSEvents, "OnInitialize", $this->Parent->anio_Footer);
        if ($this->Parent->Page_Footer->Visible) 
            $OverSize = $this->Parent->anio_Footer->Height + $this->Parent->Page_Footer->Height;
        else
            $OverSize = $this->Parent->anio_Footer->Height;
        if (($this->PageSize > 0) and $this->Parent->anio_Footer->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
            $this->ClosePage();
            $this->OpenPage();
        }
        $Groupanio->SetTotalControls("GetPrevValue");
        $Groupanio->SyncWithHeader($this->Groups[$this->manioCurrentHeaderIndex]);
        if ($this->Parent->anio_Footer->Visible)
            $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->anio_Footer->Height;
        $this->Parent->anio_Footer->CCSEventResult = CCGetEvent($this->Parent->anio_Footer->CCSEvents, "OnCalculate", $this->Parent->anio_Footer);
        $Groupanio->SetControls();
        $this->RestoreValues();
        $Groupanio->Mode = 2;
        $Groupanio->GroupType ="anio";
        $this->Groups[] = & $Groupanio;
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
//End Report1 GroupsCollection class

class clsReportReport1 { //Report1 Class @54-BC2FB08C

//Report1 Variables @54-577C9CF0

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
    var $anio_HeaderBlock, $anio_Header;
    var $anio_FooterBlock, $anio_Footer;
    var $mes_HeaderBlock, $mes_Header;
    var $mes_FooterBlock, $mes_Footer;
    var $SorterName, $SorterDirection;

    var $ds;
    var $DataSource;
    var $UseClientPaging = false;

    //Report Controls
    var $StaticControls, $RowControls, $Report_FooterControls, $Report_HeaderControls;
    var $Page_FooterControls, $Page_HeaderControls;
    var $anio_HeaderControls, $anio_FooterControls;
    var $mes_HeaderControls, $mes_FooterControls;
//End Report1 Variables

//Class_Initialize Event @54-000FB6B0
    function clsReportReport1($RelativePath = "", & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "Report1";
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
        $this->Report_Header = new clsSection($this);
        $this->Page_Footer = new clsSection($this);
        $this->Page_Footer->Height = 1;
        $MinPageSize += $this->Page_Footer->Height;
        $this->Page_Header = new clsSection($this);
        $this->Page_Header->Height = 1;
        $MinPageSize += $this->Page_Header->Height;
        $this->anio_Footer = new clsSection($this);
        $this->anio_Header = new clsSection($this);
        $this->mes_Footer = new clsSection($this);
        $this->mes_Header = new clsSection($this);
        $this->Errors = new clsErrors();
        $this->DataSource = new clsReport1DataSource($this);
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

        $this->anio = & new clsControl(ccsReportLabel, "anio", "anio", ccsInteger, "", "", $this);
        $this->mes = & new clsControl(ccsReportLabel, "mes", "mes", ccsInteger, "", "", $this);
        $this->sum_m_importe_1 = & new clsControl(ccsReportLabel, "sum_m_importe_1", "sum_m_importe_1", ccsFloat, "", "", $this);
        $this->importe = & new clsControl(ccsReportLabel, "importe", "importe", ccsFloat, "", "", $this);
        $this->rentabilidad = & new clsControl(ccsReportLabel, "rentabilidad", "rentabilidad", ccsText, "", "", $this);
        $this->rentabilidad->IsEmptySource = true;
        $this->NoRecords = & new clsPanel("NoRecords", $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @54-6C59EE65
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = $this->PageSize;
        $this->DataSource->AbsolutePage = $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//CheckErrors Method @54-5AC6B84A
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->anio->Errors->Count());
        $errors = ($errors || $this->mes->Errors->Count());
        $errors = ($errors || $this->sum_m_importe_1->Errors->Count());
        $errors = ($errors || $this->importe->Errors->Count());
        $errors = ($errors || $this->rentabilidad->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//GetErrors Method @54-3396E908
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->anio->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mes->Errors->ToString());
        $errors = ComposeStrings($errors, $this->sum_m_importe_1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->importe->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rentabilidad->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

//Show Method @54-C18EF1D5
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $ShownRecords = 0;

        $this->DataSource->Parameters["urls_anio"] = CCGetFromGet("s_anio", NULL);
        $this->DataSource->Parameters["urls_mes"] = CCGetFromGet("s_mes", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();

        $anioKey = "";
        $mesKey = "";
        $Groups = new clsGroupsCollectionReport1($this);
        $Groups->PageSize = $this->PageSize > 0 ? $this->PageSize : 0;

        $is_next_record = $this->DataSource->next_record();
        $this->IsEmpty = ! $is_next_record;
        while($is_next_record) {
            $this->DataSource->SetValues();
            $this->anio->SetValue($this->DataSource->anio->GetValue());
            $this->mes->SetValue($this->DataSource->mes->GetValue());
            $this->sum_m_importe_1->SetValue($this->DataSource->sum_m_importe_1->GetValue());
            $this->importe->SetValue($this->DataSource->importe->GetValue());
            $this->rentabilidad->SetValue("");
            if (count($Groups->Groups) == 0) $Groups->OpenGroup("Report");
            if (count($Groups->Groups) == 2 or $anioKey != $this->DataSource->f("anio")) {
                $Groups->OpenGroup("anio");
            } elseif ($mesKey != $this->DataSource->f("mes")) {
                $Groups->OpenGroup("mes");
            }
            $Groups->AddItem();
            $anioKey = $this->DataSource->f("anio");
            $mesKey = $this->DataSource->f("mes");
            $is_next_record = $this->DataSource->next_record();
            if (!$is_next_record || $anioKey != $this->DataSource->f("anio")) {
                $Groups->CloseGroup("anio");
            } elseif ($mesKey != $this->DataSource->f("mes")) {
                $Groups->CloseGroup("mes");
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
            $this->ControlsVisible["anio"] = $this->anio->Visible;
            $this->ControlsVisible["mes"] = $this->mes->Visible;
            $this->ControlsVisible["sum_m_importe_1"] = $this->sum_m_importe_1->Visible;
            $this->ControlsVisible["importe"] = $this->importe->Visible;
            $this->ControlsVisible["rentabilidad"] = $this->rentabilidad->Visible;
            do {
                $this->Attributes->RestoreFromArray($items[$i]->Attributes);
                $this->RowNumber = $items[$i]->RowNumber;
                switch ($items[$i]->GroupType) {
                    Case "":
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Detail";
                        $this->anio->Visible = $this->ControlsVisible["anio"] && !$items[$i]->anioDup;
                        $this->anio->SetValue($items[$i]->anio);
                        $this->anio->Attributes->RestoreFromArray($items[$i]->_anioAttributes);
                        $this->mes->Visible = $this->ControlsVisible["mes"] && !$items[$i]->mesDup;
                        $this->mes->SetValue($items[$i]->mes);
                        $this->mes->Attributes->RestoreFromArray($items[$i]->_mesAttributes);
                        $this->sum_m_importe_1->SetValue($items[$i]->sum_m_importe_1);
                        $this->sum_m_importe_1->Attributes->RestoreFromArray($items[$i]->_sum_m_importe_1Attributes);
                        $this->importe->SetValue($items[$i]->importe);
                        $this->importe->Attributes->RestoreFromArray($items[$i]->_importeAttributes);
                        $this->rentabilidad->SetValue($items[$i]->rentabilidad);
                        $this->rentabilidad->Attributes->RestoreFromArray($items[$i]->_rentabilidadAttributes);
                        $this->Detail->CCSEventResult = CCGetEvent($this->Detail->CCSEvents, "BeforeShow", $this->Detail);
                        $this->Attributes->Show();
                        $this->anio->Show();
                        $this->mes->Show();
                        $this->sum_m_importe_1->Show();
                        $this->importe->Show();
                        $this->rentabilidad->Show();
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
                            $this->Report_Footer->CCSEventResult = CCGetEvent($this->Report_Footer->CCSEvents, "BeforeShow", $this->Report_Footer);
                            if ($this->Report_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Report_Footer";
                                $this->NoRecords->Show();
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
                    case "anio":
                        if ($items[$i]->Mode == 1) {
                            $this->anio_Header->CCSEventResult = CCGetEvent($this->anio_Header->CCSEvents, "BeforeShow", $this->anio_Header);
                            if ($this->anio_Header->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section anio_Header";
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section anio_Header", true, "Section Detail");
                            }
                        }
                        if ($items[$i]->Mode == 2) {
                            $this->anio_Footer->CCSEventResult = CCGetEvent($this->anio_Footer->CCSEvents, "BeforeShow", $this->anio_Footer);
                            if ($this->anio_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section anio_Footer";
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section anio_Footer", true, "Section Detail");
                            }
                        }
                        break;
                    case "mes":
                        if ($items[$i]->Mode == 1) {
                            $this->mes_Header->CCSEventResult = CCGetEvent($this->mes_Header->CCSEvents, "BeforeShow", $this->mes_Header);
                            if ($this->mes_Header->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section mes_Header";
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section mes_Header", true, "Section Detail");
                            }
                        }
                        if ($items[$i]->Mode == 2) {
                            $this->mes_Footer->CCSEventResult = CCGetEvent($this->mes_Footer->CCSEvents, "BeforeShow", $this->mes_Footer);
                            if ($this->mes_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section mes_Footer";
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section mes_Footer", true, "Section Detail");
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

} //End Report1 Class @54-FCB6E20C

class clsReport1DataSource extends clsDBConnection1 {  //Report1DataSource Class @54-20EE0F53

//DataSource Variables @54-55FA462B
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $wp;


    // Datasource fields
    var $anio;
    var $mes;
    var $sum_m_importe_1;
    var $importe;
//End DataSource Variables

//DataSourceClass_Initialize Event @54-7F000614
    function clsReport1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Report Report1";
        $this->Initialize();
        $this->anio = new clsField("anio", ccsInteger, "");
        
        $this->mes = new clsField("mes", ccsInteger, "");
        
        $this->sum_m_importe_1 = new clsField("sum_m_importe_1", ccsFloat, "");
        
        $this->importe = new clsField("importe", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @54-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @54-1BB3882A
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_anio", ccsText, "", "", $this->Parameters["urls_anio"], "", false);
        $this->wp->AddParameter("2", "urls_mes", ccsText, "", "", $this->Parameters["urls_mes"], "", false);
    }
//End Prepare Method

//Open Method @54-AFD41EE3
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT m.anio,m.mes,sum(m.importe) as importe_fact,g.importe\n" .
        "FROM movimientofacturacion m ,(select sum(importe) as importe from  gastos  where anio = '" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "' and mes = '" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "') g\n" .
        "where tipomov = 'C'\n" .
        "and m.anio = '" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "'\n" .
        "and m.mes = '" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "'\n" .
        "group by m.anio,m.mes,g.importe";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, "anio asc,mes asc" .  ($this->Order ? ", " . $this->Order: "")));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @54-EE33F3BD
    function SetValues()
    {
        $this->anio->SetDBValue(trim($this->f("anio")));
        $this->mes->SetDBValue(trim($this->f("mes")));
        $this->sum_m_importe_1->SetDBValue(trim($this->f("importe_fact")));
        $this->importe->SetDBValue(trim($this->f("importe")));
    }
//End SetValues Method

} //End Report1DataSource Class @54-FCB6E20C

//Initialize Page @1-DE2014AD
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
$TemplateFileName = "reporte_fact.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Authenticate User @1-403368F4
CCSecurityRedirect("1", "denegado.php");
//End Authenticate User

//Include events file @1-55724EBE
include_once("./reporte_fact_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-1253833D
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$movimientofacturacionSearch = & new clsRecordmovimientofacturacionSearch("", $MainPage);
$header = & new clsheader("", "header", $MainPage);
$header->Initialize();
$Report1 = & new clsReportReport1("", $MainPage);
$MainPage->movimientofacturacionSearch = & $movimientofacturacionSearch;
$MainPage->header = & $header;
$MainPage->Report1 = & $Report1;
$Report1->Initialize();

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

//Go to destination page @1-6AF65FA9
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    unset($movimientofacturacionSearch);
    $header->Class_Terminate();
    unset($header);
    unset($Report1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-35D26B41
$movimientofacturacionSearch->Show();
$header->Show();
$Report1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-D84682D7
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
unset($movimientofacturacionSearch);
$header->Class_Terminate();
unset($header);
unset($Report1);
unset($Tpl);
//End Unload Page


?>
