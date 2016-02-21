<?php
// //Events @1-F81417CB

//Calendar_DayView_Cal_ds_BeforeBuildSelect @2-1775FEAB
function Calendar_DayView_Cal_ds_BeforeBuildSelect(& $sender)
{
    $Calendar_DayView_Cal_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_DayView; //Compatibility
//End Calendar_DayView_Cal_ds_BeforeBuildSelect

//Custom Code @11-2A29BDB7
// -------------------------

	//Retrieve working hours, and adjust the query list accordingly.
	$Start = "070000";
	$End = "180000";

	if ($Container->ds->Where <> "") {
		$Container->ds->Where .= " AND ";
	}

	$Container->ds->Where .= "HHiiSS >= " . $Start . " AND HHiiSS < " . $End;

// -------------------------
//End Custom Code

//Close Calendar_DayView_Cal_ds_BeforeBuildSelect @2-DC426E32
    return $Calendar_DayView_Cal_ds_BeforeBuildSelect;
}
//End Close Calendar_DayView_Cal_ds_BeforeBuildSelect

//Calendar_DayView_Cal_BeforeShowRow @2-51226ED6
function Calendar_DayView_Cal_BeforeShowRow(& $sender)
{
    $Calendar_DayView_Cal_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_DayView; //Compatibility
//End Calendar_DayView_Cal_BeforeShowRow

//Custom Code @14-2A29BDB7
// -------------------------

	global $DBConnection1, $Tpl;

	//Set the default style for each cell.
	$TimeOfDayStyle = "";
	$EventStyle = "";

	//Define the dynamic styles.
	$EventStyleActive = "background-color: #e7e7e7; ";
	$HalfHourStyle = "border-top: 0px; ";
	$DayClass = "";

	//Get some default values for variables needed.
	$db = new clsDBConnection1();
	$Time = $Container->TimeOfDay->GetValue();
	$IdTime = CCDLookUp("id", "lu_calendars_times", "time=" . CCToSQL($Time, ccsText), $db);
	$LongTime = CCDLookUp("HHiiSS", "lu_calendars_times", "time=" . CCToSQL($Time, ccsText), $db);

	//If the time is a half hour time, then adjust the cell style, and don't show the half hour label.
	if (substr($LongTime, strlen($LongTime)-4, 4) == "3000") {
		$TimeOfDayStyle .= $HalfHourStyle;
		$EventStyle .= $HalfHourStyle;
		$Container->TimeOfDay->Visible = false;
	}
	else {
		$Container->TimeOfDay->Visible = true;
	}

	//Do a lookup to get the Start and End values, and it's accompanying display value.
	$Start = "070000";
	$End = "180000";

	$StartDisplay = CCDLookUp("time", "lu_calendars_times", "HHiiSS=" . CCToSQL($Start, ccsText), $db);
	$EndDisplay = CCDLookUp("time", "lu_calendars_times", "HHiiSS=" . CCToSQL($End, ccsText), $db);
	
	//Only show AM or PM for the start time, noon, and end time.
	if ($Time <> $StartDisplay AND $Time <> "12:00 PM" AND $Time <> $EndDisplay) {
		$Container->TimeOfDay->SetValue(substr($Time, 0, strlen($Time)-3));
	}

	//See if there's an event for this timeslot.

	//Set our initial event value.  If we don't do this, then for every event found, each subsequent
	//cell will remember the prior cell's value until a new value is found.
	$Container->Event->SetValue("");

	//Figure out the day to query.
	$Day = DayOfYear(substr(CCGetParam("CalDate", ""), 0, 4), CCGetParam("DayNum", ""));
	$Date = date('Y-m-d', $Day);

	//If it's a weekend day, then set the style class.
	if (date('N', $Day) > 5) {
		$DayClass = "CalendarWeekend";
	}
	else {
		$DayClass = "CalendarDay";
	}

	$SQL = "SELECT * FROM tbl_calendars_items WHERE "
			. "calendar_id = " . CCToSQL(CCGetParam("c", ""), ccsInteger)
			. " AND TIME(calendar_item_start) <= " . CCToSQL($IdTime, ccsDate)
			. " AND DATE(calendar_item_start) = " . CCToSQL($Date, ccsDate);
	$db->query($SQL);

	while ($db->next_record()) {

		$StartTime = CCFormatDate(CCParseDate($db->f("calendar_item_start"), array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss")), array("HH", ":", "nn", ":", "ss"));
		$EndTime = CCFormatDate(CCParseDate($db->f("calendar_item_end"), array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss")), array("HH", ":", "nn", ":", "ss"));

		if ($StartTime == $IdTime) {
			$Container->Event->SetValue($db->f("calendar_item_title"));
			$EventStyle .= $EventStyleActive;
		}
		if ($IdTime < $EndTime) {
			$EventStyle .= $EventStyleActive;
		}

	}

	$db->close();

	//Finally, set the styles or classes.
	$Tpl->SetVar("DayClass", $DayClass);
	$Tpl->SetVar("TimeOfDayStyle", $TimeOfDayStyle);
	$Tpl->SetVar("EventStyle", $EventStyle);

// -------------------------
//End Custom Code

//Close Calendar_DayView_Cal_BeforeShowRow @2-09372E41
    return $Calendar_DayView_Cal_BeforeShowRow;
}
//End Close Calendar_DayView_Cal_BeforeShowRow

//Calendar_DayView_BeforeShow @1-109B520A
function Calendar_DayView_BeforeShow(& $sender)
{
    $Calendar_DayView_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_DayView; //Compatibility
//End Calendar_DayView_BeforeShow

//Custom Code @13-2A29BDB7
// -------------------------

	global $FileName;

	//If no starting date, then get the current year and month and reload.
	if ($Container->Visible == true AND !CCGetParam("CalDate", "")) {
		header("Location: " . $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "CalDate", date('Y') . "-" . date('m'))); exit;
	}

	//Break down the CalDate.
	$Year = substr(CCGetParam("CalDate", ""), 0, 4);
	$Month = substr(CCGetParam("CalDate", ""), 5, 2);

	//Let's figure out which day we're on.  If CalDate is current, then we'll use today for our 
	//reference.  If not, then we'll use the first day of the month in CalDate.
	if (CCGetParam("DayNum", "") == "" AND CCGetParam("CalDate", "") == date('Y-m')) {
		$DayNumber = date('z');
	}
	else {
		$DayNumber = date('z', mktime(0, 0, 0, $Month, 1, $Year));
	}

	//However, if we have a DayNumber in the URL, we'll use that instead.  This is for navigating
	//through the days.  If no DayNum in the URL, let's put one there and reload.
	if ($Container->Visible == true AND CCGetParam("DayNum", "")) {
		$DayNumber = CCGetParam("DayNum", "");
	}
	elseif ($Container->Visible == true AND CCGetParam("DayNum", "") == "") {
		header("Location: " . $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "DayNum", $DayNumber)); exit;
	}

	//Figure out the day to show.
	$Date = DayOfYear(substr(CCGetParam("CalDate", ""), 0, 4), CCGetParam("DayNum", ""));
	$TodayDisplay = date('l, F j, Y', $Date);
	$Container->Cal->Today->SetValue($TodayDisplay);

	//Set the link for the Previous day.  Reload with new CalDate if we went into the previous month or year.
	# Need to deal with the fact that day of year begins with 0 or Jan 1.
	# Deal with going into a previous month.  Then deal with going into a previous year.
	$PreviousDay = $DayNumber - 1;
	if (CCGetParam("DayNum", "") == "0") {
		$PreviousDay = 365;
		$NewCalDate = $Year - 1 . "-12";
		$QueryString = CCGetQueryString("QueryString", "");
		$QueryString = CCAddParam($QueryString, "CalDate", $NewCalDate);
		$QueryString = CCAddParam($QueryString, "DayNum", $PreviousDay);
		header("Location: " . $FileName . "?" . $QueryString); exit;
	}

	//Set the link for the Next day.  Reload with new CalDate if we went into the next month or year.
	$NextDay = $DayNumber + 1;
	if (CCGetParam("DayNum", "") == 366) {
		$NextDay = 1;
		$NewCalDate = $Year + 1 . "-01";
		$QueryString = CCGetQueryString("QueryString", "");
		$QueryString = CCAddParam($QueryString, "CalDate", $NewCalDate);
		$QueryString = CCAddParam($QueryString, "DayNum", $NextDay);
		header("Location: " . $FileName . "?" . $QueryString); exit;
	}

	$Container->Cal->PreviousDay->SetLink($FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "DayNum", $PreviousDay));
	$Container->Cal->NextDay->SetLink($FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "DayNum", $NextDay));


// -------------------------
//End Custom Code

//Close Calendar_DayView_BeforeShow @1-F4496B60
    return $Calendar_DayView_BeforeShow;
}
//End Close Calendar_DayView_BeforeShow

	function DayOfYear($year, $day) {
		$offset = intval($day) * 86400;
		$DesiredDate = mktime(0, 0, 0, 1, 1, $year) + $offset;
		return $DesiredDate;
	}

?>
