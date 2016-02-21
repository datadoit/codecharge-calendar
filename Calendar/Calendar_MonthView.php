<?php
//Include Common Files @1-D70D2CC7
include_once(RelativePath . "/CalendarNavigator.php");
//End Include Common Files

class clsRecordCalendar_MonthViewEventDetailRecord { //EventDetailRecord Class @36-556B4C6D

//Variables @36-9E315808

    // Public variables
    public $ComponentType = "Record";
    public $ComponentName;
    public $Parent;
    public $HTMLFormAction;
    public $PressedButton;
    public $Errors;
    public $ErrorBlock;
    public $FormSubmitted;
    public $FormEnctype;
    public $Visible;
    public $IsEmpty;

    public $CCSEvents = "";
    public $CCSEventResult;

    public $RelativePath = "";

    public $InsertAllowed = false;
    public $UpdateAllowed = false;
    public $DeleteAllowed = false;
    public $ReadAllowed   = false;
    public $EditMode      = false;
    public $ds;
    public $DataSource;
    public $ValidatingControls;
    public $Controls;
    public $Attributes;

    // Class variables
//End Variables

//Class_Initialize Event @36-42C6C222
    function clsRecordCalendar_MonthViewEventDetailRecord($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record EventDetailRecord/Error";
        $this->DataSource = new clsCalendar_MonthViewEventDetailRecordDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "EventDetailRecord";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
            $this->Button_Close = new clsButton("Button_Close", $Method, $this);
            $this->CalendarName = new clsControl(ccsLabel, "CalendarName", "CalendarName", ccsText, "", CCGetRequestParam("CalendarName", $Method, NULL), $this);
            $this->calendar_item_title = new clsControl(ccsTextBox, "calendar_item_title", "calendar_item_title", ccsText, "", CCGetRequestParam("calendar_item_title", $Method, NULL), $this);
            $this->calendar_item_description = new clsControl(ccsTextArea, "calendar_item_description", "calendar_item_description", ccsMemo, "", CCGetRequestParam("calendar_item_description", $Method, NULL), $this);
            $this->calendar_item_id = new clsControl(ccsHidden, "calendar_item_id", "calendar_item_id", ccsInteger, "", CCGetRequestParam("calendar_item_id", $Method, NULL), $this);
            $this->calendar_id = new clsControl(ccsHidden, "calendar_id", "calendar_id", ccsInteger, "", CCGetRequestParam("calendar_id", $Method, NULL), $this);
            $this->calendar_item_start = new clsControl(ccsHidden, "calendar_item_start", "calendar_item_start", ccsText, "", CCGetRequestParam("calendar_item_start", $Method, NULL), $this);
            $this->calendar_item_end = new clsControl(ccsHidden, "calendar_item_end", "calendar_item_end", ccsText, "", CCGetRequestParam("calendar_item_end", $Method, NULL), $this);
            $this->TitleLabelPanel = new clsPanel("TitleLabelPanel", $this);
            $this->TitleLabel = new clsControl(ccsLabel, "TitleLabel", "TitleLabel", ccsText, "", CCGetRequestParam("TitleLabel", $Method, NULL), $this);
            $this->StartDateTimePanel = new clsPanel("StartDateTimePanel", $this);
            $this->StartDate = new clsControl(ccsTextBox, "StartDate", "StartDate", ccsText, "", CCGetRequestParam("StartDate", $Method, NULL), $this);
            $this->DatePicker_StartDate = new clsDatePicker("DatePicker_StartDate", "EventDetailRecord", "StartDate", $this);
            $this->StartTime = new clsControl(ccsListBox, "StartTime", "StartTime", ccsText, "", CCGetRequestParam("StartTime", $Method, NULL), $this);
            $this->StartTime->DSType = dsTable;
            $this->StartTime->DataSource = new clsDBConnection1();
            $this->StartTime->ds = & $this->StartTime->DataSource;
            $this->StartTime->DataSource->SQL = "SELECT * \n" .
"FROM lu_calendars_times {SQL_Where} {SQL_OrderBy}";
            $this->StartTime->DataSource->Order = "HHiiSS";
            list($this->StartTime->BoundColumn, $this->StartTime->TextColumn, $this->StartTime->DBFormat) = array("id", "time", "");
            $this->StartTime->DataSource->Order = "HHiiSS";
            $this->EndDateTimePanel = new clsPanel("EndDateTimePanel", $this);
            $this->EndDate = new clsControl(ccsTextBox, "EndDate", "EndDate", ccsText, "", CCGetRequestParam("EndDate", $Method, NULL), $this);
            $this->DatePicker_EndDate = new clsDatePicker("DatePicker_EndDate", "EventDetailRecord", "EndDate", $this);
            $this->EndTime = new clsControl(ccsListBox, "EndTime", "EndTime", ccsText, "", CCGetRequestParam("EndTime", $Method, NULL), $this);
            $this->EndTime->DSType = dsTable;
            $this->EndTime->DataSource = new clsDBConnection1();
            $this->EndTime->ds = & $this->EndTime->DataSource;
            $this->EndTime->DataSource->SQL = "SELECT * \n" .
"FROM lu_calendars_times {SQL_Where} {SQL_OrderBy}";
            $this->EndTime->DataSource->Order = "HHiiSS";
            list($this->EndTime->BoundColumn, $this->EndTime->TextColumn, $this->EndTime->DBFormat) = array("id", "time", "");
            $this->EndTime->DataSource->Order = "HHiiSS";
            $this->StartDateTimeLabelPanel = new clsPanel("StartDateTimeLabelPanel", $this);
            $this->StartDateTimeLabel = new clsControl(ccsLabel, "StartDateTimeLabel", "StartDateTimeLabel", ccsText, "", CCGetRequestParam("StartDateTimeLabel", $Method, NULL), $this);
            $this->EndDateTimeLabelPanel = new clsPanel("EndDateTimeLabelPanel", $this);
            $this->EndDateTimeLabel = new clsControl(ccsLabel, "EndDateTimeLabel", "EndDateTimeLabel", ccsText, "", CCGetRequestParam("EndDateTimeLabel", $Method, NULL), $this);
            $this->DescriptionLabelPanel = new clsPanel("DescriptionLabelPanel", $this);
            $this->DescriptionLabel = new clsControl(ccsLabel, "DescriptionLabel", "DescriptionLabel", ccsText, "", CCGetRequestParam("DescriptionLabel", $Method, NULL), $this);
            $this->DescriptionLabel->HTML = true;
            $this->TitleLabelPanel->AddComponent("TitleLabel", $this->TitleLabel);
            $this->StartDateTimePanel->AddComponent("DatePicker_StartDate", $this->DatePicker_StartDate);
            $this->StartDateTimePanel->AddComponent("StartTime", $this->StartTime);
            $this->StartDateTimePanel->AddComponent("StartDate", $this->StartDate);
            $this->EndDateTimePanel->AddComponent("DatePicker_EndDate", $this->DatePicker_EndDate);
            $this->EndDateTimePanel->AddComponent("EndTime", $this->EndTime);
            $this->EndDateTimePanel->AddComponent("EndDate", $this->EndDate);
            $this->StartDateTimeLabelPanel->AddComponent("StartDateTimeLabel", $this->StartDateTimeLabel);
            $this->EndDateTimeLabelPanel->AddComponent("EndDateTimeLabel", $this->EndDateTimeLabel);
            $this->DescriptionLabelPanel->AddComponent("DescriptionLabel", $this->DescriptionLabel);
        }
    }
