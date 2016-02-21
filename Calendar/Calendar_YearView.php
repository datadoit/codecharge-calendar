<?php

//Include Common Files @1-D70D2CC7
include_once(RelativePath . "/CalendarNavigator.php");
//End Include Common Files

//Year clsEvent @2-3FF523B2
class clsEventCalendar_YearViewYear {
    public $_Time;
    public $EventTime;
    public $EventDescription;

}
//End Year clsEvent

class clsCalendarCalendar_YearViewYear { //Year Class @2-FF00AFC5

//Year Variables @2-E247CE17

    public $ComponentType = "Calendar";
    public $ComponentName;
    public $Visible;
    public $Errors;
    public $DataSource;
    public $ds;
    public $Type;
    //Calendar variables
    public $CurrentDate;
    public $CurrentProcessingDate;
    public $NextProcessingDate;
    public $PrevProcessingDate;
    public $CalendarStyles = array();
    public $CurrentStyle;
    public $FirstWeekDay;
    public $Now;
    public $IsCurrentMonth;
    public $MonthsInRow;
    public $CCSEvents = array();
    public $CCSEventResult;
    public $Parent;
    public $StartDate;
    public $EndDate;
    public $MonthsCount;
    public $FirstProcessingDate;
    public $LastProcessingDate;
    public $Attributes;
//End Year Variables

//Year Class_Initialize Event @2-DA916F0B
    function clsCalendarCalendar_YearViewYear($RelativePath, & $Parent) {
        global $CCSLocales;
        global $DefaultDateFormat;
        global $FileName;
        global $Redirect;
        $this->ComponentName = "Year";
        $this->Type = "12";
        $this->Visible = True;
        $this->RelativePath = $RelativePath;
        $this->Parent = & $Parent;
        $this->Errors = new clsErrors();
        $CCSForm = CCGetFromGet("ccsForm", "");
        if ($CCSForm == $this->ComponentName) {
            $Redirect = FileName . "?" .  CCGetQueryString("All", array("ccsForm"));
            $this->Visible = false;
            return;
        }
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsCalendar_YearViewYearDataSource($this);
        $this->ds = & $this->DataSource;
        $this->FirstWeekDay = $CCSLocales->GetFormatInfo("FirstWeekDay");
        $this->MonthsInRow = 4;
        $this->MonthsCount = 12;


        $this->DayOfWeek = new clsControl(ccsLink, "DayOfWeek", "DayOfWeek", ccsDate, array("wi"), CCGetRequestParam("DayOfWeek", ccsGet, NULL), $this);
        $this->DayOfWeek->Page = "";
        $this->MonthDate = new clsControl(ccsLink, "MonthDate", "MonthDate", ccsDate, array("mmmm"), CCGetRequestParam("MonthDate", ccsGet, NULL), $this);
        $this->MonthDate->Page = "";
        $this->DayNumber = new clsControl(ccsLink, "DayNumber", "DayNumber", ccsDate, array("d"), CCGetRequestParam("DayNumber", ccsGet, NULL), $this);
        $this->DayNumber->Page = "";
        $this->EventTime = new clsControl(ccsLabel, "EventTime", "EventTime", ccsDate, array("HH", ":", "nn"), CCGetRequestParam("EventTime", ccsGet, NULL), $this);
        $this->EventDescription = new clsControl(ccsLabel, "EventDescription", "EventDescription", ccsText, "", CCGetRequestParam("EventDescription", ccsGet, NULL), $this);
        $this->Navigator = new clsCalendarNavigator($this->ComponentName, "Navigator", $this->Type, 10, $this);
        $this->Now = CCGetDateArray();
        $this->CalendarStyles["WeekdayName"] = "class=\"CalendarWeekdayName\"";
        $this->CalendarStyles["WeekendName"] = "class=\"CalendarWeekendName\"";
        $this->CalendarStyles["Day"] = "class=\"CalendarDay\"";
        $this->CalendarStyles["Weekend"] = "class=\"CalendarWeekend\"";
        $this->CalendarStyles["Today"] = "class=\"CalendarToday\"";
        $this->CalendarStyles["WeekendToday"] = "class=\"CalendarWeekendToday\"";
        $this->CalendarStyles["OtherMonthDay"] = "class=\"CalendarOtherMonthDay\"";
        $this->CalendarStyles["OtherMonthToday"] = "class=\"CalendarOtherMonthToday\"";
        $this->CalendarStyles["OtherMonthWeekend"] = "class=\"CalendarOtherMonthWeekend\"";
        $this->CalendarStyles["OtherMonthWeekendToday"] = "class=\"CalendarOtherMonthWeekendToday\"";
    }
//End Year Class_Initialize Event

//Initialize Method @2-24A58114
    function Initialize()
    {
        if(!$this->Visible) return;
        $this->DataSource->SetOrder("", "");
        $this->CurrentDate = $this->Now;
        if ($FullDate = CCGetFromGet($this->ComponentName . "Date", "")) {
            @list($year,$month) = split("-", $FullDate, 2);
        } else {
            $year = CCGetFromGet($this->ComponentName . "Year", "");
            $month = CCGetFromGet($this->ComponentName . "Month", "");
        }
        if (is_numeric($year) &&  $year >=101 && $year <=9999)
            $this->CurrentDate[ccsYear] = $year;
        if (is_numeric($month) &&  $month >=1 && $month <=12)
            $this->CurrentDate[ccsMonth] = $month;
        $this->CurrentDate[ccsDay] = 1;
        $this->CalculateCalendarPeriod();
    }
//End Initialize Method

//Show Method @2-FFB039FD
    function Show () {
        global $Tpl;
        global $CCSLocales;
        global $DefaultDateFormat;
        if(!$this->Visible) return;

        $this->CalculateCalendarPeriod();
        $this->DataSource->Parameters["urlc"] = CCGetFromGet("c", NULL);
        $this->DataSource->Parameters["cal3"] = array($this->StartDate, $this->EndDate);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->DataSource->Prepare();
        $this->DataSource->Open();

        while ($this->DataSource->next_record()) {
            $DateField = CCParseDate($this->DataSource->f("calendar_item_start"), $this->DataSource->DateFormat);
            if (!is_array($DateField)) continue;
            if (CCCompareValues($DateField, $this->StartDate, ccsDate) >= 0 && CCCompareValues($DateField, $this->EndDate , ccsDate) <= 0) {
                $this->DataSource->SetValues();
                $Event = new clsEventCalendar_YearViewYear();
                $Event->_Time = $DateField;
                $this->DayOfWeek->SetValue($this->CurrentProcessingDate);
                $this->DayOfWeek->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->DayOfWeek->Parameters = CCAddParam($this->DayOfWeek->Parameters, "v", "Week");
                $this->MonthDate->SetValue($this->CurrentProcessingDate);
                $this->MonthDate->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->MonthDate->Parameters = CCAddParam($this->MonthDate->Parameters, "v", "Month");
                $this->DayNumber->SetValue($this->CurrentProcessingDate);
                $this->DayNumber->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->DayNumber->Parameters = CCAddParam($this->DayNumber->Parameters, "v", "Day");
                $Event->DayOfWeek = $this->DataSource->DayOfWeek->GetValue();
                $Event->MonthDate = $this->DataSource->MonthDate->GetValue();
                $Event->DayNumber = $this->DataSource->DayNumber->GetValue();
                $Event->EventTime = $this->DataSource->EventTime->GetValue();
                $Event->EventDescription = $this->DataSource->EventDescription->GetValue();
                $Event->Attributes = $this->Attributes->GetAsArray();
                $datestr = CCFormatDate($DateField, array("yyyy","mm","dd"));
                if(!isset($this->Events[$datestr])) $this->Events[$datestr] = array();
                $this->Events[$datestr][] = $Event;
            }
        }

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) return;
        $this->Attributes->Show();

