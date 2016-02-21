<?php

class clsRecordCalendar_SettingsSettings { //Settings Class @2-008A6B5D

//Variables @2-9E315808

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

//Class_Initialize Event @2-DD6C861F
    function clsRecordCalendar_SettingsSettings($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record Settings/Error";
        $this->DataSource = new clsCalendar_SettingsSettingsDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "Settings";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Update = new clsButton("Button_Update", $Method, $this);
            $this->active = new clsControl(ccsCheckBox, "active", $CCSLocales->GetText("active"), ccsInteger, "", CCGetRequestParam("active", $Method, NULL), $this);
            $this->active->CheckedValue = $this->active->GetParsedValue(1);
            $this->active->UncheckedValue = $this->active->GetParsedValue(0);
            $this->inactive_message = new clsControl(ccsTextBox, "inactive_message", $CCSLocales->GetText("inactive_message"), ccsText, "", CCGetRequestParam("inactive_message", $Method, NULL), $this);
            $this->default_style = new clsControl(ccsListBox, "default_style", "default_style", ccsText, "", CCGetRequestParam("default_style", $Method, NULL), $this);
            $this->default_style->DSType = dsTable;
            $this->default_style->DataSource = new clsDBConnection1();
            $this->default_style->ds = & $this->default_style->DataSource;
            $this->default_style->DataSource->SQL = "SELECT * \n" .
"FROM tbl_styles {SQL_Where} {SQL_OrderBy}";
            list($this->default_style->BoundColumn, $this->default_style->TextColumn, $this->default_style->DBFormat) = array("style_name", "style_name", "");
            $this->default_style->DataSource->Parameters["expr14"] = "1";
            $this->default_style->DataSource->wp = new clsSQLParameters();
            $this->default_style->DataSource->wp->AddParameter("1", "expr14", ccsText, "", "", $this->default_style->DataSource->Parameters["expr14"], "", false);
            $this->default_style->DataSource->wp->Criterion[1] = $this->default_style->DataSource->wp->Operation(opEqual, "site_id", $this->default_style->DataSource->wp->GetDBValue("1"), $this->default_style->DataSource->ToSQL($this->default_style->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->default_style->DataSource->Where = 
                 $this->default_style->DataSource->wp->Criterion[1];
            $this->default_locale = new clsControl(ccsListBox, "default_locale", "default_locale", ccsText, "", CCGetRequestParam("default_locale", $Method, NULL), $this);
            $this->default_locale->DSType = dsTable;
            $this->default_locale->DataSource = new clsDBConnection1();
            $this->default_locale->ds = & $this->default_locale->DataSource;
            $this->default_locale->DataSource->SQL = "SELECT * \n" .
"FROM lu_locales {SQL_Where} {SQL_OrderBy}";
            list($this->default_locale->BoundColumn, $this->default_locale->TextColumn, $this->default_locale->DBFormat) = array("locale", "description", "");
            $this->site_title = new clsControl(ccsTextBox, "site_title", $CCSLocales->GetText("site_title"), ccsText, "", CCGetRequestParam("site_title", $Method, NULL), $this);
            $this->site_subtitle = new clsControl(ccsTextBox, "site_subtitle", $CCSLocales->GetText("site_subtitle"), ccsText, "", CCGetRequestParam("site_subtitle", $Method, NULL), $this);
            $this->default_calendar_view = new clsControl(ccsListBox, "default_calendar_view", "default_calendar_view", ccsText, "", CCGetRequestParam("default_calendar_view", $Method, NULL), $this);
            $this->default_calendar_view->DSType = dsListOfValues;
            $this->default_calendar_view->Values = array(array("Year", "Year"), array("Month", "Month"), array("Week", "Week"), array("Day", "Day"));
        }
    }
//End Class_Initialize Event

//Initialize Method @2-476B0297
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["expr4"] = "1";
    }
//End Initialize Method

//Validate Method @2-84ABFA91
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->active->Validate() && $Validation);
        $Validation = ($this->inactive_message->Validate() && $Validation);
        $Validation = ($this->default_style->Validate() && $Validation);
        $Validation = ($this->default_locale->Validate() && $Validation);
        $Validation = ($this->site_title->Validate() && $Validation);
        $Validation = ($this->site_subtitle->Validate() && $Validation);
        $Validation = ($this->default_calendar_view->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->active->Errors->Count() == 0);
        $Validation =  $Validation && ($this->inactive_message->Errors->Count() == 0);
        $Validation =  $Validation && ($this->default_style->Errors->Count() == 0);
        $Validation =  $Validation && ($this->default_locale->Errors->Count() == 0);
        $Validation =  $Validation && ($this->site_title->Errors->Count() == 0);
        $Validation =  $Validation && ($this->site_subtitle->Errors->Count() == 0);
        $Validation =  $Validation && ($this->default_calendar_view->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-49F5954E
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->active->Errors->Count());
        $errors = ($errors || $this->inactive_message->Errors->Count());
        $errors = ($errors || $this->default_style->Errors->Count());
        $errors = ($errors || $this->default_locale->Errors->Count());
        $errors = ($errors || $this->site_title->Errors->Count());
        $errors = ($errors || $this->site_subtitle->Errors->Count());
        $errors = ($errors || $this->default_calendar_view->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @2-ED598703
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

//Operation Method @2-517B5C36
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted) {
            $this->EditMode = $this->DataSource->AllParametersSet;
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = $this->EditMode ? "Button_Update" : "";
            if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_Update") {
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update) || !$this->UpdateRow()) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//UpdateRow Method @2-BE1A4437
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->active->SetValue($this->active->GetValue(true));
        $this->DataSource->inactive_message->SetValue($this->inactive_message->GetValue(true));
        $this->DataSource->default_style->SetValue($this->default_style->GetValue(true));
        $this->DataSource->default_locale->SetValue($this->default_locale->GetValue(true));
        $this->DataSource->site_title->SetValue($this->site_title->GetValue(true));
        $this->DataSource->site_subtitle->SetValue($this->site_subtitle->GetValue(true));
        $this->DataSource->default_calendar_view->SetValue($this->default_calendar_view->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @2-48839E5A
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

        $this->default_style->Prepare();
        $this->default_locale->Prepare();
        $this->default_calendar_view->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if($this->EditMode) {
            if($this->DataSource->Errors->Count()){
                $this->Errors->AddErrors($this->DataSource->Errors);
                $this->DataSource->Errors->clear();
            }
            $this->DataSource->Open();
            if($this->DataSource->Errors->Count() == 0 && $this->DataSource->next_record()) {
                $this->DataSource->SetValues();
                if(!$this->FormSubmitted){
                    $this->active->SetValue($this->DataSource->active->GetValue());
                    $this->inactive_message->SetValue($this->DataSource->inactive_message->GetValue());
                    $this->default_style->SetValue($this->DataSource->default_style->GetValue());
                    $this->default_locale->SetValue($this->DataSource->default_locale->GetValue());
                    $this->site_title->SetValue($this->DataSource->site_title->GetValue());
                    $this->site_subtitle->SetValue($this->DataSource->site_subtitle->GetValue());
                    $this->default_calendar_view->SetValue($this->DataSource->default_calendar_view->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->active->Errors->ToString());
            $Error = ComposeStrings($Error, $this->inactive_message->Errors->ToString());
            $Error = ComposeStrings($Error, $this->default_style->Errors->ToString());
            $Error = ComposeStrings($Error, $this->default_locale->Errors->ToString());
            $Error = ComposeStrings($Error, $this->site_title->Errors->ToString());
            $Error = ComposeStrings($Error, $this->site_subtitle->Errors->ToString());
            $Error = ComposeStrings($Error, $this->default_calendar_view->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);
        $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Update->Show();
        $this->active->Show();
        $this->inactive_message->Show();
        $this->default_style->Show();
        $this->default_locale->Show();
        $this->site_title->Show();
        $this->site_subtitle->Show();
        $this->default_calendar_view->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End Settings Class @2-FCB6E20C

class clsCalendar_SettingsSettingsDataSource extends clsDBConnection1 {  //SettingsDataSource Class @2-06B2F89B

//DataSource Variables @2-35E8376B
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $UpdateParameters;
    public $wp;
    public $AllParametersSet;

    public $UpdateFields = array();

    // Datasource fields
    public $active;
    public $inactive_message;
    public $default_style;
    public $default_locale;
    public $site_title;
    public $site_subtitle;
    public $default_calendar_view;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-2CC90F9D
    function clsCalendar_SettingsSettingsDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record Settings/Error";
        $this->Initialize();
        $this->active = new clsField("active", ccsInteger, "");
        
        $this->inactive_message = new clsField("inactive_message", ccsText, "");
        
        $this->default_style = new clsField("default_style", ccsText, "");
        
        $this->default_locale = new clsField("default_locale", ccsText, "");
        
        $this->site_title = new clsField("site_title", ccsText, "");
        
        $this->site_subtitle = new clsField("site_subtitle", ccsText, "");
        
        $this->default_calendar_view = new clsField("default_calendar_view", ccsText, "");
        

        $this->UpdateFields["active"] = array("Name" => "active", "Value" => "", "DataType" => ccsInteger);
        $this->UpdateFields["inactive_message"] = array("Name" => "inactive_message", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["default_style"] = array("Name" => "default_style", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["default_locale"] = array("Name" => "default_locale", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["site_title"] = array("Name" => "site_title", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["site_subtitle"] = array("Name" => "site_subtitle", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["default_calendar_view"] = array("Name" => "default_calendar_view", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-34853C14
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "expr4", ccsText, "", "", $this->Parameters["expr4"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "site_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-B3D4B3F1
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tbl_config {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-A7876C6A
    function SetValues()
    {
        $this->active->SetDBValue(trim($this->f("active")));
        $this->inactive_message->SetDBValue($this->f("inactive_message"));
        $this->default_style->SetDBValue($this->f("default_style"));
        $this->default_locale->SetDBValue($this->f("default_locale"));
        $this->site_title->SetDBValue($this->f("site_title"));
        $this->site_subtitle->SetDBValue($this->f("site_subtitle"));
        $this->default_calendar_view->SetDBValue($this->f("default_calendar_view"));
    }
//End SetValues Method

//Update Method @2-9CA43261
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["active"]["Value"] = $this->active->GetDBValue(true);
        $this->UpdateFields["inactive_message"]["Value"] = $this->inactive_message->GetDBValue(true);
        $this->UpdateFields["default_style"]["Value"] = $this->default_style->GetDBValue(true);
        $this->UpdateFields["default_locale"]["Value"] = $this->default_locale->GetDBValue(true);
        $this->UpdateFields["site_title"]["Value"] = $this->site_title->GetDBValue(true);
        $this->UpdateFields["site_subtitle"]["Value"] = $this->site_subtitle->GetDBValue(true);
        $this->UpdateFields["default_calendar_view"]["Value"] = $this->default_calendar_view->GetDBValue(true);
        $this->SQL = CCBuildUpdate("tbl_config", $this->UpdateFields, $this);
        $this->SQL .= strlen($this->Where) ? " WHERE " . $this->Where : $this->Where;
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

} //End SettingsDataSource Class @2-FCB6E20C

class clsCalendar_Settings { //Calendar_Settings class @1-0BAB5F94

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

//Class_Initialize Event @1-3F5F43F8
    function clsCalendar_Settings($RelativePath, $ComponentName, & $Parent)
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = $ComponentName;
        $this->RelativePath = $RelativePath;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->FileName = "Calendar_Settings.php";
        $this->Redirect = "";
        $this->TemplateFileName = "Calendar_Settings.html";
        $this->BlockToParse = "main";
        $this->TemplateEncoding = "UTF-8";
        $this->ContentType = "text/html";
    }
//End Class_Initialize Event

//Class_Terminate Event @1-58B40551
    function Class_Terminate()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
        unset($this->Settings);
    }
//End Class_Terminate Event

//BindEvents Method @1-36A3FE78
    function BindEvents()
    {
        $this->Settings->CCSEvents["AfterUpdate"] = "Calendar_Settings_Settings_AfterUpdate";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInitialize", $this);
    }
//End BindEvents Method

//Operations Method @1-876FADF2
    function Operations()
    {
        global $Redirect;
        if(!$this->Visible)
            return "";
        $this->Settings->Operation();
    }
//End Operations Method

//Initialize Method @1-3CD4F30E
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
        $this->Settings = new clsRecordCalendar_SettingsSettings($this->RelativePath, $this);
        $this->Settings->Initialize();
        $this->BindEvents();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
    }
//End Initialize Method

//Show Method @1-FF4250E9
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        $block_path = $Tpl->block_path;
        $Tpl->LoadTemplate("/Calendar/" . $this->TemplateFileName, $this->ComponentName, $this->TemplateEncoding, "remove");
        $Tpl->block_path = $Tpl->block_path . "/" . $this->ComponentName;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) {
            $Tpl->block_path = $block_path;
            $Tpl->SetVar($this->ComponentName, "");
            return "";
        }
        $this->Attributes->Show();
        $this->Settings->Show();
        $Tpl->Parse();
        $Tpl->block_path = $block_path;
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
        $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
    }
//End Show Method

} //End Calendar_Settings Class @1-FCB6E20C

//Include Event File @1-E8514004
include_once(RelativePath . "/Calendar/Calendar_Settings_events.php");
//End Include Event File


?>
