<?php
// //Events @1-F81417CB

//Calendar_MonthView_EventDetailRecord_CalendarName_BeforeShow @43-3C5945D8
function Calendar_MonthView_EventDetailRecord_CalendarName_BeforeShow(& $sender)
{
    $Calendar_MonthView_EventDetailRecord_CalendarName_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_MonthView; //Compatibility
//End Calendar_MonthView_EventDetailRecord_CalendarName_BeforeShow

//DLookup @69-2A45232E
    global $DBConnection1;
    $Page = CCGetParentPage($sender);
    $ccs_result = CCDLookUp("calendar_name", "tbl_calendars", "calendar_id=" . CCToSQL($Container->calendar_id->GetValue(), ccsInteger), $Page->Connections["Connection1"]);
    $ccs_result = strval($ccs_result);
    $Container->CalendarName->SetValue($ccs_result);
//End DLookup

//Close Calendar_MonthView_EventDetailRecord_CalendarName_BeforeShow @43-0485A668
    return $Calendar_MonthView_EventDetailRecord_CalendarName_BeforeShow;
}
//End Close Calendar_MonthView_EventDetailRecord_CalendarName_BeforeShow

//Calendar_MonthView_EventDetailRecord_calendar_item_title_OnValidate @48-F339A292
function Calendar_MonthView_EventDetailRecord_calendar_item_title_OnValidate(& $sender)
{
    $Calendar_MonthView_EventDetailRecord_calendar_item_title_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_MonthView; //Compatibility
//End Calendar_MonthView_EventDetailRecord_calendar_item_title_OnValidate

//Validate Minimum Length @93-7461AC16
    global $CCSLocales;
    if (CCStrLen($Container->calendar_item_title->GetText()) < 5) {
        $Container->calendar_item_title->Errors->addError($CCSLocales->GetText("CRM_ErrorMoreDescriptiveTitle"));
    }
//End Validate Minimum Length

//Close Calendar_MonthView_EventDetailRecord_calendar_item_title_OnValidate @48-88FF66B6
    return $Calendar_MonthView_EventDetailRecord_calendar_item_title_OnValidate;
}
//End Close Calendar_MonthView_EventDetailRecord_calendar_item_title_OnValidate

//Calendar_MonthView_EventDetailRecord_TitleLabel_BeforeShow @67-9B84E960
function Calendar_MonthView_EventDetailRecord_TitleLabel_BeforeShow(& $sender)
{
    $Calendar_MonthView_EventDetailRecord_TitleLabel_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_MonthView; //Compatibility
//End Calendar_MonthView_EventDetailRecord_TitleLabel_BeforeShow

//Declare Variable @74-FC3D1FC8
    global $DBConnection1;
    $DBConnection1 = $DBConnection1;
//End Declare Variable

//Retrieve Value for Control @73-F4A6CEA9
    $Container->TitleLabel->SetValue(!CCGetUserID() ? CCDLookUp("calendar_item_title", "tbl_calendars_items", "calendar_item_id=" . CCToSQL($Container->calendar_item_id->GetValue(), ccsInteger), $DBConnection1) : "");
//End Retrieve Value for Control

//Close Calendar_MonthView_EventDetailRecord_TitleLabel_BeforeShow @67-6DFCF20D
    return $Calendar_MonthView_EventDetailRecord_TitleLabel_BeforeShow;
}
//End Close Calendar_MonthView_EventDetailRecord_TitleLabel_BeforeShow

//Calendar_MonthView_EventDetailRecord_StartDate_OnValidate @44-4C853F59
function Calendar_MonthView_EventDetailRecord_StartDate_OnValidate(& $sender)
{
    $Calendar_MonthView_EventDetailRecord_StartDate_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_MonthView; //Compatibility
//End Calendar_MonthView_EventDetailRecord_StartDate_OnValidate

//Validate Minimum Length @94-08C65B71
    global $CCSLocales;
    if (CCStrLen($Container->StartDate->GetText()) < 1) {
        $Container->StartDate->Errors->addError($CCSLocales->GetText("CRM_ErrorEnterStartDate"));
    }
//End Validate Minimum Length

//Regular Expression Validation @102-D1E170C3
    global $CCSLocales;
    if (CCStrLen($Container->StartDate->GetText()) && !preg_match("/^\d{2}\/\d{2}\/\d{4}\$/", $Container->StartDate->GetText()))
    {
        $Container->StartDate->Errors->addError($CCSLocales->GetText("CRM_ErrorDateFormat"));
    }
//End Regular Expression Validation

//Close Calendar_MonthView_EventDetailRecord_StartDate_OnValidate @44-57D2D7FB
    return $Calendar_MonthView_EventDetailRecord_StartDate_OnValidate;
}
//End Close Calendar_MonthView_EventDetailRecord_StartDate_OnValidate