        $CalendarBlock = "Calendar " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $CalendarBlock;
        $this->Errors->AddErrors($this->DataSource->Errors);
        if($this->Errors->Count()) {
            $Tpl->replaceblock("", $this->Errors->ToString());
            $Tpl->block_path = $ParentPath;
            return;
        } else {
            $month = 0;
            $this->CurrentProcessingDate = $this->FirstProcessingDate;
            $this->NextProcessingDate = CCDateAdd($this->CurrentProcessingDate, "1month");
            $this->PrevProcessingDate = CCDateAdd($this->CurrentProcessingDate, "-1month");
            $Tpl->block_path = $ParentPath . "/" . $CalendarBlock . "/Month";
            while ($this->MonthsCount > $month++) {
                $this->ShowMonth();
                if(($this->MonthsCount != $month) && ($month % $this->MonthsInRow == 0)) {
                    $this->Attributes->Show();
                    $Tpl->SetVar("MonthsInRow", $this->MonthsInRow);
                    $Tpl->block_path = $ParentPath . "/" . $CalendarBlock;
                    $Tpl->ParseTo("MonthsRowSeparator", true, "Month");
                    $Tpl->block_path = $ParentPath . "/" . $CalendarBlock . "/Month";
                }
                $Tpl->SetBlockVar("Week", "");
                $Tpl->SetBlockVar("Week/Day", "");
                $this->ProcessNextDate(CCDateAdd($this->NextProcessingDate, "+1month"));
            }
            $this->CurrentProcessingDate = $this->FirstProcessingDate;
            $this->NextProcessingDate = CCDateAdd($this->CurrentProcessingDate, "1year");
            $this->PrevProcessingDate = CCDateAdd($this->CurrentProcessingDate, "-1year");
            $Tpl->SetVar("MonthsInRow", $this->MonthsInRow);
            $Tpl->block_path = $ParentPath . "/" . $CalendarBlock;
            $this->Navigator->CurrentDate = $this->CurrentDate;
            $this->Navigator->PrevProcessingDate = $this->PrevProcessingDate;
            $this->Navigator->NextProcessingDate = $this->NextProcessingDate;
            $this->Navigator->Show();
            $Tpl->Parse();
        }
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

//Year ShowMonth Method @2-66770A2B
    function ShowMonth () {
        global $Tpl;
        global $CCSLocales;
        global $DefaultDateFormat;
        $ParentPath = $Tpl->block_path;
        $OldCurrentProcessingDate = $this->CurrentProcessingDate;
        $OldNextProcessingDate = $this->NextProcessingDate;
        $OldPrevProcessingDate = $this->PrevProcessingDate;
        $FirstMonthDate = CCParseDate(CCFormatDate($this->CurrentProcessingDate, array("yyyy", "-", "mm","-01 00:00:00")), array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        $LastMonthDate = CCDateAdd($FirstMonthDate, "+1month -1second");
        $Days = (CCFormatDate($FirstMonthDate, array("w")) - $this->FirstWeekDay + 6) % 7;
        $FirstShowedDate = CCDateAdd($FirstMonthDate, "-" . $Days . "day");
        $Days += $LastMonthDate[ccsDay];
        $Days += ($this->FirstWeekDay  - CCFormatDate($LastMonthDate, array("w")) + 7) % 7;
        $this->CurrentProcessingDate =  $FirstShowedDate;
        $this->PrevProcessingDate =  CCDateAdd($FirstShowedDate, "-1day");
        $this->NextProcessingDate =  CCDateAdd($FirstShowedDate, "+1day");
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowMonth", $this);
        $this->Attributes->Show();
        $ShowedDays = 0;
        $WeekDay = CCFormatDate($this->CurrentProcessingDate, array("w"));
        while($ShowedDays < $Days) {
            if ($ShowedDays && $ShowedDays % 7 == 0){
                $Tpl->block_path = $ParentPath . "/WeekSeparator";
                $this->Attributes->Show();
                $Tpl->SetVar("MonthsInRow", $this->MonthsInRow);
                $Tpl->block_path = $ParentPath;
                $Tpl->ParseTo("WeekSeparator", true, "Week");
            }
            if ($ShowedDays % 7 == 0) {
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowWeek", $this);
                $this->Attributes->Show();
            }
            $this->IsCurrentMonth = $this->CurrentProcessingDate[ccsMonth] == $OldCurrentProcessingDate[ccsMonth];
            $this->SetCurrentStyle("Day", $WeekDay);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowDay", $this);
            $this->Attributes->Show();
            if ($this->IsCurrentMonth) {
                $datestr = CCFormatDate($this->CurrentProcessingDate, array("yyyy","mm","dd"));
                $Tpl->block_path = $ParentPath . "/Week/Day/EventRow";
                $Tpl->SetBlockVar("", "");
                if (isset($this->Events[$datestr])) {
                    uasort($this->Events[$datestr], array($this, "CompareEventTime"));
                    foreach ($this->Events[$datestr] as $key=>$event) {
                        $Tpl->block_path = $ParentPath . "/Week/Day/EventRow";
                        $this->Attributes->AddFromArray($this->Events[$datestr][$key]->Attributes);
                        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowEvent", $this);
                        $this->DayOfWeek->SetValue($event->DayOfWeek);
                        $this->MonthDate->SetValue($event->MonthDate);
                        $this->DayNumber->SetValue($event->DayNumber);
                        $this->EventTime->SetValue($event->EventTime);
                        $this->EventDescription->SetValue($event->EventDescription);
                        $this->EventTime->Show();
                        $this->EventDescription->Show();
                        $this->Attributes->Show();
                        $Tpl->Parse("", true);
                    }
                } else {
                }
                $Tpl->block_path = $ParentPath . "/Week/Day";
                $this->DayNumber->SetValue($this->CurrentProcessingDate);
                $this->DayNumber->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->DayNumber->Parameters = CCAddParam($this->DayNumber->Parameters, "v", "Day");
                $this->DayNumber->Parameters = CCAddParam($this->DayNumber->Parameters, "CalDate", CCFormatDate($this->CurrentProcessingDate, array("yyyy", "-", "mm")));
                $this->DayNumber->Parameters = CCAddParam($this->DayNumber->Parameters, "DayNum", CCFormatDate($this->PrevProcessingDate, array("y")));
                $this->DayNumber->Show();
                $this->Attributes->Show();
                $Tpl->SetVar("Style", $this->CurrentStyle);
                $Tpl->Parse("", true);
            } else {
                $Tpl->block_path = $ParentPath . "/Week/EmptyDay";
                $this->Attributes->Show();
                $Tpl->block_path = $ParentPath . "/Week";
                $Tpl->SetVar("Style", $this->CurrentStyle);
                $Tpl->ParseTo("EmptyDay", true, "Day");
            }
            $ShowedDays++;
            if ($ShowedDays and $ShowedDays % 7 == 0) {
                $Tpl->block_path = $ParentPath . "/Week";
                $this->Attributes->Show();
                $Tpl->Parse("", true);
                $Tpl->SetBlockVar("Day", "");
            }
            $this->ProcessNextDate(CCDateAdd($this->NextProcessingDate, "+1day"));
            $WeekDay = $WeekDay == 7 ? 1 : $WeekDay + 1;
        }
        $Tpl->block_path = $ParentPath . "/WeekDays";
        $Tpl->SetBlockVar("","");
        $WeekDay = CCFormatDate($this->CurrentProcessingDate, array("w"));
        $ShowedDays = 0;
        $this->CurrentProcessingDate =  $FirstShowedDate;
        $this->PrevProcessingDate =  CCDateAdd($FirstShowedDate, "-1day");
        $this->NextProcessingDate =  CCDateAdd($FirstShowedDate, "+1day");
        while($ShowedDays < 7) {
            $this->Attributes->Show();
            $this->DayOfWeek->SetValue($this->CurrentProcessingDate);
            $this->DayOfWeek->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DayOfWeek->Parameters = CCAddParam($this->DayOfWeek->Parameters, "v", "Week");
            $this->DayOfWeek->Parameters = CCAddParam($this->DayOfWeek->Parameters, "CalDate", CCFormatDate($this->CurrentProcessingDate, array("yyyy", "-", "mm")));
            $this->DayOfWeek->Parameters = CCAddParam($this->DayOfWeek->Parameters, "WeekNum", CCFormatDate($this->CurrentProcessingDate, array("ww")));
            $this->DayOfWeek->Show();
            $this->SetCurrentStyle("WeekDay", $WeekDay);
            $Tpl->SetVar("Style", $this->CurrentStyle);
            $Tpl->Parse("", true);
            $WeekDay = $WeekDay == 7 ? 1 : $WeekDay + 1;
            $this->ProcessNextDate(CCDateAdd($this->NextProcessingDate, "+1day"));
            $ShowedDays++;
        }
        $Tpl->block_path = $ParentPath;
        $this->CurrentProcessingDate = $OldCurrentProcessingDate;
        $this->NextProcessingDate = $OldNextProcessingDate;
        $this->PrevProcessingDate = $OldPrevProcessingDate;
        $this->MonthDate->SetValue($this->CurrentProcessingDate);
        $this->MonthDate->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->MonthDate->Parameters = CCAddParam($this->MonthDate->Parameters, "v", "Month");
        $this->MonthDate->Parameters = CCAddParam($this->MonthDate->Parameters, "CalDate", CCFormatDate($this->CurrentProcessingDate, array("yyyy", "-", "mm")));
        $this->MonthDate->Show();
        $Tpl->Parse("", true);
        $Tpl->block_path = $ParentPath;
    }
//End Year ShowMonth Method

//Year ProcessNextDate Method @2-67D24A68
    function ProcessNextDate($NewDate) {
        $this->PrevProcessingDate = $this->CurrentProcessingDate;
        $this->CurrentProcessingDate = $this->NextProcessingDate;
        $this->NextProcessingDate = $NewDate;
    }
//End Year ProcessNextDate Method

//Year CalculateCalendarPeriod Method @2-3A37EBBE
    function CalculateCalendarPeriod() {
        $this->FirstProcessingDate = CCParseDate(CCFormatDate($this->CurrentDate, array("yyyy", "-01-01 00:00:00")), array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        $Days = (CCFormatDate($this->FirstProcessingDate, array("w")) - $this->FirstWeekDay + 6) % 7;
        $this->StartDate = CCDateAdd($this->FirstProcessingDate, "-" . $Days . "day");
        $this->LastProcessingDate = CCDateAdd($this->FirstProcessingDate, "1year -1second");
        $Days = ($this->FirstWeekDay - CCFormatDate($this->LastProcessingDate, array("w")) + 7) % 7;
        $this->EndDate = CCDateAdd($this->LastProcessingDate, $Days . "day");
    }
//End Year CalculateCalendarPeriod Method

//Year SetCurrentStyle Method @2-1162C70C
    function SetCurrentStyle ($scope, $weekday="") {
        $Result="";
        switch ($scope) {
            case "WeekDay":
                if ($weekday == 1 || $weekday == 7)
                    $Result = "WeekendName";
                else
                    $Result = "WeekdayName";
                break;
            case "Day":
                $IsWeekend = $weekday == 1 || $weekday == 7;
                if (!$this->IsCurrentMonth) {
                    $Result = "OtherMonth" . ($IsWeekend ? "Weekend" : "Day");
                } else {
                    $IsCurrentDay = $this->CurrentProcessingDate[ccsYear] == $this->Now[ccsYear] &&
                        $this->CurrentProcessingDate[ccsMonth] == $this->Now[ccsMonth] &&
                        $this->CurrentProcessingDate[ccsDay] == $this->Now[ccsDay];
                    if($IsCurrentDay)
                        $Result = "Today";
                    if($IsWeekend) 
                        $Result = "Weekend" . $Result;
                    elseif (!$Result) 
                        $Result = "Day";
                }
                break;
        }
        $this->CurrentStyle = isset($this->CalendarStyles[$Result]) ? $this->CalendarStyles[$Result] : "";
    }
//End Year SetCurrentStyle Method

//Year CompareEventTime Method @2-CC40EC21
    function CompareEventTime($val1, $val2) {
        $className = "clsEventCalendar_YearViewYear";
        $time1 = ($val1 instanceof $className) && is_array($val1->_Time) ? $val1->_Time[ccsHour] * 3600 + $val1->_Time[ccsMinute] * 60 + $val1->_Time[ccsSecond] : 0;
        $time2 = ($val2 instanceof $className) && is_array($val2->_Time) ? $val2->_Time[ccsHour] * 3600 + $val2->_Time[ccsMinute] * 60 + $val2->_Time[ccsSecond] : 0;
        if ($time1 == $time2)
            return 0;
        return $time1 > $time2 ? 1 : -1;
    }
//End Year CompareEventTime Method

} //End Year Class @2-FCB6E20C

class clsCalendar_YearViewYearDataSource extends clsDBConnection1 {  //YearDataSource Class @2-63CA27FE

//DataSource Variables @2-6F443B84
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;


    // Datasource fields
    public $DayOfWeek;
    public $MonthDate;
    public $DayNumber;
    public $EventTime;
    public $EventDescription;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-B7EA343F
    function clsCalendar_YearViewYearDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "";
        $this->Initialize();
        $this->DayOfWeek = new clsField("DayOfWeek", ccsDate, $this->DateFormat);
        
        $this->MonthDate = new clsField("MonthDate", ccsDate, $this->DateFormat);
        
        $this->DayNumber = new clsField("DayNumber", ccsDate, $this->DateFormat);
        
        $this->EventTime = new clsField("EventTime", ccsDate, $this->DateFormat);
        
        $this->EventDescription = new clsField("EventDescription", ccsText, "");
        

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

//Prepare Method @2-9A555139
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlc", ccsInteger, "", "", $this->Parameters["urlc"], "", false);
        $this->wp->AddParameter("2", "cal3", ccsDate, $DefaultDateFormat, $this->DateFormat, $this->Parameters["cal3"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "calendar_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opBetween, "calendar_item_start", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsDate, true),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @2-A17ADB5C
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tbl_calendars_items {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
        $this->MoveToPage($this->AbsolutePage);
    }
//End Open Method

//SetValues Method @2-33C5B555
    function SetValues()
    {
        $this->EventTime->SetDBValue(trim($this->f("calendar_item_start")));
        $this->EventDescription->SetDBValue($this->f("calendar_item_title"));
    }
//End SetValues Method

} //End YearDataSource Class @2-FCB6E20C

//Include Page implementation @22-3D0083C6
include_once(RelativePath . "/Calendar/Calendar_Select.php");
//End Include Page implementation

class clsCalendar_YearView { //Calendar_YearView class @1-A47483FA

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

//Class_Initialize Event @1-4B9DF2C5
    function clsCalendar_YearView($RelativePath, $ComponentName, & $Parent)
    {
        include_once(RelativePath . "/CalendarNavigator.php");
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = $ComponentName;
        $this->RelativePath = $RelativePath;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->FileName = "Calendar_YearView.php";
        $this->Redirect = "";
        $this->TemplateFileName = "Calendar_YearView.html";
        $this->BlockToParse = "main";
        $this->TemplateEncoding = "UTF-8";
        $this->ContentType = "text/html";
    }
//End Class_Initialize Event

//Class_Terminate Event @1-0D213B2C
    function Class_Terminate()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
        unset($this->Year);
        $this->Calendar_Select->Class_Terminate();
        unset($this->Calendar_Select);
    }
//End Class_Terminate Event

//BindEvents Method @1-9D0FEA6C
    function BindEvents()
    {
        $this->Year->CCSEvents["BeforeShowDay"] = "Calendar_YearView_Year_BeforeShowDay";
        $this->CCSEvents["BeforeShow"] = "Calendar_YearView_BeforeShow";
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

//Initialize Method @1-96481101
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
        $this->Year = new clsCalendarCalendar_YearViewYear($this->RelativePath, $this);
        $this->Calendar_Select = new clsCalendar_Select($this->RelativePath, "Calendar_Select", $this);
        $this->Calendar_Select->Initialize();
        $this->Year->Initialize();
        $this->BindEvents();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
    }
//End Initialize Method

//Show Method @1-259854F3
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
        $this->Year->Show();
        $this->Calendar_Select->Show();
        $Tpl->Parse();
        $Tpl->block_path = $block_path;
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
        $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
    }
//End Show Method

} //End Calendar_YearView Class @1-FCB6E20C

//Include Event File @1-8106A3A6
include_once(RelativePath . "/Calendar/Calendar_YearView_events.php");
//End Include Event File


?>
