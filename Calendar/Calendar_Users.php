<?php

class clsRecordCalendar_UsersUsersSearch { //UsersSearch Class @2-A16128EE

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

//Class_Initialize Event @2-33C2422C
    function clsRecordCalendar_UsersUsersSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record UsersSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "UsersSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->u = new clsControl(ccsListBox, "u", "u", ccsText, "", CCGetRequestParam("u", $Method, NULL), $this);
            $this->u->DSType = dsTable;
            $this->u->DataSource = new clsDBConnection1();
            $this->u->ds = & $this->u->DataSource;
            $this->u->DataSource->SQL = "SELECT * \n" .
"FROM tbl_users {SQL_Where} {SQL_OrderBy}";
            list($this->u->BoundColumn, $this->u->TextColumn, $this->u->DBFormat) = array("user_id", "user_login", "");
            $this->g = new clsControl(ccsListBox, "g", "g", ccsInteger, "", CCGetRequestParam("g", $Method, NULL), $this);
            $this->g->DSType = dsTable;
            $this->g->DataSource = new clsDBConnection1();
            $this->g->ds = & $this->g->DataSource;
            $this->g->DataSource->SQL = "SELECT * \n" .
"FROM tbl_groups {SQL_Where} {SQL_OrderBy}";
            list($this->g->BoundColumn, $this->g->TextColumn, $this->g->DBFormat) = array("group_id", "group_name", "");
            $this->n = new clsControl(ccsTextBox, "n", "n", ccsText, "", CCGetRequestParam("n", $Method, NULL), $this);
            $this->Button_Clear = new clsButton("Button_Clear", $Method, $this);
            $this->Button_Add = new clsButton("Button_Add", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @2-80208A1F
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->u->Validate() && $Validation);
        $Validation = ($this->g->Validate() && $Validation);
        $Validation = ($this->n->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->u->Errors->Count() == 0);
        $Validation =  $Validation && ($this->g->Errors->Count() == 0);
        $Validation =  $Validation && ($this->n->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-B442C029
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->u->Errors->Count());
        $errors = ($errors || $this->g->Errors->Count());
        $errors = ($errors || $this->n->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
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

//Operation Method @2-72A664C8
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
            $this->PressedButton = "Button_DoSearch";
            if($this->Button_DoSearch->Pressed) {
                $this->PressedButton = "Button_DoSearch";
            } else if($this->Button_Clear->Pressed) {
                $this->PressedButton = "Button_Clear";
            } else if($this->Button_Add->Pressed) {
                $this->PressedButton = "Button_Add";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Clear") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "action", "id", "g", "n", "u", "UsersGridOrder", "UsersGridDir", "SorterLastName", "SorterLogin", "SorterGroup", "UsersGridPage", "UsersGridPageSize"));
            if(!CCGetEvent($this->Button_Clear->CCSEvents, "OnClick", $this->Button_Clear)) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Add") {
            if(!CCGetEvent($this->Button_Add->CCSEvents, "OnClick", $this->Button_Add)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = $FileName . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y", "Button_Clear", "Button_Clear_x", "Button_Clear_y", "Button_Add", "Button_Add_x", "Button_Add_y")), CCGetQueryString("QueryString", array("u", "g", "n", "ccsForm")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @2-09FC2B74
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

        $this->u->Prepare();
        $this->g->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->u->Errors->ToString());
            $Error = ComposeStrings($Error, $this->g->Errors->ToString());
            $Error = ComposeStrings($Error, $this->n->Errors->ToString());
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

        $this->Button_DoSearch->Show();
        $this->u->Show();
        $this->g->Show();
        $this->n->Show();
        $this->Button_Clear->Show();
        $this->Button_Add->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End UsersSearch Class @2-FCB6E20C

class clsEditableGridCalendar_UsersUsersGrid { //UsersGrid Class @11-20418E43

//Variables @11-D1D19DB0

    // Public variables
    public $ComponentType = "EditableGrid";
    public $ComponentName;
    public $HTMLFormAction;
    public $PressedButton;
    public $Errors;
    public $ErrorBlock;
    public $FormSubmitted;
    public $FormParameters;
    public $FormState;
    public $FormEnctype;
    public $CachedColumns;
    public $TotalRows;
    public $UpdatedRows;
    public $EmptyRows;
    public $Visible;
    public $RowsErrors;
    public $ds;
    public $DataSource;
    public $PageSize;
    public $IsEmpty;
    public $SorterName = "";
    public $SorterDirection = "";
    public $PageNumber;
    public $ControlsVisible = array();

    public $CCSEvents = "";
    public $CCSEventResult;

    public $RelativePath = "";

    public $InsertAllowed = false;
    public $UpdateAllowed = false;
    public $DeleteAllowed = false;
    public $ReadAllowed   = false;
    public $EditMode;
    public $ValidatingControls;
    public $Controls;
    public $ControlsErrors;
    public $RowNumber;
    public $Attributes;
    public $PrimaryKeys;

    // Class variables
    public $SorterLastName;
    public $SorterLogin;
    public $SorterGroup;
//End Variables

//Class_Initialize Event @11-0B3F4078
    function clsEditableGridCalendar_UsersUsersGrid($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid UsersGrid/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "UsersGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["user_id"][0] = "user_id";
        $this->DataSource = new clsCalendar_UsersUsersGridDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 10;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: EditableGrid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->EmptyRows = 0;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if(!$this->Visible) return;

        $CCSForm = CCGetFromGet("ccsForm", "");
        $this->FormEnctype = "application/x-www-form-urlencoded";
        $this->FormSubmitted = ($CCSForm == $this->ComponentName);
        if($this->FormSubmitted) {
            $this->FormState = CCGetFromPost("FormState", "");
            $this->SetFormState($this->FormState);
        } else {
            $this->FormState = "";
        }
        $Method = $this->FormSubmitted ? ccsPost : ccsGet;

        $this->SorterName = CCGetParam("UsersGridOrder", "");
        $this->SorterDirection = CCGetParam("UsersGridDir", "");

        $this->TotalRecords = new clsControl(ccsLabel, "TotalRecords", "TotalRecords", ccsText, "", NULL, $this);
        $this->user_name = new clsControl(ccsLink, "user_name", $CCSLocales->GetText("last_name"), ccsText, "", NULL, $this);
        $this->user_name->Page = "";
        $this->user_login = new clsControl(ccsLabel, "user_login", $CCSLocales->GetText("user_login"), ccsText, "", NULL, $this);
        $this->group = new clsControl(ccsLabel, "group", $CCSLocales->GetText("group_id"), ccsText, "", NULL, $this);
        $this->Data_ColumnAction = new clsPanel("Data_ColumnAction", $this);
        $this->CheckBox_Delete = new clsControl(ccsCheckBox, "CheckBox_Delete", "CheckBox_Delete", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->CheckBox_Delete->CheckedValue = true;
        $this->CheckBox_Delete->UncheckedValue = false;
        $this->user_id = new clsControl(ccsHidden, "user_id", "user_id", ccsInteger, "", NULL, $this);
        $this->FooterPanel = new clsPanel("FooterPanel", $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->ActionPanel = new clsPanel("ActionPanel", $this);
        $this->action = new clsControl(ccsListBox, "action", "action", ccsText, "", NULL, $this);
        $this->action->DSType = dsListOfValues;
        $this->action->Values = array(array("delete", $CCSLocales->GetText("CCS_Delete")));
        $this->Button_Submit = new clsButton("Button_Submit", $Method, $this);
        $this->HeaderPanel = new clsPanel("HeaderPanel", $this);
        $this->SorterLastName = new clsSorter($this->ComponentName, "SorterLastName", $FileName, $this);
        $this->SorterLogin = new clsSorter($this->ComponentName, "SorterLogin", $FileName, $this);
        $this->SorterGroup = new clsSorter($this->ComponentName, "SorterGroup", $FileName, $this);
        $this->Header_ColumnAction = new clsPanel("Header_ColumnAction", $this);
        $this->CheckBox_SelectAll = new clsControl(ccsCheckBox, "CheckBox_SelectAll", "CheckBox_SelectAll", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->CheckBox_SelectAll->CheckedValue = true;
        $this->CheckBox_SelectAll->UncheckedValue = false;
        $this->Data_ColumnAction->AddComponent("CheckBox_Delete", $this->CheckBox_Delete);
        $this->Data_ColumnAction->AddComponent("user_id", $this->user_id);
        $this->FooterPanel->AddComponent("Navigator", $this->Navigator);
        $this->FooterPanel->AddComponent("ActionPanel", $this->ActionPanel);
        $this->ActionPanel->AddComponent("action", $this->action);
        $this->ActionPanel->AddComponent("Button_Submit", $this->Button_Submit);
        $this->HeaderPanel->AddComponent("SorterLastName", $this->SorterLastName);
        $this->HeaderPanel->AddComponent("SorterLogin", $this->SorterLogin);
        $this->HeaderPanel->AddComponent("SorterGroup", $this->SorterGroup);
        $this->HeaderPanel->AddComponent("Header_ColumnAction", $this->Header_ColumnAction);
        $this->Header_ColumnAction->AddComponent("CheckBox_SelectAll", $this->CheckBox_SelectAll);
    }
//End Class_Initialize Event

//Initialize Method @11-287B20F3
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urlu"] = CCGetFromGet("u", NULL);
        $this->DataSource->Parameters["urlg"] = CCGetFromGet("g", NULL);
        $this->DataSource->Parameters["urln"] = CCGetFromGet("n", NULL);
    }
//End Initialize Method

//SetPrimaryKeys Method @11-EBC3F86C
    function SetPrimaryKeys($PrimaryKeys) {
        $this->PrimaryKeys = $PrimaryKeys;
        return $this->PrimaryKeys;
    }
//End SetPrimaryKeys Method

//GetPrimaryKeys Method @11-74F9A772
    function GetPrimaryKeys() {
        return $this->PrimaryKeys;
    }
//End GetPrimaryKeys Method

//GetFormParameters Method @11-995B6550
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["CheckBox_Delete"][$RowNumber] = CCGetFromPost("CheckBox_Delete_" . $RowNumber, NULL);
            $this->FormParameters["user_id"][$RowNumber] = CCGetFromPost("user_id_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @11-EEB1CDEF
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["user_id"] = $this->CachedColumns["user_id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            $this->user_id->SetText($this->FormParameters["user_id"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if(!$this->CheckBox_Delete->Value)
                    $Validation = ($this->ValidateRow() && $Validation);
            }
            else if($this->CheckInsert())
            {
                $Validation = ($this->ValidateRow() && $Validation);
            }
        }
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//ValidateRow Method @11-9D5AEE07
    function ValidateRow()
    {
        global $CCSLocales;
        $this->CheckBox_Delete->Validate();
        $this->user_id->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->CheckBox_Delete->Errors->ToString());
        $errors = ComposeStrings($errors, $this->user_id->Errors->ToString());
        $this->CheckBox_Delete->Errors->Clear();
        $this->user_id->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @11-97CB6937
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["user_id"][$this->RowNumber]) && count($this->FormParameters["user_id"][$this->RowNumber])) || strlen($this->FormParameters["user_id"][$this->RowNumber]));
        return $filed;
    }
//End CheckInsert Method

//CheckErrors Method @11-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @11-909F269B
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted)
            return;

