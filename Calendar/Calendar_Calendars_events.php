<?php
// //Events @1-F81417CB

//Calendar_Calendars_Calendars_Button_Submit_OnClick @13-7D3A3DC2
function Calendar_Calendars_Calendars_Button_Submit_OnClick(& $sender)
{
    $Calendar_Calendars_Calendars_Button_Submit_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Calendars; //Compatibility
//End Calendar_Calendars_Calendars_Button_Submit_OnClick

//Custom Code @17-2A29BDB7
// -------------------------

  	$Container->DeleteAllowed = false;
  
  	foreach ($Container->FormParameters['CheckBox_Delete'] as $key=>$value) {
  		if ($value != "") {
  			$code = $Container->CachedColumns["calendar_id"][$key];
  			if (CCGetParam("action","") == "delete") {
  				$Container->DeleteAllowed = true;
  			}
  		}
  	}

// -------------------------
//End Custom Code

//Close Calendar_Calendars_Calendars_Button_Submit_OnClick @13-A2D25B9B
    return $Calendar_Calendars_Calendars_Button_Submit_OnClick;
}
//End Close Calendar_Calendars_Calendars_Button_Submit_OnClick

//Calendar_Calendars_Calendars_TotalRecords_BeforeShow @4-6D404D84
function Calendar_Calendars_Calendars_TotalRecords_BeforeShow(& $sender)
{
    $Calendar_Calendars_Calendars_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Calendars; //Compatibility
//End Calendar_Calendars_Calendars_TotalRecords_BeforeShow

//Retrieve number of records @5-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close Calendar_Calendars_Calendars_TotalRecords_BeforeShow @4-812758DD
    return $Calendar_Calendars_Calendars_TotalRecords_BeforeShow;
}
//End Close Calendar_Calendars_Calendars_TotalRecords_BeforeShow

//Calendar_Calendars_Calendars_Button_Add_OnClick @25-01EBAE83
function Calendar_Calendars_Calendars_Button_Add_OnClick(& $sender)
{
    $Calendar_Calendars_Calendars_Button_Add_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Calendars; //Compatibility
//End Calendar_Calendars_Calendars_Button_Add_OnClick

//Declare Variable @26-12B27B74
    global $Redirect;
    $Redirect = "?p=Calendars&action=AddEdit";
//End Declare Variable

//Close Calendar_Calendars_Calendars_Button_Add_OnClick @25-EADF26B9
    return $Calendar_Calendars_Calendars_Button_Add_OnClick;
}
//End Close Calendar_Calendars_Calendars_Button_Add_OnClick

//Calendar_Calendars_Calendars_Button_Add_BeforeShow @25-0B6A536D
function Calendar_Calendars_Calendars_Button_Add_BeforeShow(& $sender)
{
    $Calendar_Calendars_Calendars_Button_Add_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Calendars; //Compatibility
//End Calendar_Calendars_Calendars_Button_Add_BeforeShow

//Hide-Show Component @46-BC2967A7
    if (CCGetParam("action", ""))
        $Component->Visible = false;
//End Hide-Show Component

//Close Calendar_Calendars_Calendars_Button_Add_BeforeShow @25-A1380919
    return $Calendar_Calendars_Calendars_Button_Add_BeforeShow;
}
//End Close Calendar_Calendars_Calendars_Button_Add_BeforeShow

//Calendar_Calendars_Calendars_calendar_name_BeforeShow @8-85DFD237
function Calendar_Calendars_Calendars_calendar_name_BeforeShow(& $sender)
{
    $Calendar_Calendars_Calendars_calendar_name_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Calendars; //Compatibility
//End Calendar_Calendars_Calendars_calendar_name_BeforeShow

//Declare Variable @62-BEE7B23A
    global $CCSLocales;
    $CCSLocales = $CCSLocales;
//End Declare Variable

//Retrieve Value for Control @61-9038415A
    $Container->calendar_name->SetValue($Container->ds->f("calendar_default") == 1 ? $Component->GetValue() . " (" . $CCSLocales->GetText("CRM_Default") . ")" : $Component->GetValue());
//End Retrieve Value for Control

//Close Calendar_Calendars_Calendars_calendar_name_BeforeShow @8-4A56E0E0
    return $Calendar_Calendars_Calendars_calendar_name_BeforeShow;
}
//End Close Calendar_Calendars_Calendars_calendar_name_BeforeShow

