<?php

class clsRecordheaderHeaderForm { //HeaderForm Class @7-ADDE0B17

//Variables @7-9E315808

    // Public variables
    public $ComponentType = "Record";
    public $ComponentName;
    public $Parent;
    public $HTMLFormAction;
    public $PressedButton;
    public $Errors;
    public $ErrorBlock;
    public $FormSubmitted;
    public $FormEnctype;
    public $Visible;
    public $IsEmpty;

    public $CCSEvents = "";
    public $CCSEventResult;

    public $RelativePath = "";

    public $InsertAllowed = false;
    public $UpdateAllowed = false;
    public $DeleteAllowed = false;
    public $ReadAllowed   = false;
    public $EditMode      = false;
    public $ds;
    public $DataSource;
    public $ValidatingControls;
    public $Controls;
    public $Attributes;

    // Class variables
//End Variables

//Class_Initialize Event @7-FE62DF8E
    function clsRecordheaderHeaderForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record HeaderForm/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "HeaderForm";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->style = new clsControl(ccsListBox, "style", "style", ccsText, "", CCGetRequestParam("style", $Method, NULL), $this);
            $this->style->DSType = dsTable;
            $this->style->DataSource = new clsDBConnection1();
            $this->style->ds = & $this->style->DataSource;
            $this->style->DataSource->SQL = "SELECT * \n" .
"FROM tbl_styles {SQL_Where} {SQL_OrderBy}";
            list($this->style->BoundColumn, $this->style->TextColumn, $this->style->DBFormat) = array("style_name", "style_name", "");
            $this->style->DataSource->Parameters["sesSiteID"] = CCGetSession("SiteID", NULL);
            $this->style->DataSource->wp = new clsSQLParameters();
            $this->style->DataSource->wp->AddParameter("1", "sesSiteID", ccsInteger, "", "", $this->style->DataSource->Parameters["sesSiteID"], "", false);
            $this->style->DataSource->wp->Criterion[1] = $this->style->DataSource->wp->Operation(opEqual, "site_id", $this->style->DataSource->wp->GetDBValue("1"), $this->style->DataSource->ToSQL($this->style->DataSource->wp->GetDBValue("1"), ccsInteger),false);
            $this->style->DataSource->Where = 
                 $this->style->DataSource->wp->Criterion[1];
            $this->Button_Search = new clsButton("Button_Search", $Method, $this);
            $this->Logout = new clsControl(ccsLink, "Logout", "Logout", ccsText, "", CCGetRequestParam("Logout", $Method, NULL), $this);
            $this->Logout->Page = "";
            $this->locale = new clsControl(ccsListBox, "locale", "locale", ccsText, "", CCGetRequestParam("locale", $Method, NULL), $this);
            $this->locale->DSType = dsTable;
            $this->locale->DataSource = new clsDBConnection1();
            $this->locale->ds = & $this->locale->DataSource;
            $this->locale->DataSource->SQL = "SELECT * \n" .
"FROM lu_locales {SQL_Where} {SQL_OrderBy}";
            list($this->locale->BoundColumn, $this->locale->TextColumn, $this->locale->DBFormat) = array("locale", "description", "");
            $this->lbl_Name = new clsControl(ccsLabel, "lbl_Name", "lbl_Name", ccsText, "", CCGetRequestParam("lbl_Name", $Method, NULL), $this);
            $this->lbl_Welcome = new clsControl(ccsLabel, "lbl_Welcome", "lbl_Welcome", ccsText, "", CCGetRequestParam("lbl_Welcome", $Method, NULL), $this);
            $this->Login = new clsControl(ccsLink, "Login", "Login", ccsText, "", CCGetRequestParam("Login", $Method, NULL), $this);
            $this->Login->Page = "";
            if(!$this->FormSubmitted) {
                if(!is_array($this->style->Value) && !strlen($this->style->Value) && $this->style->Value !== false)
                    $this->style->SetText(CCGetSession("style",""));
                if(!is_array($this->locale->Value) && !strlen($this->locale->Value) && $this->locale->Value !== false)
                    $this->locale->SetText(CCGetSession("locale"));
            }
            if(!is_array($this->lbl_Welcome->Value) && !strlen($this->lbl_Welcome->Value) && $this->lbl_Welcome->Value !== false)
                $this->lbl_Welcome->SetText($CCSLocales->GetText("CRM_Welcome"));
        }
    }
//End Class_Initialize Event

