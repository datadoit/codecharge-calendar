<?php
// //Events @1-F81417CB

//Calendar_Menu_CalendarMenu_BeforeShowRow @2-23802F8F
function Calendar_Menu_CalendarMenu_BeforeShowRow(& $sender)
{
    $Calendar_Menu_CalendarMenu_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Menu; //Compatibility
//End Calendar_Menu_CalendarMenu_BeforeShowRow

//Declare Variable @14-BEE7B23A
    global $CCSLocales;
    $CCSLocales = $CCSLocales;
//End Declare Variable

//Hide-Show Component @13-066BB423
    if ($Component->ItemLink->GetValue() == $CCSLocales->GetText("CRM_Users") AND CCGetGroupID() > 2)
        $Component->ItemLink->Visible = false;
//End Hide-Show Component

//Custom Code @15-2A29BDB7
// -------------------------

	//For My Profile, we want to dynamically set the link based on the User's ID.
	if ($Component->ItemLink->GetValue() == $CCSLocales->GetText("CRM_MyProfile")) {
		$Component->ItemLink->SetLink("?p=Users&action=AddEdit&id=" . CCGetUserID());
	}

// -------------------------
//End Custom Code

//Close Calendar_Menu_CalendarMenu_BeforeShowRow @2-D0954961
    return $Calendar_Menu_CalendarMenu_BeforeShowRow;
}
//End Close Calendar_Menu_CalendarMenu_BeforeShowRow


?>
