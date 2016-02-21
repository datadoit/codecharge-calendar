<?php
// //Events @1-F81417CB

//Calendar_WeekView_Cal_Sunday_BeforeShow @18-F0953771
function Calendar_WeekView_Cal_Sunday_BeforeShow(& $sender)
{
    $Calendar_WeekView_Cal_Sunday_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_WeekView; //Compatibility
//End Calendar_WeekView_Cal_Sunday_BeforeShow

//Custom Code @34-2A29BDB7
// -------------------------

	//Dynamically control our link.
	global $FileName;

	$QueryString = CCGetQueryString("QueryString", "");
	$QueryString = CCAddParam($QueryString, "v", "Day");

	//Figure out what day to jump to.


	$Component->SetLink($FileName . "?" . $QueryString);

// -------------------------
//End Custom Code

//Close Calendar_WeekView_Cal_Sunday_BeforeShow @18-2C260DED
    return $Calendar_WeekView_Cal_Sunday_BeforeShow;
}
//End Close Calendar_WeekView_Cal_Sunday_BeforeShow

//Calendar_WeekView_Cal_Monday_BeforeShow @19-CB4E284C
function Calendar_WeekView_Cal_Monday_BeforeShow(& $sender)
{
    $Calendar_WeekView_Cal_Monday_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_WeekView; //Compatibility
//End Calendar_WeekView_Cal_Monday_BeforeShow

//Custom Code @35-2A29BDB7
// -------------------------

	//Dynamically control our link.
	global $FileName;

	$QueryString = CCGetQueryString("QueryString", "");
	$QueryString = CCAddParam($QueryString, "v", "Day");

	//Figure out what month to jump to.


	$Component->SetLink($FileName . "?" . $QueryString);

// -------------------------
//End Custom Code

//Close Calendar_WeekView_Cal_Monday_BeforeShow @19-973FB9E6
    return $Calendar_WeekView_Cal_Monday_BeforeShow;
}
//End Close Calendar_WeekView_Cal_Monday_BeforeShow

//Calendar_WeekView_Cal_Tuesday_BeforeShow @20-8B18BAC8
function Calendar_WeekView_Cal_Tuesday_BeforeShow(& $sender)
{
    $Calendar_WeekView_Cal_Tuesday_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_WeekView; //Compatibility
//End Calendar_WeekView_Cal_Tuesday_BeforeShow

//Custom Code @36-2A29BDB7
// -------------------------

	//Dynamically control our link.
	global $FileName;

	$QueryString = CCGetQueryString("QueryString", "");
	$QueryString = CCAddParam($QueryString, "v", "Day");

	//Figure out what day to jump to.


	$Component->SetLink($FileName . "?" . $QueryString);

// -------------------------
//End Custom Code

//Close Calendar_WeekView_Cal_Tuesday_BeforeShow @20-41C1ABF2
    return $Calendar_WeekView_Cal_Tuesday_BeforeShow;
}
//End Close Calendar_WeekView_Cal_Tuesday_BeforeShow

//Calendar_WeekView_Cal_Wednesday_BeforeShow @21-FC5A545E
function Calendar_WeekView_Cal_Wednesday_BeforeShow(& $sender)
{
    $Calendar_WeekView_Cal_Wednesday_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_WeekView; //Compatibility
//End Calendar_WeekView_Cal_Wednesday_BeforeShow

//Custom Code @37-2A29BDB7
// -------------------------

	//Dynamically control our link.
	global $FileName;

	$QueryString = CCGetQueryString("QueryString", "");
	$QueryString = CCAddParam($QueryString, "v", "Day");

	//Figure out what day to jump to.


	$Component->SetLink($FileName . "?" . $QueryString);

// -------------------------
//End Custom Code

//Close Calendar_WeekView_Cal_Wednesday_BeforeShow @21-F28523CE
    return $Calendar_WeekView_Cal_Wednesday_BeforeShow;
}
//End Close Calendar_WeekView_Cal_Wednesday_BeforeShow