//End Class_Initialize Event

//Initialize Method @36-5D060BAC
    function Initialize()
    {

        if(!$this->Visible)
            return;

    }
//End Initialize Method

//Validate Method @36-6C47F94C
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        if(! (CCStrLen($this->StartTime->GetText()) > 0)) {
            $this->StartTime->Errors->addError($CCSLocales->GetText("CRM_ErrorChooseStartTime"));
        }
        if(! (CCStrLen($this->EndTime->GetText()) > 0)) {
            $this->EndTime->Errors->addError($CCSLocales->GetText("CRM_ErrorChooseEndTime"));
        }
        $Validation = ($this->calendar_item_title->Validate() && $Validation);
        $Validation = ($this->calendar_item_description->Validate() && $Validation);
        $Validation = ($this->calendar_item_id->Validate() && $Validation);
        $Validation = ($this->calendar_id->Validate() && $Validation);
        $Validation = ($this->calendar_item_start->Validate() && $Validation);
        $Validation = ($this->calendar_item_end->Validate() && $Validation);
        $Validation = ($this->StartDate->Validate() && $Validation);
        $Validation = ($this->StartTime->Validate() && $Validation);
        $Validation = ($this->EndDate->Validate() && $Validation);
        $Validation = ($this->EndTime->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->calendar_item_title->Errors->Count() == 0);
        $Validation =  $Validation && ($this->calendar_item_description->Errors->Count() == 0);
        $Validation =  $Validation && ($this->calendar_item_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->calendar_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->calendar_item_start->Errors->Count() == 0);
        $Validation =  $Validation && ($this->calendar_item_end->Errors->Count() == 0);
        $Validation =  $Validation && ($this->StartDate->Errors->Count() == 0);
        $Validation =  $Validation && ($this->StartTime->Errors->Count() == 0);
        $Validation =  $Validation && ($this->EndDate->Errors->Count() == 0);
        $Validation =  $Validation && ($this->EndTime->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @36-50D3AB90
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->CalendarName->Errors->Count());
        $errors = ($errors || $this->calendar_item_title->Errors->Count());
        $errors = ($errors || $this->calendar_item_description->Errors->Count());
        $errors = ($errors || $this->calendar_item_id->Errors->Count());
        $errors = ($errors || $this->calendar_id->Errors->Count());
        $errors = ($errors || $this->calendar_item_start->Errors->Count());
        $errors = ($errors || $this->calendar_item_end->Errors->Count());
        $errors = ($errors || $this->TitleLabel->Errors->Count());
        $errors = ($errors || $this->StartDate->Errors->Count());
        $errors = ($errors || $this->DatePicker_StartDate->Errors->Count());
        $errors = ($errors || $this->StartTime->Errors->Count());
        $errors = ($errors || $this->EndDate->Errors->Count());
        $errors = ($errors || $this->DatePicker_EndDate->Errors->Count());
        $errors = ($errors || $this->EndTime->Errors->Count());
        $errors = ($errors || $this->StartDateTimeLabel->Errors->Count());
        $errors = ($errors || $this->EndDateTimeLabel->Errors->Count());
        $errors = ($errors || $this->DescriptionLabel->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @36-ED598703
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

//Operation Method @36-1CF5BCCD
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted) {
            $this->EditMode = true;
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            } else if($this->Button_Close->Pressed) {
                $this->PressedButton = "Button_Close";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Close") {
            if(!CCGetEvent($this->Button_Close->CCSEvents, "OnClick", $this->Button_Close)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//InsertRow Method @36-C81FFFE8
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->CalendarName->SetValue($this->CalendarName->GetValue(true));
        $this->DataSource->calendar_item_title->SetValue($this->calendar_item_title->GetValue(true));
        $this->DataSource->calendar_item_description->SetValue($this->calendar_item_description->GetValue(true));
        $this->DataSource->calendar_item_id->SetValue($this->calendar_item_id->GetValue(true));
        $this->DataSource->calendar_id->SetValue($this->calendar_id->GetValue(true));
        $this->DataSource->calendar_item_start->SetValue($this->calendar_item_start->GetValue(true));
        $this->DataSource->calendar_item_end->SetValue($this->calendar_item_end->GetValue(true));
        $this->DataSource->TitleLabel->SetValue($this->TitleLabel->GetValue(true));
        $this->DataSource->StartDate->SetValue($this->StartDate->GetValue(true));
        $this->DataSource->StartTime->SetValue($this->StartTime->GetValue(true));
        $this->DataSource->EndDate->SetValue($this->EndDate->GetValue(true));
        $this->DataSource->EndTime->SetValue($this->EndTime->GetValue(true));
        $this->DataSource->StartDateTimeLabel->SetValue($this->StartDateTimeLabel->GetValue(true));
        $this->DataSource->EndDateTimeLabel->SetValue($this->EndDateTimeLabel->GetValue(true));
        $this->DataSource->DescriptionLabel->SetValue($this->DescriptionLabel->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//Show Method @36-FEB1D246
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

        $this->StartTime->Prepare();
        $this->EndTime->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if($this->EditMode) {
            if($this->DataSource->Errors->Count()){
                $this->Errors->AddErrors($this->DataSource->Errors);
                $this->DataSource->Errors->clear();
            }
            $this->DataSource->Open();
            if($this->DataSource->Errors->Count() == 0 && $this->DataSource->next_record()) {
                $this->DataSource->SetValues();
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->CalendarName->Errors->ToString());
            $Error = ComposeStrings($Error, $this->calendar_item_title->Errors->ToString());
            $Error = ComposeStrings($Error, $this->calendar_item_description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->calendar_item_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->calendar_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->calendar_item_start->Errors->ToString());
            $Error = ComposeStrings($Error, $this->calendar_item_end->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TitleLabel->Errors->ToString());
            $Error = ComposeStrings($Error, $this->StartDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_StartDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->StartTime->Errors->ToString());
            $Error = ComposeStrings($Error, $this->EndDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_EndDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->EndTime->Errors->ToString());
            $Error = ComposeStrings($Error, $this->StartDateTimeLabel->Errors->ToString());
            $Error = ComposeStrings($Error, $this->EndDateTimeLabel->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DescriptionLabel->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);
        $this->Button_Insert->Visible = !$this->EditMode && $this->InsertAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Insert->Show();
        $this->Button_Close->Show();
        $this->CalendarName->Show();
        $this->calendar_item_title->Show();
        $this->calendar_item_description->Show();
        $this->calendar_item_id->Show();
        $this->calendar_id->Show();
        $this->calendar_item_start->Show();
        $this->calendar_item_end->Show();
        $this->TitleLabelPanel->Show();
        $this->StartDateTimePanel->Show();
        $this->EndDateTimePanel->Show();
        $this->StartDateTimeLabelPanel->Show();
        $this->EndDateTimeLabelPanel->Show();
        $this->DescriptionLabelPanel->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End EventDetailRecord Class @36-FCB6E20C

class clsCalendar_MonthViewEventDetailRecordDataSource extends clsDBConnection1 {  //EventDetailRecordDataSource Class @36-C5855619

//DataSource Variables @36-C71811F9
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $InsertParameters;
    public $wp;
    public $AllParametersSet;

    public $InsertFields = array();

    // Datasource fields
    public $CalendarName;
    public $calendar_item_title;
    public $calendar_item_description;
    public $calendar_item_id;
    public $calendar_id;
    public $calendar_item_start;
    public $calendar_item_end;
    public $TitleLabel;
    public $StartDate;
    public $StartTime;
    public $EndDate;
    public $EndTime;
    public $StartDateTimeLabel;
    public $EndDateTimeLabel;
    public $DescriptionLabel;
//End DataSource Variables

//DataSourceClass_Initialize Event @36-760ACC34
    function clsCalendar_MonthViewEventDetailRecordDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record EventDetailRecord/Error";
        $this->Initialize();
        $this->CalendarName = new clsField("CalendarName", ccsText, "");
        
        $this->calendar_item_title = new clsField("calendar_item_title", ccsText, "");
        
        $this->calendar_item_description = new clsField("calendar_item_description", ccsMemo, "");
        
        $this->calendar_item_id = new clsField("calendar_item_id", ccsInteger, "");
        
        $this->calendar_id = new clsField("calendar_id", ccsInteger, "");
        
        $this->calendar_item_start = new clsField("calendar_item_start", ccsText, "");
        
        $this->calendar_item_end = new clsField("calendar_item_end", ccsText, "");
        
        $this->TitleLabel = new clsField("TitleLabel", ccsText, "");
        
        $this->StartDate = new clsField("StartDate", ccsText, "");
        
        $this->StartTime = new clsField("StartTime", ccsText, "");
        
        $this->EndDate = new clsField("EndDate", ccsText, "");
        
        $this->EndTime = new clsField("EndTime", ccsText, "");
        
        $this->StartDateTimeLabel = new clsField("StartDateTimeLabel", ccsText, "");
        
        $this->EndDateTimeLabel = new clsField("EndDateTimeLabel", ccsText, "");
        
        $this->DescriptionLabel = new clsField("DescriptionLabel", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @36-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @36-B739B77D
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tbl_calendars_items {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @36-BAF0975B
    function SetValues()
    {
    }
//End SetValues Method

//Insert Method @36-4858FFE4
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->SQL = CCBuildInsert("tbl_calendars_items", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

} //End EventDetailRecordDataSource Class @36-FCB6E20C

//Include Page implementation @23-3D0083C6
include_once(RelativePath . "/Calendar/Calendar_Select.php");
//End Include Page implementation

//Cal clsEvent @2-98D6FD9B
class clsEventCalendar_MonthViewCal {
    public $_Time;
    public $calendar_item_id;
    public $calendar_item_start;
    public $calendar_item_end;
    public $calendar_item_title;
    public $calendar_item_description;
    public $EventPanel;
    public $EventLink;
    public $_EventLinkPage;
    public $_EventLinkParameters;

}
//End Cal clsEvent

class clsCalendarCalendar_MonthViewCal { //Cal Class @2-E326C244

//Cal Variables @2-E247CE17

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
//End Cal Variables

//Cal Class_Initialize Event @2-CF0F1F0B
    function clsCalendarCalendar_MonthViewCal($RelativePath, & $Parent) {
        global $CCSLocales;
        global $DefaultDateFormat;
        global $FileName;
        global $Redirect;
        $this->ComponentName = "Cal";
        $this->Type = "1";
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
        $this->DataSource = new clsCalendar_MonthViewCalDataSource($this);
        $this->ds = & $this->DataSource;
        $this->FirstWeekDay = $CCSLocales->GetFormatInfo("FirstWeekDay");
        $this->MonthsInRow = 1;
        $this->MonthsCount = 1;


        $this->DayOfWeek = new clsControl(ccsLink, "DayOfWeek", "DayOfWeek", ccsDate, array("dddd"), CCGetRequestParam("DayOfWeek", ccsGet, NULL), $this);
        $this->DayOfWeek->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->DayOfWeek->Page = "";
        $this->DayNumber = new clsControl(ccsLink, "DayNumber", "DayNumber", ccsDate, array("d"), CCGetRequestParam("DayNumber", ccsGet, NULL), $this);
        $this->DayNumber->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->DayNumber->Page = "";
        $this->Navigator = new clsCalendarNavigator($this->ComponentName, "Navigator", $this->Type, 10, $this);
        $this->calendar_item_id = new clsControl(ccsHidden, "calendar_item_id", "calendar_item_id", ccsInteger, "", CCGetRequestParam("calendar_item_id", ccsGet, NULL), $this);
        $this->calendar_item_start = new clsControl(ccsHidden, "calendar_item_start", "calendar_item_start", ccsDate, $DefaultDateFormat, CCGetRequestParam("calendar_item_start", ccsGet, NULL), $this);
        $this->calendar_item_end = new clsControl(ccsHidden, "calendar_item_end", "calendar_item_end", ccsText, "", CCGetRequestParam("calendar_item_end", ccsGet, NULL), $this);
        $this->calendar_item_title = new clsControl(ccsHidden, "calendar_item_title", "calendar_item_title", ccsText, "", CCGetRequestParam("calendar_item_title", ccsGet, NULL), $this);
        $this->calendar_item_description = new clsControl(ccsHidden, "calendar_item_description", "calendar_item_description", ccsText, "", CCGetRequestParam("calendar_item_description", ccsGet, NULL), $this);
        $this->EventPanel = new clsPanel("EventPanel", $this);
        $this->EventLink = new clsControl(ccsLink, "EventLink", "EventLink", ccsText, "", CCGetRequestParam("EventLink", ccsGet, NULL), $this);
        $this->EventLink->Page = "modal";
        $this->EventPanel->AddComponent("EventLink", $this->EventLink);
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
//End Cal Class_Initialize Event

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

//Show Method @2-74A60DB5
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
                $Event = new clsEventCalendar_MonthViewCal();
                $Event->_Time = $DateField;
                $this->EventLink->Parameters = "";
                $this->EventLink->Parameters = CCAddParam($this->EventLink->Parameters, "id", $this->DataSource->f("calendar_item_id"));
                $Event->calendar_item_id = $this->DataSource->calendar_item_id->GetValue();
                $Event->calendar_item_start = $this->DataSource->calendar_item_start->GetValue();
                $Event->calendar_item_end = $this->DataSource->calendar_item_end->GetValue();
                $Event->calendar_item_title = $this->DataSource->calendar_item_title->GetValue();
                $Event->calendar_item_description = $this->DataSource->calendar_item_description->GetValue();
                $Event->EventLink = $this->DataSource->EventLink->GetValue();
                $Event->_EventLinkPage = $this->EventLink->Page;
                $Event->_EventLinkParameters = $this->EventLink->Parameters;
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
            $this->NextProcessingDate = CCDateAdd($this->CurrentProcessingDate, "1month");
            $this->PrevProcessingDate = CCDateAdd($this->CurrentProcessingDate, "-1month");
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

//Cal ShowMonth Method @2-1638C851
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
            $datestr = CCFormatDate($this->CurrentProcessingDate, array("yyyy","mm","dd"));
            $Tpl->block_path = $ParentPath . "/Week/Day/EventRow";
            $Tpl->SetBlockVar("", "");
            if (isset($this->Events[$datestr])) {
                uasort($this->Events[$datestr], array($this, "CompareEventTime"));
                foreach ($this->Events[$datestr] as $key=>$event) {
                    $Tpl->block_path = $ParentPath . "/Week/Day/EventRow";
                    $this->Attributes->AddFromArray($this->Events[$datestr][$key]->Attributes);
                    $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowEvent", $this);
                    $this->EventLink->Page = $event->_EventLinkPage;
                    $this->EventLink->Parameters = $event->_EventLinkParameters;
                    $this->calendar_item_id->SetValue($event->calendar_item_id);
                    $this->calendar_item_start->SetValue($event->calendar_item_start);
                    $this->calendar_item_end->SetValue($event->calendar_item_end);
                    $this->calendar_item_title->SetValue($event->calendar_item_title);
                    $this->calendar_item_description->SetValue($event->calendar_item_description);
                    $this->EventLink->SetValue($event->EventLink);
                    $this->calendar_item_id->Show();
                    $this->calendar_item_start->Show();
                    $this->calendar_item_end->Show();
                    $this->calendar_item_title->Show();
                    $this->calendar_item_description->Show();
                    $this->EventPanel->Show();
                    $this->Attributes->Show();
                    $Tpl->Parse("", true);
                }
            } else {
            }
            $Tpl->block_path = $ParentPath . "/Week/Day";
            $this->DayNumber->SetValue($this->CurrentProcessingDate);
            $this->DayNumber->Show();
            $this->Attributes->Show();
            $Tpl->SetVar("Style", $this->CurrentStyle);
            $Tpl->Parse("", true);
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
        $Tpl->Parse("", true);
        $Tpl->block_path = $ParentPath;
    }
//End Cal ShowMonth Method

//Cal ProcessNextDate Method @2-67D24A68
    function ProcessNextDate($NewDate) {
        $this->PrevProcessingDate = $this->CurrentProcessingDate;
        $this->CurrentProcessingDate = $this->NextProcessingDate;
        $this->NextProcessingDate = $NewDate;
    }
//End Cal ProcessNextDate Method

//Cal CalculateCalendarPeriod Method @2-8917C348
    function CalculateCalendarPeriod() {
        $this->FirstProcessingDate = CCParseDate(CCFormatDate($this->CurrentDate, array("yyyy","-","mm","-01 00:00:00")), array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        $Days = (CCFormatDate($this->FirstProcessingDate, array("w")) - $this->FirstWeekDay + 6) % 7;
        $this->StartDate = CCDateAdd($this->FirstProcessingDate, "-" . $Days . "day");
        $this->LastProcessingDate = CCDateAdd($this->FirstProcessingDate, "1month -1second");
        $Days = ($this->FirstWeekDay - CCFormatDate($this->LastProcessingDate, array("w")) + 7) % 7;
        $this->EndDate = CCDateAdd($this->LastProcessingDate, $Days . "day");
    }
//End Cal CalculateCalendarPeriod Method

//Cal SetCurrentStyle Method @2-FDD58228
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
                $IsCurrentDay = $this->CurrentProcessingDate[ccsYear] == $this->Now[ccsYear] &&
                    $this->CurrentProcessingDate[ccsMonth] == $this->Now[ccsMonth] &&
                    $this->CurrentProcessingDate[ccsDay] == $this->Now[ccsDay];
                if($IsCurrentDay)
                    $Result = "Today";
                if($IsWeekend) 
                    $Result = "Weekend" . $Result;
                elseif (!$Result) 
                    $Result = "Day";
                if (!$this->IsCurrentMonth)
                    $Result = "OtherMonth" . $Result;
                break;
        }
        $this->CurrentStyle = isset($this->CalendarStyles[$Result]) ? $this->CalendarStyles[$Result] : "";
    }
//End Cal SetCurrentStyle Method

//Cal CompareEventTime Method @2-7C196157
    function CompareEventTime($val1, $val2) {
        $className = "clsEventCalendar_MonthViewCal";
        $time1 = ($val1 instanceof $className) && is_array($val1->_Time) ? $val1->_Time[ccsHour] * 3600 + $val1->_Time[ccsMinute] * 60 + $val1->_Time[ccsSecond] : 0;
        $time2 = ($val2 instanceof $className) && is_array($val2->_Time) ? $val2->_Time[ccsHour] * 3600 + $val2->_Time[ccsMinute] * 60 + $val2->_Time[ccsSecond] : 0;
        if ($time1 == $time2)
            return 0;
        return $time1 > $time2 ? 1 : -1;
    }
//End Cal CompareEventTime Method

} //End Cal Class @2-FCB6E20C

class clsCalendar_MonthViewCalDataSource extends clsDBConnection1 {  //CalDataSource Class @2-998338DE

//DataSource Variables @2-6948162A
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;


    // Datasource fields
    public $calendar_item_id;
    public $calendar_item_start;
    public $calendar_item_end;
    public $calendar_item_title;
    public $calendar_item_description;
    public $EventLink;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-B3A71E04
    function clsCalendar_MonthViewCalDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "";
        $this->Initialize();
        $this->calendar_item_id = new clsField("calendar_item_id", ccsInteger, "");
        
        $this->calendar_item_start = new clsField("calendar_item_start", ccsDate, $this->DateFormat);
        
        $this->calendar_item_end = new clsField("calendar_item_end", ccsText, "");
        
        $this->calendar_item_title = new clsField("calendar_item_title", ccsText, "");
        
        $this->calendar_item_description = new clsField("calendar_item_description", ccsText, "");
        
        $this->EventLink = new clsField("EventLink", ccsText, "");
        

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

//SetValues Method @2-1317144C
    function SetValues()
    {
        $this->calendar_item_id->SetDBValue(trim($this->f("calendar_item_id")));
        $this->calendar_item_start->SetDBValue(trim($this->f("calendar_item_start")));
        $this->calendar_item_end->SetDBValue($this->f("calendar_item_end"));
        $this->calendar_item_title->SetDBValue($this->f("calendar_item_title"));
        $this->calendar_item_description->SetDBValue($this->f("calendar_item_description"));
        $this->EventLink->SetDBValue($this->f("calendar_item_id"));
    }
//End SetValues Method

} //End CalDataSource Class @2-FCB6E20C

class clsCalendar_MonthView { //Calendar_MonthView class @1-AD426A02

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

//Class_Initialize Event @1-DEB62CF6
    function clsCalendar_MonthView($RelativePath, $ComponentName, & $Parent)
    {
        include_once(RelativePath . "/CalendarNavigator.php");
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = $ComponentName;
        $this->RelativePath = $RelativePath;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->FileName = "Calendar_MonthView.php";
        $this->Redirect = "";
        $this->TemplateFileName = "Calendar_MonthView.html";
        $this->BlockToParse = "main";
        $this->TemplateEncoding = "UTF-8";
        $this->ContentType = "text/html";
    }
//End Class_Initialize Event

//Class_Terminate Event @1-266B19C2
    function Class_Terminate()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
        unset($this->EventDetailRecord);
        $this->Calendar_Select->Class_Terminate();
        unset($this->Calendar_Select);
        unset($this->Cal);
    }
//End Class_Terminate Event

//BindEvents Method @1-A6881733
    function BindEvents()
    {
        $this->EventDetailRecord->CalendarName->CCSEvents["BeforeShow"] = "Calendar_MonthView_EventDetailRecord_CalendarName_BeforeShow";
        $this->EventDetailRecord->calendar_item_title->CCSEvents["OnValidate"] = "Calendar_MonthView_EventDetailRecord_calendar_item_title_OnValidate";
        $this->EventDetailRecord->TitleLabel->CCSEvents["BeforeShow"] = "Calendar_MonthView_EventDetailRecord_TitleLabel_BeforeShow";
        $this->EventDetailRecord->StartDate->CCSEvents["OnValidate"] = "Calendar_MonthView_EventDetailRecord_StartDate_OnValidate";
        $this->EventDetailRecord->EndDate->CCSEvents["OnValidate"] = "Calendar_MonthView_EventDetailRecord_EndDate_OnValidate";
        $this->EventDetailRecord->CCSEvents["BeforeInsert"] = "Calendar_MonthView_EventDetailRecord_BeforeInsert";
        $this->EventDetailRecord->CCSEvents["BeforeShow"] = "Calendar_MonthView_EventDetailRecord_BeforeShow";
        $this->EventDetailRecord->CCSEvents["OnValidate"] = "Calendar_MonthView_EventDetailRecord_OnValidate";
        $this->EventDetailPanel->CCSEvents["BeforeShow"] = "Calendar_MonthView_EventDetailPanel_BeforeShow";
        $this->Cal->DayOfWeek->CCSEvents["BeforeShow"] = "Calendar_MonthView_Cal_DayOfWeek_BeforeShow";
        $this->Cal->DayNumber->CCSEvents["BeforeShow"] = "Calendar_MonthView_Cal_DayNumber_BeforeShow";
        $this->Cal->EventLink->CCSEvents["BeforeShow"] = "Calendar_MonthView_Cal_EventLink_BeforeShow";
        $this->CalendarPanel->CCSEvents["BeforeShow"] = "Calendar_MonthView_CalendarPanel_BeforeShow";
        $this->CCSEvents["BeforeShow"] = "Calendar_MonthView_BeforeShow";
        $this->CCSEvents["AfterInitialize"] = "Calendar_MonthView_AfterInitialize";
        $this->CCSEvents["BeforeOutput"] = "Calendar_MonthView_BeforeOutput";
        $this->CCSEvents["BeforeUnload"] = "Calendar_MonthView_BeforeUnload";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInitialize", $this);
    }
//End BindEvents Method

//Operations Method @1-DBCB3EF6
    function Operations()
    {
        global $Redirect;
        if(!$this->Visible)
            return "";
        $this->EventDetailRecord->Operation();
        $this->Calendar_Select->Operations();
    }
//End Operations Method

//Initialize Method @1-2CEBAA01
    function Initialize()
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CCSEvents["BeforeInitialize"] = "Calendar_MonthView_BeforeInitialize";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInitialize", $this);
        if(!$this->Visible)
            return "";
        $this->Attributes = & $this->Parent->Attributes;
        $this->DBConnection1 = new clsDBConnection1();
        $this->Connections["Connection1"] = & $this->DBConnection1;

        // Create Components
        $this->EventDetailPanel = new clsPanel("EventDetailPanel", $this);
        $this->EventDetailRecord = new clsRecordCalendar_MonthViewEventDetailRecord($this->RelativePath, $this);
        $this->CalendarPanel = new clsPanel("CalendarPanel", $this);
        $this->Calendar_Select = new clsCalendar_Select($this->RelativePath, "Calendar_Select", $this);
        $this->Calendar_Select->Initialize();
        $this->Cal = new clsCalendarCalendar_MonthViewCal($this->RelativePath, $this);
        $this->EventDetailPanel->AddComponent("EventDetailRecord", $this->EventDetailRecord);
        $this->CalendarPanel->AddComponent("Calendar_Select", $this->Calendar_Select);
        $this->CalendarPanel->AddComponent("Cal", $this->Cal);
        $this->EventDetailRecord->Initialize();
        $this->Cal->Initialize();
        $this->BindEvents();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
    }
//End Initialize Method

//Show Method @1-EFA36638
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
        $this->EventDetailPanel->Show();
        $this->CalendarPanel->Show();
        $Tpl->Parse();
        $Tpl->block_path = $block_path;
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
        $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
    }
//End Show Method

} //End Calendar_MonthView Class @1-FCB6E20C

//Include Event File @1-FEDBA6C6
include_once(RelativePath . "/Calendar/Calendar_MonthView_events.php");
//End Include Event File


?>