//Calendar_Calendars_Calendars_BeforeShow @2-821CCE5F
function Calendar_Calendars_Calendars_BeforeShow(& $sender)
{
    $Calendar_Calendars_Calendars_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Calendars; //Compatibility
//End Calendar_Calendars_Calendars_BeforeShow

//Hide-Show Component @52-977ECCBE
    if ($Container->ds->RecordsCount == 0 AND CCGetParam("action", "") == "AddEdit")
        $Component->Visible = false;
//End Hide-Show Component

//Hide-Show Component @24-79C8FC6B
    if ($Container->ds->RecordsCount == 0)
        $Component->TotalRecordsPanel->Visible = false;
//End Hide-Show Component

//Hide-Show Component @21-660ED1B5
    if ($Container->ds->RecordsCount == 0)
        $Component->HeaderPanel->Visible = false;
//End Hide-Show Component

//Hide-Show Component @22-600DBC07
    if ($Container->ds->RecordsCount == 0)
        $Component->FooterPanel->Visible = false;
//End Hide-Show Component

//Hide-Show Component @49-36310F3A
    if (CCGetParam("action", ""))
        $Component->Header_ColumnAction->Visible = false;
//End Hide-Show Component

//Hide-Show Component @50-8DDB0101
    if (CCGetParam("action", ""))
        $Component->Data_ColumnAction->Visible = false;
//End Hide-Show Component

//Hide-Show Component @51-0EE1B559
    if (CCGetParam("action", ""))
        $Component->ActionPanel->Visible = false;
//End Hide-Show Component

//Hide-Show Component @68-49128509
    if (CCGetParam("action", "") == "AddEdit" AND !CCGetParam("id", ""))
        $Component->Visible = false;
//End Hide-Show Component

//Close Calendar_Calendars_Calendars_BeforeShow @2-72975D6A
    return $Calendar_Calendars_Calendars_BeforeShow;
}
//End Close Calendar_Calendars_Calendars_BeforeShow

//Calendar_Calendars_CalendarAddEdit_calendar_name_OnValidate @34-CEB96FFC
function Calendar_Calendars_CalendarAddEdit_calendar_name_OnValidate(& $sender)
{
    $Calendar_Calendars_CalendarAddEdit_calendar_name_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Calendars; //Compatibility
//End Calendar_Calendars_CalendarAddEdit_calendar_name_OnValidate

//Validate Minimum Length @42-91AE6E3D
    global $CCSLocales;
    if (CCStrLen($Container->calendar_name->GetText()) < 5) {
        $Container->calendar_name->Errors->addError($CCSLocales->GetText("CRM_MoreDescriptiveCalendarName"));
    }
//End Validate Minimum Length

//Close Calendar_Calendars_CalendarAddEdit_calendar_name_OnValidate @34-7AE9FF5B
    return $Calendar_Calendars_CalendarAddEdit_calendar_name_OnValidate;
}
//End Close Calendar_Calendars_CalendarAddEdit_calendar_name_OnValidate

//Calendar_Calendars_CalendarAddEdit_calendar_type_OnValidate @35-EC4E461D
function Calendar_Calendars_CalendarAddEdit_calendar_type_OnValidate(& $sender)
{
    $Calendar_Calendars_CalendarAddEdit_calendar_type_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Calendars; //Compatibility
//End Calendar_Calendars_CalendarAddEdit_calendar_type_OnValidate

//Validate Minimum Length @43-5C439A76
    global $CCSLocales;
    if (CCStrLen($Container->calendar_type->GetText()) < 1) {
        $Container->calendar_type->Errors->addError($CCSLocales->GetText("CRM_ChooseCalendarType"));
    }
//End Validate Minimum Length

//Close Calendar_Calendars_CalendarAddEdit_calendar_type_OnValidate @35-72CCF5ED
    return $Calendar_Calendars_CalendarAddEdit_calendar_type_OnValidate;
}
//End Close Calendar_Calendars_CalendarAddEdit_calendar_type_OnValidate

