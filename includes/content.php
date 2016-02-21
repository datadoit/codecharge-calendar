<?php

//Include Page implementation @2-01ECB016
include_once(RelativePath . "/includes/login.php");
//End Include Page implementation

//Include Page implementation @4-482343C0
include_once(RelativePath . "/Calendar/Calendar_YearView.php");
//End Include Page implementation

//Include Page implementation @7-16FE2D6E
include_once(RelativePath . "/Calendar/Calendar_MonthView.php");
//End Include Page implementation

//Include Page implementation @10-F458E64E
include_once(RelativePath . "/Calendar/Calendar_WeekView.php");
//End Include Page implementation

//Include Page implementation @11-C86C9236
include_once(RelativePath . "/Calendar/Calendar_DayView.php");
//End Include Page implementation

//Include Page implementation @14-93F74EC9
include_once(RelativePath . "/Calendar/Calendar_Calendars.php");
//End Include Page implementation

//Include Page implementation @16-3547FA96
include_once(RelativePath . "/Calendar/Calendar_CalendarItems.php");
//End Include Page implementation

//Include Page implementation @20-3D64D159
include_once(RelativePath . "/Calendar/Calendar_Users.php");
//End Include Page implementation

//Include Page implementation @21-9ACB0C20
include_once(RelativePath . "/Calendar/Calendar_Settings.php");
//End Include Page implementation

class clscontent { //content class @1-AA011ECD

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

//Class_Initialize Event @1-DBB87975
    function clscontent($RelativePath, $ComponentName, & $Parent)
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = $ComponentName;
        $this->RelativePath = $RelativePath;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->FileName = "content.php";
        $this->Redirect = "";
        $this->TemplateFileName = "content.html";
        $this->BlockToParse = "main";
        $this->TemplateEncoding = "UTF-8";
        $this->ContentType = "text/html";
    }
//End Class_Initialize Event

//Class_Terminate Event @1-41783810
    function Class_Terminate()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
        $this->login->Class_Terminate();
        unset($this->login);
        $this->Calendar_YearView->Class_Terminate();
        unset($this->Calendar_YearView);
        $this->Calendar_MonthView->Class_Terminate();
        unset($this->Calendar_MonthView);
        $this->Calendar_WeekView->Class_Terminate();
        unset($this->Calendar_WeekView);
        $this->Calendar_DayView->Class_Terminate();
        unset($this->Calendar_DayView);
        $this->Calendar_Calendars->Class_Terminate();
        unset($this->Calendar_Calendars);
        $this->Calendar_CalendarItems->Class_Terminate();
        unset($this->Calendar_CalendarItems);
        $this->Calendar_Users->Class_Terminate();
        unset($this->Calendar_Users);
        $this->Calendar_Settings->Class_Terminate();
        unset($this->Calendar_Settings);
    }
//End Class_Terminate Event

//BindEvents Method @1-F5F94696
    function BindEvents()
    {
        $this->CCSEvents["BeforeShow"] = "content_BeforeShow";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInitialize", $this);
    }
//End BindEvents Method

//Operations Method @1-F7AEE843
    function Operations()
    {
        global $Redirect;
        if(!$this->Visible)
            return "";
        $this->login->Operations();
        $this->Calendar_YearView->Operations();
        $this->Calendar_MonthView->Operations();
        $this->Calendar_WeekView->Operations();
        $this->Calendar_DayView->Operations();
        $this->Calendar_Calendars->Operations();
        $this->Calendar_CalendarItems->Operations();
        $this->Calendar_Users->Operations();
        $this->Calendar_Settings->Operations();
    }
//End Operations Method

//Initialize Method @1-7E6F1BFD
    function Initialize()
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInitialize", $this);
        if(!$this->Visible)
            return "";
        $this->Attributes = & $this->Parent->Attributes;

        // Create Components
        $this->login = new clslogin($this->RelativePath, "login", $this);
        $this->login->Initialize();
        $this->Calendar_YearView = new clsCalendar_YearView($this->RelativePath . "../Calendar/", "Calendar_YearView", $this);
        $this->Calendar_YearView->Initialize();
        $this->Calendar_MonthView = new clsCalendar_MonthView($this->RelativePath . "../Calendar/", "Calendar_MonthView", $this);
        $this->Calendar_MonthView->Initialize();
        $this->Calendar_WeekView = new clsCalendar_WeekView($this->RelativePath . "../Calendar/", "Calendar_WeekView", $this);
        $this->Calendar_WeekView->Initialize();
        $this->Calendar_DayView = new clsCalendar_DayView($this->RelativePath . "../Calendar/", "Calendar_DayView", $this);
        $this->Calendar_DayView->Initialize();
        $this->Calendar_Calendars = new clsCalendar_Calendars($this->RelativePath . "../Calendar/", "Calendar_Calendars", $this);
        $this->Calendar_Calendars->Initialize();
        $this->Calendar_CalendarItems = new clsCalendar_CalendarItems($this->RelativePath . "../Calendar/", "Calendar_CalendarItems", $this);
        $this->Calendar_CalendarItems->Initialize();
        $this->Calendar_Users = new clsCalendar_Users($this->RelativePath . "../Calendar/", "Calendar_Users", $this);
        $this->Calendar_Users->Initialize();
        $this->Calendar_Settings = new clsCalendar_Settings($this->RelativePath . "../Calendar/", "Calendar_Settings", $this);
        $this->Calendar_Settings->Initialize();
        $this->BindEvents();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
    }
//End Initialize Method

//Show Method @1-39BF0841
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        $block_path = $Tpl->block_path;
        $Tpl->LoadTemplate("/includes/" . $this->TemplateFileName, $this->ComponentName, $this->TemplateEncoding, "remove");
        $Tpl->block_path = $Tpl->block_path . "/" . $this->ComponentName;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) {
            $Tpl->block_path = $block_path;
            $Tpl->SetVar($this->ComponentName, "");
            return "";
        }
        $this->Attributes->Show();
        $this->login->Show();
        $this->Calendar_YearView->Show();
        $this->Calendar_MonthView->Show();
        $this->Calendar_WeekView->Show();
        $this->Calendar_DayView->Show();
        $this->Calendar_Calendars->Show();
        $this->Calendar_CalendarItems->Show();
        $this->Calendar_Users->Show();
        $this->Calendar_Settings->Show();
        $Tpl->Parse();
        $Tpl->block_path = $block_path;
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
        $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
    }
//End Show Method

} //End content Class @1-FCB6E20C

//Include Event File @1-72478FA6
include_once(RelativePath . "/includes/content_events.php");
//End Include Event File


?>
