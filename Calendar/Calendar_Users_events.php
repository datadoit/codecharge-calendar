<?php
// //Events @1-F81417CB

//Calendar_Users_UsersSearch_u_ds_BeforeBuildSelect @5-622BBAAA
function Calendar_Users_UsersSearch_u_ds_BeforeBuildSelect(& $sender)
{
    $Calendar_Users_UsersSearch_u_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Users; //Compatibility
//End Calendar_Users_UsersSearch_u_ds_BeforeBuildSelect

//Custom Code @167-2A29BDB7
// -------------------------

	//Don't show the SuperUser if you're not the SuperUser.
	if (CCGetGroupID() <> 1) {
		if ($Component->ds->Where <> "") {
			$Component->ds->Where .= " AND ";
		}
		$Component->ds->Where .= "group_id <> 1";
	}

// -------------------------
//End Custom Code

//Close Calendar_Users_UsersSearch_u_ds_BeforeBuildSelect @5-4CAA257A
    return $Calendar_Users_UsersSearch_u_ds_BeforeBuildSelect;
}
//End Close Calendar_Users_UsersSearch_u_ds_BeforeBuildSelect

//Calendar_Users_UsersSearch_g_ds_BeforeBuildSelect @6-3F971C6E
function Calendar_Users_UsersSearch_g_ds_BeforeBuildSelect(& $sender)
{
    $Calendar_Users_UsersSearch_g_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Users; //Compatibility
//End Calendar_Users_UsersSearch_g_ds_BeforeBuildSelect

//Custom Code @168-2A29BDB7
// -------------------------

	//Don't show the SuperUser group if you're not the SuperUser.
	if (CCGetGroupID() <> 1) {
		if ($Component->ds->Where <> "") {
			$Component->ds->Where .= " AND ";
		}
		$Component->ds->Where .= "group_id <> 1";
	}

// -------------------------
//End Custom Code

//Close Calendar_Users_UsersSearch_g_ds_BeforeBuildSelect @6-EAFA9648
    return $Calendar_Users_UsersSearch_g_ds_BeforeBuildSelect;
}
//End Close Calendar_Users_UsersSearch_g_ds_BeforeBuildSelect

//Calendar_Users_UsersSearch_Button_Add_OnClick @9-5C7ADD21
function Calendar_Users_UsersSearch_Button_Add_OnClick(& $sender)
{
    $Calendar_Users_UsersSearch_Button_Add_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Users; //Compatibility
//End Calendar_Users_UsersSearch_Button_Add_OnClick

//Declare Variable @10-91446A29
    global $Redirect;
    $Redirect = "?p=Users&action=AddEdit";
//End Declare Variable

//Close Calendar_Users_UsersSearch_Button_Add_OnClick @9-4D8989D7
    return $Calendar_Users_UsersSearch_Button_Add_OnClick;
}
//End Close Calendar_Users_UsersSearch_Button_Add_OnClick

//Calendar_Users_UsersSearch_BeforeShow @2-F3932922
function Calendar_Users_UsersSearch_BeforeShow(& $sender)
{
    $Calendar_Users_UsersSearch_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Users; //Compatibility
//End Calendar_Users_UsersSearch_BeforeShow

//Hide-Show Component @119-7DBAA573
    if (CCGetParam("action", "") == "AddEdit")
        $Component->Visible = false;
//End Hide-Show Component

//Close Calendar_Users_UsersSearch_BeforeShow @2-50CFE45B
    return $Calendar_Users_UsersSearch_BeforeShow;
}
//End Close Calendar_Users_UsersSearch_BeforeShow

//Calendar_Users_UsersSearch_OnValidate @2-5D95CB47
function Calendar_Users_UsersSearch_OnValidate(& $sender)
{
    $Calendar_Users_UsersSearch_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Users; //Compatibility
//End Calendar_Users_UsersSearch_OnValidate

//Custom Code @121-2A29BDB7
// -------------------------

	//No search criteria given.
	if (!CCGetParam("u", "") AND !CCGetParam("g", "") AND !CCGetParam("n", "")) {
		$Container->Errors->addError("Please enter search criteria.");
	}

// -------------------------
//End Custom Code

//Close Calendar_Users_UsersSearch_OnValidate @2-6F3480D2
    return $Calendar_Users_UsersSearch_OnValidate;
}
//End Close Calendar_Users_UsersSearch_OnValidate