//Calendar_Calendars_CalendarAddEdit_AddEditLabel_BeforeShow @38-0F1176AE
function Calendar_Calendars_CalendarAddEdit_AddEditLabel_BeforeShow(& $sender)
{
    $Calendar_Calendars_CalendarAddEdit_AddEditLabel_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Calendars; //Compatibility
//End Calendar_Calendars_CalendarAddEdit_AddEditLabel_BeforeShow

//Declare Variable @39-BEE7B23A
    global $CCSLocales;
    $CCSLocales = $CCSLocales;
//End Declare Variable

//Retrieve Value for Control @40-2EC45C64
    $Container->AddEditLabel->SetValue((CCGetParam("action", "") == "AddEdit" AND !CCGetParam("id", "")) ? $CCSLocales->GetText("CRM_NewCalendar") : $CCSLocales->GetText("CRM_EditCalendar"));
//End Retrieve Value for Control

//Close Calendar_Calendars_CalendarAddEdit_AddEditLabel_BeforeShow @38-3026EA46
    return $Calendar_Calendars_CalendarAddEdit_AddEditLabel_BeforeShow;
}
//End Close Calendar_Calendars_CalendarAddEdit_AddEditLabel_BeforeShow

//Calendar_Calendars_CalendarAddEdit_calendar_view_OnValidate @54-C22D9E0C
function Calendar_Calendars_CalendarAddEdit_calendar_view_OnValidate(& $sender)
{
    $Calendar_Calendars_CalendarAddEdit_calendar_view_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Calendars; //Compatibility
//End Calendar_Calendars_CalendarAddEdit_calendar_view_OnValidate

//Validate Minimum Length @57-7A8FD6E9
    global $CCSLocales;
    if (CCStrLen($Container->calendar_view->GetText()) < 1) {
        $Container->calendar_view->Errors->addError($CCSLocales->GetText("CRM_ChooseCalendarView"));
    }
//End Validate Minimum Length

//Close Calendar_Calendars_CalendarAddEdit_calendar_view_OnValidate @54-B0EE82B1
    return $Calendar_Calendars_CalendarAddEdit_calendar_view_OnValidate;
}
//End Close Calendar_Calendars_CalendarAddEdit_calendar_view_OnValidate

//Calendar_Calendars_CalendarAddEdit_Lsb_Available_ds_BeforeBuildSelect @69-7316BD8C
function Calendar_Calendars_CalendarAddEdit_Lsb_Available_ds_BeforeBuildSelect(& $sender)
{
    $Calendar_Calendars_CalendarAddEdit_Lsb_Available_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Calendars; //Compatibility
//End Calendar_Calendars_CalendarAddEdit_Lsb_Available_ds_BeforeBuildSelect

//Custom Code @70-2A29BDB7
// -------------------------

    $db = null;
	$LinkedUsers = "";
	
    //Select all users for the currect calendar.
    if (intval(CCGetFromGet("id", "")) > 0) {
  
		//Create a new database connection object.
		$db = new clsDBConnection1;
		$db->query("SELECT user_id FROM tbl_calendars_private_users WHERE calendar_id =" . $db->ToSQL(CCGetParam("id", ""), ccsInteger));
		while($db->next_record()) {
			if($LinkedUsers != "") {
				$LinkedUsers .= ",";
			}
			$LinkedUsers .= $db->f("user_id");
		}
  
		//Destroy the database connection object.
		$db->close();
	}

	//Modify the Where clause of the Available ListBox.
	if($LinkedUsers != "") {
		if ($Component->ds->Where <> "") {
			$Component->ds->Where .= " AND ";
		}
		$Component->ds->Where .= "user_id NOT IN (" . $LinkedUsers . ") AND user_id <> 1";
	}  

// -------------------------
//End Custom Code

//Close Calendar_Calendars_CalendarAddEdit_Lsb_Available_ds_BeforeBuildSelect @69-39068280
    return $Calendar_Calendars_CalendarAddEdit_Lsb_Available_ds_BeforeBuildSelect;
}
//End Close Calendar_Calendars_CalendarAddEdit_Lsb_Available_ds_BeforeBuildSelect

//Calendar_Calendars_CalendarAddEdit_LinkedID_BeforeShow @86-0E8BA464
function Calendar_Calendars_CalendarAddEdit_LinkedID_BeforeShow(& $sender)
{
    $Calendar_Calendars_CalendarAddEdit_LinkedID_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Calendars; //Compatibility
//End Calendar_Calendars_CalendarAddEdit_LinkedID_BeforeShow

//Custom Code @97-2A29BDB7
// -------------------------

	//Prepopulate with SuperUser and all Admins, since they get to see all calendars.
	global $DBConnection1;
	$db = new clsDBConnection1();

	$LinkedID = "1,"; //The SuperUser

	$db->query("SELECT user_id FROM tbl_users WHERE group_id=2");

	while ($db->next_record()) {
		$LinkedID .= $db->f("user_id") . ",";
	}

	$db->close();

	$Component->SetValue($LinkedID);


// -------------------------
//End Custom Code

//Close Calendar_Calendars_CalendarAddEdit_LinkedID_BeforeShow @86-68C40E03
    return $Calendar_Calendars_CalendarAddEdit_LinkedID_BeforeShow;
}
//End Close Calendar_Calendars_CalendarAddEdit_LinkedID_BeforeShow

