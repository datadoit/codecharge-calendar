<?php
// //Events @1-F81417CB

//Calendar_Settings_Settings_AfterUpdate @2-E4AE73BB
function Calendar_Settings_Settings_AfterUpdate(& $sender)
{
    $Calendar_Settings_Settings_AfterUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Settings; //Compatibility
//End Calendar_Settings_Settings_AfterUpdate

//Custom Code @15-2A29BDB7
// -------------------------

	if ($Container->Errors->Count() == 0) {
		$Container->Errors->addError("<span style='color: GREEN;'>Changes saved!</span>");
	}

// -------------------------
//End Custom Code

//Close Calendar_Settings_Settings_AfterUpdate @2-A6BA3761
    return $Calendar_Settings_Settings_AfterUpdate;
}
//End Close Calendar_Settings_Settings_AfterUpdate


?>