//Calendar_Users_UsersGrid_TotalRecords_BeforeShow @13-10294E3D
function Calendar_Users_UsersGrid_TotalRecords_BeforeShow(& $sender)
{
    $Calendar_Users_UsersGrid_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Users; //Compatibility
//End Calendar_Users_UsersGrid_TotalRecords_BeforeShow

//Retrieve number of records @14-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close Calendar_Users_UsersGrid_TotalRecords_BeforeShow @13-318C1F8F
    return $Calendar_Users_UsersGrid_TotalRecords_BeforeShow;
}
//End Close Calendar_Users_UsersGrid_TotalRecords_BeforeShow

//Calendar_Users_UsersGrid_group_BeforeShow @22-4E283332
function Calendar_Users_UsersGrid_group_BeforeShow(& $sender)
{
    $Calendar_Users_UsersGrid_group_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Users; //Compatibility
//End Calendar_Users_UsersGrid_group_BeforeShow

//DLookup @38-9CE1469B
    global $DBConnection1;
    $Page = CCGetParentPage($sender);
    $ccs_result = CCDLookUp("group_name", "tbl_groups", "group_id=" . CCToSQL($Container->ds->f("group_id"), ccsInteger), $Page->Connections["Connection1"]);
    $ccs_result = strval($ccs_result);
    $Container->group->SetValue($ccs_result);
//End DLookup

//Close Calendar_Users_UsersGrid_group_BeforeShow @22-61F9D8D9
    return $Calendar_Users_UsersGrid_group_BeforeShow;
}
//End Close Calendar_Users_UsersGrid_group_BeforeShow

//Calendar_Users_UsersGrid_Button_Submit_OnClick @26-455B2600
function Calendar_Users_UsersGrid_Button_Submit_OnClick(& $sender)
{
    $Calendar_Users_UsersGrid_Button_Submit_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Users; //Compatibility
//End Calendar_Users_UsersGrid_Button_Submit_OnClick

//Custom Code @138-2A29BDB7
// -------------------------

  	$Container->DeleteAllowed = false;
  
  	foreach ($Container->FormParameters['CheckBox_Delete'] as $key=>$value) {
  		if ($value != "") {
  			$code = $Container->CachedColumns["user_id"][$key];
  			if (CCGetParam("action","") == "delete") {
  				$Container->DeleteAllowed = true;
  			}
  		}
  	}

// -------------------------
//End Custom Code

//Close Calendar_Users_UsersGrid_Button_Submit_OnClick @26-CC898F51
    return $Calendar_Users_UsersGrid_Button_Submit_OnClick;
}
//End Close Calendar_Users_UsersGrid_Button_Submit_OnClick

//Calendar_Users_UsersGrid_BeforeShow @11-847D964B
function Calendar_Users_UsersGrid_BeforeShow(& $sender)
{
    $Calendar_Users_UsersGrid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Users; //Compatibility
//End Calendar_Users_UsersGrid_BeforeShow

//Hide-Show Component @28-51587253
    if (!CCGetParam("n", "") AND !CCGetParam("g", "") AND !CCGetParam("u", ""))
        $Component->Visible = false;
//End Hide-Show Component

//Hide-Show Component @141-36310F3A
    if (CCGetParam("action", ""))
        $Component->Header_ColumnAction->Visible = false;
//End Hide-Show Component

//Hide-Show Component @142-8DDB0101
    if (CCGetParam("action", ""))
        $Component->Data_ColumnAction->Visible = false;
//End Hide-Show Component

//Hide-Show Component @146-0EE1B559
    if (CCGetParam("action", ""))
        $Component->ActionPanel->Visible = false;
//End Hide-Show Component

//Close Calendar_Users_UsersGrid_BeforeShow @11-E9C4DBE7
    return $Calendar_Users_UsersGrid_BeforeShow;
}
//End Close Calendar_Users_UsersGrid_BeforeShow

