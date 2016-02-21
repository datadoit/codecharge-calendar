<?php
// //Events @1-F81417CB

//topmenu_TopMenu_BeforeShowRow @17-34280DE1
function topmenu_TopMenu_BeforeShowRow(& $sender)
{
    $topmenu_TopMenu_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $topmenu; //Compatibility
//End topmenu_TopMenu_BeforeShowRow

//Custom Code @32-2A29BDB7
// -------------------------

	/*
	//Have to clean up the menu links manually since we want to preserve parameters dynamically.

	//Parameters to never keep from view to view.
	$Link = CCRemoveParam($Component->ItemLink->GetLink(), "Login");
	$Link = CCRemoveParam($Link, "p");

	//Some cleanup of the link url is necessary.
	$Link = str_replace("amp;", "", $Link);
	$FirstCharacter = substr($Link, 0, 1);

	if ($FirstCharacter == "&") {
		$FirstCharacter = "?";
		$Link = $FirstCharacter . substr($Link, 1, strlen($Link));
	}
	elseif ($FirstCharacter <> "?") {
		$FirstCharacter = "?";
		$Link = $FirstCharacter . $Link;
	}

	//Now set the new link value.
	$Component->ItemLink->SetLink($Link);
	*/

// -------------------------
//End Custom Code

//Close topmenu_TopMenu_BeforeShowRow @17-DDD25226
    return $topmenu_TopMenu_BeforeShowRow;
}
//End Close topmenu_TopMenu_BeforeShowRow


?>
