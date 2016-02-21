<?php
// //Events @1-F81417CB

//Calendar_YearView_Year_BeforeShowDay @2-7B8FA4A6
function Calendar_YearView_Year_BeforeShowDay(& $sender)
{
    $Calendar_YearView_Year_BeforeShowDay = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_YearView; //Compatibility
//End Calendar_YearView_Year_BeforeShowDay

//DLookup @38-713479C2
    global $DBConnection1;
    global $Event;
    $Page = CCGetParentPage($sender);
    $ccs_result = CCDLookUp("calendar_item_title", "tbl_calendars_items", "calendar_id=" . CCToSQL(CCGetParam("c", ""), ccsInteger) . " AND DATE(calendar_item_start)=" . CCToSQL(CCFormatDate($Container->CurrentProcessingDate, array("yyyy", "-", "mm", "-", "dd")), ccsDate), $Page->Connections["Connection1"]);
    $ccs_result = strval($ccs_result);
    $Event = $ccs_result;
//End DLookup

//Set Tag @39-D30E8682
    global $Tpl;
    $Tpl->SetVar("DayNumberStyle", ($Event) ? "font-weight: bold; " : "");
//End Set Tag

//Close Calendar_YearView_Year_BeforeShowDay @2-4887314A
    return $Calendar_YearView_Year_BeforeShowDay;
}
//End Close Calendar_YearView_Year_BeforeShowDay

//Calendar_YearView_BeforeShow @1-5215C0EA
function Calendar_YearView_BeforeShow(& $sender)
{
    $Calendar_YearView_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_YearView; //Compatibility
//End Calendar_YearView_BeforeShow

//Declare Variable @40-50A1334A
    global $FileName;
    $FileName = $FileName;
//End Declare Variable

//Call Function @41-9AF7707C
    header(($Container->Visible == true AND CCGetParam("CalDate", "")) ? "Location: " . $FileName . "?" . CCRemoveParam(CCGetQueryString("QueryString", ""), "CalDate") : "");
//End Call Function

//Call Function @42-933698CE
    header(($Container->Visible == true AND CCGetParam("WeekNum", "")) ? "Location: " . $FileName . "?" . CCRemoveParam(CCGetQueryString("QueryString", ""), "WeekNum") : "");
//End Call Function

//Call Function @43-0947C71B
    header(($Container->Visible == true AND CCGetParam("DayNum", "")) ? "Location: " . $FileName . "?" . CCRemoveParam(CCGetQueryString("QueryString", ""), "DayNum") : "");
//End Call Function

//Close Calendar_YearView_BeforeShow @1-960A8B87
    return $Calendar_YearView_BeforeShow;
}
//End Close Calendar_YearView_BeforeShow

?>