//Calendar_MonthView_EventDetailRecord_EndDate_OnValidate @46-6E5F1074
function Calendar_MonthView_EventDetailRecord_EndDate_OnValidate(& $sender)
{
    $Calendar_MonthView_EventDetailRecord_EndDate_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_MonthView; //Compatibility
//End Calendar_MonthView_EventDetailRecord_EndDate_OnValidate

//Validate Minimum Length @95-AB8DC343
    global $CCSLocales;
    if (CCStrLen($Container->EndDate->GetText()) < 1) {
        $Container->EndDate->Errors->addError($CCSLocales->GetText("CRM_ErrorEnterEndDate"));
    }
//End Validate Minimum Length

//Regular Expression Validation @103-9E993699
    global $CCSLocales;
    if (CCStrLen($Container->EndDate->GetText()) && !preg_match("/^\d{2}\/\d{2}\/\d{4}\$/", $Container->EndDate->GetText()))
    {
        $Container->EndDate->Errors->addError($CCSLocales->GetText("CRM_ErrorDateFormat"));
    }
//End Regular Expression Validation

//Close Calendar_MonthView_EventDetailRecord_EndDate_OnValidate @46-6DFB0245
    return $Calendar_MonthView_EventDetailRecord_EndDate_OnValidate;
}
//End Close Calendar_MonthView_EventDetailRecord_EndDate_OnValidate

//Calendar_MonthView_EventDetailRecord_BeforeInsert @36-2EF4A516
function Calendar_MonthView_EventDetailRecord_BeforeInsert(& $sender)
{
    $Calendar_MonthView_EventDetailRecord_BeforeInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_MonthView; //Compatibility
//End Calendar_MonthView_EventDetailRecord_BeforeInsert

//Custom Code @62-2A29BDB7
// -------------------------

	//There's not really any record operations being done by CCS since in a javascript Modal window the record
	//operations must be either via AJAX, or in this case we'll manually handle them.  Our modal window here
	//only displays existing records, so we'll only be doing a record update.

	//The calendar itself cannot be changed here.

	global $DBConnection1;

	$Container->InsertAllowed = false;  //To avoid a blank record insert.

	//Update the event record as long as the record exists.
	$db = new clsDBConnection1();
	$ItemID = CCDLookUp("calendar_item_id", "tbl_calendars_items", "calendar_item_id=" . CCToSQL($Container->calendar_item_id->GetValue(), ccsInteger), $db);
	$db->close();
	if ($ItemID) {

		$SQL = "UPDATE tbl_calendars_items SET"
				. " calendar_item_start = " . CCToSQL($Container->calendar_item_start->GetValue(), ccsDate)
				. ", calendar_item_end = " . CCToSQL($Container->calendar_item_end->GetValue(), ccsDate)
				. ", calendar_item_title = " . CCToSQL($Container->calendar_item_title->GetValue(), ccsText)
				. ", calendar_item_description = " . CCToSQL($Container->calendar_item_description->GetValue(), ccsText)
				. " WHERE calendar_item_id = " . CCToSQL($ItemID, ccsInteger);

		$db = new clsDBConnection1();
		$db->query($SQL);
		$db->close();

	}

	//All record operations done, so display a status message if no errors encountered.
	if ($Container->Errors->Count() == 0) {
		$Container->Errors->addError("<span style='color: GREEN;'>Changes saved!</span>");
	}


// -------------------------
//End Custom Code

//Close Calendar_MonthView_EventDetailRecord_BeforeInsert @36-8704F96F
    return $Calendar_MonthView_EventDetailRecord_BeforeInsert;
}
//End Close Calendar_MonthView_EventDetailRecord_BeforeInsert