//Calendar_WeekView_Cal_Thursday_BeforeShow @22-DF7AECA9
function Calendar_WeekView_Cal_Thursday_BeforeShow(& $sender)
{
    $Calendar_WeekView_Cal_Thursday_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_WeekView; //Compatibility
//End Calendar_WeekView_Cal_Thursday_BeforeShow

//Custom Code @38-2A29BDB7
// -------------------------

	//Dynamically control our link.
	global $FileName;

	$QueryString = CCGetQueryString("QueryString", "");
	$QueryString = CCAddParam($QueryString, "v", "Day");

	//Figure out what day to jump to.


	$Component->SetLink($FileName . "?" . $QueryString);

// -------------------------
//End Custom Code

//Close Calendar_WeekView_Cal_Thursday_BeforeShow @22-7AB0B43F
    return $Calendar_WeekView_Cal_Thursday_BeforeShow;
}
//End Close Calendar_WeekView_Cal_Thursday_BeforeShow

//Calendar_WeekView_Cal_Friday_BeforeShow @23-94B87181
function Calendar_WeekView_Cal_Friday_BeforeShow(& $sender)
{
    $Calendar_WeekView_Cal_Friday_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_WeekView; //Compatibility
//End Calendar_WeekView_Cal_Friday_BeforeShow

//Custom Code @39-2A29BDB7
// -------------------------

	//Dynamically control our link.
	global $FileName;

	$QueryString = CCGetQueryString("QueryString", "");
	$QueryString = CCAddParam($QueryString, "v", "Day");

	//Figure out what day to jump to.


	$Component->SetLink($FileName . "?" . $QueryString);

// -------------------------
//End Custom Code

//Close Calendar_WeekView_Cal_Friday_BeforeShow @23-C052CD72
    return $Calendar_WeekView_Cal_Friday_BeforeShow;
}
//End Close Calendar_WeekView_Cal_Friday_BeforeShow

//Calendar_WeekView_Cal_Saturday_BeforeShow @24-8C9EA216
function Calendar_WeekView_Cal_Saturday_BeforeShow(& $sender)
{
    $Calendar_WeekView_Cal_Saturday_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_WeekView; //Compatibility
//End Calendar_WeekView_Cal_Saturday_BeforeShow

//Custom Code @40-2A29BDB7
// -------------------------

	//Dynamically control our link.
	global $FileName;

	$QueryString = CCGetQueryString("QueryString", "");
	$QueryString = CCAddParam($QueryString, "v", "Day");

	//Figure out what day to jump to.


	$Component->SetLink($FileName . "?" . $QueryString);

// -------------------------
//End Custom Code

//Close Calendar_WeekView_Cal_Saturday_BeforeShow @24-5A819EEC
    return $Calendar_WeekView_Cal_Saturday_BeforeShow;
}
//End Close Calendar_WeekView_Cal_Saturday_BeforeShow

