<?php
// //Events @1-F81417CB

//Calendar_CalendarItems_ItemsSearch_Button_DoSearch_OnClick @3-54C0FDF4
function Calendar_CalendarItems_ItemsSearch_Button_DoSearch_OnClick(& $sender)
{
    $Calendar_CalendarItems_ItemsSearch_Button_DoSearch_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_CalendarItems; //Compatibility
//End Calendar_CalendarItems_ItemsSearch_Button_DoSearch_OnClick

//Custom Code @130-2A29BDB7
// -------------------------

	//We want to have the URL search parameters CalStart and CalEnd in the format yyyy-mm-dd.  However,
	//we also want the display of the date along with the date picker to use the easier to read
	//format of mm/dd/yyyy.  So, to accomplish this we'll have to manually control the form submission
	//and redirect back around with our newly formatted date values. 
	 
	//This works in unison with setting the default values for the date fields by parsing back from 
	//the URL format to the display format. Also notice how we're using a ternary operator for determining
	//what the default value of the date fields will be. This is to deal with any errors on the form.

	//There's also the added benefit of this method in that search parameters that don't have a value
	//will not be displayed in the URL.

	global $FileName, $Redirect;

	$QueryString = CCGetQueryString("QueryString", "");
	$QueryString = CCRemoveParam($QueryString, "ccsForm");
	$QueryString = CCAddParam($QueryString, "c", $Container->c->GetValue());
	
	if ($Container->CalStart->GetValue()) {
		$QueryString = CCAddParam($QueryString, "CalStart", CCFormatDate(CCParseDate($Container->CalStart->GetValue(), array("mm","/","dd","/","yyyy")), array("yyyy","-","mm","-","dd")));
	}

	if ($Container->CalEnd->GetValue()) {
		$QueryString = CCAddParam($QueryString, "CalEnd", CCFormatDate(CCParseDate($Container->CalEnd->GetValue(), array("mm","/","dd","/","yyyy")), array("yyyy","-","mm","-","dd")));
	}

	$Redirect = $FileName . "?" . $QueryString;

// -------------------------
//End Custom Code

//Close Calendar_CalendarItems_ItemsSearch_Button_DoSearch_OnClick @3-7F587488
    return $Calendar_CalendarItems_ItemsSearch_Button_DoSearch_OnClick;
}
//End Close Calendar_CalendarItems_ItemsSearch_Button_DoSearch_OnClick

//Calendar_CalendarItems_ItemsSearch_CalEnd_BeforeShow @7-80CECFDB
function Calendar_CalendarItems_ItemsSearch_CalEnd_BeforeShow(& $sender)
{
    $Calendar_CalendarItems_ItemsSearch_CalEnd_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_CalendarItems; //Compatibility
//End Calendar_CalendarItems_ItemsSearch_CalEnd_BeforeShow

//Retrieve Value for Control @132-207BAADD
    $Container->CalEnd->SetValue(CCGetParam("ccsForm", "") ? $Container->CalEnd->GetValue() : CCFormatDate(CCParseDate(CCGetParam("CalEnd",""), array("yyyy","-","mm","-","dd")), array("mm","/","dd","/","yyyy")));
//End Retrieve Value for Control

//Close Calendar_CalendarItems_ItemsSearch_CalEnd_BeforeShow @7-73AD6F28
    return $Calendar_CalendarItems_ItemsSearch_CalEnd_BeforeShow;
}
//End Close Calendar_CalendarItems_ItemsSearch_CalEnd_BeforeShow

