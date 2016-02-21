<?php

class clsGridCalendar_WeekViewCal { //Cal class @2-EFEA43CC

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

//Class_Initialize Event @2-9CDFCCE2
    function clsGridCalendar_WeekViewCal($RelativePath, & $Parent)
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
        $this->DataSource = new clsCalendar_WeekViewCalDataSource($this);
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

        $this->Data_time = new clsPanel("Data_time", $this);
        $this->TimeOfDay = new clsControl(ccsLabel, "TimeOfDay", "TimeOfDay", ccsText, "", CCGetRequestParam("TimeOfDay", ccsGet, NULL), $this);
        $this->MondayEvents = new clsControl(ccsLabel, "MondayEvents", "MondayEvents", ccsText, "", CCGetRequestParam("MondayEvents", ccsGet, NULL), $this);
        $this->MondayEvents->HTML = true;
        $this->SundayEvents = new clsControl(ccsLabel, "SundayEvents", "SundayEvents", ccsText, "", CCGetRequestParam("SundayEvents", ccsGet, NULL), $this);
        $this->SundayEvents->HTML = true;
        $this->TuesdayEvents = new clsControl(ccsLabel, "TuesdayEvents", "TuesdayEvents", ccsText, "", CCGetRequestParam("TuesdayEvents", ccsGet, NULL), $this);
        $this->TuesdayEvents->HTML = true;
        $this->WednesdayEvents = new clsControl(ccsLabel, "WednesdayEvents", "WednesdayEvents", ccsText, "", CCGetRequestParam("WednesdayEvents", ccsGet, NULL), $this);
        $this->WednesdayEvents->HTML = true;
        $this->ThursdayEvents = new clsControl(ccsLabel, "ThursdayEvents", "ThursdayEvents", ccsText, "", CCGetRequestParam("ThursdayEvents", ccsGet, NULL), $this);
        $this->ThursdayEvents->HTML = true;
        $this->FridayEvents = new clsControl(ccsLabel, "FridayEvents", "FridayEvents", ccsText, "", CCGetRequestParam("FridayEvents", ccsGet, NULL), $this);
        $this->FridayEvents->HTML = true;
        $this->SaturdayEvents = new clsControl(ccsLabel, "SaturdayEvents", "SaturdayEvents", ccsText, "", CCGetRequestParam("SaturdayEvents", ccsGet, NULL), $this);
        $this->SaturdayEvents->HTML = true;
        $this->PreviousWeek = new clsControl(ccsImageLink, "PreviousWeek", "PreviousWeek", ccsText, "", CCGetRequestParam("PreviousWeek", ccsGet, NULL), $this);
        $this->PreviousWeek->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->PreviousWeek->Page = "{PreviousWeek}";
        $this->ThisWeek = new clsControl(ccsLabel, "ThisWeek", "ThisWeek", ccsText, "", CCGetRequestParam("ThisWeek", ccsGet, NULL), $this);
        $this->NextWeek = new clsControl(ccsImageLink, "NextWeek", "NextWeek", ccsText, "", CCGetRequestParam("NextWeek", ccsGet, NULL), $this);
        $this->NextWeek->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->NextWeek->Page = "{NextWeek}";
        $this->Sunday = new clsControl(ccsLink, "Sunday", "Sunday", ccsText, "", CCGetRequestParam("Sunday", ccsGet, NULL), $this);
        $this->Sunday->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->Sunday->Page = "";
        $this->Monday = new clsControl(ccsLink, "Monday", "Monday", ccsText, "", CCGetRequestParam("Monday", ccsGet, NULL), $this);
        $this->Monday->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->Monday->Page = "";
        $this->Tuesday = new clsControl(ccsLink, "Tuesday", "Tuesday", ccsText, "", CCGetRequestParam("Tuesday", ccsGet, NULL), $this);
        $this->Tuesday->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->Tuesday->Page = "";
        $this->Wednesday = new clsControl(ccsLink, "Wednesday", "Wednesday", ccsText, "", CCGetRequestParam("Wednesday", ccsGet, NULL), $this);
        $this->Wednesday->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->Wednesday->Page = "";
        $this->Thursday = new clsControl(ccsLink, "Thursday", "Thursday", ccsText, "", CCGetRequestParam("Thursday", ccsGet, NULL), $this);
        $this->Thursday->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->Thursday->Page = "";
        $this->Friday = new clsControl(ccsLink, "Friday", "Friday", ccsText, "", CCGetRequestParam("Friday", ccsGet, NULL), $this);
        $this->Friday->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->Friday->Page = "";
        $this->Saturday = new clsControl(ccsLink, "Saturday", "Saturday", ccsText, "", CCGetRequestParam("Saturday", ccsGet, NULL), $this);
        $this->Saturday->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->Saturday->Page = "";
        $this->Data_time->AddComponent("TimeOfDay", $this->TimeOfDay);
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

//Show Method @2-3D4F1F3C
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["expr8"] = "1500";
        $this->DataSource->Parameters["expr9"] = "4500";

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
            $this->ControlsVisible["Data_time"] = $this->Data_time->Visible;
            $this->ControlsVisible["TimeOfDay"] = $this->TimeOfDay->Visible;
            $this->ControlsVisible["MondayEvents"] = $this->MondayEvents->Visible;
            $this->ControlsVisible["SundayEvents"] = $this->SundayEvents->Visible;
            $this->ControlsVisible["TuesdayEvents"] = $this->TuesdayEvents->Visible;
            $this->ControlsVisible["WednesdayEvents"] = $this->WednesdayEvents->Visible;
            $this->ControlsVisible["ThursdayEvents"] = $this->ThursdayEvents->Visible;
            $this->ControlsVisible["FridayEvents"] = $this->FridayEvents->Visible;
            $this->ControlsVisible["SaturdayEvents"] = $this->SaturdayEvents->Visible;
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
                $this->Data_time->Show();
                $this->MondayEvents->Show();
                $this->SundayEvents->Show();
                $this->TuesdayEvents->Show();
                $this->WednesdayEvents->Show();
                $this->ThursdayEvents->Show();
                $this->FridayEvents->Show();
                $this->SaturdayEvents->Show();
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
        $this->PreviousWeek->Show();
        $this->ThisWeek->Show();
        $this->NextWeek->Show();
        $this->Sunday->Show();
        $this->Monday->Show();
        $this->Tuesday->Show();
        $this->Wednesday->Show();
        $this->Thursday->Show();
        $this->Friday->Show();
        $this->Saturday->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-369BF14F
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->TimeOfDay->Errors->ToString());
        $errors = ComposeStrings($errors, $this->MondayEvents->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SundayEvents->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TuesdayEvents->Errors->ToString());
        $errors = ComposeStrings($errors, $this->WednesdayEvents->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ThursdayEvents->Errors->ToString());
        $errors = ComposeStrings($errors, $this->FridayEvents->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SaturdayEvents->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End Cal Class @2-FCB6E20C

class clsCalendar_WeekViewCalDataSource extends clsDBConnection1 {  //CalDataSource Class @2-D955D382

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

//DataSourceClass_Initialize Event @2-7880263B
    function clsCalendar_WeekViewCalDataSource(& $Parent)
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

//Prepare Method @2-9030DB38
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "expr8", ccsText, "", "", $this->Parameters["expr8"], "", false);
        $this->wp->AddParameter("2", "expr9", ccsText, "", "", $this->Parameters["expr9"], "", false);
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

//Include Page implementation @33-3D0083C6
include_once(RelativePath . "/Calendar/Calendar_Select.php");
//End Include Page implementation

class clsCalendar_WeekView { //Calendar_WeekView class @1-BC202F28

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

//Class_Initialize Event @1-AB69C1D6
    function clsCalendar_WeekView($RelativePath, $ComponentName, & $Parent)
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = $ComponentName;
        $this->RelativePath = $RelativePath;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->FileName = "Calendar_WeekView.php";
        $this->Redirect = "";
        $this->TemplateFileName = "Calendar_WeekView.html";
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

//BindEvents Method @1-B7E8EC85
    function BindEvents()
    {
        $this->Cal->Sunday->CCSEvents["BeforeShow"] = "Calendar_WeekView_Cal_Sunday_BeforeShow";
        $this->Cal->Monday->CCSEvents["BeforeShow"] = "Calendar_WeekView_Cal_Monday_BeforeShow";
        $this->Cal->Tuesday->CCSEvents["BeforeShow"] = "Calendar_WeekView_Cal_Tuesday_BeforeShow";
        $this->Cal->Wednesday->CCSEvents["BeforeShow"] = "Calendar_WeekView_Cal_Wednesday_BeforeShow";
        $this->Cal->Thursday->CCSEvents["BeforeShow"] = "Calendar_WeekView_Cal_Thursday_BeforeShow";
        $this->Cal->Friday->CCSEvents["BeforeShow"] = "Calendar_WeekView_Cal_Friday_BeforeShow";
        $this->Cal->Saturday->CCSEvents["BeforeShow"] = "Calendar_WeekView_Cal_Saturday_BeforeShow";
        $this->Cal->CCSEvents["BeforeShowRow"] = "Calendar_WeekView_Cal_BeforeShowRow";
        $this->Cal->ds->CCSEvents["BeforeBuildSelect"] = "Calendar_WeekView_Cal_ds_BeforeBuildSelect";
        $this->CCSEvents["BeforeShow"] = "Calendar_WeekView_BeforeShow";
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

//Initialize Method @1-275BFBD4
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
        $this->Cal = new clsGridCalendar_WeekViewCal($this->RelativePath, $this);
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

} //End Calendar_WeekView Class @1-FCB6E20C

//Include Event File @1-C95892A8
include_once(RelativePath . "/Calendar/Calendar_WeekView_events.php");
//End Include Event File


?>