        $this->GetFormParameters();
        $this->PressedButton = "Button_Submit";
        if($this->Button_Submit->Pressed) {
            $this->PressedButton = "Button_Submit";
        }

        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Submit") {
            if(!CCGetEvent($this->Button_Submit->CCSEvents, "OnClick", $this->Button_Submit) || !$this->UpdateGrid()) {
                $Redirect = "";
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//UpdateGrid Method @11-E8FE268E
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["user_id"] = $this->CachedColumns["user_id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            $this->user_id->SetText($this->FormParameters["user_id"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if($this->CheckBox_Delete->Value) {
                    if($this->DeleteAllowed) { $Validation = ($this->DeleteRow() && $Validation); }
                } else if($this->UpdateAllowed) {
                    $Validation = ($this->UpdateRow() && $Validation);
                }
            }
            else if($this->CheckInsert() && $this->InsertAllowed)
            {
                $Validation = ($Validation && $this->InsertRow());
            }
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterSubmit", $this);
        if ($this->Errors->Count() == 0 && $Validation){
            $this->DataSource->close();
            return true;
        }
        return false;
    }
//End UpdateGrid Method

//DeleteRow Method @11-A4A656F6
    function DeleteRow()
    {
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End DeleteRow Method

//FormScript Method @11-372E22D9
    function FormScript($TotalRows)
    {
        $script = "";
        $script .= "\n<script language=\"JavaScript\" type=\"text/javascript\">\n<!--\n";
        $script .= "var UsersGridElements;\n";
        $script .= "var UsersGridEmptyRows = 0;\n";
        $script .= "var " . $this->ComponentName . "DeleteControl = 0;\n";
        $script .= "var " . $this->ComponentName . "user_idID = 1;\n";
        $script .= "\nfunction initUsersGridElements() {\n";
        $script .= "\tvar ED = document.forms[\"UsersGrid\"];\n";
        $script .= "\tUsersGridElements = new Array (\n";
        for($i = 1; $i <= $TotalRows; $i++) {
            $script .= "\t\tnew Array(" . "ED.CheckBox_Delete_" . $i . ", " . "ED.user_id_" . $i . ")";
            if($i != $TotalRows) $script .= ",\n";
        }
        $script .= ");\n";
        $script .= "}\n";
        $script .= "\n//-->\n</script>";
        return $script;
    }
//End FormScript Method

//SetFormState Method @11-23DE87CB
    function SetFormState($FormState)
    {
        if(strlen($FormState)) {
            $FormState = str_replace("\\\\", "\\" . ord("\\"), $FormState);
            $FormState = str_replace("\\;", "\\" . ord(";"), $FormState);
            $pieces = explode(";", $FormState);
            $this->UpdatedRows = $pieces[0];
            $this->EmptyRows   = $pieces[1];
            $this->TotalRows = $this->UpdatedRows + $this->EmptyRows;
            $RowNumber = 0;
            for($i = 2; $i < sizeof($pieces); $i = $i + 1)  {
                $piece = $pieces[$i + 0];
                $piece = str_replace("\\" . ord("\\"), "\\", $piece);
                $piece = str_replace("\\" . ord(";"), ";", $piece);
                $this->CachedColumns["user_id"][$RowNumber] = $piece;
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $this->CachedColumns["user_id"][$RowNumber] = "";
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @11-FCB1A54C
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["user_id"][$i]));
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @11-DF583B32
    function Show()
    {
        global $Tpl;
        global $FileName;
        global $CCSLocales;
        global $CCSUseAmp;
        $Error = "";

        if(!$this->Visible) { return; }

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->action->Prepare();

        $this->DataSource->open();
        $is_next_record = ($this->ReadAllowed && $this->DataSource->next_record());
        $this->IsEmpty = ! $is_next_record;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) { return; }

        $this->Attributes->Show();
        $this->Button_Submit->Visible = $this->Button_Submit->Visible && ($this->InsertAllowed || $this->UpdateAllowed || $this->DeleteAllowed);
        $ParentPath = $Tpl->block_path;
        $EditableGridPath = $ParentPath . "/EditableGrid " . $this->ComponentName;
        $EditableGridRowPath = $ParentPath . "/EditableGrid " . $this->ComponentName . "/Row";
        $Tpl->block_path = $EditableGridRowPath;
        $this->RowNumber = 0;
        $NonEmptyRows = 0;
        $EmptyRowsLeft = $this->EmptyRows;
        $this->ControlsVisible["user_name"] = $this->user_name->Visible;
        $this->ControlsVisible["user_login"] = $this->user_login->Visible;
        $this->ControlsVisible["group"] = $this->group->Visible;
        $this->ControlsVisible["Data_ColumnAction"] = $this->Data_ColumnAction->Visible;
        $this->ControlsVisible["CheckBox_Delete"] = $this->CheckBox_Delete->Visible;
        $this->ControlsVisible["user_id"] = $this->user_id->Visible;
        if ($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed)) {
            do {
                // Parse Separator
                if($this->RowNumber) {
                    $Tpl->block_path = $EditableGridPath;
                    $this->Attributes->Show();
                    $Tpl->parseto("Separator", true, "Row");
                    $Tpl->block_path = $EditableGridRowPath;
                }
                $this->RowNumber++;
                if($is_next_record) {
                    $NonEmptyRows++;
                    $this->DataSource->SetValues();
                }
                if (!($is_next_record) || !($this->DeleteAllowed)) {
                    $this->CheckBox_Delete->Visible = false;
                }
                if (!($this->FormSubmitted) && $is_next_record) {
                    $this->CachedColumns["user_id"][$this->RowNumber] = $this->DataSource->CachedColumns["user_id"];
                    $this->group->SetText("");
                    $this->CheckBox_Delete->SetValue("");
                    $this->user_name->SetValue($this->DataSource->user_name->GetValue());
                    $this->user_name->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                    $this->user_name->Parameters = CCAddParam($this->user_name->Parameters, "action", "AddEdit");
                    $this->user_name->Parameters = CCAddParam($this->user_name->Parameters, "id", $this->DataSource->f("user_id"));
                    $this->user_login->SetValue($this->DataSource->user_login->GetValue());
                    $this->user_id->SetValue($this->DataSource->user_id->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->user_name->SetText("");
                    $this->user_login->SetText("");
                    $this->group->SetText("");
                    $this->user_name->SetValue($this->DataSource->user_name->GetValue());
                    $this->user_name->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                    $this->user_name->Parameters = CCAddParam($this->user_name->Parameters, "action", "AddEdit");
                    $this->user_name->Parameters = CCAddParam($this->user_name->Parameters, "id", $this->DataSource->f("user_id"));
                    $this->user_login->SetValue($this->DataSource->user_login->GetValue());
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                    $this->user_id->SetText($this->FormParameters["user_id"][$this->RowNumber], $this->RowNumber);
                    $this->user_name->Parameters = CCAddParam($this->user_name->Parameters, "action", "AddEdit");
                    $this->user_name->Parameters = CCAddParam($this->user_name->Parameters, "id", $this->DataSource->f("user_id"));
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["user_id"][$this->RowNumber] = "";
                    $this->user_name->SetText("");
                    $this->user_login->SetText("");
                    $this->group->SetText("");
                    $this->user_id->SetText("");
                    $this->user_name->Parameters = CCAddParam($this->user_name->Parameters, "action", "AddEdit");
                    $this->user_name->Parameters = CCAddParam($this->user_name->Parameters, "id", $this->DataSource->f("user_id"));
                } else {
                    $this->user_name->SetText("");
                    $this->user_login->SetText("");
                    $this->group->SetText("");
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                    $this->user_id->SetText($this->FormParameters["user_id"][$this->RowNumber], $this->RowNumber);
                    $this->user_name->Parameters = CCAddParam($this->user_name->Parameters, "action", "AddEdit");
                    $this->user_name->Parameters = CCAddParam($this->user_name->Parameters, "id", $this->DataSource->f("user_id"));
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->user_name->Show($this->RowNumber);
                $this->user_login->Show($this->RowNumber);
                $this->group->Show($this->RowNumber);
                $this->Data_ColumnAction->Show($this->RowNumber);
                if (isset($this->RowsErrors[$this->RowNumber]) && ($this->RowsErrors[$this->RowNumber] != "")) {
                    $Tpl->setblockvar("RowError", "");
                    $Tpl->setvar("Error", $this->RowsErrors[$this->RowNumber]);
                    $this->Attributes->Show();
                    $Tpl->parse("RowError", false);
                } else {
                    $Tpl->setblockvar("RowError", "");
                }
                $Tpl->setvar("FormScript", $this->FormScript($this->RowNumber));
                $Tpl->parse();
                if ($is_next_record) {
                    if ($this->FormSubmitted) {
                        $is_next_record = $this->RowNumber < $this->UpdatedRows;
                        if (($this->DataSource->CachedColumns["user_id"] == $this->CachedColumns["user_id"][$this->RowNumber])) {
                            if ($this->ReadAllowed) $this->DataSource->next_record();
                        }
                    }else{
                        $is_next_record = ($this->RowNumber < $this->PageSize) &&  $this->ReadAllowed && $this->DataSource->next_record();
                    }
                } else { 
                    $EmptyRowsLeft--;
                }
            } while($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed));
        } else {
            $Tpl->block_path = $EditableGridPath;
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $Tpl->block_path = $EditableGridPath;
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if ($this->Navigator->TotalPages <= 1) {
            $this->Navigator->Visible = false;
        }
        $this->TotalRecords->Show();
        $this->FooterPanel->Show();
        $this->HeaderPanel->Show();

        if($this->CheckErrors()) {
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);
        if (!$CCSUseAmp) {
            $Tpl->SetVar("HTMLFormProperties", "method=\"POST\" action=\"" . $this->HTMLFormAction . "\" name=\"" . $this->ComponentName . "\"");
        } else {
            $Tpl->SetVar("HTMLFormProperties", "method=\"post\" action=\"" . str_replace("&", "&amp;", $this->HTMLFormAction) . "\" id=\"" . $this->ComponentName . "\"");
        }
        $Tpl->SetVar("FormState", CCToHTML($this->GetFormState($NonEmptyRows)));
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End UsersGrid Class @11-FCB6E20C

class clsCalendar_UsersUsersGridDataSource extends clsDBConnection1 {  //UsersGridDataSource Class @11-A96A063C

//DataSource Variables @11-9B3DE1B7
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $DeleteParameters;
    public $CountSQL;
    public $wp;
    public $AllParametersSet;

    public $CachedColumns;
    public $CurrentRow;

    // Datasource fields
    public $user_name;
    public $user_login;
    public $group;
    public $CheckBox_Delete;
    public $user_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @11-CA9C84E0
    function clsCalendar_UsersUsersGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid UsersGrid/Error";
        $this->Initialize();
        $this->user_name = new clsField("user_name", ccsText, "");
        
        $this->user_login = new clsField("user_login", ccsText, "");
        
        $this->group = new clsField("group", ccsText, "");
        
        $this->CheckBox_Delete = new clsField("CheckBox_Delete", ccsBoolean, $this->BooleanFormat);
        
        $this->user_id = new clsField("user_id", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @11-1F2278D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("SorterLastName" => array("last_name", ""), 
            "SorterLogin" => array("user_login", ""), 
            "SorterGroup" => array("group_id", "")));
    }
//End SetOrder Method

//Prepare Method @11-E935163A
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlu", ccsInteger, "", "", $this->Parameters["urlu"], "", false);
        $this->wp->AddParameter("2", "urlg", ccsInteger, "", "", $this->Parameters["urlg"], "", false);
        $this->wp->AddParameter("3", "urln", ccsText, "", "", $this->Parameters["urln"], "", false);
        $this->wp->AddParameter("4", "urln", ccsText, "", "", $this->Parameters["urln"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "user_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "group_id", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsInteger),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opContains, "first_name", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opContains, "last_name", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), $this->wp->opOR(
             true, 
             $this->wp->Criterion[3], 
             $this->wp->Criterion[4]));
    }
//End Prepare Method

//Open Method @11-E6E1A688
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM tbl_users";
        $this->SQL = "SELECT *, CONCAT(last_name, ', ', first_name) AS Name, user_id \n\n" .
        "FROM tbl_users {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @11-D4C26B1E
    function SetValues()
    {
        $this->CachedColumns["user_id"] = $this->f("user_id");
        $this->user_name->SetDBValue($this->f("Name"));
        $this->user_login->SetDBValue($this->f("user_login"));
        $this->user_id->SetDBValue(trim($this->f("user_id")));
    }
//End SetValues Method

//Delete Method @11-52C61483
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "user_id=" . $this->ToSQL($this->CachedColumns["user_id"], ccsInteger);
        $this->SQL = "DELETE FROM tbl_users";
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
        $this->Where = $SelectWhere;
    }
//End Delete Method

} //End UsersGridDataSource Class @11-FCB6E20C

