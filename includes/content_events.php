<?php
// //Events @1-F81417CB

//content_BeforeShow @1-644587AB
function content_BeforeShow(& $sender)
{
    $content_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $content; //Compatibility
//End content_BeforeShow

//Hide-Show Component @3-84A6F025
    if (CCGetParam("Login","") <> True)
        $Component->login->Visible = false;
//End Hide-Show Component

//Hide-Show Component @8-16DFEA8A
    if (CCGetParam("m", "") != "Calendar" OR CCGetParam("v", "") != "Year")
        $Component->Calendar_YearView->Visible = false;
//End Hide-Show Component

//Hide-Show Component @9-80ED84FB
    if (CCGetParam("m", "") != "Calendar" OR CCGetParam("v", "") != "Month")
        $Component->Calendar_MonthView->Visible = false;
//End Hide-Show Component

//Hide-Show Component @12-D995D4A4
    if (CCGetParam("m", "") != "Calendar" OR CCGetParam("v", "") != "Week")
        $Component->Calendar_WeekView->Visible = false;
//End Hide-Show Component

//Hide-Show Component @13-AA067251
    if (CCGetParam("m", "") != "Calendar" OR CCGetParam("v", "") != "Day")
        $Component->Calendar_DayView->Visible = false;
//End Hide-Show Component

//Hide-Show Component @15-D53D45D8
    if (!CCGetUserID() OR CCGetParam("p", "") <> "Calendars")
        $Component->Calendar_Calendars->Visible = false;
//End Hide-Show Component

//Hide-Show Component @17-1213BBD3
    if (!CCGetUserID() OR CCGetParam("p", "") <> "CalendarItems")
        $Component->Calendar_CalendarItems->Visible = false;
//End Hide-Show Component

//Hide-Show Component @19-F6ABAA05
    if (!CCGetUserID() OR CCGetParam("p", "") <> "Users")
        $Component->Calendar_Users->Visible = false;
//End Hide-Show Component

//Hide-Show Component @22-4E531021
    if (!CCGetUserID() OR CCGetParam("p", "") <> "Settings")
        $Component->Calendar_Settings->Visible = false;
//End Hide-Show Component

//Custom Code @23-2A29BDB7
// -------------------------

	global $DBConnection1;

	//If there's a request for the Calendar module, but no view chosen, then get the default
	//calendar view.
	if (CCGetParam("m", "") == "Calendar" AND !CCGetParam("v", "")) {

		$db = new clsDBConnection1();
		$View = CCDLookUp("default_calendar_view", "tbl_config", "site_id = " . CCToSQL(CCGetSession("SiteID", ""), ccsInteger), $db);
		$db->close();
		if (!$View) {
			$View = "Month"; //System default.
		}
		$QueryString = CCGetQueryString("QueryString", "");
		header("Location: " . ServerURL . "?" . $QueryString . "&v=" . $View); exit;

	}


// -------------------------
//End Custom Code

//Close content_BeforeShow @1-E786F199
    return $content_BeforeShow;
}
//End Close content_BeforeShow


?>