//Calendar_Users_UsersGrid_ds_BeforeBuildSelect @11-2AED50A4
function Calendar_Users_UsersGrid_ds_BeforeBuildSelect(& $sender)
{
    $Calendar_Users_UsersGrid_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Users; //Compatibility
//End Calendar_Users_UsersGrid_ds_BeforeBuildSelect

//Custom Code @169-2A29BDB7
// -------------------------

	//Don't show the SuperUser if you're not the SuperUser.
	if (CCGetGroupID() <> 1) {
		if ($Container->ds->Where <> "") {
			$Container->ds->Where .= " AND ";
		}
		$Container->ds->Where .= "group_id <> 1";
	}

// -------------------------
//End Custom Code

//Close Calendar_Users_UsersGrid_ds_BeforeBuildSelect @11-F40AE474
    return $Calendar_Users_UsersGrid_ds_BeforeBuildSelect;
}
//End Close Calendar_Users_UsersGrid_ds_BeforeBuildSelect

//Calendar_Users_UserAddEdit_Button_Delete_BeforeShow @45-2F6D3F8B
function Calendar_Users_UserAddEdit_Button_Delete_BeforeShow(& $sender)
{
    $Calendar_Users_UserAddEdit_Button_Delete_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Users; //Compatibility
//End Calendar_Users_UserAddEdit_Button_Delete_BeforeShow

//Hide-Show Component @130-E2FBB6C1
    if (CCGetGroupID() > 2 OR CCGetUserID() == CCGetParam("id", ""))
        $Component->Visible = false;
//End Hide-Show Component

//Close Calendar_Users_UserAddEdit_Button_Delete_BeforeShow @45-D08C282A
    return $Calendar_Users_UserAddEdit_Button_Delete_BeforeShow;
}
//End Close Calendar_Users_UserAddEdit_Button_Delete_BeforeShow

//Calendar_Users_UserAddEdit_Button_Cancel_BeforeShow @47-B4511F82
function Calendar_Users_UserAddEdit_Button_Cancel_BeforeShow(& $sender)
{
    $Calendar_Users_UserAddEdit_Button_Cancel_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Users; //Compatibility
//End Calendar_Users_UserAddEdit_Button_Cancel_BeforeShow

//Hide-Show Component @131-370088BC
    if (!CCGetParam("u","") AND !CCGetParam("g","") AND !CCGetParam("n",""))
        $Component->Visible = false;
//End Hide-Show Component

//Hide-Show Component @143-22C2606C
    if (CCGetGroupID() < 3 AND CCGetParam("action", "") == "AddEdit" AND CCGetParam("u", "") AND CCGetParam("g", "") AND CCGetParam("n", ""))
        $Component->Visible = true;
//End Hide-Show Component

//Hide-Show Component @144-D79AC02A
    if (CCGetGroupID() < 3 AND CCGetParam("action", "") == "AddEdit" AND !CCGetParam("id", ""))
        $Component->Visible = true;
//End Hide-Show Component

//Close Calendar_Users_UserAddEdit_Button_Cancel_BeforeShow @47-457836A3
    return $Calendar_Users_UserAddEdit_Button_Cancel_BeforeShow;
}
//End Close Calendar_Users_UserAddEdit_Button_Cancel_BeforeShow

//Calendar_Users_UserAddEdit_user_login_OnValidate @49-71B9054E
function Calendar_Users_UserAddEdit_user_login_OnValidate(& $sender)
{
    $Calendar_Users_UserAddEdit_user_login_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Users; //Compatibility
//End Calendar_Users_UserAddEdit_user_login_OnValidate

//Validate Minimum Length @122-00DBF0EC
    global $CCSLocales;
    if (CCStrLen($Container->user_login->GetText()) < 8) {
        $Container->user_login->Errors->addError($CCSLocales->GetText("CRM_ErrorValidLogin"));
    }
//End Validate Minimum Length

//Validate Email @123-4C3A2EA8
    global $CCSLocales;
    if (CCStrLen($Container->user_login->GetText()) && !preg_match("/^[\w\.-]{1,}\@([\da-zA-Z-]{1,}\.){1,}[\da-zA-Z-]+$/", $Container->user_login->GetText()))
    {
        $Container->user_login->Errors->addError($CCSLocales->GetText("CRM_ErrorValidLogin"));
    }
//End Validate Email

//Close Calendar_Users_UserAddEdit_user_login_OnValidate @49-ED03E1CD
    return $Calendar_Users_UserAddEdit_user_login_OnValidate;
}
//End Close Calendar_Users_UserAddEdit_user_login_OnValidate