class clsRecordCalendar_UsersUserAddEdit { //UserAddEdit Class @39-6AC26D9B

//Variables @39-9E315808

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

//Class_Initialize Event @39-2505A321
    function clsRecordCalendar_UsersUserAddEdit($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record UserAddEdit/Error";
        $this->DataSource = new clsCalendar_UsersUserAddEditDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "UserAddEdit";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = new clsButton("Button_Delete", $Method, $this);
            $this->Button_Cancel = new clsButton("Button_Cancel", $Method, $this);
            $this->user_login = new clsControl(ccsTextBox, "user_login", $CCSLocales->GetText("user_login"), ccsText, "", CCGetRequestParam("user_login", $Method, NULL), $this);
            $this->group_id = new clsControl(ccsListBox, "group_id", "group_id", ccsInteger, "", CCGetRequestParam("group_id", $Method, NULL), $this);
            $this->group_id->DSType = dsTable;
            $this->group_id->DataSource = new clsDBConnection1();
            $this->group_id->ds = & $this->group_id->DataSource;
            $this->group_id->DataSource->SQL = "SELECT * \n" .
"FROM tbl_groups {SQL_Where} {SQL_OrderBy}";
            list($this->group_id->BoundColumn, $this->group_id->TextColumn, $this->group_id->DBFormat) = array("group_id", "group_name", "");
            $this->group_id->DataSource->Parameters["expr161"] = 1;
            $this->group_id->DataSource->wp = new clsSQLParameters();
            $this->group_id->DataSource->wp->AddParameter("1", "expr161", ccsInteger, "", "", $this->group_id->DataSource->Parameters["expr161"], "", false);
            $this->group_id->DataSource->wp->Criterion[1] = $this->group_id->DataSource->wp->Operation(opNotEqual, "group_id", $this->group_id->DataSource->wp->GetDBValue("1"), $this->group_id->DataSource->ToSQL($this->group_id->DataSource->wp->GetDBValue("1"), ccsInteger),false);
            $this->group_id->DataSource->Where = 
                 $this->group_id->DataSource->wp->Criterion[1];
            $this->prefix = new clsControl(ccsListBox, "prefix", "prefix", ccsText, "", CCGetRequestParam("prefix", $Method, NULL), $this);
            $this->prefix->DSType = dsTable;
            $this->prefix->DataSource = new clsDBConnection1();
            $this->prefix->ds = & $this->prefix->DataSource;
            $this->prefix->DataSource->SQL = "SELECT * \n" .
"FROM lu_prefix {SQL_Where} {SQL_OrderBy}";
            list($this->prefix->BoundColumn, $this->prefix->TextColumn, $this->prefix->DBFormat) = array("prefix", "prefix", "");
            $this->first_name = new clsControl(ccsTextBox, "first_name", $CCSLocales->GetText("first_name"), ccsText, "", CCGetRequestParam("first_name", $Method, NULL), $this);
            $this->last_name = new clsControl(ccsTextBox, "last_name", $CCSLocales->GetText("last_name"), ccsText, "", CCGetRequestParam("last_name", $Method, NULL), $this);
            $this->suffix = new clsControl(ccsListBox, "suffix", "suffix", ccsText, "", CCGetRequestParam("suffix", $Method, NULL), $this);
            $this->suffix->DSType = dsTable;
            $this->suffix->DataSource = new clsDBConnection1();
            $this->suffix->ds = & $this->suffix->DataSource;
            $this->suffix->DataSource->SQL = "SELECT * \n" .
"FROM lu_suffix {SQL_Where} {SQL_OrderBy}";
            list($this->suffix->BoundColumn, $this->suffix->TextColumn, $this->suffix->DBFormat) = array("suffix", "suffix", "");
            $this->company = new clsControl(ccsTextBox, "company", $CCSLocales->GetText("company"), ccsText, "", CCGetRequestParam("company", $Method, NULL), $this);
            $this->title = new clsControl(ccsTextBox, "title", $CCSLocales->GetText("title"), ccsText, "", CCGetRequestParam("title", $Method, NULL), $this);
            $this->address1 = new clsControl(ccsTextBox, "address1", $CCSLocales->GetText("address1"), ccsText, "", CCGetRequestParam("address1", $Method, NULL), $this);
            $this->address2 = new clsControl(ccsTextBox, "address2", $CCSLocales->GetText("address2"), ccsText, "", CCGetRequestParam("address2", $Method, NULL), $this);
            $this->city = new clsControl(ccsTextBox, "city", $CCSLocales->GetText("city"), ccsText, "", CCGetRequestParam("city", $Method, NULL), $this);
            $this->post_code = new clsControl(ccsTextBox, "post_code", $CCSLocales->GetText("post_code"), ccsText, "", CCGetRequestParam("post_code", $Method, NULL), $this);
            $this->country = new clsControl(ccsListBox, "country", "country", ccsText, "", CCGetRequestParam("country", $Method, NULL), $this);
            $this->country->DSType = dsTable;
            $this->country->DataSource = new clsDBConnection1();
            $this->country->ds = & $this->country->DataSource;
            $this->country->DataSource->SQL = "SELECT * \n" .
"FROM lu_countries {SQL_Where} {SQL_OrderBy}";
            list($this->country->BoundColumn, $this->country->TextColumn, $this->country->DBFormat) = array("country_id", "country_name", "");
            $this->phone_work = new clsControl(ccsTextBox, "phone_work", $CCSLocales->GetText("phone_work"), ccsText, "", CCGetRequestParam("phone_work", $Method, NULL), $this);
            $this->phone_cell = new clsControl(ccsTextBox, "phone_cell", $CCSLocales->GetText("phone_cell"), ccsText, "", CCGetRequestParam("phone_cell", $Method, NULL), $this);
            $this->fax = new clsControl(ccsTextBox, "fax", $CCSLocales->GetText("fax"), ccsText, "", CCGetRequestParam("fax", $Method, NULL), $this);
            $this->notes = new clsControl(ccsTextArea, "notes", $CCSLocales->GetText("notes"), ccsMemo, "", CCGetRequestParam("notes", $Method, NULL), $this);
            $this->user_password_Shadow = new clsControl(ccsHidden, "user_password_Shadow", "user_password_Shadow", ccsText, "", CCGetRequestParam("user_password_Shadow", $Method, NULL), $this);
            $this->AddEditLabel = new clsControl(ccsLabel, "AddEditLabel", "AddEditLabel", ccsText, "", CCGetRequestParam("AddEditLabel", $Method, NULL), $this);
            $this->NewPassword = new clsControl(ccsTextBox, "NewPassword", "NewPassword", ccsText, "", CCGetRequestParam("NewPassword", $Method, NULL), $this);
            $this->ConfirmNewPassword = new clsControl(ccsTextBox, "ConfirmNewPassword", "ConfirmNewPassword", ccsText, "", CCGetRequestParam("ConfirmNewPassword", $Method, NULL), $this);
            $this->ActivePanel = new clsPanel("ActivePanel", $this);
            $this->user_active = new clsControl(ccsCheckBox, "user_active", $CCSLocales->GetText("user_active"), ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), CCGetRequestParam("user_active", $Method, NULL), $this);
            $this->user_active->CheckedValue = true;
            $this->user_active->UncheckedValue = false;
            $this->GroupLabel = new clsControl(ccsLabel, "GroupLabel", "GroupLabel", ccsText, "", CCGetRequestParam("GroupLabel", $Method, NULL), $this);
            $this->county = new clsControl(ccsTextBox, "county", $CCSLocales->GetText("county"), ccsText, "", CCGetRequestParam("county", $Method, NULL), $this);
            $this->state = new clsControl(ccsListBox, "state", "state", ccsText, "", CCGetRequestParam("state", $Method, NULL), $this);
            $this->state->DSType = dsTable;
            $this->state->DataSource = new clsDBConnection1();
            $this->state->ds = & $this->state->DataSource;
            $this->state->DataSource->SQL = "SELECT * \n" .
"FROM lu_states {SQL_Where} {SQL_OrderBy}";
            list($this->state->BoundColumn, $this->state->TextColumn, $this->state->DBFormat) = array("state_id", "abbrv", "");
            $this->ActivePanel->AddComponent("user_active", $this->user_active);
        }
    }