//Calendar_CalendarItems_ItemsSearch_c_ds_BeforeBuildSelect @4-C1464874
function Calendar_CalendarItems_ItemsSearch_c_ds_BeforeBuildSelect(& $sender)
{
    $Calendar_CalendarItems_ItemsSearch_c_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_CalendarItems; //Compatibility
//End Calendar_CalendarItems_ItemsSearch_c_ds_BeforeBuildSelect

//Custom Code @112-2A29BDB7
// -------------------------

	//If a private calendar, make sure the user has permission to view it.
	if ($Component->ds->Where <> "") {
		$Component->ds->Where .= " OR ";
	}
	$Component->ds->Where .= "EXISTS(SELECT * FROM tbl_calendars_private_users WHERE user_id=" . CCToSQL(CCGetUserID(), ccsInteger)
							. " AND tbl_calendars_private_users.calendar_id=tbl_calendars.calendar_id)";

// -------------------------
//End Custom Code

//Close Calendar_CalendarItems_ItemsSearch_c_ds_BeforeBuildSelect @4-47A9529C
    return $Calendar_CalendarItems_ItemsSearch_c_ds_BeforeBuildSelect;
}
//End Close Calendar_CalendarItems_ItemsSearch_c_ds_BeforeBuildSelect

//Calendar_CalendarItems_ItemsSearch_CalStart_BeforeShow @5-264D8D19
function Calendar_CalendarItems_ItemsSearch_CalStart_BeforeShow(& $sender)
{
    $Calendar_CalendarItems_ItemsSearch_CalStart_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_CalendarItems; //Compatibility
//End Calendar_CalendarItems_ItemsSearch_CalStart_BeforeShow

//Retrieve Value for Control @131-8FD0D411
    $Container->CalStart->SetValue(CCGetParam("ccsForm", "") ? $Container->CalStart->GetValue() : CCFormatDate(CCParseDate(CCGetParam("CalStart",""), array("yyyy","-","mm","-","dd")), array("mm","/","dd","/","yyyy")));
//End Retrieve Value for Control

//Close Calendar_CalendarItems_ItemsSearch_CalStart_BeforeShow @5-7885281F
    return $Calendar_CalendarItems_ItemsSearch_CalStart_BeforeShow;
}
//End Close Calendar_CalendarItems_ItemsSearch_CalStart_BeforeShow

//Calendar_CalendarItems_ItemsSearch_Button_Add_OnClick @46-A4D577F6
function Calendar_CalendarItems_ItemsSearch_Button_Add_OnClick(& $sender)
{
    $Calendar_CalendarItems_ItemsSearch_Button_Add_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_CalendarItems; //Compatibility
//End Calendar_CalendarItems_ItemsSearch_Button_Add_OnClick

//Declare Variable @67-C1EAC99E
    global $Redirect;
    $Redirect = "?p=CalendarItems&action=AddEdit";
//End Declare Variable

//Close Calendar_CalendarItems_ItemsSearch_Button_Add_OnClick @46-EAF39968
    return $Calendar_CalendarItems_ItemsSearch_Button_Add_OnClick;
}
//End Close Calendar_CalendarItems_ItemsSearch_Button_Add_OnClick

//Calendar_CalendarItems_ItemsSearch_BeforeShow @2-1DC394AD
function Calendar_CalendarItems_ItemsSearch_BeforeShow(& $sender)
{
    $Calendar_CalendarItems_ItemsSearch_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_CalendarItems; //Compatibility
//End Calendar_CalendarItems_ItemsSearch_BeforeShow

//Hide-Show Component @68-7DBAA573
    if (CCGetParam("action", "") == "AddEdit")
        $Component->Visible = false;
//End Hide-Show Component

//Close Calendar_CalendarItems_ItemsSearch_BeforeShow @2-D2306F07
    return $Calendar_CalendarItems_ItemsSearch_BeforeShow;
}
//End Close Calendar_CalendarItems_ItemsSearch_BeforeShow

//Calendar_CalendarItems_Items_TotalRecords_BeforeShow @11-4AB21EBF
function Calendar_CalendarItems_Items_TotalRecords_BeforeShow(& $sender)
{
    $Calendar_CalendarItems_Items_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_CalendarItems; //Compatibility
//End Calendar_CalendarItems_Items_TotalRecords_BeforeShow

//Retrieve number of records @12-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close Calendar_CalendarItems_Items_TotalRecords_BeforeShow @11-C127E1D8
    return $Calendar_CalendarItems_Items_TotalRecords_BeforeShow;
}
//End Close Calendar_CalendarItems_Items_TotalRecords_BeforeShow