//Calendar_MonthView_EventDetailRecord_BeforeShow @36-AD249EA9
function Calendar_MonthView_EventDetailRecord_BeforeShow(& $sender)
{
    $Calendar_MonthView_EventDetailRecord_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_MonthView; //Compatibility
//End Calendar_MonthView_EventDetailRecord_BeforeShow

//Hide-Show Component @78-939F2654
    if (!CCGetUserID())
        $Component->Button_Insert->Visible = false;
//End Hide-Show Component

//Hide-Show Component @89-26A456B5
    if (!CCGetUserID())
        $Component->StartDateTimePanel->Visible = false;
//End Hide-Show Component

//Hide-Show Component @90-824BC8D5
    if (CCGetUserID())
        $Component->StartDateTimeLabelPanel->Visible = false;
//End Hide-Show Component

//Hide-Show Component @91-BBB8CA6B
    if (!CCGetUserID())
        $Component->EndDateTimePanel->Visible = false;
//End Hide-Show Component

//Hide-Show Component @92-1EE51554
    if (CCGetUserID())
        $Component->EndDateTimeLabelPanel->Visible = false;
//End Hide-Show Component

//Hide-Show Component @77-D3F659BA
    if (!CCGetUserID())
        $Component->calendar_item_title->Visible = false;
//End Hide-Show Component

//Hide-Show Component @76-4BC8B156
    if (CCGetUserID())
        $Component->TitleLabelPanel->Visible = false;
//End Hide-Show Component

//Hide-Show Component @87-5700D851
    if (!CCGetUserID())
        $Component->calendar_item_description->Visible = false;
//End Hide-Show Component

//Hide-Show Component @88-C6672DC7
    if (CCGetUserID())
        $Component->DescriptionLabelPanel->Visible = false;
//End Hide-Show Component

//Close Calendar_MonthView_EventDetailRecord_BeforeShow @36-F942B113
    return $Calendar_MonthView_EventDetailRecord_BeforeShow;
}
//End Close Calendar_MonthView_EventDetailRecord_BeforeShow

//Calendar_MonthView_EventDetailRecord_OnValidate @36-D91983A4
function Calendar_MonthView_EventDetailRecord_OnValidate(& $sender)
{
    $Calendar_MonthView_EventDetailRecord_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_MonthView; //Compatibility
//End Calendar_MonthView_EventDetailRecord_OnValidate

//Retrieve Value for Control @98-C419E40E
    $Container->calendar_item_start->SetValue(CCFormatDate(CCParseDate($Container->StartDate->GetValue() . " " . $Container->StartTime->GetValue(), array("mm","/","dd","/","yyyy"," ","HH",":","nn",":","ss")), array("yyyy","-","mm","-","dd"," ","HH",":","nn",":","ss")));
//End Retrieve Value for Control

//Retrieve Value for Control @99-8B548021
    $Container->calendar_item_end->SetValue(CCFormatDate(CCParseDate($Container->EndDate->GetValue() . " " . $Container->EndTime->GetValue(), array("mm","/","dd","/","yyyy"," ","HH",":","nn",":","ss")), array("yyyy","-","mm","-","dd"," ","HH",":","nn",":","ss")));
//End Retrieve Value for Control

//Custom Code @97-2A29BDB7
// -------------------------

	global $CCSLocales;

	//End cannot be before the start.
	if ($Container->calendar_item_start->GetValue() > $Container->calendar_item_end->GetValue()) {
		$Container->Errors->addError($CCSLocales->GetText("CRM_ErrorEndBeforeStart"));
	}

// -------------------------
//End Custom Code

//Close Calendar_MonthView_EventDetailRecord_OnValidate @36-C6B9D59A
    return $Calendar_MonthView_EventDetailRecord_OnValidate;
}
//End Close Calendar_MonthView_EventDetailRecord_OnValidate