//End Class_Initialize Event

//Initialize Method @39-2832F4DC
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlid"] = CCGetFromGet("id", NULL);
    }
//End Initialize Method

//Validate Method @39-02E675D1
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        if(! ($this->group_id->Visible == true OR CCStrLen($this->group_id->GetText()) > 0)) {
            $this->group_id->Errors->addError($CCSLocales->GetText("CRM_ErrorSelectGroup"));
        }
        if(! (CCStrLen($this->country->GetText()) > 0)) {
            $this->country->Errors->addError($CCSLocales->GetText("CRM_ErrorSelectCountry"));
        }
        if(! ($this->ConfirmNewPassword->GetText() == $this->NewPassword->GetText())) {
            $this->ConfirmNewPassword->Errors->addError($CCSLocales->GetText("CRM_ErrorPasswordsDoNotMatch"));
        }
        $Validation = ($this->user_login->Validate() && $Validation);
        $Validation = ($this->group_id->Validate() && $Validation);
        $Validation = ($this->prefix->Validate() && $Validation);
        $Validation = ($this->first_name->Validate() && $Validation);
        $Validation = ($this->last_name->Validate() && $Validation);
        $Validation = ($this->suffix->Validate() && $Validation);
        $Validation = ($this->company->Validate() && $Validation);
        $Validation = ($this->title->Validate() && $Validation);
        $Validation = ($this->address1->Validate() && $Validation);
        $Validation = ($this->address2->Validate() && $Validation);
        $Validation = ($this->city->Validate() && $Validation);
        $Validation = ($this->post_code->Validate() && $Validation);
        $Validation = ($this->country->Validate() && $Validation);
        $Validation = ($this->phone_work->Validate() && $Validation);
        $Validation = ($this->phone_cell->Validate() && $Validation);
        $Validation = ($this->fax->Validate() && $Validation);
        $Validation = ($this->notes->Validate() && $Validation);
        $Validation = ($this->user_password_Shadow->Validate() && $Validation);
        $Validation = ($this->NewPassword->Validate() && $Validation);
        $Validation = ($this->ConfirmNewPassword->Validate() && $Validation);
        $Validation = ($this->user_active->Validate() && $Validation);
        $Validation = ($this->county->Validate() && $Validation);
        $Validation = ($this->state->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->user_login->Errors->Count() == 0);
        $Validation =  $Validation && ($this->group_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->prefix->Errors->Count() == 0);
        $Validation =  $Validation && ($this->first_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->last_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->suffix->Errors->Count() == 0);
        $Validation =  $Validation && ($this->company->Errors->Count() == 0);
        $Validation =  $Validation && ($this->title->Errors->Count() == 0);
        $Validation =  $Validation && ($this->address1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->address2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->city->Errors->Count() == 0);
        $Validation =  $Validation && ($this->post_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->country->Errors->Count() == 0);
        $Validation =  $Validation && ($this->phone_work->Errors->Count() == 0);
        $Validation =  $Validation && ($this->phone_cell->Errors->Count() == 0);
        $Validation =  $Validation && ($this->fax->Errors->Count() == 0);
        $Validation =  $Validation && ($this->notes->Errors->Count() == 0);
        $Validation =  $Validation && ($this->user_password_Shadow->Errors->Count() == 0);
        $Validation =  $Validation && ($this->NewPassword->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ConfirmNewPassword->Errors->Count() == 0);
        $Validation =  $Validation && ($this->user_active->Errors->Count() == 0);
        $Validation =  $Validation && ($this->county->Errors->Count() == 0);
        $Validation =  $Validation && ($this->state->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @39-0A831FB6
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->user_login->Errors->Count());
        $errors = ($errors || $this->group_id->Errors->Count());
        $errors = ($errors || $this->prefix->Errors->Count());
        $errors = ($errors || $this->first_name->Errors->Count());
        $errors = ($errors || $this->last_name->Errors->Count());
        $errors = ($errors || $this->suffix->Errors->Count());
        $errors = ($errors || $this->company->Errors->Count());
        $errors = ($errors || $this->title->Errors->Count());
        $errors = ($errors || $this->address1->Errors->Count());
        $errors = ($errors || $this->address2->Errors->Count());
        $errors = ($errors || $this->city->Errors->Count());
        $errors = ($errors || $this->post_code->Errors->Count());
        $errors = ($errors || $this->country->Errors->Count());
        $errors = ($errors || $this->phone_work->Errors->Count());
        $errors = ($errors || $this->phone_cell->Errors->Count());
        $errors = ($errors || $this->fax->Errors->Count());
        $errors = ($errors || $this->notes->Errors->Count());
        $errors = ($errors || $this->user_password_Shadow->Errors->Count());
        $errors = ($errors || $this->AddEditLabel->Errors->Count());
        $errors = ($errors || $this->NewPassword->Errors->Count());
        $errors = ($errors || $this->ConfirmNewPassword->Errors->Count());
        $errors = ($errors || $this->user_active->Errors->Count());
        $errors = ($errors || $this->GroupLabel->Errors->Count());
        $errors = ($errors || $this->county->Errors->Count());
        $errors = ($errors || $this->state->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @39-ED598703
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

//Operation Method @39-FECC0910
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
            $this->PressedButton = $this->EditMode ? "Button_Update" : "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            } else if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            } else if($this->Button_Delete->Pressed) {
                $this->PressedButton = "Button_Delete";
            } else if($this->Button_Cancel->Pressed) {
                $this->PressedButton = "Button_Cancel";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "action", "id"));
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
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