//Calendar_Calendars_CalendarAddEdit_BeforeUpdate @27-CB21C3EA
function Calendar_Calendars_CalendarAddEdit_BeforeUpdate(& $sender)
{
    $Calendar_Calendars_CalendarAddEdit_BeforeUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Calendars; //Compatibility
//End Calendar_Calendars_CalendarAddEdit_BeforeUpdate

//Call Function @64-16B7980B
    CheckDefault();
//End Call Function

//Close Calendar_Calendars_CalendarAddEdit_BeforeUpdate @27-B4648D01
    return $Calendar_Calendars_CalendarAddEdit_BeforeUpdate;
}
//End Close Calendar_Calendars_CalendarAddEdit_BeforeUpdate

//Calendar_Calendars_CalendarAddEdit_BeforeInsert @27-B1790F76
function Calendar_Calendars_CalendarAddEdit_BeforeInsert(& $sender)
{
    $Calendar_Calendars_CalendarAddEdit_BeforeInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Calendars; //Compatibility
//End Calendar_Calendars_CalendarAddEdit_BeforeInsert

//Call Function @65-16B7980B
    CheckDefault();
//End Call Function

//Close Calendar_Calendars_CalendarAddEdit_BeforeInsert @27-7B4D4C8E
    return $Calendar_Calendars_CalendarAddEdit_BeforeInsert;
}
//End Close Calendar_Calendars_CalendarAddEdit_BeforeInsert

//Calendar_Calendars_CalendarAddEdit_OnValidate @27-80E1E8DB
function Calendar_Calendars_CalendarAddEdit_OnValidate(& $sender)
{
    $Calendar_Calendars_CalendarAddEdit_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Calendars; //Compatibility
//End Calendar_Calendars_CalendarAddEdit_OnValidate

//Custom Code @66-2A29BDB7
// -------------------------

  	global $CCSLocales, $DBConnection1;
 
  	//If Default is not checked, then look in the database for another Default calendar.  If there
  	//isn't one, then show an error.
  	if (CCGetParam("id", "") AND !$Container->calendar_default->GetValue()) {
  		$db = new clsDBConnection1();
  		$Result = CCDLookUp("calendar_id", "tbl_calendars", "calendar_default = 1 AND calendar_id <> " . CCToSQL(CCGetParam("id", ""), ccsInteger), $db);
  		$db->close();
  		if (!$Result) {
  			$Container->Errors->addError($CCSLocales->GetText("CRM_NoDefaultCalendarError"));
  		}
  	}

// -------------------------
//End Custom Code

//Close Calendar_Calendars_CalendarAddEdit_OnValidate @27-F4B7CA0A
    return $Calendar_Calendars_CalendarAddEdit_OnValidate;
}
//End Close Calendar_Calendars_CalendarAddEdit_OnValidate

//Calendar_Calendars_CalendarAddEdit_BeforeShow @27-5D01CC62
function Calendar_Calendars_CalendarAddEdit_BeforeShow(& $sender)
{
    $Calendar_Calendars_CalendarAddEdit_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Calendars; //Compatibility
//End Calendar_Calendars_CalendarAddEdit_BeforeShow

//Hide-Show Component @88-F1E6B781
    if (!CCGetParam("action",""))
        $Component->Visible = false;
//End Hide-Show Component

//Close Calendar_Calendars_CalendarAddEdit_BeforeShow @27-CB4CAE83
    return $Calendar_Calendars_CalendarAddEdit_BeforeShow;
}
//End Close Calendar_Calendars_CalendarAddEdit_BeforeShow

//Calendar_Calendars_CalendarAddEdit_AfterUpdate @27-69DD20A6
function Calendar_Calendars_CalendarAddEdit_AfterUpdate(& $sender)
{
    $Calendar_Calendars_CalendarAddEdit_AfterUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Calendars; //Compatibility
//End Calendar_Calendars_CalendarAddEdit_AfterUpdate

//Call Function @95-7924A944
    CalendarUsersModify("Update");
//End Call Function

//Custom Code @93-2A29BDB7
// -------------------------

	if ($Container->Errors->Count() == 0) {
		$Container->Errors->addError("<span style='color: GREEN;'>Changes saved!</span>");
	}

// -------------------------
//End Custom Code

//Close Calendar_Calendars_CalendarAddEdit_AfterUpdate @27-C2FE6574
    return $Calendar_Calendars_CalendarAddEdit_AfterUpdate;
}
//End Close Calendar_Calendars_CalendarAddEdit_AfterUpdate

