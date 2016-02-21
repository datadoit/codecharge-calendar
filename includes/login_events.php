<?php
// //Events @1-F81417CB

//login_CRMInactive_BeforeShow @10-0B1A8B33
function login_CRMInactive_BeforeShow(& $sender)
{
    $login_CRMInactive_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $login; //Compatibility
//End login_CRMInactive_BeforeShow

//DLookup @11-F41DCBB3
    global $DBConnection1;
    $Page = CCGetParentPage($sender);
    $ccs_result = CCDLookUp("inactive_message", "tbl_config", "site_id=" . CCToSQL(CCGetSession("SiteID", ""), ccsInteger), $Page->Connections["Connection1"]);
    $ccs_result = strval($ccs_result);
    $Container->CRMInactive->SetValue($ccs_result);
//End DLookup

//Close login_CRMInactive_BeforeShow @10-AAC23E5C
    return $login_CRMInactive_BeforeShow;
}
//End Close login_CRMInactive_BeforeShow

//login_LoginForm_Button_DoLogin_OnClick @17-88187151
function login_LoginForm_Button_DoLogin_OnClick(& $sender)
{
    $login_LoginForm_Button_DoLogin_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $login; //Compatibility
//End login_LoginForm_Button_DoLogin_OnClick

//Login @18-05A360F9
    global $CCSLocales;
    global $Redirect;
    if ($Container->autoLogin->Value != $Container->autoLogin->CheckedValue) {
        CCSetCookie("calendarLogin", "");
    }
    if ( !CCLoginUser( $Container->login->Value, $Container->password->Value)) {
        $Container->Errors->addError($CCSLocales->GetText("CCS_LoginError"));
        $Container->password->SetValue("");
        $login_LoginForm_Button_DoLogin_OnClick = 0;
        CCSetCookie("calendarLogin", "");
    } else {
        global $Redirect;
        if ($Container->autoLogin->Value == $Container->autoLogin->CheckedValue) {
            $ALLogin    = $Container->login->Value;
            $ALPassword = $Container->password->Value;
            CCSetALCookie($ALLogin, $ALPassword);
        }
        $Redirect = CCGetParam("ret_link", $Redirect);
        $login_LoginForm_Button_DoLogin_OnClick = 1;
    }
//End Login

//Close login_LoginForm_Button_DoLogin_OnClick @17-CE16E63B
    return $login_LoginForm_Button_DoLogin_OnClick;
}
//End Close login_LoginForm_Button_DoLogin_OnClick

//login_LoginForm_OnValidate @16-317BABD4
function login_LoginForm_OnValidate(& $sender)
{
    $login_LoginForm_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $login; //Compatibility
//End login_LoginForm_OnValidate

//Custom Code @25-2A29BDB7
// -------------------------

	//So we don't have several error messages, let's truncate to just one.
	
	global $CCSLocales;
	$Error = null;

	if (!CCStrLen($Container->login->GetText()) AND !CCStrLen($Container->password->GetText()) ) {
		$Error = $CCSLocales->GetText("CRM_EmailPasswordRequired");
	}
	elseif (!$Error AND !CCStrLen($Container->login->GetText()) ) {
		$Error = $CCSLocales->GetText("CRM_EmailRequired");
	}
	elseif (!$Error AND !CCStrLen($Container->password->GetText()) ) {
		$Error = $CCSLocales->GetText("CRM_PasswordRequired");
	}

	if ($Error) {
		$Container->Errors->addError($Error);
	}

// -------------------------
//End Custom Code

//Close login_LoginForm_OnValidate @16-147E9D18
    return $login_LoginForm_OnValidate;
}
//End Close login_LoginForm_OnValidate

//login_BeforeShow @1-47115E6D
function login_BeforeShow(& $sender)
{
    $login_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $login; //Compatibility
//End login_BeforeShow

//Declare Variable @14-FC3D1FC8
    global $DBConnection1;
    $DBConnection1 = $DBConnection1;
//End Declare Variable

//Hide-Show Component @13-A755668B
    if (CCDLookUp("active", "tbl_config", "site_id=" . CCToSQL(CCGetSession("SiteID", ""), ccsInteger), $DBConnection1) < 1)
        $Component->LoginForm->Visible = false;
//End Hide-Show Component

//Hide-Show Component @15-9DAB2FD8
    if (CCDLookUp("active", "tbl_config", "site_id=" . CCToSQL(CCGetSession("SiteID", ""), ccsInteger), $DBConnection1) == 1)
        $Component->CRMInactive->Visible = false;
//End Hide-Show Component

//Close login_BeforeShow @1-C8988BEE
    return $login_BeforeShow;
}
//End Close login_BeforeShow


?>