//InsertRow Method @39-7CDD79DC
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->user_login->SetValue($this->user_login->GetValue(true));
        $this->DataSource->user_active->SetValue($this->user_active->GetValue(true));
        $this->DataSource->group_id->SetValue($this->group_id->GetValue(true));
        $this->DataSource->prefix->SetValue($this->prefix->GetValue(true));
        $this->DataSource->first_name->SetValue($this->first_name->GetValue(true));
        $this->DataSource->last_name->SetValue($this->last_name->GetValue(true));
        $this->DataSource->suffix->SetValue($this->suffix->GetValue(true));
        $this->DataSource->company->SetValue($this->company->GetValue(true));
        $this->DataSource->title->SetValue($this->title->GetValue(true));
        $this->DataSource->address1->SetValue($this->address1->GetValue(true));
        $this->DataSource->address2->SetValue($this->address2->GetValue(true));
        $this->DataSource->city->SetValue($this->city->GetValue(true));
        $this->DataSource->state->SetValue($this->state->GetValue(true));
        $this->DataSource->post_code->SetValue($this->post_code->GetValue(true));
        $this->DataSource->country->SetValue($this->country->GetValue(true));
        $this->DataSource->county->SetValue($this->county->GetValue(true));
        $this->DataSource->phone_work->SetValue($this->phone_work->GetValue(true));
        $this->DataSource->phone_cell->SetValue($this->phone_cell->GetValue(true));
        $this->DataSource->fax->SetValue($this->fax->GetValue(true));
        $this->DataSource->notes->SetValue($this->notes->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @39-342003E7
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->user_login->SetValue($this->user_login->GetValue(true));
        $this->DataSource->user_active->SetValue($this->user_active->GetValue(true));
        $this->DataSource->group_id->SetValue($this->group_id->GetValue(true));
        $this->DataSource->prefix->SetValue($this->prefix->GetValue(true));
        $this->DataSource->first_name->SetValue($this->first_name->GetValue(true));
        $this->DataSource->last_name->SetValue($this->last_name->GetValue(true));
        $this->DataSource->suffix->SetValue($this->suffix->GetValue(true));
        $this->DataSource->company->SetValue($this->company->GetValue(true));
        $this->DataSource->title->SetValue($this->title->GetValue(true));
        $this->DataSource->address1->SetValue($this->address1->GetValue(true));
        $this->DataSource->address2->SetValue($this->address2->GetValue(true));
        $this->DataSource->city->SetValue($this->city->GetValue(true));
        $this->DataSource->state->SetValue($this->state->GetValue(true));
        $this->DataSource->post_code->SetValue($this->post_code->GetValue(true));
        $this->DataSource->country->SetValue($this->country->GetValue(true));
        $this->DataSource->county->SetValue($this->county->GetValue(true));
        $this->DataSource->phone_work->SetValue($this->phone_work->GetValue(true));
        $this->DataSource->phone_cell->SetValue($this->phone_cell->GetValue(true));
        $this->DataSource->fax->SetValue($this->fax->GetValue(true));
        $this->DataSource->notes->SetValue($this->notes->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @39-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @39-499E9FA3
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

        $this->group_id->Prepare();
        $this->prefix->Prepare();
        $this->suffix->Prepare();
        $this->country->Prepare();
        $this->state->Prepare();

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
                    $this->user_login->SetValue($this->DataSource->user_login->GetValue());
                    $this->group_id->SetValue($this->DataSource->group_id->GetValue());
                    $this->prefix->SetValue($this->DataSource->prefix->GetValue());
                    $this->first_name->SetValue($this->DataSource->first_name->GetValue());
                    $this->last_name->SetValue($this->DataSource->last_name->GetValue());
                    $this->suffix->SetValue($this->DataSource->suffix->GetValue());
                    $this->company->SetValue($this->DataSource->company->GetValue());
                    $this->title->SetValue($this->DataSource->title->GetValue());
                    $this->address1->SetValue($this->DataSource->address1->GetValue());
                    $this->address2->SetValue($this->DataSource->address2->GetValue());
                    $this->city->SetValue($this->DataSource->city->GetValue());
                    $this->post_code->SetValue($this->DataSource->post_code->GetValue());
                    $this->country->SetValue($this->DataSource->country->GetValue());
                    $this->phone_work->SetValue($this->DataSource->phone_work->GetValue());
                    $this->phone_cell->SetValue($this->DataSource->phone_cell->GetValue());
                    $this->fax->SetValue($this->DataSource->fax->GetValue());
                    $this->notes->SetValue($this->DataSource->notes->GetValue());
                    $this->NewPassword->SetValue($this->DataSource->NewPassword->GetValue());
                    $this->user_active->SetValue($this->DataSource->user_active->GetValue());
                    $this->county->SetValue($this->DataSource->county->GetValue());
                    $this->state->SetValue($this->DataSource->state->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->user_login->Errors->ToString());
            $Error = ComposeStrings($Error, $this->group_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->prefix->Errors->ToString());
            $Error = ComposeStrings($Error, $this->first_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->last_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->suffix->Errors->ToString());
            $Error = ComposeStrings($Error, $this->company->Errors->ToString());
            $Error = ComposeStrings($Error, $this->title->Errors->ToString());
            $Error = ComposeStrings($Error, $this->address1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->address2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->city->Errors->ToString());
            $Error = ComposeStrings($Error, $this->post_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->country->Errors->ToString());
            $Error = ComposeStrings($Error, $this->phone_work->Errors->ToString());
            $Error = ComposeStrings($Error, $this->phone_cell->Errors->ToString());
            $Error = ComposeStrings($Error, $this->fax->Errors->ToString());
            $Error = ComposeStrings($Error, $this->notes->Errors->ToString());
            $Error = ComposeStrings($Error, $this->user_password_Shadow->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddEditLabel->Errors->ToString());
            $Error = ComposeStrings($Error, $this->NewPassword->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ConfirmNewPassword->Errors->ToString());
            $Error = ComposeStrings($Error, $this->user_active->Errors->ToString());
            $Error = ComposeStrings($Error, $this->GroupLabel->Errors->ToString());
            $Error = ComposeStrings($Error, $this->county->Errors->ToString());
            $Error = ComposeStrings($Error, $this->state->Errors->ToString());
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
        $this->Button_Insert->Visible = !$this->EditMode && $this->InsertAllowed;
        $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;
        $this->Button_Delete->Visible = $this->EditMode && $this->DeleteAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->Button_Delete->Show();
        $this->Button_Cancel->Show();
        $this->user_login->Show();
        $this->group_id->Show();
        $this->prefix->Show();
        $this->first_name->Show();
        $this->last_name->Show();
        $this->suffix->Show();
        $this->company->Show();
        $this->title->Show();
        $this->address1->Show();
        $this->address2->Show();
        $this->city->Show();
        $this->post_code->Show();
        $this->country->Show();
        $this->phone_work->Show();
        $this->phone_cell->Show();
        $this->fax->Show();
        $this->notes->Show();
        $this->user_password_Shadow->Show();
        $this->AddEditLabel->Show();
        $this->NewPassword->Show();
        $this->ConfirmNewPassword->Show();
        $this->ActivePanel->Show();
        $this->GroupLabel->Show();
        $this->county->Show();
        $this->state->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End UserAddEdit Class @39-FCB6E20C

class clsCalendar_UsersUserAddEditDataSource extends clsDBConnection1 {  //UserAddEditDataSource Class @39-9178A507

//DataSource Variables @39-6BF514DC
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $InsertParameters;
    public $UpdateParameters;
    public $DeleteParameters;
    public $wp;
    public $AllParametersSet;

    public $InsertFields = array();
    public $UpdateFields = array();

    // Datasource fields
    public $user_login;
    public $group_id;
    public $prefix;
    public $first_name;
    public $last_name;
    public $suffix;
    public $company;
    public $title;
    public $address1;
    public $address2;
    public $city;
    public $post_code;
    public $country;
    public $phone_work;
    public $phone_cell;
    public $fax;
    public $notes;
    public $user_password_Shadow;
    public $AddEditLabel;
    public $NewPassword;
    public $ConfirmNewPassword;
    public $user_active;
    public $GroupLabel;
    public $county;
    public $state;
//End DataSource Variables

//DataSourceClass_Initialize Event @39-3D85E38D
    function clsCalendar_UsersUserAddEditDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record UserAddEdit/Error";
        $this->Initialize();
        $this->user_login = new clsField("user_login", ccsText, "");
        
        $this->group_id = new clsField("group_id", ccsInteger, "");
        
        $this->prefix = new clsField("prefix", ccsText, "");
        
        $this->first_name = new clsField("first_name", ccsText, "");
        
        $this->last_name = new clsField("last_name", ccsText, "");
        
        $this->suffix = new clsField("suffix", ccsText, "");
        
        $this->company = new clsField("company", ccsText, "");
        
        $this->title = new clsField("title", ccsText, "");
        
        $this->address1 = new clsField("address1", ccsText, "");
        
        $this->address2 = new clsField("address2", ccsText, "");
        
        $this->city = new clsField("city", ccsText, "");
        
        $this->post_code = new clsField("post_code", ccsText, "");
        
        $this->country = new clsField("country", ccsText, "");
        
        $this->phone_work = new clsField("phone_work", ccsText, "");
        
        $this->phone_cell = new clsField("phone_cell", ccsText, "");
        
        $this->fax = new clsField("fax", ccsText, "");
        
        $this->notes = new clsField("notes", ccsMemo, "");
        
        $this->user_password_Shadow = new clsField("user_password_Shadow", ccsText, "");
        
        $this->AddEditLabel = new clsField("AddEditLabel", ccsText, "");
        
        $this->NewPassword = new clsField("NewPassword", ccsText, "");
        
        $this->ConfirmNewPassword = new clsField("ConfirmNewPassword", ccsText, "");
        
        $this->user_active = new clsField("user_active", ccsBoolean, $this->BooleanFormat);
        
        $this->GroupLabel = new clsField("GroupLabel", ccsText, "");
        
        $this->county = new clsField("county", ccsText, "");
        
        $this->state = new clsField("state", ccsText, "");
        

        $this->InsertFields["user_login"] = array("Name" => "user_login", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["user_password"] = array("Name" => "user_password", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["user_active"] = array("Name" => "user_active", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["group_id"] = array("Name" => "group_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["prefix"] = array("Name" => "prefix", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["first_name"] = array("Name" => "first_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["last_name"] = array("Name" => "last_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["suffix"] = array("Name" => "suffix", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["company"] = array("Name" => "company", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["title"] = array("Name" => "title", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["address1"] = array("Name" => "address1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["address2"] = array("Name" => "address2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["city"] = array("Name" => "city", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["state"] = array("Name" => "state", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["post_code"] = array("Name" => "post_code", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["country"] = array("Name" => "country", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["county"] = array("Name" => "county", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["phone_work"] = array("Name" => "phone_work", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["phone_cell"] = array("Name" => "phone_cell", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["fax"] = array("Name" => "fax", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["notes"] = array("Name" => "notes", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["user_login"] = array("Name" => "user_login", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["user_password"] = array("Name" => "user_password", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["user_active"] = array("Name" => "user_active", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["group_id"] = array("Name" => "group_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["prefix"] = array("Name" => "prefix", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["first_name"] = array("Name" => "first_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["last_name"] = array("Name" => "last_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["suffix"] = array("Name" => "suffix", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["company"] = array("Name" => "company", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["title"] = array("Name" => "title", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["address1"] = array("Name" => "address1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["address2"] = array("Name" => "address2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["city"] = array("Name" => "city", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["state"] = array("Name" => "state", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["post_code"] = array("Name" => "post_code", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["country"] = array("Name" => "country", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["county"] = array("Name" => "county", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["phone_work"] = array("Name" => "phone_work", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["phone_cell"] = array("Name" => "phone_cell", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["fax"] = array("Name" => "fax", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["notes"] = array("Name" => "notes", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @39-A8C3E592
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlid", ccsInteger, "", "", $this->Parameters["urlid"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "user_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @39-0FCD2591
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tbl_users {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @39-CD27D800
    function SetValues()
    {
        $this->user_login->SetDBValue($this->f("user_login"));
        $this->group_id->SetDBValue(trim($this->f("group_id")));
        $this->prefix->SetDBValue($this->f("prefix"));
        $this->first_name->SetDBValue($this->f("first_name"));
        $this->last_name->SetDBValue($this->f("last_name"));
        $this->suffix->SetDBValue($this->f("suffix"));
        $this->company->SetDBValue($this->f("company"));
        $this->title->SetDBValue($this->f("title"));
        $this->address1->SetDBValue($this->f("address1"));
        $this->address2->SetDBValue($this->f("address2"));
        $this->city->SetDBValue($this->f("city"));
        $this->post_code->SetDBValue($this->f("post_code"));
        $this->country->SetDBValue($this->f("country"));
        $this->phone_work->SetDBValue($this->f("phone_work"));
        $this->phone_cell->SetDBValue($this->f("phone_cell"));
        $this->fax->SetDBValue($this->f("fax"));
        $this->notes->SetDBValue($this->f("notes"));
        $this->NewPassword->SetDBValue($this->f("user_password"));
        $this->user_active->SetDBValue(trim($this->f("user_active")));
        $this->county->SetDBValue($this->f("county"));
        $this->state->SetDBValue($this->f("state"));
    }
//End SetValues Method

//Insert Method @39-C5B21D8C
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["user_login"] = new clsSQLParameter("ctrluser_login", ccsText, "", "", $this->user_login->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["user_password"] = new clsSQLParameter("expr73", ccsText, "", "", "{password}", NULL, false, $this->ErrorBlock);
        $this->cp["user_active"] = new clsSQLParameter("ctrluser_active", ccsInteger, "", "", $this->user_active->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["group_id"] = new clsSQLParameter("ctrlgroup_id", ccsInteger, "", "", $this->group_id->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["prefix"] = new clsSQLParameter("ctrlprefix", ccsText, "", "", $this->prefix->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["first_name"] = new clsSQLParameter("ctrlfirst_name", ccsText, "", "", $this->first_name->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["last_name"] = new clsSQLParameter("ctrllast_name", ccsText, "", "", $this->last_name->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["suffix"] = new clsSQLParameter("ctrlsuffix", ccsText, "", "", $this->suffix->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["company"] = new clsSQLParameter("ctrlcompany", ccsText, "", "", $this->company->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["title"] = new clsSQLParameter("ctrltitle", ccsText, "", "", $this->title->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["address1"] = new clsSQLParameter("ctrladdress1", ccsText, "", "", $this->address1->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["address2"] = new clsSQLParameter("ctrladdress2", ccsText, "", "", $this->address2->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["city"] = new clsSQLParameter("ctrlcity", ccsText, "", "", $this->city->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["state"] = new clsSQLParameter("ctrlstate", ccsText, "", "", $this->state->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["post_code"] = new clsSQLParameter("ctrlpost_code", ccsText, "", "", $this->post_code->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["country"] = new clsSQLParameter("ctrlcountry", ccsText, "", "", $this->country->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["county"] = new clsSQLParameter("ctrlcounty", ccsText, "", "", $this->county->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["phone_work"] = new clsSQLParameter("ctrlphone_work", ccsText, "", "", $this->phone_work->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["phone_cell"] = new clsSQLParameter("ctrlphone_cell", ccsText, "", "", $this->phone_cell->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["fax"] = new clsSQLParameter("ctrlfax", ccsText, "", "", $this->fax->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["notes"] = new clsSQLParameter("ctrlnotes", ccsMemo, "", "", $this->notes->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["user_login"]->GetValue()) and !strlen($this->cp["user_login"]->GetText()) and !is_bool($this->cp["user_login"]->GetValue())) 
            $this->cp["user_login"]->SetValue($this->user_login->GetValue(true));
        if (!is_null($this->cp["user_password"]->GetValue()) and !strlen($this->cp["user_password"]->GetText()) and !is_bool($this->cp["user_password"]->GetValue())) 
            $this->cp["user_password"]->SetValue("{password}");
        if (!is_null($this->cp["user_active"]->GetValue()) and !strlen($this->cp["user_active"]->GetText()) and !is_bool($this->cp["user_active"]->GetValue())) 
            $this->cp["user_active"]->SetValue($this->user_active->GetValue(true));
        if (!is_null($this->cp["group_id"]->GetValue()) and !strlen($this->cp["group_id"]->GetText()) and !is_bool($this->cp["group_id"]->GetValue())) 
            $this->cp["group_id"]->SetValue($this->group_id->GetValue(true));
        if (!is_null($this->cp["prefix"]->GetValue()) and !strlen($this->cp["prefix"]->GetText()) and !is_bool($this->cp["prefix"]->GetValue())) 
            $this->cp["prefix"]->SetValue($this->prefix->GetValue(true));
        if (!is_null($this->cp["first_name"]->GetValue()) and !strlen($this->cp["first_name"]->GetText()) and !is_bool($this->cp["first_name"]->GetValue())) 
            $this->cp["first_name"]->SetValue($this->first_name->GetValue(true));
        if (!is_null($this->cp["last_name"]->GetValue()) and !strlen($this->cp["last_name"]->GetText()) and !is_bool($this->cp["last_name"]->GetValue())) 
            $this->cp["last_name"]->SetValue($this->last_name->GetValue(true));
        if (!is_null($this->cp["suffix"]->GetValue()) and !strlen($this->cp["suffix"]->GetText()) and !is_bool($this->cp["suffix"]->GetValue())) 
            $this->cp["suffix"]->SetValue($this->suffix->GetValue(true));
        if (!is_null($this->cp["company"]->GetValue()) and !strlen($this->cp["company"]->GetText()) and !is_bool($this->cp["company"]->GetValue())) 
            $this->cp["company"]->SetValue($this->company->GetValue(true));
        if (!is_null($this->cp["title"]->GetValue()) and !strlen($this->cp["title"]->GetText()) and !is_bool($this->cp["title"]->GetValue())) 
            $this->cp["title"]->SetValue($this->title->GetValue(true));
        if (!is_null($this->cp["address1"]->GetValue()) and !strlen($this->cp["address1"]->GetText()) and !is_bool($this->cp["address1"]->GetValue())) 
            $this->cp["address1"]->SetValue($this->address1->GetValue(true));
        if (!is_null($this->cp["address2"]->GetValue()) and !strlen($this->cp["address2"]->GetText()) and !is_bool($this->cp["address2"]->GetValue())) 
            $this->cp["address2"]->SetValue($this->address2->GetValue(true));
        if (!is_null($this->cp["city"]->GetValue()) and !strlen($this->cp["city"]->GetText()) and !is_bool($this->cp["city"]->GetValue())) 
            $this->cp["city"]->SetValue($this->city->GetValue(true));
        if (!is_null($this->cp["state"]->GetValue()) and !strlen($this->cp["state"]->GetText()) and !is_bool($this->cp["state"]->GetValue())) 
            $this->cp["state"]->SetValue($this->state->GetValue(true));
        if (!strlen($this->cp["state"]->GetText()) and !is_bool($this->cp["state"]->GetValue(true))) 
            $this->cp["state"]->SetText("");
        if (!is_null($this->cp["post_code"]->GetValue()) and !strlen($this->cp["post_code"]->GetText()) and !is_bool($this->cp["post_code"]->GetValue())) 
            $this->cp["post_code"]->SetValue($this->post_code->GetValue(true));
        if (!is_null($this->cp["country"]->GetValue()) and !strlen($this->cp["country"]->GetText()) and !is_bool($this->cp["country"]->GetValue())) 
            $this->cp["country"]->SetValue($this->country->GetValue(true));
        if (!is_null($this->cp["county"]->GetValue()) and !strlen($this->cp["county"]->GetText()) and !is_bool($this->cp["county"]->GetValue())) 
            $this->cp["county"]->SetValue($this->county->GetValue(true));
        if (!is_null($this->cp["phone_work"]->GetValue()) and !strlen($this->cp["phone_work"]->GetText()) and !is_bool($this->cp["phone_work"]->GetValue())) 
            $this->cp["phone_work"]->SetValue($this->phone_work->GetValue(true));
        if (!is_null($this->cp["phone_cell"]->GetValue()) and !strlen($this->cp["phone_cell"]->GetText()) and !is_bool($this->cp["phone_cell"]->GetValue())) 
            $this->cp["phone_cell"]->SetValue($this->phone_cell->GetValue(true));
        if (!is_null($this->cp["fax"]->GetValue()) and !strlen($this->cp["fax"]->GetText()) and !is_bool($this->cp["fax"]->GetValue())) 
            $this->cp["fax"]->SetValue($this->fax->GetValue(true));
        if (!is_null($this->cp["notes"]->GetValue()) and !strlen($this->cp["notes"]->GetText()) and !is_bool($this->cp["notes"]->GetValue())) 
            $this->cp["notes"]->SetValue($this->notes->GetValue(true));
        $this->InsertFields["user_login"]["Value"] = $this->cp["user_login"]->GetDBValue(true);
        $this->InsertFields["user_password"]["Value"] = $this->cp["user_password"]->GetDBValue(true);
        $this->InsertFields["user_active"]["Value"] = $this->cp["user_active"]->GetDBValue(true);
        $this->InsertFields["group_id"]["Value"] = $this->cp["group_id"]->GetDBValue(true);
        $this->InsertFields["prefix"]["Value"] = $this->cp["prefix"]->GetDBValue(true);
        $this->InsertFields["first_name"]["Value"] = $this->cp["first_name"]->GetDBValue(true);
        $this->InsertFields["last_name"]["Value"] = $this->cp["last_name"]->GetDBValue(true);
        $this->InsertFields["suffix"]["Value"] = $this->cp["suffix"]->GetDBValue(true);
        $this->InsertFields["company"]["Value"] = $this->cp["company"]->GetDBValue(true);
        $this->InsertFields["title"]["Value"] = $this->cp["title"]->GetDBValue(true);
        $this->InsertFields["address1"]["Value"] = $this->cp["address1"]->GetDBValue(true);
        $this->InsertFields["address2"]["Value"] = $this->cp["address2"]->GetDBValue(true);
        $this->InsertFields["city"]["Value"] = $this->cp["city"]->GetDBValue(true);
        $this->InsertFields["state"]["Value"] = $this->cp["state"]->GetDBValue(true);
        $this->InsertFields["post_code"]["Value"] = $this->cp["post_code"]->GetDBValue(true);
        $this->InsertFields["country"]["Value"] = $this->cp["country"]->GetDBValue(true);
        $this->InsertFields["county"]["Value"] = $this->cp["county"]->GetDBValue(true);
        $this->InsertFields["phone_work"]["Value"] = $this->cp["phone_work"]->GetDBValue(true);
        $this->InsertFields["phone_cell"]["Value"] = $this->cp["phone_cell"]->GetDBValue(true);
        $this->InsertFields["fax"]["Value"] = $this->cp["fax"]->GetDBValue(true);
        $this->InsertFields["notes"]["Value"] = $this->cp["notes"]->GetDBValue(true);
        $this->SQL = CCBuildInsert("tbl_users", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @39-70C03474
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["user_login"] = new clsSQLParameter("ctrluser_login", ccsText, "", "", $this->user_login->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["user_password"] = new clsSQLParameter("expr95", ccsText, "", "", "{password}", NULL, false, $this->ErrorBlock);
        $this->cp["user_active"] = new clsSQLParameter("ctrluser_active", ccsInteger, "", "", $this->user_active->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["group_id"] = new clsSQLParameter("ctrlgroup_id", ccsInteger, "", "", $this->group_id->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["prefix"] = new clsSQLParameter("ctrlprefix", ccsText, "", "", $this->prefix->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["first_name"] = new clsSQLParameter("ctrlfirst_name", ccsText, "", "", $this->first_name->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["last_name"] = new clsSQLParameter("ctrllast_name", ccsText, "", "", $this->last_name->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["suffix"] = new clsSQLParameter("ctrlsuffix", ccsText, "", "", $this->suffix->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["company"] = new clsSQLParameter("ctrlcompany", ccsText, "", "", $this->company->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["title"] = new clsSQLParameter("ctrltitle", ccsText, "", "", $this->title->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["address1"] = new clsSQLParameter("ctrladdress1", ccsText, "", "", $this->address1->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["address2"] = new clsSQLParameter("ctrladdress2", ccsText, "", "", $this->address2->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["city"] = new clsSQLParameter("ctrlcity", ccsText, "", "", $this->city->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["state"] = new clsSQLParameter("ctrlstate", ccsText, "", "", $this->state->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["post_code"] = new clsSQLParameter("ctrlpost_code", ccsText, "", "", $this->post_code->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["country"] = new clsSQLParameter("ctrlcountry", ccsText, "", "", $this->country->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["county"] = new clsSQLParameter("ctrlcounty", ccsText, "", "", $this->county->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["phone_work"] = new clsSQLParameter("ctrlphone_work", ccsText, "", "", $this->phone_work->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["phone_cell"] = new clsSQLParameter("ctrlphone_cell", ccsText, "", "", $this->phone_cell->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["fax"] = new clsSQLParameter("ctrlfax", ccsText, "", "", $this->fax->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["notes"] = new clsSQLParameter("ctrlnotes", ccsMemo, "", "", $this->notes->GetValue(true), NULL, false, $this->ErrorBlock);
        $wp = new clsSQLParameters($this->ErrorBlock);
        $wp->AddParameter("1", "urlid", ccsInteger, "", "", CCGetFromGet("id", NULL), NULL, false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["user_login"]->GetValue()) and !strlen($this->cp["user_login"]->GetText()) and !is_bool($this->cp["user_login"]->GetValue())) 
            $this->cp["user_login"]->SetValue($this->user_login->GetValue(true));
        if (!is_null($this->cp["user_password"]->GetValue()) and !strlen($this->cp["user_password"]->GetText()) and !is_bool($this->cp["user_password"]->GetValue())) 
            $this->cp["user_password"]->SetValue("{password}");
        if (!is_null($this->cp["user_active"]->GetValue()) and !strlen($this->cp["user_active"]->GetText()) and !is_bool($this->cp["user_active"]->GetValue())) 
            $this->cp["user_active"]->SetValue($this->user_active->GetValue(true));
        if (!is_null($this->cp["group_id"]->GetValue()) and !strlen($this->cp["group_id"]->GetText()) and !is_bool($this->cp["group_id"]->GetValue())) 
            $this->cp["group_id"]->SetValue($this->group_id->GetValue(true));
        if (!is_null($this->cp["prefix"]->GetValue()) and !strlen($this->cp["prefix"]->GetText()) and !is_bool($this->cp["prefix"]->GetValue())) 
            $this->cp["prefix"]->SetValue($this->prefix->GetValue(true));
        if (!is_null($this->cp["first_name"]->GetValue()) and !strlen($this->cp["first_name"]->GetText()) and !is_bool($this->cp["first_name"]->GetValue())) 
            $this->cp["first_name"]->SetValue($this->first_name->GetValue(true));
        if (!is_null($this->cp["last_name"]->GetValue()) and !strlen($this->cp["last_name"]->GetText()) and !is_bool($this->cp["last_name"]->GetValue())) 
            $this->cp["last_name"]->SetValue($this->last_name->GetValue(true));
        if (!is_null($this->cp["suffix"]->GetValue()) and !strlen($this->cp["suffix"]->GetText()) and !is_bool($this->cp["suffix"]->GetValue())) 
            $this->cp["suffix"]->SetValue($this->suffix->GetValue(true));
        if (!is_null($this->cp["company"]->GetValue()) and !strlen($this->cp["company"]->GetText()) and !is_bool($this->cp["company"]->GetValue())) 
            $this->cp["company"]->SetValue($this->company->GetValue(true));
        if (!is_null($this->cp["title"]->GetValue()) and !strlen($this->cp["title"]->GetText()) and !is_bool($this->cp["title"]->GetValue())) 
            $this->cp["title"]->SetValue($this->title->GetValue(true));
        if (!is_null($this->cp["address1"]->GetValue()) and !strlen($this->cp["address1"]->GetText()) and !is_bool($this->cp["address1"]->GetValue())) 
            $this->cp["address1"]->SetValue($this->address1->GetValue(true));
        if (!is_null($this->cp["address2"]->GetValue()) and !strlen($this->cp["address2"]->GetText()) and !is_bool($this->cp["address2"]->GetValue())) 
            $this->cp["address2"]->SetValue($this->address2->GetValue(true));
        if (!is_null($this->cp["city"]->GetValue()) and !strlen($this->cp["city"]->GetText()) and !is_bool($this->cp["city"]->GetValue())) 
            $this->cp["city"]->SetValue($this->city->GetValue(true));
        if (!is_null($this->cp["state"]->GetValue()) and !strlen($this->cp["state"]->GetText()) and !is_bool($this->cp["state"]->GetValue())) 
            $this->cp["state"]->SetValue($this->state->GetValue(true));
        if (!strlen($this->cp["state"]->GetText()) and !is_bool($this->cp["state"]->GetValue(true))) 
            $this->cp["state"]->SetText("");
        if (!is_null($this->cp["post_code"]->GetValue()) and !strlen($this->cp["post_code"]->GetText()) and !is_bool($this->cp["post_code"]->GetValue())) 
            $this->cp["post_code"]->SetValue($this->post_code->GetValue(true));
        if (!is_null($this->cp["country"]->GetValue()) and !strlen($this->cp["country"]->GetText()) and !is_bool($this->cp["country"]->GetValue())) 
            $this->cp["country"]->SetValue($this->country->GetValue(true));
        if (!is_null($this->cp["county"]->GetValue()) and !strlen($this->cp["county"]->GetText()) and !is_bool($this->cp["county"]->GetValue())) 
            $this->cp["county"]->SetValue($this->county->GetValue(true));
        if (!is_null($this->cp["phone_work"]->GetValue()) and !strlen($this->cp["phone_work"]->GetText()) and !is_bool($this->cp["phone_work"]->GetValue())) 
            $this->cp["phone_work"]->SetValue($this->phone_work->GetValue(true));
        if (!is_null($this->cp["phone_cell"]->GetValue()) and !strlen($this->cp["phone_cell"]->GetText()) and !is_bool($this->cp["phone_cell"]->GetValue())) 
            $this->cp["phone_cell"]->SetValue($this->phone_cell->GetValue(true));
        if (!is_null($this->cp["fax"]->GetValue()) and !strlen($this->cp["fax"]->GetText()) and !is_bool($this->cp["fax"]->GetValue())) 
            $this->cp["fax"]->SetValue($this->fax->GetValue(true));
        if (!is_null($this->cp["notes"]->GetValue()) and !strlen($this->cp["notes"]->GetText()) and !is_bool($this->cp["notes"]->GetValue())) 
            $this->cp["notes"]->SetValue($this->notes->GetValue(true));
        $wp->Criterion[1] = $wp->Operation(opEqual, "user_id", $wp->GetDBValue("1"), $this->ToSQL($wp->GetDBValue("1"), ccsInteger),false);
        $Where = 
             $wp->Criterion[1];
        $this->UpdateFields["user_login"]["Value"] = $this->cp["user_login"]->GetDBValue(true);
        $this->UpdateFields["user_password"]["Value"] = $this->cp["user_password"]->GetDBValue(true);
        $this->UpdateFields["user_active"]["Value"] = $this->cp["user_active"]->GetDBValue(true);
        $this->UpdateFields["group_id"]["Value"] = $this->cp["group_id"]->GetDBValue(true);
        $this->UpdateFields["prefix"]["Value"] = $this->cp["prefix"]->GetDBValue(true);
        $this->UpdateFields["first_name"]["Value"] = $this->cp["first_name"]->GetDBValue(true);
        $this->UpdateFields["last_name"]["Value"] = $this->cp["last_name"]->GetDBValue(true);
        $this->UpdateFields["suffix"]["Value"] = $this->cp["suffix"]->GetDBValue(true);
        $this->UpdateFields["company"]["Value"] = $this->cp["company"]->GetDBValue(true);
        $this->UpdateFields["title"]["Value"] = $this->cp["title"]->GetDBValue(true);
        $this->UpdateFields["address1"]["Value"] = $this->cp["address1"]->GetDBValue(true);
        $this->UpdateFields["address2"]["Value"] = $this->cp["address2"]->GetDBValue(true);
        $this->UpdateFields["city"]["Value"] = $this->cp["city"]->GetDBValue(true);
        $this->UpdateFields["state"]["Value"] = $this->cp["state"]->GetDBValue(true);
        $this->UpdateFields["post_code"]["Value"] = $this->cp["post_code"]->GetDBValue(true);
        $this->UpdateFields["country"]["Value"] = $this->cp["country"]->GetDBValue(true);
        $this->UpdateFields["county"]["Value"] = $this->cp["county"]->GetDBValue(true);
        $this->UpdateFields["phone_work"]["Value"] = $this->cp["phone_work"]->GetDBValue(true);
        $this->UpdateFields["phone_cell"]["Value"] = $this->cp["phone_cell"]->GetDBValue(true);
        $this->UpdateFields["fax"]["Value"] = $this->cp["fax"]->GetDBValue(true);
        $this->UpdateFields["notes"]["Value"] = $this->cp["notes"]->GetDBValue(true);
        $this->SQL = CCBuildUpdate("tbl_users", $this->UpdateFields, $this);
        $this->SQL .= strlen($Where) ? " WHERE " . $Where : $Where;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @39-E866E487
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM tbl_users";
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End UserAddEditDataSource Class @39-FCB6E20C

class clsCalendar_Users { //Calendar_Users class @1-C08C45DA

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

//Class_Initialize Event @1-9D913DB1
    function clsCalendar_Users($RelativePath, $ComponentName, & $Parent)
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = $ComponentName;
        $this->RelativePath = $RelativePath;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->FileName = "Calendar_Users.php";
        $this->Redirect = "";
        $this->TemplateFileName = "Calendar_Users.html";
        $this->BlockToParse = "main";
        $this->TemplateEncoding = "UTF-8";
        $this->ContentType = "text/html";
    }
//End Class_Initialize Event

//Class_Terminate Event @1-C4B1D632
    function Class_Terminate()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
        unset($this->UsersSearch);
        unset($this->UsersGrid);
        unset($this->UserAddEdit);
    }
//End Class_Terminate Event

//BindEvents Method @1-0164D43D
    function BindEvents()
    {
        $this->UsersSearch->u->ds->CCSEvents["BeforeBuildSelect"] = "Calendar_Users_UsersSearch_u_ds_BeforeBuildSelect";
        $this->UsersSearch->g->ds->CCSEvents["BeforeBuildSelect"] = "Calendar_Users_UsersSearch_g_ds_BeforeBuildSelect";
        $this->UsersSearch->Button_Add->CCSEvents["OnClick"] = "Calendar_Users_UsersSearch_Button_Add_OnClick";
        $this->UsersSearch->CCSEvents["BeforeShow"] = "Calendar_Users_UsersSearch_BeforeShow";
        $this->UsersSearch->CCSEvents["OnValidate"] = "Calendar_Users_UsersSearch_OnValidate";
        $this->UsersGrid->TotalRecords->CCSEvents["BeforeShow"] = "Calendar_Users_UsersGrid_TotalRecords_BeforeShow";
        $this->UsersGrid->group->CCSEvents["BeforeShow"] = "Calendar_Users_UsersGrid_group_BeforeShow";
        $this->UsersGrid->Button_Submit->CCSEvents["OnClick"] = "Calendar_Users_UsersGrid_Button_Submit_OnClick";
        $this->UsersGrid->CCSEvents["BeforeShow"] = "Calendar_Users_UsersGrid_BeforeShow";
        $this->UsersGrid->ds->CCSEvents["BeforeBuildSelect"] = "Calendar_Users_UsersGrid_ds_BeforeBuildSelect";
        $this->UserAddEdit->Button_Delete->CCSEvents["BeforeShow"] = "Calendar_Users_UserAddEdit_Button_Delete_BeforeShow";
        $this->UserAddEdit->Button_Cancel->CCSEvents["BeforeShow"] = "Calendar_Users_UserAddEdit_Button_Cancel_BeforeShow";
        $this->UserAddEdit->user_login->CCSEvents["OnValidate"] = "Calendar_Users_UserAddEdit_user_login_OnValidate";
        $this->UserAddEdit->group_id->ds->CCSEvents["BeforeBuildSelect"] = "Calendar_Users_UserAddEdit_group_id_ds_BeforeBuildSelect";
        $this->UserAddEdit->group_id->CCSEvents["BeforeShow"] = "Calendar_Users_UserAddEdit_group_id_BeforeShow";
        $this->UserAddEdit->first_name->CCSEvents["OnValidate"] = "Calendar_Users_UserAddEdit_first_name_OnValidate";
        $this->UserAddEdit->last_name->CCSEvents["OnValidate"] = "Calendar_Users_UserAddEdit_last_name_OnValidate";
        $this->UserAddEdit->AddEditLabel->CCSEvents["BeforeShow"] = "Calendar_Users_UserAddEdit_AddEditLabel_BeforeShow";
        $this->UserAddEdit->NewPassword->CCSEvents["OnValidate"] = "Calendar_Users_UserAddEdit_NewPassword_OnValidate";
        $this->UserAddEdit->GroupLabel->CCSEvents["BeforeShow"] = "Calendar_Users_UserAddEdit_GroupLabel_BeforeShow";
        $this->UserAddEdit->CCSEvents["BeforeShow"] = "Calendar_Users_UserAddEdit_BeforeShow";
        $this->UserAddEdit->ds->CCSEvents["BeforeExecuteInsert"] = "Calendar_Users_UserAddEdit_ds_BeforeExecuteInsert";
        $this->UserAddEdit->ds->CCSEvents["BeforeExecuteUpdate"] = "Calendar_Users_UserAddEdit_ds_BeforeExecuteUpdate";
        $this->UserAddEdit->CCSEvents["AfterUpdate"] = "Calendar_Users_UserAddEdit_AfterUpdate";
        $this->UserAddEdit->CCSEvents["OnValidate"] = "Calendar_Users_UserAddEdit_OnValidate";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInitialize", $this);
    }
//End BindEvents Method

//Operations Method @1-B09B2BCF
    function Operations()
    {
        global $Redirect;
        if(!$this->Visible)
            return "";
        $this->UsersSearch->Operation();
        $this->UsersGrid->Operation();
        $this->UserAddEdit->Operation();
    }
//End Operations Method

//Initialize Method @1-79C32BF7
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
        $this->UsersSearch = new clsRecordCalendar_UsersUsersSearch($this->RelativePath, $this);
        $this->UsersGrid = new clsEditableGridCalendar_UsersUsersGrid($this->RelativePath, $this);
        $this->UserAddEdit = new clsRecordCalendar_UsersUserAddEdit($this->RelativePath, $this);
        $this->UsersGrid->Initialize();
        $this->UserAddEdit->Initialize();
        $this->BindEvents();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
    }
//End Initialize Method

//Show Method @1-8562C4DB
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
        $this->UsersSearch->Show();
        $this->UsersGrid->Show();
        $this->UserAddEdit->Show();
        $Tpl->Parse();
        $Tpl->block_path = $block_path;
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
        $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
    }
//End Show Method

} //End Calendar_Users Class @1-FCB6E20C

//Include Event File @1-1DCAF3F6
include_once(RelativePath . "/Calendar/Calendar_Users_events.php");
//End Include Event File


?>
