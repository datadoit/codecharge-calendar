<?php
// //Events @1-F81417CB

//Calendar_Select_CalendarForm_c_ds_BeforeBuildSelect @3-BC01528F
function Calendar_Select_CalendarForm_c_ds_BeforeBuildSelect(& $sender)
{
    $Calendar_Select_CalendarForm_c_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Select; //Compatibility
//End Calendar_Select_CalendarForm_c_ds_BeforeBuildSelect

//Custom Code @5-2A29BDB7
// -------------------------

	//If you are logged in, then show only the calendars that you have permission to view.
	if (CCGetUserID()) {
		if ($Component->ds->Where <> "") {
			$Component->ds->Where .= " OR ";
		}
		$Component->ds->Where .= "EXISTS(SELECT * FROM tbl_calendars_private_users WHERE user_id=" . CCToSQL(CCGetUserID(), ccsInteger)
								. " AND tbl_calendars_private_users.calendar_id=tbl_calendars.calendar_id)";
	}	
	
// -------------------------
//End Custom Code

//Close Calendar_Select_CalendarForm_c_ds_BeforeBuildSelect @3-9161A848
    return $Calendar_Select_CalendarForm_c_ds_BeforeBuildSelect;
}
//End Close Calendar_Select_CalendarForm_c_ds_BeforeBuildSelect

//Calendar_Select_BeforeShow @1-572F082B
function Calendar_Select_BeforeShow(& $sender)
{
    $Calendar_Select_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Select; //Compatibility
//End Calendar_Select_BeforeShow

//Custom Code @6-2A29BDB7
// -------------------------

	global $DBConnection1, $Tpl;
	
	//Determine the Default calendar and display it if no other calendar selected.
	if (!CCGetParam("c", "") OR CCGetParam("c", "") == "") {

		$db = new clsDBConnection1();
		$Result = CCDLookUp("calendar_id", "tbl_calendars", "calendar_default=1", $db);
		$db->close();
		if ($Result) {
			header("Location: ?" . CCAddParam(CCGetQueryString("QueryString", ""), "c", $Result)); exit;
		}

	}

// -------------------------
//End Custom Code

//Close Calendar_Select_BeforeShow @1-F9802420
    return $Calendar_Select_BeforeShow;
}
//End Close Calendar_Select_BeforeShow


?>