//Calendar_Users_UserAddEdit_group_id_ds_BeforeBuildSelect @53-18C7AB57
function Calendar_Users_UserAddEdit_group_id_ds_BeforeBuildSelect(& $sender)
{
    $Calendar_Users_UserAddEdit_group_id_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Users; //Compatibility
//End Calendar_Users_UserAddEdit_group_id_ds_BeforeBuildSelect

//Custom Code @159-2A29BDB7
// -------------------------

	//Only the SuperUser or an Admin can select the Administrators group.
	if (CCGetGroupID() > 2) {
		if ($Component->ds->Where <> "") {
			$Component->ds->Where .= " AND ";
		}
		$Component->ds->Where .= "group_id > 2";
	}

// -------------------------
//End Custom Code

//Close Calendar_Users_UserAddEdit_group_id_ds_BeforeBuildSelect @53-748EFE84
    return $Calendar_Users_UserAddEdit_group_id_ds_BeforeBuildSelect;
}
//End Close Calendar_Users_UserAddEdit_group_id_ds_BeforeBuildSelect

//Calendar_Users_UserAddEdit_group_id_BeforeShow @53-510300C2
function Calendar_Users_UserAddEdit_group_id_BeforeShow(& $sender)
{
    $Calendar_Users_UserAddEdit_group_id_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Users; //Compatibility
//End Calendar_Users_UserAddEdit_group_id_BeforeShow

//Hide-Show Component @164-5201F363
    if ($Container->ds->f("group_id") == 1 OR CCGetGroupID() > 2)
        $Component->Visible = false;
//End Hide-Show Component

//Close Calendar_Users_UserAddEdit_group_id_BeforeShow @53-0A166853
    return $Calendar_Users_UserAddEdit_group_id_BeforeShow;
}
//End Close Calendar_Users_UserAddEdit_group_id_BeforeShow

//Calendar_Users_UserAddEdit_first_name_OnValidate @55-890B53BE
function Calendar_Users_UserAddEdit_first_name_OnValidate(& $sender)
{
    $Calendar_Users_UserAddEdit_first_name_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Users; //Compatibility
//End Calendar_Users_UserAddEdit_first_name_OnValidate

//Validate Minimum Length @147-C54DED36
    global $CCSLocales;
    if (CCStrLen($Container->first_name->GetText()) < 1) {
        $Container->first_name->Errors->addError($CCSLocales->GetText("CRM_ErrorEnterFirstName"));
    }
//End Validate Minimum Length

//Close Calendar_Users_UserAddEdit_first_name_OnValidate @55-E7777CD4
    return $Calendar_Users_UserAddEdit_first_name_OnValidate;
}
//End Close Calendar_Users_UserAddEdit_first_name_OnValidate

//Calendar_Users_UserAddEdit_last_name_OnValidate @56-83C58FFD
function Calendar_Users_UserAddEdit_last_name_OnValidate(& $sender)
{
    $Calendar_Users_UserAddEdit_last_name_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Users; //Compatibility
//End Calendar_Users_UserAddEdit_last_name_OnValidate

//Validate Minimum Length @148-80735D82
    global $CCSLocales;
    if (CCStrLen($Container->last_name->GetText()) < 1) {
        $Container->last_name->Errors->addError($CCSLocales->GetText("CRM_ErrorEnterLastName"));
    }
//End Validate Minimum Length

//Close Calendar_Users_UserAddEdit_last_name_OnValidate @56-80BF8BA4
    return $Calendar_Users_UserAddEdit_last_name_OnValidate;
}
//End Close Calendar_Users_UserAddEdit_last_name_OnValidate