//Calendar_CalendarItems_Items_Button_Submit_OnClick @26-09FA4E69
function Calendar_CalendarItems_Items_Button_Submit_OnClick(& $sender)
{
    $Calendar_CalendarItems_Items_Button_Submit_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_CalendarItems; //Compatibility
//End Calendar_CalendarItems_Items_Button_Submit_OnClick

//Custom Code @44-2A29BDB7
// -------------------------

  	$Container->DeleteAllowed = false;
  
  	foreach ($Container->FormParameters['CheckBox_Delete'] as $key=>$value) {
  		if ($value != "") {
  			$code = $Container->CachedColumns["calendar_item_id"][$key];
  			if (CCGetParam("action","") == "delete") {
  				$Container->DeleteAllowed = true;
  			}
  		}
  	}

// -------------------------
//End Custom Code

//Close Calendar_CalendarItems_Items_Button_Submit_OnClick @26-705E7237
    return $Calendar_CalendarItems_Items_Button_Submit_OnClick;
}
//End Close Calendar_CalendarItems_Items_Button_Submit_OnClick

//Calendar_CalendarItems_Items_BeforeShow @9-962AFD0C
function Calendar_CalendarItems_Items_BeforeShow(& $sender)
{
    $Calendar_CalendarItems_Items_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_CalendarItems; //Compatibility
//End Calendar_CalendarItems_Items_BeforeShow

//Hide-Show Component @29-B87B4720
    if (!CCGetParam("c", ""))
        $Component->Visible = false;
//End Hide-Show Component

//Hide-Show Component @106-36310F3A
    if (CCGetParam("action", ""))
        $Component->Header_ColumnAction->Visible = false;
//End Hide-Show Component

//Hide-Show Component @107-8DDB0101
    if (CCGetParam("action", ""))
        $Component->Data_ColumnAction->Visible = false;
//End Hide-Show Component

//Hide-Show Component @109-0EE1B559
    if (CCGetParam("action", ""))
        $Component->ActionPanel->Visible = false;
//End Hide-Show Component

//Close Calendar_CalendarItems_Items_BeforeShow @9-FAA82983
    return $Calendar_CalendarItems_Items_BeforeShow;
}
//End Close Calendar_CalendarItems_Items_BeforeShow

//Calendar_CalendarItems_ItemAddEdit_calendar_id_ds_BeforeBuildSelect @54-E71479C4
function Calendar_CalendarItems_ItemAddEdit_calendar_id_ds_BeforeBuildSelect(& $sender)
{
    $Calendar_CalendarItems_ItemAddEdit_calendar_id_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_CalendarItems; //Compatibility
//End Calendar_CalendarItems_ItemAddEdit_calendar_id_ds_BeforeBuildSelect

//Custom Code @126-2A29BDB7
// -------------------------

	//If a private calendar, make sure the user has permission to view it.
	if ($Component->ds->Where <> "") {
		$Component->ds->Where .= " OR ";
	}
	$Component->ds->Where .= "EXISTS(SELECT * FROM tbl_calendars_private_users WHERE user_id=" . CCToSQL(CCGetUserID(), ccsInteger)
							. " AND tbl_calendars_private_users.calendar_id=tbl_calendars.calendar_id)";

// -------------------------
//End Custom Code

//Close Calendar_CalendarItems_ItemAddEdit_calendar_id_ds_BeforeBuildSelect @54-B6DA29F1
    return $Calendar_CalendarItems_ItemAddEdit_calendar_id_ds_BeforeBuildSelect;
}
//End Close Calendar_CalendarItems_ItemAddEdit_calendar_id_ds_BeforeBuildSelect

