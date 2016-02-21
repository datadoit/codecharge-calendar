<?php

class clsGridCalendar_DayViewCal { //Cal class @2-1BCEB4B7

//Variables @2-6E51DF5A

    // Public variables
    public $ComponentType = "Grid";
    public $ComponentName;
    public $Visible;
    public $Errors;
    public $ErrorBlock;
    public $ds;
    public $DataSource;
    public $PageSize;
    public $IsEmpty;
    public $ForceIteration = false;
    public $HasRecord = false;
    public $SorterName = "";
    public $SorterDirection = "";
    public $PageNumber;
    public $RowNumber;
    public $ControlsVisible = array();

    public $CCSEvents = "";
    public $CCSEventResult;

    public $RelativePath = "";
    public $Attributes;

    // Grid Controls
    public $StaticControls;
    public $RowControls;
//End Variables

//Class_Initialize Event @2-C445B367
    function clsGridCalendar_DayViewCal($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "Cal";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid Cal";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsCalendar_DayViewCalDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 100;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->TimeOfDay = new clsControl(ccsLabel, "TimeOfDay", "TimeOfDay", ccsText, "", CCGetRequestParam("TimeOfDay", ccsGet, NULL), $this);
        $this->Event = new clsControl(ccsLabel, "Event", "Event", ccsText, "", CCGetRequestParam("Event", ccsGet, NULL), $this);
        $this->Event->HTML = true;
        $this->PreviousDay = new clsControl(ccsImageLink, "PreviousDay", "PreviousDay", ccsText, "", CCGetRequestParam("PreviousDay", ccsGet, NULL), $this);
        $this->PreviousDay->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->PreviousDay->Page = "{PreviousDay}";
        $this->Today = new clsControl(ccsLabel, "Today", "Today", ccsText, "", CCGetRequestParam("Today", ccsGet, NULL), $this);
        $this->Today->HTML = true;
        $this->NextDay = new clsControl(ccsImageLink, "NextDay", "NextDay", ccsText, "", CCGetRequestParam("NextDay", ccsGet, NULL), $this);
        $this->NextDay->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->NextDay->Page = "{NextDay}";
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

//Show Method @2-DBF194D0
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["expr5"] = "1500";
        $this->DataSource->Parameters["expr6"] = "4500";

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
            $this->ControlsVisible["TimeOfDay"] = $this->TimeOfDay->Visible;
            $this->ControlsVisible["Event"] = $this->Event->Visible;
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
                $this->TimeOfDay->SetValue($this->DataSource->TimeOfDay->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->TimeOfDay->Show();
                $this->Event->Show();
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
        $this->PreviousDay->Show();
        $this->Today->Show();
        $this->NextDay->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-02370AA2
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->TimeOfDay->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Event->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End Cal Class @2-FCB6E20C

class clsCalendar_DayViewCalDataSource extends clsDBConnection1 {  //CalDataSource Class @2-86BE7BE2

//DataSource Variables @2-8B512AAE
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $TimeOfDay;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-78F33052
    function clsCalendar_DayViewCalDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid Cal";
        $this->Initialize();
        $this->TimeOfDay = new clsField("TimeOfDay", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-DDD6B272
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "HHiiSS";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-6B439A4B
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "expr5", ccsText, "", "", $this->Parameters["expr5"], "", false);
        $this->wp->AddParameter("2", "expr6", ccsText, "", "", $this->Parameters["expr6"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opNotEndsWith, "HHiiSS", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opNotEndsWith, "HHiiSS", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @2-19DAC8D8
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM lu_calendars_times";
        $this->SQL = "SELECT * \n\n" .
        "FROM lu_calendars_times {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-9F9966B6
    function SetValues()
    {
        $this->TimeOfDay->SetDBValue($this->f("time"));
    }
//End SetValues Method

} //End CalDataSource Class @2-FCB6E20C

//Include Page implementation @16-3D0083C6
include_once(RelativePath . "/Calendar/Calendar_Select.php");
//End Include Page implementation

class clsCalendar_DayView { //Calendar_DayView class @1-B208C38B

//Variables @1-51D7F06F
    public $ComponentType = "IncludablePage";
    public $Connections = array();
    public $FileName = "";
    public $Redirect = "";
    public $Tpl = "";
    public $TemplateFileName = "";
    public $BlockToParse = "";
    public $ComponentName = "";
    public $Attributes = "";

    // Events;
    public $CCSEvents = "";
    public $CCSEventResult = "";
    public $RelativePath;
    public $Visible;
    public $Parent;
//End Variables

//Class_Initialize Event @1-9B3B0C37
    function clsCalendar_DayView($RelativePath, $ComponentName, & $Parent)
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = $ComponentName;
        $this->RelativePath = $RelativePath;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->FileName = "Calendar_DayView.php";
        $this->Redirect = "";
        $this->TemplateFileName = "Calendar_DayView.html";
        $this->BlockToParse = "main";
        $this->TemplateEncoding = "UTF-8";
        $this->ContentType = "text/html";
    }
//End Class_Initialize Event

//Class_Terminate Event @1-4790EEFF
    function Class_Terminate()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
        unset($this->Cal);
        $this->Calendar_Select->Class_Terminate();
        unset($this->Calendar_Select);
    }
//End Class_Terminate Event

//BindEvents Method @1-31995EF6
    function BindEvents()
    {
        $this->Cal->ds->CCSEvents["BeforeBuildSelect"] = "Calendar_DayView_Cal_ds_BeforeBuildSelect";
        $this->Cal->CCSEvents["BeforeShowRow"] = "Calendar_DayView_Cal_BeforeShowRow";
        $this->CCSEvents["BeforeShow"] = "Calendar_DayView_BeforeShow";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInitialize", $this);
    }
//End BindEvents Method

//Operations Method @1-47DC3F85
    function Operations()
    {
        global $Redirect;
        if(!$this->Visible)
            return "";
        $this->Calendar_Select->Operations();
    }
//End Operations Method

//Initialize Method @1-8ED8CCD9
    function Initialize()
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInitialize", $this);
        if(!$this->Visible)
            return "";
        $this->Attributes = & $this->Parent->Attributes;
        $this->DBConnection1 = new clsDBConnection1();
        $this->Connections["Connection1"] = & $this->DBConnection1;

        // Create Components
        $this->Cal = new clsGridCalendar_DayViewCal($this->RelativePath, $this);
        $this->Calendar_Select = new clsCalendar_Select($this->RelativePath, "Calendar_Select", $this);
        $this->Calendar_Select->Initialize();
        $this->Cal->Initialize();
        $this->BindEvents();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
    }
//End Initialize Method

//Show Method @1-0F983665
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        $block_path = $Tpl->block_path;
        $Tpl->LoadTemplate("/Calendar/" . $this->TemplateFileName, $this->ComponentName, $this->TemplateEncoding, "remove");
        $Tpl->block_path = $Tpl->block_path . "/" . $this->ComponentName;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) {
            $Tpl->block_path = $block_path;
            $Tpl->SetVar($this->ComponentName, "");
            return "";
        }
        $this->Attributes->Show();
        $this->Cal->Show();
        $this->Calendar_Select->Show();
        $Tpl->Parse();
        $Tpl->block_path = $block_path;
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
        $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
    }
//End Show Method

} //End Calendar_DayView Class @1-FCB6E20C

//Include Event File @1-68301A6C
include_once(RelativePath . "/Calendar/Calendar_DayView_events.php");
//End Include Event File


?>