//Calendar_Users_UserAddEdit_AddEditLabel_BeforeShow @115-E9382AA5
function Calendar_Users_UserAddEdit_AddEditLabel_BeforeShow(& $sender)
{
    $Calendar_Users_UserAddEdit_AddEditLabel_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Users; //Compatibility
//End Calendar_Users_UserAddEdit_AddEditLabel_BeforeShow

//Declare Variable @116-BEE7B23A
    global $CCSLocales;
    $CCSLocales = $CCSLocales;
//End Declare Variable

//Retrieve Value for Control @117-72324E09
    $Container->AddEditLabel->SetValue((CCGetParam("action", "") == "AddEdit" AND !CCGetParam("id", "")) ? $CCSLocales->GetText("CRM_NewUser") : $CCSLocales->GetText("CRM_EditUser"));
//End Retrieve Value for Control

//Retrieve Value for Control @127-FD8F6C63
    $Container->AddEditLabel->SetValue((!CCGetParam("u", "") AND !CCGetParam("g", "") AND !CCGetParam("n", "") AND CCGetParam("id", "") == CCGetUserID()) ? $CCSLocales->GetText("CRM_MyProfile") : $Component->GetValue());
//End Retrieve Value for Control

//Close Calendar_Users_UserAddEdit_AddEditLabel_BeforeShow @115-770893A2
    return $Calendar_Users_UserAddEdit_AddEditLabel_BeforeShow;
}
//End Close Calendar_Users_UserAddEdit_AddEditLabel_BeforeShow

//Calendar_Users_UserAddEdit_NewPassword_OnValidate @124-99299101
function Calendar_Users_UserAddEdit_NewPassword_OnValidate(& $sender)
{
    $Calendar_Users_UserAddEdit_NewPassword_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Users; //Compatibility
//End Calendar_Users_UserAddEdit_NewPassword_OnValidate

//Reset Password Validation @128-D5AC8535
    if ($Container->EditMode && ($Container->NewPassword->GetValue() == "")) {
        $Component->Errors->Clear();
    }
//End Reset Password Validation

//Close Calendar_Users_UserAddEdit_NewPassword_OnValidate @124-0DCB41B3
    return $Calendar_Users_UserAddEdit_NewPassword_OnValidate;
}
//End Close Calendar_Users_UserAddEdit_NewPassword_OnValidate

//Calendar_Users_UserAddEdit_GroupLabel_BeforeShow @162-37F4DACF
function Calendar_Users_UserAddEdit_GroupLabel_BeforeShow(& $sender)
{
    $Calendar_Users_UserAddEdit_GroupLabel_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Users; //Compatibility
//End Calendar_Users_UserAddEdit_GroupLabel_BeforeShow

//Hide-Show Component @165-83ED17CE
    if ($Container->group_id->Visible == true)
        $Component->Visible = false;
//End Hide-Show Component

//DLookup @163-677BE268
    global $DBConnection1;
    $Page = CCGetParentPage($sender);
    $ccs_result = CCDLookUp("group_name", "tbl_groups", "group_id=" . CCToSQL(CCGetGroupID(), ccsInteger), $Page->Connections["Connection1"]);
    $ccs_result = strval($ccs_result);
    $Container->GroupLabel->SetValue($ccs_result);
//End DLookup

//Close Calendar_Users_UserAddEdit_GroupLabel_BeforeShow @162-AC180602
    return $Calendar_Users_UserAddEdit_GroupLabel_BeforeShow;
}
//End Close Calendar_Users_UserAddEdit_GroupLabel_BeforeShow

//Calendar_Users_UserAddEdit_BeforeShow @39-CD4DD5C2
function Calendar_Users_UserAddEdit_BeforeShow(& $sender)
{
    $Calendar_Users_UserAddEdit_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Users; //Compatibility
//End Calendar_Users_UserAddEdit_BeforeShow

//Hide-Show Component @118-AA5367F1
    if (CCGetParam("action", "") <> "AddEdit")
        $Component->Visible = false;
//End Hide-Show Component

//Preserve Password @40-580CBE68
    if (!$Component->FormSubmitted) {
        $Component->user_password_Shadow->SetValue(CCEncryptString($Component->NewPassword->GetValue(), CCS_ENCRYPTION_KEY_FOR_COOKIE));
        $Component->NewPassword->SetValue("");
    }
//End Preserve Password

//Hide-Show Component @150-1542346A
    if (CCGetParam("id", "") == 1 OR CCGetGroupID() > 2 OR CCGetUserID() == CCGetParam("id", ""))
        $Component->ActivePanel->Visible = false;
//End Hide-Show Component

//Close Calendar_Users_UserAddEdit_BeforeShow @39-33C48B55
    return $Calendar_Users_UserAddEdit_BeforeShow;
}
//End Close Calendar_Users_UserAddEdit_BeforeShow