//Calendar_CalendarItems_ItemAddEdit_StartDate_BeforeShow @55-1A08100A
function Calendar_CalendarItems_ItemAddEdit_StartDate_BeforeShow(& $sender)
{
    $Calendar_CalendarItems_ItemAddEdit_StartDate_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_CalendarItems; //Compatibility
//End Calendar_CalendarItems_ItemAddEdit_StartDate_BeforeShow

//Retrieve Value for Control @98-29B4C62D
    $Container->StartDate->SetValue(CCFormatDate(CCParseDate($Container->ds->f("calendar_item_start"), array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss")), array("mm", "/", "dd", "/", "yyyy")));
//End Retrieve Value for Control

//Close Calendar_CalendarItems_ItemAddEdit_StartDate_BeforeShow @55-C341C728
    return $Calendar_CalendarItems_ItemAddEdit_StartDate_BeforeShow;
}
//End Close Calendar_CalendarItems_ItemAddEdit_StartDate_BeforeShow

//Calendar_CalendarItems_ItemAddEdit_StartDate_OnValidate @55-DEB2CC6C
function Calendar_CalendarItems_ItemAddEdit_StartDate_OnValidate(& $sender)
{
    $Calendar_CalendarItems_ItemAddEdit_StartDate_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_CalendarItems; //Compatibility
//End Calendar_CalendarItems_ItemAddEdit_StartDate_OnValidate

//Validate Minimum Length @102-08C65B71
    global $CCSLocales;
    if (CCStrLen($Container->StartDate->GetText()) < 1) {
        $Container->StartDate->Errors->addError($CCSLocales->GetText("CRM_ErrorEnterStartDate"));
    }
//End Validate Minimum Length

//Close Calendar_CalendarItems_ItemAddEdit_StartDate_OnValidate @55-FCBAA3A1
    return $Calendar_CalendarItems_ItemAddEdit_StartDate_OnValidate;
}
//End Close Calendar_CalendarItems_ItemAddEdit_StartDate_OnValidate

//Calendar_CalendarItems_ItemAddEdit_EndDate_BeforeShow @57-DA477AD4
function Calendar_CalendarItems_ItemAddEdit_EndDate_BeforeShow(& $sender)
{
    $Calendar_CalendarItems_ItemAddEdit_EndDate_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_CalendarItems; //Compatibility
//End Calendar_CalendarItems_ItemAddEdit_EndDate_BeforeShow

//Retrieve Value for Control @100-B4C53782
    $Container->EndDate->SetValue(CCFormatDate(CCParseDate($Container->ds->f("calendar_item_end"), array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss")), array("mm", "/", "dd", "/", "yyyy")));
//End Retrieve Value for Control

//Close Calendar_CalendarItems_ItemAddEdit_EndDate_BeforeShow @57-7DD740BA
    return $Calendar_CalendarItems_ItemAddEdit_EndDate_BeforeShow;
}
//End Close Calendar_CalendarItems_ItemAddEdit_EndDate_BeforeShow

//Calendar_CalendarItems_ItemAddEdit_EndDate_OnValidate @57-D8DA81FE
function Calendar_CalendarItems_ItemAddEdit_EndDate_OnValidate(& $sender)
{
    $Calendar_CalendarItems_ItemAddEdit_EndDate_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_CalendarItems; //Compatibility
//End Calendar_CalendarItems_ItemAddEdit_EndDate_OnValidate

//Validate Minimum Length @127-AB8DC343
    global $CCSLocales;
    if (CCStrLen($Container->EndDate->GetText()) < 1) {
        $Container->EndDate->Errors->addError($CCSLocales->GetText("CRM_ErrorEnterEndDate"));
    }
//End Validate Minimum Length

//Close Calendar_CalendarItems_ItemAddEdit_EndDate_OnValidate @57-422C2433
    return $Calendar_CalendarItems_ItemAddEdit_EndDate_OnValidate;
}
//End Close Calendar_CalendarItems_ItemAddEdit_EndDate_OnValidate

//Calendar_CalendarItems_ItemAddEdit_calendar_item_title_OnValidate @59-D243807B
function Calendar_CalendarItems_ItemAddEdit_calendar_item_title_OnValidate(& $sender)
{
    $Calendar_CalendarItems_ItemAddEdit_calendar_item_title_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_CalendarItems; //Compatibility
//End Calendar_CalendarItems_ItemAddEdit_calendar_item_title_OnValidate

//Validate Minimum Length @82-7461AC16
    global $CCSLocales;
    if (CCStrLen($Container->calendar_item_title->GetText()) < 5) {
        $Container->calendar_item_title->Errors->addError($CCSLocales->GetText("CRM_ErrorMoreDescriptiveTitle"));
    }
//End Validate Minimum Length

//Close Calendar_CalendarItems_ItemAddEdit_calendar_item_title_OnValidate @59-CD24DE74
    return $Calendar_CalendarItems_ItemAddEdit_calendar_item_title_OnValidate;
}
//End Close Calendar_CalendarItems_ItemAddEdit_calendar_item_title_OnValidate

//Calendar_CalendarItems_ItemAddEdit_AddEditLabel_BeforeShow @69-0BB1A49C
function Calendar_CalendarItems_ItemAddEdit_AddEditLabel_BeforeShow(& $sender)
{
    $Calendar_CalendarItems_ItemAddEdit_AddEditLabel_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_CalendarItems; //Compatibility
//End Calendar_CalendarItems_ItemAddEdit_AddEditLabel_BeforeShow

//Declare Variable @70-BEE7B23A
    global $CCSLocales;
    $CCSLocales = $CCSLocales;
//End Declare Variable

//Retrieve Value for Control @71-69389977
    $Container->AddEditLabel->SetValue((CCGetParam("action", "") == "AddEdit" AND !CCGetParam("id", "")) ? $CCSLocales->GetText("CRM_NewCalendarItem") : $CCSLocales->GetText("CRM_EditCalendarItem"));
//End Retrieve Value for Control

//Close Calendar_CalendarItems_ItemAddEdit_AddEditLabel_BeforeShow @69-0DA69C50
    return $Calendar_CalendarItems_ItemAddEdit_AddEditLabel_BeforeShow;
}
//End Close Calendar_CalendarItems_ItemAddEdit_AddEditLabel_BeforeShow

//Calendar_CalendarItems_ItemAddEdit_StartTime_BeforeShow @76-786C5656
function Calendar_CalendarItems_ItemAddEdit_StartTime_BeforeShow(& $sender)
{
    $Calendar_CalendarItems_ItemAddEdit_StartTime_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_CalendarItems; //Compatibility
//End Calendar_CalendarItems_ItemAddEdit_StartTime_BeforeShow

//Retrieve Value for Control @99-26370F09
    $Container->StartTime->SetValue(CCFormatDate(CCParseDate($Container->ds->f("calendar_item_start"), array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss")), array("HH", ":", "nn", ":", "ss")));
//End Retrieve Value for Control

//Close Calendar_CalendarItems_ItemAddEdit_StartTime_BeforeShow @76-9513493A
    return $Calendar_CalendarItems_ItemAddEdit_StartTime_BeforeShow;
}
//End Close Calendar_CalendarItems_ItemAddEdit_StartTime_BeforeShow

//Calendar_CalendarItems_ItemAddEdit_EndTime_BeforeShow @77-C667C5D9
function Calendar_CalendarItems_ItemAddEdit_EndTime_BeforeShow(& $sender)
{
    $Calendar_CalendarItems_ItemAddEdit_EndTime_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_CalendarItems; //Compatibility
//End Calendar_CalendarItems_ItemAddEdit_EndTime_BeforeShow

//Retrieve Value for Control @101-DCA531C9
    $Container->EndTime->SetValue(CCFormatDate(CCParseDate($Container->ds->f("calendar_item_end"), array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss")), array("HH", ":", "nn", ":", "ss")));
//End Retrieve Value for Control

//Close Calendar_CalendarItems_ItemAddEdit_EndTime_BeforeShow @77-2B85CEA8
    return $Calendar_CalendarItems_ItemAddEdit_EndTime_BeforeShow;
}
//End Close Calendar_CalendarItems_ItemAddEdit_EndTime_BeforeShow

//Calendar_CalendarItems_ItemAddEdit_BeforeShow @47-4F3730B5
function Calendar_CalendarItems_ItemAddEdit_BeforeShow(& $sender)
{
    $Calendar_CalendarItems_ItemAddEdit_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_CalendarItems; //Compatibility
//End Calendar_CalendarItems_ItemAddEdit_BeforeShow

//Hide-Show Component @65-AA5367F1
    if (CCGetParam("action", "") <> "AddEdit")
        $Component->Visible = false;
//End Hide-Show Component

//Close Calendar_CalendarItems_ItemAddEdit_BeforeShow @47-B13B0009
    return $Calendar_CalendarItems_ItemAddEdit_BeforeShow;
}
//End Close Calendar_CalendarItems_ItemAddEdit_BeforeShow

//Calendar_CalendarItems_ItemAddEdit_OnValidate @47-B615821C
function Calendar_CalendarItems_ItemAddEdit_OnValidate(& $sender)
{
    $Calendar_CalendarItems_ItemAddEdit_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_CalendarItems; //Compatibility
//End Calendar_CalendarItems_ItemAddEdit_OnValidate

//Retrieve Value for Control @92-CC17A154
    $Container->calendar_item_start->SetValue(CCParseDate($Container->StartDate->GetValue() . " " . $Container->StartTime->GetValue(), array("mm","/","dd","/","yyyy"," ","HH",":","nn",":","ss")));
//End Retrieve Value for Control

//Retrieve Value for Control @97-E4841DE0
    $Container->calendar_item_end->SetValue(CCParseDate($Container->EndDate->GetValue() . " " . $Container->EndTime->GetValue(), array("mm","/","dd","/","yyyy"," ","HH",":","nn",":","ss")));
//End Retrieve Value for Control

//Custom Code @105-2A29BDB7
// -------------------------

	global $CCSLocales;

	//End cannot be before the start.
	if ($Container->calendar_item_start->GetValue() > $Container->calendar_item_end->GetValue()) {
		$Container->Errors->addError($CCSLocales->GetText("CRM_ErrorEndBeforeStart"));
	}

// -------------------------
//End Custom Code

//Close Calendar_CalendarItems_ItemAddEdit_OnValidate @47-8EC06480
    return $Calendar_CalendarItems_ItemAddEdit_OnValidate;
}
//End Close Calendar_CalendarItems_ItemAddEdit_OnValidate

//Calendar_CalendarItems_ItemAddEdit_AfterUpdate @47-6F0033AA
function Calendar_CalendarItems_ItemAddEdit_AfterUpdate(& $sender)
{
    $Calendar_CalendarItems_ItemAddEdit_AfterUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_CalendarItems; //Compatibility
//End Calendar_CalendarItems_ItemAddEdit_AfterUpdate

//Custom Code @103-2A29BDB7
// -------------------------

	if ($Container->Errors->Count() == 0) {
		$Container->Errors->addError("<span style='color: GREEN'>Changes saved!</span>");
	}

// -------------------------
//End Custom Code

//Close Calendar_CalendarItems_ItemAddEdit_AfterUpdate @47-CFE978E4
    return $Calendar_CalendarItems_ItemAddEdit_AfterUpdate;
}
//End Close Calendar_CalendarItems_ItemAddEdit_AfterUpdate
?>
