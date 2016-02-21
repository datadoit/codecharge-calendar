<?php
//BindEvents Method @1-03419ECF
function BindEvents()
{
    global $SiteTitle;
    global $CCSEvents;
    $SiteTitle->CCSEvents["BeforeShow"] = "SiteTitle_BeforeShow";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//SiteTitle_BeforeShow @6-B76B5D14
function SiteTitle_BeforeShow(& $sender)
{
    $SiteTitle_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $SiteTitle; //Compatibility
//End SiteTitle_BeforeShow

//DLookup @7-3701B4E1
    global $DBConnection1;
    $Page = CCGetParentPage($sender);
    $ccs_result = CCDLookUp("site_title", "tbl_config", "site_id=" . CCToSQL(CCGetSession("SiteID", ""), ccsInteger), $Page->Connections["Connection1"]);
    $ccs_result = strval($ccs_result);
    $Container->SiteTitle->SetValue($ccs_result);
//End DLookup

//Close SiteTitle_BeforeShow @6-A7B8FF8E
    return $SiteTitle_BeforeShow;
}
//End Close SiteTitle_BeforeShow

//Page_AfterInitialize @1-12769A36
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $index; //Compatibility
//End Page_AfterInitialize

//Logout @4-4AAF6A8A
    if(strlen(CCGetParam("Logout", ""))) 
    {
        CCLogoutUser();
        CCSetCookie("calendarLogin", "");
    }
//End Logout

//Custom Code @12-2A29BDB7
// -------------------------

	//We don't want the page name to be readily visible.  However, if a form submission is
	//made and there's an error, then it must show.
	global $FileName;

	$URI = isset($_SERVER["REQUEST_URI"]) ? $_SERVER["REQUEST_URI"] : "";
    if(!strlen($URI)) {
        $URI = isset($_SERVER["SCRIPT_NAME"]) ? $_SERVER["SCRIPT_NAME"] : "";
	}
	
	$QueryString = CCGetQueryString("QueryString","");

	$pos = strpos($URI, $FileName);
	if ($pos AND !CCGetParam("ccsForm")) {
		if ($QueryString) {
			header("Location: " . ServerURL . "?" . CCGetQueryString("QueryString",""));
		}
		else {
			header("Location: " . ServerURL);
		}
		exit;
	}

	//Let's get rid of these if they're there.
	$QueryString = CCGetQueryString("QueryString", "");
	if (strlen($QueryString) > 1 AND (CCGetParam("Logout", "") OR CCGetParam("locale", "") OR CCGetParam("style", ""))) {

		$QueryString = CCRemoveParam($QueryString, "Logout");

		if (CCGetParam("locale", "")) {
			CCSetSession("locale", CCGetParam("locale", ""));
			$QueryString = CCRemoveParam($QueryString, "locale");
		}

		if (CCGetParam("style", "")) {
			CCSetSession("style", CCGetParam("style", ""));
			$QueryString = CCRemoveParam($QueryString, "style");
		}

		header("Location: " . ServerURL . "?" . $QueryString); exit;

	}

	//If Login is in the URL, then remove all other URL parameters.  If already logged in, 
	//then remove the Login parameter from the URL.
	if (CCGetParam("Login", "") == "True") {
		
		if (CCGetUserID()) {
			$QueryString = CCRemoveParam(CCGetQueryString("QueryString", ""), "Login");
			header("Location: " . ServerURL . "?" . $QueryString); exit;
		}

		//Make sure there's not a form submission.
		if (!CCGetParam("ccsForm", "") AND CCGetParam("m", "") OR CCGetParam("p", "") OR CCGetParam("v", "")) {
			header("Location: " . ServerURL . "?Login=True"); exit;
		}

	}


// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeInitialize @1-E5CCA708
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $index; //Compatibility
//End Page_BeforeInitialize

//Custom Code @11-2A29BDB7
// -------------------------

	//Set some session information.
	global $DBConnection1, $FileName, $Redirect;
	$URL = null;
	$SiteID = null;

	//Establish a DB connection.
	$db = new clsDBConnection1();

	//Get the URL for the site.  After retrieving this site's ID, validate it against the
	//database.  
	if (strtoupper(substr(PHP_OS,0,3)) == "WIN") {
		$host = $_SERVER['PHP_SELF'];
		$pieces = explode("/", $host);
		$URL = $pieces[1];
	}
	else {
		$URL = $_SERVER['HTTP_HOST'];
	}

	$SiteID = CCDLookUp("site_id", "tbl_config", "site_url=" . CCToSQL($URL, ccsText), $db);
	if (!$SiteID) {

		//Site doesn't exist, so let's come back to this and redirect to a setup program.  For now,
		//error out.
		die("Fatal error.  Site " . $URL . " doesn't exist!");

	}

	CCSetSession("SiteID", $SiteID);
	
	//Get the default locale and style if not already specified.
	if (CCGetSession("style", "") == "") {
		$SQL = "SELECT default_style, default_locale FROM tbl_config WHERE site_id=" . CCToSQL(CCGetSession("SiteID", ""), ccsInteger);
		$db->query($SQL);
		$Result = $db->next_record();
		if ($Result) {
			CCSetSession("style", $db->f("default_style"));
			CCSetSession("locale", $db->f("default_locale"));
			$Redirect = $FileName;
		}
		else {
			//Defaults if not specified.
			CCSetSession("style", "Basic");
			CCSetSession("locale", "en");
			$Redirect = $FileName;
		}
	}

	//Check the site modules and redirect accordingly.

	//Calendar only site?  If so, then show the default calendar view if no other view specified.
	$CalendarModule = CCDLookUp("*", "tbl_sites_modules", "site_id = " . CCToSQL(CCGetSession("SiteID", ""), ccsInteger) . " AND module_id = 1", $db);
	if ($CalendarModule) {
		
		//Are there any other modules for this site?  If so, then it's not a calendar only site.
		$OtherModules = CCDLookUp("*", "tbl_sites_modules", "site_id = " . CCToSQL(CCGetSession("SiteID", ""), ccsInteger) . " AND module_id > 1", $db);
		if (!$OtherModules AND !CCGetParam("Login", "") AND !CCGetParam("Logout", "") AND !CCGetParam("m", "") AND !CCGetParam("v", "") AND !CCGetParam("p", "") AND !CCGetParam("action", "")) {
			CCSetSession("SiteType", "Calendar");
			header("Location: " . ServerURL . "?m=Calendar"); exit;
		}
		elseif ($OtherModules) {
			CCSetSession("SiteType", "CRM");
		}

	}


	//Close the DB connection.
	$db->close();

// -------------------------
//End Custom Code

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize

//Page_BeforeShow @1-4CD7DBED
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $index; //Compatibility
//End Page_BeforeShow

//Hide-Show Component @15-60DB6D49
    if (!CCGetUserID())
        $Component->leftcolumn->Visible = false;
//End Hide-Show Component

//Hide-Show Component @14-7B4A7F37
    if (CCGetSession("SiteType", "") == "CRM" AND !CCGetUserID())
        $Component->topmenu->Visible = false;
//End Hide-Show Component

//Custom Code @13-2A29BDB7
// -------------------------

	global $FileName, $Redirect, $Tpl;
	
	//If site is a CRM site and not logged in, then redirect to log in.
	if (CCGetSession("SiteType", "") == "CRM") {
		if (!CCGetUserID() AND CCGetParam("Login", "") <> "True") {
			$Redirect = $FileName . "?Login=True";
		}
	}

	//Let's control the width of the content block based on whether or not the left column
	//is visible or not.  This is set in the content include, main DIV {ContentWidth}.
	if ($Container->leftcolumn->Visible == false AND CCGetParam("Login", "") <> "True") {
		$Tpl->SetVar("ContentWidth", "WIDTH: 99%;");
	}
	else {
		$Tpl->SetVar("ContentWidth", "WIDTH: 75%;");
	}

// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow


?>