//Calendar_MonthView_EventDetailPanel_BeforeShow @34-D6D405DC
function Calendar_MonthView_EventDetailPanel_BeforeShow(& $sender)
{
    $Calendar_MonthView_EventDetailPanel_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_MonthView; //Compatibility
//End Calendar_MonthView_EventDetailPanel_BeforeShow

//Calendar_MonthViewEventDetailPanelUpdatePanel Page BeforeShow @35-D6498EAC
    global $CCSFormFilter;
    if ($CCSFormFilter == "Calendar_MonthViewEventDetailPanel") {
        $Component->BlockPrefix = "";
        $Component->BlockSuffix = "";
    } else {
        $Component->BlockPrefix = "<div id=\"Calendar_MonthViewEventDetailPanel\">";
        $Component->BlockSuffix = "</div>";
    }
//End Calendar_MonthViewEventDetailPanelUpdatePanel Page BeforeShow

//Close Calendar_MonthView_EventDetailPanel_BeforeShow @34-D604FAFA
    return $Calendar_MonthView_EventDetailPanel_BeforeShow;
}
//End Close Calendar_MonthView_EventDetailPanel_BeforeShow

//Calendar_MonthView_Cal_DayOfWeek_BeforeShow @15-317DA839
function Calendar_MonthView_Cal_DayOfWeek_BeforeShow(& $sender)
{
    $Calendar_MonthView_Cal_DayOfWeek_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_MonthView; //Compatibility
//End Calendar_MonthView_Cal_DayOfWeek_BeforeShow

//Custom Code @104-2A29BDB7
// -------------------------

	//Dynamically control our link.
	global $FileName;

	$QueryString = CCGetQueryString("QueryString", "");
	$QueryString = CCAddParam($QueryString, "v", "Week");

	//Figure out what week we want to jump to.


	$Component->SetLink($FileName . "?" . $QueryString);

// -------------------------
//End Custom Code

//Close Calendar_MonthView_Cal_DayOfWeek_BeforeShow @15-8FDE957B
    return $Calendar_MonthView_Cal_DayOfWeek_BeforeShow;
}
//End Close Calendar_MonthView_Cal_DayOfWeek_BeforeShow

//Calendar_MonthView_Cal_DayNumber_BeforeShow @17-37350DE0
function Calendar_MonthView_Cal_DayNumber_BeforeShow(& $sender)
{
    $Calendar_MonthView_Cal_DayNumber_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_MonthView; //Compatibility
//End Calendar_MonthView_Cal_DayNumber_BeforeShow

//Custom Code @105-2A29BDB7
// -------------------------

	//Dynamically control our link.
	global $FileName;

	$QueryString = CCGetQueryString("QueryString", "");
	$QueryString = CCAddParam($QueryString, "v", "Day");

	//Figure out what day to jump to.


	$Component->SetLink($FileName . "?" . $QueryString);

// -------------------------
//End Custom Code

//Close Calendar_MonthView_Cal_DayNumber_BeforeShow @17-A2DADBDE
    return $Calendar_MonthView_Cal_DayNumber_BeforeShow;
}
//End Close Calendar_MonthView_Cal_DayNumber_BeforeShow

//Calendar_MonthView_Cal_EventLink_BeforeShow @26-31B5DD3C
function Calendar_MonthView_Cal_EventLink_BeforeShow(& $sender)
{
    $Calendar_MonthView_Cal_EventLink_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_MonthView; //Compatibility
//End Calendar_MonthView_Cal_EventLink_BeforeShow

//Custom Code @57-2A29BDB7
// -------------------------

  	//Build our link.
  	$Component->SetValue(CCFormatDate($Container->calendar_item_start->GetValue(), array("h",":","nn"," ","AM/PM")) . " - " . $Container->calendar_item_title->GetValue() );
	//$Component->SetLink("?id=" . $Container->calendar_item_id->GetValue());

// -------------------------
//End Custom Code

//Close Calendar_MonthView_Cal_EventLink_BeforeShow @26-8819CA47
    return $Calendar_MonthView_Cal_EventLink_BeforeShow;
}
//End Close Calendar_MonthView_Cal_EventLink_BeforeShow

