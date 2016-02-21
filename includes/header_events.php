<?php
// //Events @1-F81417CB

//header_HeaderForm_Logout_BeforeShow @4-9ACA2B50
function header_HeaderForm_Logout_BeforeShow(& $sender)
{
    $header_HeaderForm_Logout_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $header; //Compatibility
//End header_HeaderForm_Logout_BeforeShow

//Hide-Show Component @12-7BE60715
    if (!CCGetUserID())
        $Component->Visible = false;
//End Hide-Show Component

//Close header_HeaderForm_Logout_BeforeShow @4-283EC268
    return $header_HeaderForm_Logout_BeforeShow;
}
//End Close header_HeaderForm_Logout_BeforeShow

//header_HeaderForm_lbl_Name_BeforeShow @16-50E9D0D1
function header_HeaderForm_lbl_Name_BeforeShow(& $sender)
{
    $header_HeaderForm_lbl_Name_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $header; //Compatibility
//End header_HeaderForm_lbl_Name_BeforeShow

//DLookup @17-00D212A9
    global $DBConnection1;
    $Page = CCGetParentPage($sender);
    $ccs_result = CCDLookUp("CONCAT(first_name, ' ', last_name, '!')", "tbl_users", "user_id=" . CCToSQL(CCGetUserID(), ccsInteger), $Page->Connections["Connection1"]);
    $ccs_result = strval($ccs_result);
    $Container->lbl_Name->SetValue($ccs_result);
//End DLookup

//Close header_HeaderForm_lbl_Name_BeforeShow @16-5CBA19DF
    return $header_HeaderForm_lbl_Name_BeforeShow;
}
//End Close header_HeaderForm_lbl_Name_BeforeShow

//header_HeaderForm_lbl_Welcome_BeforeShow @18-97A33D32
function header_HeaderForm_lbl_Welcome_BeforeShow(& $sender)
{
    $header_HeaderForm_lbl_Welcome_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $header; //Compatibility
//End header_HeaderForm_lbl_Welcome_BeforeShow

//Hide-Show Component @19-7BE60715
    if (!CCGetUserID())
        $Component->Visible = false;
//End Hide-Show Component

//Close header_HeaderForm_lbl_Welcome_BeforeShow @18-ECA14D41
    return $header_HeaderForm_lbl_Welcome_BeforeShow;
}
//End Close header_HeaderForm_lbl_Welcome_BeforeShow

//header_HeaderForm_Login_BeforeShow @30-4806048C
function header_HeaderForm_Login_BeforeShow(& $sender)
{
    $header_HeaderForm_Login_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $header; //Compatibility
//End header_HeaderForm_Login_BeforeShow

//Hide-Show Component @31-C4FFE77D
    if (CCGetUserID())
        $Component->Visible = false;
//End Hide-Show Component

//Close header_HeaderForm_Login_BeforeShow @30-1BD71F18
    return $header_HeaderForm_Login_BeforeShow;
}
//End Close header_HeaderForm_Login_BeforeShow

//header_TitleLink_BeforeShow @24-4B5201B4
function header_TitleLink_BeforeShow(& $sender)
{
    $header_TitleLink_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $header; //Compatibility
//End header_TitleLink_BeforeShow

//DLookup @25-7099E037
    global $DBConnection1;
    $Page = CCGetParentPage($sender);
    $ccs_result = CCDLookUp("site_title", "tbl_config", "site_id=" . CCToSQL(CCGetSession("SiteID", ""), ccsInteger), $Page->Connections["Connection1"]);
    $ccs_result = strval($ccs_result);
    $Container->TitleLink->SetValue($ccs_result);
//End DLookup

//Close header_TitleLink_BeforeShow @24-A55667A0
    return $header_TitleLink_BeforeShow;
}
//End Close header_TitleLink_BeforeShow

?>