//Validate Method @7-8DF0FD0E
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->style->Validate() && $Validation);
        $Validation = ($this->locale->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->style->Errors->Count() == 0);
        $Validation =  $Validation && ($this->locale->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @7-1BF44267
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->style->Errors->Count());
        $errors = ($errors || $this->Logout->Errors->Count());
        $errors = ($errors || $this->locale->Errors->Count());
        $errors = ($errors || $this->lbl_Name->Errors->Count());
        $errors = ($errors || $this->lbl_Welcome->Errors->Count());
        $errors = ($errors || $this->Login->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @7-ED598703
function SetPrimaryKeys($keyArray)
{
    $this->PrimaryKeys = $keyArray;
}
function GetPrimaryKeys()
{
    return $this->PrimaryKeys;
}
function GetPrimaryKey($keyName)
{
    return $this->PrimaryKeys[$keyName];
}
//End MasterDetail

//Operation Method @7-1B326756
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        if(!$this->FormSubmitted) {
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = "Button_Search";
            if($this->Button_Search->Pressed) {
                $this->PressedButton = "Button_Search";
            }
        }
        $Redirect = $FileName;
        if($this->PressedButton == "Button_Search") {
            $Redirect = $FileName . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_Search", "Button_Search_x", "Button_Search_y")));
            if(!CCGetEvent($this->Button_Search->CCSEvents, "OnClick", $this->Button_Search)) {
                $Redirect = "";
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @7-A7EE6163
    function Show()
    {
        global $CCSUseAmp;
        global $Tpl;
        global $FileName;
        global $CCSLocales;
        $Error = "";

        if(!$this->Visible)
            return;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->style->Prepare();
        $this->locale->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }
        $this->Logout->Parameters = "";
        $this->Logout->Parameters = CCAddParam($this->Logout->Parameters, "Logout", "True");
        $this->Login->Parameters = "";
        $this->Login->Parameters = CCAddParam($this->Login->Parameters, "Login", "True");

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->style->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Logout->Errors->ToString());
            $Error = ComposeStrings($Error, $this->locale->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lbl_Name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lbl_Welcome->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Login->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->style->Show();
        $this->Button_Search->Show();
        $this->Logout->Show();
        $this->locale->Show();
        $this->lbl_Name->Show();
        $this->lbl_Welcome->Show();
        $this->Login->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End HeaderForm Class @7-FCB6E20C

class clsheader { //header class @1-0325152D

//Variables @1-51D7F06F
    public $ComponentType = "IncludablePage";
    public $Connections = array();
    public $FileName = "";
    public $Redirect = "";
    public $Tpl = "";
    public $TemplateFileName = "";
    public $BlockToParse = "";
    public $ComponentName = "";
    public $Attributes = "";

    // Events;
    public $CCSEvents = "";
    public $CCSEventResult = "";
    public $RelativePath;
    public $Visible;
    public $Parent;
//End Variables

//Class_Initialize Event @1-4AB373E1
    function clsheader($RelativePath, $ComponentName, & $Parent)
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = $ComponentName;
        $this->RelativePath = $RelativePath;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->FileName = "header.php";
        $this->Redirect = "";
        $this->TemplateFileName = "header.html";
        $this->BlockToParse = "main";
        $this->TemplateEncoding = "UTF-8";
        $this->ContentType = "text/html";
    }
//End Class_Initialize Event

//Class_Terminate Event @1-313ACF00
    function Class_Terminate()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
        unset($this->HeaderForm);
    }
//End Class_Terminate Event

//BindEvents Method @1-3B15BF49
    function BindEvents()
    {
        $this->HeaderForm->Logout->CCSEvents["BeforeShow"] = "header_HeaderForm_Logout_BeforeShow";
        $this->HeaderForm->lbl_Name->CCSEvents["BeforeShow"] = "header_HeaderForm_lbl_Name_BeforeShow";
        $this->HeaderForm->lbl_Welcome->CCSEvents["BeforeShow"] = "header_HeaderForm_lbl_Welcome_BeforeShow";
        $this->HeaderForm->Login->CCSEvents["BeforeShow"] = "header_HeaderForm_Login_BeforeShow";
        $this->TitleLink->CCSEvents["BeforeShow"] = "header_TitleLink_BeforeShow";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInitialize", $this);
    }
//End BindEvents Method

//Operations Method @1-33D4C2E5
    function Operations()
    {
        global $Redirect;
        if(!$this->Visible)
            return "";
        $this->HeaderForm->Operation();
    }
//End Operations Method

//Initialize Method @1-DF02ABCC
    function Initialize()
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInitialize", $this);
        if(!$this->Visible)
            return "";
        $this->Attributes = & $this->Parent->Attributes;
        $this->DBConnection1 = new clsDBConnection1();
        $this->Connections["Connection1"] = & $this->DBConnection1;

        // Create Components
        $this->HeaderForm = new clsRecordheaderHeaderForm($this->RelativePath, $this);
        $this->TitleLink = new clsControl(ccsLink, "TitleLink", "TitleLink", ccsText, "", CCGetRequestParam("TitleLink", ccsGet, NULL), $this);
        $this->TitleLink->Page = ".";
        $this->BindEvents();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
    }
//End Initialize Method

//Show Method @1-83A4A7E2
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        $block_path = $Tpl->block_path;
        $Tpl->LoadTemplate("/includes/" . $this->TemplateFileName, $this->ComponentName, $this->TemplateEncoding, "remove");
        $Tpl->block_path = $Tpl->block_path . "/" . $this->ComponentName;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) {
            $Tpl->block_path = $block_path;
            $Tpl->SetVar($this->ComponentName, "");
            return "";
        }
        $this->Attributes->Show();
        $this->HeaderForm->Show();
        $this->TitleLink->Show();
        $Tpl->Parse();
        $Tpl->block_path = $block_path;
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
        $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
    }
//End Show Method

} //End header Class @1-FCB6E20C

//Include Event File @1-16B1A70C
include_once(RelativePath . "/includes/header_events.php");
//End Include Event File


?>