//Calendar_Calendars_CalendarAddEdit_AfterInsert @27-DCB37427
function Calendar_Calendars_CalendarAddEdit_AfterInsert(& $sender)
{
    $Calendar_Calendars_CalendarAddEdit_AfterInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Calendars; //Compatibility
//End Calendar_Calendars_CalendarAddEdit_AfterInsert

//Call Function @94-04EC1E34
    CalendarUsersModify("Insert");
//End Call Function

//Close Calendar_Calendars_CalendarAddEdit_AfterInsert @27-0DD7A4FB
    return $Calendar_Calendars_CalendarAddEdit_AfterInsert;
}
//End Close Calendar_Calendars_CalendarAddEdit_AfterInsert

//Calendar_Calendars_CalendarAddEdit_BeforeDelete @27-A437B4C0
function Calendar_Calendars_CalendarAddEdit_BeforeDelete(& $sender)
{
    $Calendar_Calendars_CalendarAddEdit_BeforeDelete = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Calendars; //Compatibility
//End Calendar_Calendars_CalendarAddEdit_BeforeDelete

//Call Function @96-5EBACC48
    CalendarUsersModify("Delete");
//End Call Function

//Close Calendar_Calendars_CalendarAddEdit_BeforeDelete @27-28402B70
    return $Calendar_Calendars_CalendarAddEdit_BeforeDelete;
}
//End Close Calendar_Calendars_CalendarAddEdit_BeforeDelete

function CalendarUsersModify($Actions)
{ 
	//This method comes from the CodeCharge Example Pack: ManyToManyListboxes
	global $DBConnection1;

	$db = new clsDBConnection1();
  
	//Retrieve current calendar.
	$CalendarID = CCGetFromGet("id", "");
	$UsersList = explode(",", trim(CCGetFromPost("LinkedID", "")));
	$View = CCGetFromPost("calendar_view", "");

	if($Actions == "Insert" AND $View == "Private") {
		//Retrieve the last inserted key. Use a method compatible with all databases (unsafe 
		//when multiple users insert records at the same time).  Notice we're also using
		//the form's existing connection, not our new connection.
		$GetLastInsKey = CCDLookUp("MAX(calendar_id)", "tbl_calendars", "", $DBConnection1);

		//Insert new users for calendar.
		reset($UsersList);
		while(list($key, $UserID) = each($UsersList)) {
			if(intval($UserID) > 0) {
				$db->query("INSERT INTO tbl_calendars_private_users (calendar_id, user_id) VALUES (" . $db->ToSQL($GetLastInsKey, ccsInteger) . "," . $db->ToSQL($UserID, ccsInteger) . ")");
				}
			}
		}  	 

	if($CalendarID > 0) {
		if( ($Actions == "Delete") OR ($Actions == "Update") OR ($View == "Public") ) {
			//Delete users from calendar.
			$db->query("DELETE FROM tbl_calendars_private_users WHERE calendar_id=" . $db->ToSQL($CalendarID, ccsInteger));
			} 
    
		if($Actions == "Update" AND $View == "Private") {
			//Insert new users for calendar.
			reset($UsersList);
			while(list($key, $UserID) = each($UsersList)) {
				if(intval($UserID) > 0) {
					$db->query("INSERT INTO tbl_calendars_private_users (calendar_id, user_id) VALUES (" . $db->ToSQL($CalendarID, ccsInteger) . "," . $db->ToSQL($UserID, ccsInteger) . ")");
					}
				}
			}
		}

	$db->close();
}
//End CalendarUsersModify.

function CheckDefault()
{
	global $DBConnection1;
	//If Default is set, then clear out any other records that may have default set.
	if (CCGetFromPost("calendar_default", "") == 1) {
		$db = new clsDBConnection1();
		$db->query("SELECT calendar_id FROM tbl_calendars WHERE calendar_default=1");
		while ($db->next_record()) {
			$db2 = new clsDBConnection1();
			$db2->query("UPDATE tbl_calendars SET calendar_default=NULL WHERE calendar_id=" . CCToSQL($db->f("calendar_id"), ccsInteger));
			$db2->close();
		}
		$db->close();
	}
}
//End CheckDefault

?>