//Calendar_WeekView_Cal_BeforeShowRow @2-EB171B2D
function Calendar_WeekView_Cal_BeforeShowRow(& $sender)
{
    $Calendar_WeekView_Cal_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_WeekView; //Compatibility
//End Calendar_WeekView_Cal_BeforeShowRow

//Custom Code @10-2A29BDB7
// -------------------------

	global $DBConnection1, $Tpl;
	global $Sunday, $Monday, $Tuesday, $Wednesday, $Thursday, $Friday, $Saturday;

	//Set the default style for each cell.
	$HeaderStyle = "width: 12.5%; height: 20px; ";
	$TimeOfDayStyle = "";
	$SundayStyle = "";
	$MondayStyle= "";
	$TuesdayStyle = "";
	$WednesdayStyle = "";
	$ThursdayStyle = "";
	$FridayStyle = "";
	$SaturdayStyle = "";

	//Define the dynamic styles.
	$EventStyleActive = "background-color: #e7e7e7; ";
	$HalfHourStyle = "border-top: 0px; ";

	//Get some default values for variables needed.
	$db = new clsDBConnection1();
	$Time = $Container->TimeOfDay->GetValue();
	$IdTime = CCDLookUp("id", "lu_calendars_times", "time=" . CCToSQL($Time, ccsText), $db);
	$LongTime = CCDLookUp("HHiiSS", "lu_calendars_times", "time=" . CCToSQL($Time, ccsText), $db);
	
	//If the time is a half hour time, then adjust the cell style, and don't show the half hour label.
	if (substr($LongTime, strlen($LongTime)-4, 4) == "3000") {
		$TimeOfDayStyle .= $HalfHourStyle;
		$SundayStyle .= $HalfHourStyle;
		$MondayStyle .= $HalfHourStyle;
		$TuesdayStyle .= $HalfHourStyle;
		$WednesdayStyle .= $HalfHourStyle;
		$ThursdayStyle .= $HalfHourStyle;
		$FridayStyle .= $HalfHourStyle;
		$SaturdayStyle .= $HalfHourStyle;
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

	//Set our initial event values.  If we don't do this, then for every event found, each subsequent
	//cell will remember the prior cell's value until a new value is found.
	$Container->SundayEvents->SetValue("");
	$Container->MondayEvents->SetValue("");
	$Container->TuesdayEvents->SetValue("");
	$Container->WednesdayEvents->SetValue("");
	$Container->ThursdayEvents->SetValue("");
	$Container->FridayEvents->SetValue("");
	$Container->SaturdayEvents->SetValue("");

	$WeekStart = date('Y-m-d', $Sunday) . " " . $IdTime;
	$WeekEnd = date('Y-m-d', $Saturday) . " " . $IdTime;

	$SQL = "SELECT * FROM tbl_calendars_items WHERE "
			. "calendar_id = " . CCToSQL(CCGetParam("c", ""), ccsInteger)
			. " AND TIME(calendar_item_start) <= " . CCToSQL($IdTime, ccsDate)
			. " AND calendar_item_start BETWEEN " . CCToSQL($WeekStart, ccsDate) . " AND " . CCToSQL($WeekEnd, ccsDate);
	$db->query($SQL);

	while ($db->next_record()) {

		$EventDay = CCFormatDate(CCParseDate($db->f("calendar_item_start"), array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss")), array("dddd"));
		$StartTime = CCFormatDate(CCParseDate($db->f("calendar_item_start"), array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss")), array("HH", ":", "nn", ":", "ss"));
		$EndTime = CCFormatDate(CCParseDate($db->f("calendar_item_end"), array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss")), array("HH", ":", "nn", ":", "ss"));
		
		if ($EventDay == "Sunday") {
			if ($StartTime == $IdTime) {
				$Container->SundayEvents->SetValue($db->f("calendar_item_title"));
				$SundayStyle .= $EventStyleActive;
			}
			if ($IdTime < $EndTime) {
				$SundayStyle .= $EventStyleActive;
			}
		}

		if ($EventDay == "Monday") {
			if ($StartTime == $IdTime) {
				$Container->MondayEvents->SetValue($db->f("calendar_item_title"));
				$MondayStyle .= $EventStyleActive;
			}
			if ($IdTime < $EndTime) {
				$MondayStyle .= $EventStyleActive;
			}
		}

		if ($EventDay == "Tuesday") {
			if ($StartTime == $IdTime) {
				$Container->TuesdayEvents->SetValue($db->f("calendar_item_title"));
				$TuesdayStyle .= $EventStyleActive;
			}
			if ($IdTime < $EndTime) {
				$TuesdayStyle .= $EventStyleActive;
			}
		}

		if ($EventDay == "Wednesday") {
			if ($StartTime == $IdTime) {
				$Container->WednesdayEvents->SetValue($db->f("calendar_item_title"));
				$WednesdayStyle .= $EventStyleActive;
			}
			if ($IdTime < $EndTime) {
				$WednesdayStyle .= $EventStyleActive;
			}
		}

		if ($EventDay == "Thursday") {
			if ($StartTime == $IdTime) {
				$Container->ThursdayEvents->SetValue($db->f("calendar_item_title"));
				$ThursdayStyle .= $EventStyleActive;
			}
			if ($IdTime < $EndTime) {
				$ThursdayStyle .= $EventStyleActive;
			}
		}

		if ($EventDay == "Friday") {
			if ($StartTime == $IdTime) {
				$Container->FridayEvents->SetValue($db->f("calendar_item_title"));
				$FridayStyle .= $EventStyleActive;
			}
			if ($IdTime < $EndTime) {
				$FridayStyle .= $EventStyleActive;
			}
		}

		if ($EventDay == "Saturday") {
			if ($StartTime == $IdTime) {
				$Container->SaturdayEvents->SetValue($db->f("calendar_item_title"));
				$SaturdayStyle .= $EventStyleActive;
			}
			if ($IdTime < $EndTime) {
				$SaturdayStyle .= $EventStyleActive;
			}
		}

	}

	$db->close();
	
	//Finally, set the styles.
	$Tpl->SetVar("HeaderStyle", $HeaderStyle);
	$Tpl->SetVar("TimeOfDayStyle", $TimeOfDayStyle);
	$Tpl->SetVar("SundayStyle", $SundayStyle);
	$Tpl->SetVar("MondayStyle", $MondayStyle);
	$Tpl->SetVar("TuesdayStyle", $TuesdayStyle);
	$Tpl->SetVar("WednesdayStyle", $WednesdayStyle);
	$Tpl->SetVar("ThursdayStyle", $ThursdayStyle);
	$Tpl->SetVar("FridayStyle", $FridayStyle);
	$Tpl->SetVar("SaturdayStyle", $SaturdayStyle);

// -------------------------
//End Custom Code

//Close Calendar_WeekView_Cal_BeforeShowRow @2-A418E4E4
    return $Calendar_WeekView_Cal_BeforeShowRow;
}
//End Close Calendar_WeekView_Cal_BeforeShowRow

//Calendar_WeekView_Cal_ds_BeforeBuildSelect @2-6EB7E476
function Calendar_WeekView_Cal_ds_BeforeBuildSelect(& $sender)
{
    $Calendar_WeekView_Cal_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_WeekView; //Compatibility
//End Calendar_WeekView_Cal_ds_BeforeBuildSelect

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

//Close Calendar_WeekView_Cal_ds_BeforeBuildSelect @2-8532D624
    return $Calendar_WeekView_Cal_ds_BeforeBuildSelect;
}
//End Close Calendar_WeekView_Cal_ds_BeforeBuildSelect

//Calendar_WeekView_BeforeShow @1-97D1B114
function Calendar_WeekView_BeforeShow(& $sender)
{
    $Calendar_WeekView_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_WeekView; //Compatibility
//End Calendar_WeekView_BeforeShow

//Declare Variable @46-50A1334A
    global $FileName;
    $FileName = $FileName;
//End Declare Variable

//Call Function @47-98EC19CD
    header(($Container->Visible == true AND !CCGetParam("CalDate", "")) ? "Location: " . $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "CalDate", date('Y') . "-" . date('m')) : "");
//End Call Function

//Custom Code @12-2A29BDB7
// -------------------------

	if ($Container->Visible == true) {

		global $Sunday, $Monday, $Tuesday, $Wednesday, $Thursday, $Friday, $Saturday;

		//Break down the CalDate.
		$Year = CCFormatDate(CCParseDate(CCGetParam("CalDate", ""), array("yyyy","-","mm")), array("yyyy"));
		$Month = CCFormatDate(CCParseDate(CCGetParam("CalDate", ""), array("yyyy","-","mm")), array("mm"));

		//Let's figure out which week we're in.	
		if (!CCGetParam("WeekNum", "")) {
				$WeekNumber = CCFormatDate(CCParseDate(CCGetParam("CalDate", ""), array("yyyy","-","mm")), array("ww"));
		}
		else {
			$WeekNumber = CCGetParam("WeekNum", "");
		}

		//Figure out what the days of the week are.
		$Sunday = DayOfWeek($Year, $WeekNumber, -1);
		$Monday = DayOfWeek($Year, $WeekNumber, 0);
		$Tuesday = DayOfWeek($Year, $WeekNumber, 1);
		$Wednesday = DayOfWeek($Year, $WeekNumber, 2);
		$Thursday = DayOfWeek($Year, $WeekNumber, 3);
		$Friday = DayOfWeek($Year, $WeekNumber, 4);
		$Saturday = DayOfWeek($Year, $WeekNumber, 5);

		$WeekDisplay = date('F j', $Sunday) . " - ";
		if (date('F', $Sunday) == date('F', $Saturday)) {
			$WeekDisplay .= date('j, ', $Saturday) . $Year;
		}
		else {
			$WeekDisplay .= date('F j, ', $Saturday) . $Year;
		}
		$Container->Cal->ThisWeek->SetValue($WeekDisplay);

		//Now fill out our day labels.
		$Container->Cal->Sunday->SetValue(date('D, M j', $Sunday));
		$Container->Cal->Monday->SetValue(date('D, M j', $Monday));
		$Container->Cal->Tuesday->SetValue(date('D, M j', $Tuesday));
		$Container->Cal->Wednesday->SetValue(date('D, M j', $Wednesday));
		$Container->Cal->Thursday->SetValue(date('D, M j', $Thursday));
		$Container->Cal->Friday->SetValue(date('D, M j', $Friday));
		$Container->Cal->Saturday->SetValue(date('D, M j', $Saturday));
	
		//Set the link for Previous week.  Reload with new CalDate if we went into the previous year.
		$PreviousWeek = $WeekNumber - 1;
		if (CCGetParam("WeekNum", "") == "0") {
			$PreviousWeek = 52;
			$NewCalDate = $Year - 1 . "-12";
			$QueryString = CCGetQueryString("QueryString", "");
			$QueryString = CCAddParam($QueryString, "CalDate", $NewCalDate);
			$QueryString = CCAddParam($QueryString, "WeekNum", $PreviousWeek);
			header("Location: " . $FileName . "?" . $QueryString); exit;
		}
	
		//Set the link for Next week.  Reload with new CalDate if we went into the next year.
		$NextWeek = $WeekNumber + 1;
		if (CCGetParam("WeekNum", "") == 53) {
			$NextWeek = 1;
			$NewCalDate = $Year + 1 . "-01";
			$QueryString = CCGetQueryString("QueryString", "");
			$QueryString = CCAddParam($QueryString, "CalDate", $NewCalDate);
			$QueryString = CCAddParam($QueryString, "WeekNum", $NextWeek);
			header("Location: " . $FileName . "?" . $QueryString); exit;
		}
	
		$Container->Cal->PreviousWeek->SetLink($FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "WeekNum", $PreviousWeek));
		$Container->Cal->NextWeek->SetLink($FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "WeekNum", $NextWeek));
	
	} //end if the container is visible.

// -------------------------
//End Custom Code

//Close Calendar_WeekView_BeforeShow @1-7A0DCE20
    return $Calendar_WeekView_BeforeShow;
}
//End Close Calendar_WeekView_BeforeShow

function DayOfWeek($year, $week, $offset) {
	//offsets: -1 = Prior Sunday
	//         +5 = Next Saturday
	$Jan1 = mktime(1,1,1,1,1, $year);
	$Offset = ((11-date('w', $Jan1))%7-3) + $offset;
	$DesiredDate = strtotime(($week-1) . " weeks " . $Offset . " days", $Jan1);
	return $DesiredDate;
}

?>