//Calendar_MonthView_CalendarPanel_BeforeShow @55-A9CE08AF
function Calendar_MonthView_CalendarPanel_BeforeShow(& $sender)
{
    $Calendar_MonthView_CalendarPanel_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_MonthView; //Compatibility
//End Calendar_MonthView_CalendarPanel_BeforeShow

//Calendar_MonthViewCalendarPanelUpdatePanel1 Page BeforeShow @56-77FAEB47
    global $CCSFormFilter;
    if ($CCSFormFilter == "Calendar_MonthViewCalendarPanel") {
        $Component->BlockPrefix = "";
        $Component->BlockSuffix = "";
    } else {
        $Component->BlockPrefix = "<div id=\"Calendar_MonthViewCalendarPanel\">";
        $Component->BlockSuffix = "</div>";
    }
//End Calendar_MonthViewCalendarPanelUpdatePanel1 Page BeforeShow

//Close Calendar_MonthView_CalendarPanel_BeforeShow @55-507010EF
    return $Calendar_MonthView_CalendarPanel_BeforeShow;
}
//End Close Calendar_MonthView_CalendarPanel_BeforeShow

//Calendar_MonthView_BeforeShow @1-0F9234A5
function Calendar_MonthView_BeforeShow(& $sender)
{
    $Calendar_MonthView_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_MonthView; //Compatibility
//End Calendar_MonthView_BeforeShow

//Declare Variable @106-50A1334A
    global $FileName;
    $FileName = $FileName;
//End Declare Variable

//Call Function @107-0807A090
    header(($Container->Visible == true AND CCGetParam("YearDate", "")) ? "Location: " . $FileName . "?" . CCRemoveParam(CCGetQueryString("QueryString", ""), "YearDate") : "");
//End Call Function

//Call Function @108-933698CE
    header(($Container->Visible == true AND CCGetParam("WeekNum", "")) ? "Location: " . $FileName . "?" . CCRemoveParam(CCGetQueryString("QueryString", ""), "WeekNum") : "");
//End Call Function

//Call Function @109-0947C71B
    header(($Container->Visible == true AND CCGetParam("DayNum", "")) ? "Location: " . $FileName . "?" . CCRemoveParam(CCGetQueryString("QueryString", ""), "DayNum") : "");
//End Call Function

//Calendar_MonthViewEventDetailPanelUpdatePanel Page BeforeShow @35-5497324E
    global $CCSFormFilter;
    if (CCGetFromGet("FormFilter") == "Calendar_MonthViewEventDetailPanel") {
        $CCSFormFilter = CCGetFromGet("FormFilter");
        unset($_GET["FormFilter"]);
        if (isset($_GET["IsParamsEncoded"])) unset($_GET["IsParamsEncoded"]);
    }
//End Calendar_MonthViewEventDetailPanelUpdatePanel Page BeforeShow

//Calendar_MonthViewCalendarPanelUpdatePanel1 Page BeforeShow @56-C6BD200A
    global $CCSFormFilter;
    if (CCGetFromGet("FormFilter") == "Calendar_MonthViewCalendarPanel") {
        $CCSFormFilter = CCGetFromGet("FormFilter");
        unset($_GET["FormFilter"]);
        if (isset($_GET["IsParamsEncoded"])) unset($_GET["IsParamsEncoded"]);
    }
//End Calendar_MonthViewCalendarPanelUpdatePanel1 Page BeforeShow

//Close Calendar_MonthView_BeforeShow @1-F638DD3A
    return $Calendar_MonthView_BeforeShow;
}
//End Close Calendar_MonthView_BeforeShow

//Calendar_MonthView_BeforeInitialize @1-46D167A1
function Calendar_MonthView_BeforeInitialize(& $sender)
{
    $Calendar_MonthView_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_MonthView; //Compatibility
//End Calendar_MonthView_BeforeInitialize

//Calendar_MonthViewEventDetailPanelUpdatePanel PageBeforeInitialize @35-11DB74C3
    if (CCGetFromGet("FormFilter") == "Calendar_MonthViewEventDetailPanel" && CCGetFromGet("IsParamsEncoded") != "true") {
        global $CCSLocales, $CCSIsParamsEncoded;
        CCConvertDataArrays("UTF-8", $CCSLocales->GetFormatInfo("PHPEncoding"));
        $CCSIsParamsEncoded = true;
    }
//End Calendar_MonthViewEventDetailPanelUpdatePanel PageBeforeInitialize

//Calendar_MonthViewCalendarPanelUpdatePanel1 PageBeforeInitialize @56-24A373A7
    if (CCGetFromGet("FormFilter") == "Calendar_MonthViewCalendarPanel" && CCGetFromGet("IsParamsEncoded") != "true") {
        global $CCSLocales, $CCSIsParamsEncoded;
        CCConvertDataArrays("UTF-8", $CCSLocales->GetFormatInfo("PHPEncoding"));
        $CCSIsParamsEncoded = true;
    }
//End Calendar_MonthViewCalendarPanelUpdatePanel1 PageBeforeInitialize

//Close Calendar_MonthView_BeforeInitialize @1-DF681166
    return $Calendar_MonthView_BeforeInitialize;
}
//End Close Calendar_MonthView_BeforeInitialize