//Calendar_Users_UserAddEdit_ds_BeforeExecuteInsert @39-11CAF25D
function Calendar_Users_UserAddEdit_ds_BeforeExecuteInsert(& $sender)
{
    $Calendar_Users_UserAddEdit_ds_BeforeExecuteInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Users; //Compatibility
//End Calendar_Users_UserAddEdit_ds_BeforeExecuteInsert

//Encrypt Password @42-87E509D1
    $Component->DataSource->SQL = str_replace("'{password}'", "MD5(" . $Component->DataSource->ToSQL($Component->NewPassword->GetValue(), ccsText) . ")", $Component->DataSource->SQL);
//End Encrypt Password

//Close Calendar_Users_UserAddEdit_ds_BeforeExecuteInsert @39-DC8FBD17
    return $Calendar_Users_UserAddEdit_ds_BeforeExecuteInsert;
}
//End Close Calendar_Users_UserAddEdit_ds_BeforeExecuteInsert

//Calendar_Users_UserAddEdit_ds_BeforeExecuteUpdate @39-D47B4A55
function Calendar_Users_UserAddEdit_ds_BeforeExecuteUpdate(& $sender)
{
    $Calendar_Users_UserAddEdit_ds_BeforeExecuteUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Users; //Compatibility
//End Calendar_Users_UserAddEdit_ds_BeforeExecuteUpdate

//Encrypt Password @44-48B7A938
    if ("" != $Component->NewPassword->GetValue()) {
        $Component->DataSource->SQL = str_replace("'{password}'", "MD5(" . $Component->DataSource->ToSQL($Component->NewPassword->GetValue(), ccsText) . ")", $Component->DataSource->SQL);
    } else {
        $Component->DataSource->SQL = str_replace("'{password}'", $Component->DataSource->ToSQL(CCDecryptString($Component->user_password_Shadow->GetValue(), CCS_ENCRYPTION_KEY_FOR_COOKIE), ccsText), $Component->DataSource->SQL);
    }
//End Encrypt Password

//Close Calendar_Users_UserAddEdit_ds_BeforeExecuteUpdate @39-13A67C98
    return $Calendar_Users_UserAddEdit_ds_BeforeExecuteUpdate;
}
//End Close Calendar_Users_UserAddEdit_ds_BeforeExecuteUpdate

//Calendar_Users_UserAddEdit_AfterUpdate @39-B7485A42
function Calendar_Users_UserAddEdit_AfterUpdate(& $sender)
{
    $Calendar_Users_UserAddEdit_AfterUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Users; //Compatibility
//End Calendar_Users_UserAddEdit_AfterUpdate

//Custom Code @129-2A29BDB7
// -------------------------

	global $CCSLocales;
	if ($Container->Errors->Count() == 0) {
		$Container->Errors->addError("<span style='color: GREEN;'>" . $CCSLocales->GetText("CRM_ChangesSaved") . "</span>");
	}

// -------------------------
//End Custom Code

//Close Calendar_Users_UserAddEdit_AfterUpdate @39-ADB69AB0
    return $Calendar_Users_UserAddEdit_AfterUpdate;
}
//End Close Calendar_Users_UserAddEdit_AfterUpdate

//Calendar_Users_UserAddEdit_OnValidate @39-634B37A7
function Calendar_Users_UserAddEdit_OnValidate(& $sender)
{
    $Calendar_Users_UserAddEdit_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Calendar_Users; //Compatibility
//End Calendar_Users_UserAddEdit_OnValidate

//Retrieve Value for Control @154-CDAD6053
    $Container->state->SetValue(($Container->country->GetValue() <> "1") ? "" : $Container->state->GetValue());
//End Retrieve Value for Control

//Close Calendar_Users_UserAddEdit_OnValidate @39-0C3FEFDC
    return $Calendar_Users_UserAddEdit_OnValidate;
}
//End Close Calendar_Users_UserAddEdit_OnValidate
?>
