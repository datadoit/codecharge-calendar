<?php

//BindEvents Method @1-D40060DD
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_BeforeShow @1-3AC6017A
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_AJAX_GetEvent; //Compatibility
//End Page_BeforeShow

//Custom Code @2-2A29BDB7
// -------------------------

	//Retrieve information for the event detail modal window.
	
	header("Content-type: text/xml");                    //Create our XML file.
	header("Cache-Control: no-cache, must-revalidate");  //No cache. File will always be new.
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");    //Any date in the past.

	global $DBConnection1;
	$db = new clsDBConnection1();

	$SQL = "SELECT tbl_calendars_items.*, tbl_calendars.calendar_name FROM tbl_calendars_items "
			. "INNER JOIN tbl_calendars ON tbl_calendars_items.calendar_id = tbl_calendars.calendar_id "
			. "WHERE tbl_calendars_items.calendar_item_id = " . CCToSQL(CCGetParam("id", ""), ccsInteger);

	$db->query($SQL);
	$Result = $db->next_record();

	if ($Result) {
		$calendar_id = $db->f("calendar_id");
		$calendar_name = $db->f("calendar_name");
		$calendar_item_start = $db->f("calendar_item_start");
		$calendar_item_end = $db->f("calendar_item_end");
		$calendar_item_title = $db->f("calendar_item_title");
		$calendar_item_description = $db->f("calendar_item_description");
	}

	$db->close();

	//Populate our XML file.
	echo "<?xml version='1.0' encoding='utf-8'?>";
	echo "<EventDetail>";
	echo "<calendar_id>" . $calendar_id . "</calendar_id>";
	echo "<calendar_name>" . $calendar_name . "</calendar_name>";
	echo "<calendar_item_start>" . $calendar_item_start . "</calendar_item_start>";
	echo "<calendar_item_end>" . $calendar_item_end . "</calendar_item_end>";
	echo "<calendar_item_title>" . $calendar_item_title . "</calendar_item_title>";
	echo "<calendar_item_description>" . $calendar_item_description . "</calendar_item_description>";
	echo "</EventDetail>";

	exit;  //Very important to exit here so that the HTML doesn't get processed!

// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow
?>