//Calendar_MonthView_AfterInitialize @1-36DFD455
function Calendar_MonthView_AfterInitialize(& $sender)
{
    $Calendar_MonthView_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_MonthView; //Compatibility
//End Calendar_MonthView_AfterInitialize

//Close Calendar_MonthView_AfterInitialize @1-00A402C6
    return $Calendar_MonthView_AfterInitialize;
}
//End Close Calendar_MonthView_AfterInitialize

//Calendar_MonthView_BeforeOutput @1-7D1F9798
function Calendar_MonthView_BeforeOutput(& $sender)
{
    $Calendar_MonthView_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_MonthView; //Compatibility
//End Calendar_MonthView_BeforeOutput

//Calendar_MonthViewEventDetailPanelUpdatePanel PageBeforeOutput @35-2A6E692E
    global $CCSFormFilter, $Tpl, $main_block;
    if ($CCSFormFilter == "Calendar_MonthViewEventDetailPanel") {
        $main_block = $Tpl->getvar("/Calendar_MonthView/Panel EventDetailPanel");
    }
//End Calendar_MonthViewEventDetailPanelUpdatePanel PageBeforeOutput

//Calendar_MonthViewCalendarPanelUpdatePanel1 PageBeforeOutput @56-407295E0
    global $CCSFormFilter, $Tpl, $main_block;
    if ($CCSFormFilter == "Calendar_MonthViewCalendarPanel") {
        $main_block = $Tpl->getvar("/Calendar_MonthView/Panel CalendarPanel");
    }
//End Calendar_MonthViewCalendarPanelUpdatePanel1 PageBeforeOutput

//Close Calendar_MonthView_BeforeOutput @1-0C2295CD
    return $Calendar_MonthView_BeforeOutput;
}
//End Close Calendar_MonthView_BeforeOutput

//Calendar_MonthView_BeforeUnload @1-78036482
function Calendar_MonthView_BeforeUnload(& $sender)
{
    $Calendar_MonthView_BeforeUnload = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_MonthView; //Compatibility
//End Calendar_MonthView_BeforeUnload

//Calendar_MonthViewEventDetailPanelUpdatePanel PageBeforeUnload @35-FB5CC941
    global $Redirect, $CCSFormFilter, $CCSIsParamsEncoded;
    if ($Redirect && $CCSFormFilter == "Calendar_MonthViewEventDetailPanel") {
        if ($CCSIsParamsEncoded) $Redirect = CCAddParam($Redirect, "IsParamsEncoded", "true");
        $Redirect = CCAddParam($Redirect, "FormFilter", $CCSFormFilter);
    }
//End Calendar_MonthViewEventDetailPanelUpdatePanel PageBeforeUnload

//Calendar_MonthViewCalendarPanelUpdatePanel1 PageBeforeUnload @56-CEEB86CF
    global $Redirect, $CCSFormFilter, $CCSIsParamsEncoded;
    if ($Redirect && $CCSFormFilter == "Calendar_MonthViewCalendarPanel") {
        if ($CCSIsParamsEncoded) $Redirect = CCAddParam($Redirect, "IsParamsEncoded", "true");
        $Redirect = CCAddParam($Redirect, "FormFilter", $CCSFormFilter);
    }
//End Calendar_MonthViewCalendarPanelUpdatePanel1 PageBeforeUnload

//Close Calendar_MonthView_BeforeUnload @1-4AE89307
    return $Calendar_MonthView_BeforeUnload;
}
//End Close Calendar_MonthView_BeforeUnload
?>