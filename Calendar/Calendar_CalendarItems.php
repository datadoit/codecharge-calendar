<?php

class clsRecordCalendar_CalendarItemsItemsSearch { //ItemsSearch Class @2-0AFFDA1C

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

//Class_Initialize Event @2-405BB471
    function clsRecordCalendar_CalendarItemsItemsSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record ItemsSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "ItemsSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->CalEnd = new clsControl(ccsTextBox, "CalEnd", "CalEnd", ccsText, "", CCGetRequestParam("CalEnd", $Method, NULL), $this);
            $this->DatePicker_CalEnd = new clsDatePicker("DatePicker_CalEnd", "ItemsSearch", "CalEnd", $this);
            $this->c = new clsControl(ccsListBox, "c", "c", ccsInteger, "", CCGetRequestParam("c", $Method, NULL), $this);
            $this->c->DSType = dsTable;
            $this->c->DataSource = new clsDBConnection1();
            $this->c->ds = & $this->c->DataSource;
            $this->c->DataSource->SQL = "SELECT CONCAT(calendar_name, ' (', calendar_view, ')') AS CalendarNameView, tbl_calendars.* \n" .
"FROM tbl_calendars LEFT JOIN tbl_calendars_private_users ON\n" .
"tbl_calendars.calendar_id = tbl_calendars_private_users.calendar_id {SQL_Where}\n" .
"GROUP BY tbl_calendars.calendar_id {SQL_OrderBy}";
            list($this->c->BoundColumn, $this->c->TextColumn, $this->c->DBFormat) = array("calendar_id", "CalendarNameView", "");
            $this->c->DataSource->Parameters["expr113"] = "Public";
            $this->c->DataSource->wp = new clsSQLParameters();
            $this->c->DataSource->wp->AddParameter("1", "expr113", ccsText, "", "", $this->c->DataSource->Parameters["expr113"], "", false);
            $this->c->DataSource->wp->Criterion[1] = $this->c->DataSource->wp->Operation(opEqual, "tbl_calendars.calendar_view", $this->c->DataSource->wp->GetDBValue("1"), $this->c->DataSource->ToSQL($this->c->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->c->DataSource->Where = 
                 $this->c->DataSource->wp->Criterion[1];
            $this->CalStart = new clsControl(ccsTextBox, "CalStart", "CalStart", ccsText, "", CCGetRequestParam("CalStart", $Method, NULL), $this);
            $this->DatePicker_CalStart = new clsDatePicker("DatePicker_CalStart", "ItemsSearch", "CalStart", $this);
            $this->Button_Clear = new clsButton("Button_Clear", $Method, $this);
            $this->Button_Add = new clsButton("Button_Add", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @2-1E0AC09F
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        if(! (CCStrLen($this->c->GetText()) > 0)) {
            $this->c->Errors->addError($CCSLocales->GetText("CRM_ChooseCalendarError"));
        }
        $Validation = ($this->CalEnd->Validate() && $Validation);
        $Validation = ($this->c->Validate() && $Validation);
        $Validation = ($this->CalStart->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->CalEnd->Errors->Count() == 0);
        $Validation =  $Validation && ($this->c->Errors->Count() == 0);
        $Validation =  $Validation && ($this->CalStart->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-79A6D186
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->CalEnd->Errors->Count());
        $errors = ($errors || $this->DatePicker_CalEnd->Errors->Count());
        $errors = ($errors || $this->c->Errors->Count());
        $errors = ($errors || $this->CalStart->Errors->Count());
        $errors = ($errors || $this->DatePicker_CalStart->Errors->Count());
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

//Operation Method @2-1BA57A97
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
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "c", "CalStart", "CalEnd", "ItemsPage", "ItemsPageSize", "ItemsOrder", "ItemsDir"));
            if(!CCGetEvent($this->Button_Clear->CCSEvents, "OnClick", $this->Button_Clear)) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Add") {
            if(!CCGetEvent($this->Button_Add->CCSEvents, "OnClick", $this->Button_Add)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = $FileName . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y", "Button_Clear", "Button_Clear_x", "Button_Clear_y", "Button_Add", "Button_Add_x", "Button_Add_y", "ItemsPage", "ItemsPageSize", "ItemsOrder", "ItemsDir")), CCGetQueryString("QueryString", array("CalEnd", "c", "CalStart", "ccsForm", "ItemsPage", "ItemsPageSize", "ItemsOrder", "ItemsDir")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @2-B8CBBFC7
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

        $this->c->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->CalEnd->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_CalEnd->Errors->ToString());
            $Error = ComposeStrings($Error, $this->c->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CalStart->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_CalStart->Errors->ToString());
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
        $this->CalEnd->Show();
        $this->DatePicker_CalEnd->Show();
        $this->c->Show();
        $this->CalStart->Show();
        $this->DatePicker_CalStart->Show();
        $this->Button_Clear->Show();
        $this->Button_Add->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End ItemsSearch Class @2-FCB6E20C

class clsEditableGridCalendar_CalendarItemsItems { //Items Class @9-F9589BE7

//Variables @9-5627F2DB

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
    public $Sorter_calendar_item_start;
    public $Sorter_calendar_item_title;
//End Variables

//Class_Initialize Event @9-DE3B709D
    function clsEditableGridCalendar_CalendarItemsItems($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid Items/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "Items";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["calendar_item_id"][0] = "calendar_item_id";
        $this->DataSource = new clsCalendar_CalendarItemsItemsDataSource($this);
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

        $this->SorterName = CCGetParam("ItemsOrder", "");
        $this->SorterDirection = CCGetParam("ItemsDir", "");

        $this->TotalRecords = new clsControl(ccsLabel, "TotalRecords", "TotalRecords", ccsText, "", NULL, $this);
        $this->calendar_item_start = new clsControl(ccsLabel, "calendar_item_start", $CCSLocales->GetText("calendar_item_start"), ccsDate, array("m", "/", "d", "/", "yy", " ", "h", ":", "nn", "am/pm"), NULL, $this);
        $this->calendar_item_end = new clsControl(ccsLabel, "calendar_item_end", $CCSLocales->GetText("calendar_item_end"), ccsDate, array("m", "/", "d", "/", "yy", " ", "h", ":", "nn", "am/pm"), NULL, $this);
        $this->calendar_item_title = new clsControl(ccsLink, "calendar_item_title", $CCSLocales->GetText("calendar_item_title"), ccsText, "", NULL, $this);
        $this->calendar_item_title->Page = "";
        $this->HeaderPanel = new clsPanel("HeaderPanel", $this);
        $this->Sorter_calendar_item_start = new clsSorter($this->ComponentName, "Sorter_calendar_item_start", $FileName, $this);
        $this->Sorter_calendar_item_title = new clsSorter($this->ComponentName, "Sorter_calendar_item_title", $FileName, $this);
        $this->Header_ColumnAction = new clsPanel("Header_ColumnAction", $this);
        $this->CheckBox_SelectAll = new clsControl(ccsCheckBox, "CheckBox_SelectAll", "CheckBox_SelectAll", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->CheckBox_SelectAll->CheckedValue = true;
        $this->CheckBox_SelectAll->UncheckedValue = false;
        $this->Data_ColumnAction = new clsPanel("Data_ColumnAction", $this);
        $this->CheckBox_Delete = new clsControl(ccsCheckBox, "CheckBox_Delete", "CheckBox_Delete", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->CheckBox_Delete->CheckedValue = true;
        $this->CheckBox_Delete->UncheckedValue = false;
        $this->calendar_item_id = new clsControl(ccsHidden, "calendar_item_id", "calendar_item_id", ccsInteger, "", NULL, $this);
        $this->FooterPanel = new clsPanel("FooterPanel", $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->ActionPanel = new clsPanel("ActionPanel", $this);
        $this->Button_Submit = new clsButton("Button_Submit", $Method, $this);
        $this->action = new clsControl(ccsListBox, "action", "action", ccsText, "", NULL, $this);
        $this->action->DSType = dsListOfValues;
        $this->action->Values = array(array("delete", $CCSLocales->GetText("CCS_Delete")));
        $this->HeaderPanel->AddComponent("Sorter_calendar_item_start", $this->Sorter_calendar_item_start);
        $this->HeaderPanel->AddComponent("Sorter_calendar_item_title", $this->Sorter_calendar_item_title);
        $this->HeaderPanel->AddComponent("Header_ColumnAction", $this->Header_ColumnAction);
        $this->Header_ColumnAction->AddComponent("CheckBox_SelectAll", $this->CheckBox_SelectAll);
        $this->Data_ColumnAction->AddComponent("CheckBox_Delete", $this->CheckBox_Delete);
        $this->Data_ColumnAction->AddComponent("calendar_item_id", $this->calendar_item_id);
        $this->FooterPanel->AddComponent("Navigator", $this->Navigator);
        $this->FooterPanel->AddComponent("ActionPanel", $this->ActionPanel);
        $this->ActionPanel->AddComponent("Button_Submit", $this->Button_Submit);
        $this->ActionPanel->AddComponent("action", $this->action);
    }
//End Class_Initialize Event

//Initialize Method @9-74DC4F5E
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urlc"] = CCGetFromGet("c", NULL);
        $this->DataSource->Parameters["urlCalStart"] = CCGetFromGet("CalStart", NULL);
    }
//End Initialize Method

//SetPrimaryKeys Method @9-EBC3F86C
    function SetPrimaryKeys($PrimaryKeys) {
        $this->PrimaryKeys = $PrimaryKeys;
        return $this->PrimaryKeys;
    }
//End SetPrimaryKeys Method

//GetPrimaryKeys Method @9-74F9A772
    function GetPrimaryKeys() {
        return $this->PrimaryKeys;
    }
//End GetPrimaryKeys Method

//GetFormParameters Method @9-263AF004
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["CheckBox_Delete"][$RowNumber] = CCGetFromPost("CheckBox_Delete_" . $RowNumber, NULL);
            $this->FormParameters["calendar_item_id"][$RowNumber] = CCGetFromPost("calendar_item_id_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @9-22A0B446
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["calendar_item_id"] = $this->CachedColumns["calendar_item_id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            $this->calendar_item_id->SetText($this->FormParameters["calendar_item_id"][$this->RowNumber], $this->RowNumber);
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

//ValidateRow Method @9-3F9C14EC
    function ValidateRow()
    {
        global $CCSLocales;
        $this->CheckBox_Delete->Validate();
        $this->calendar_item_id->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->CheckBox_Delete->Errors->ToString());
        $errors = ComposeStrings($errors, $this->calendar_item_id->Errors->ToString());
        $this->CheckBox_Delete->Errors->Clear();
        $this->calendar_item_id->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @9-0126AD13
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["calendar_item_id"][$this->RowNumber]) && count($this->FormParameters["calendar_item_id"][$this->RowNumber])) || strlen($this->FormParameters["calendar_item_id"][$this->RowNumber]));
        return $filed;
    }
//End CheckInsert Method

//CheckErrors Method @9-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @9-909F269B
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

//UpdateGrid Method @9-044164A5
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["calendar_item_id"] = $this->CachedColumns["calendar_item_id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            $this->calendar_item_id->SetText($this->FormParameters["calendar_item_id"][$this->RowNumber], $this->RowNumber);
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

//DeleteRow Method @9-A4A656F6
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

//FormScript Method @9-D9D17B40
    function FormScript($TotalRows)
    {
        $script = "";
        $script .= "\n<script language=\"JavaScript\" type=\"text/javascript\">\n<!--\n";
        $script .= "var ItemsElements;\n";
        $script .= "var ItemsEmptyRows = 0;\n";
        $script .= "var " . $this->ComponentName . "DeleteControl = 0;\n";
        $script .= "var " . $this->ComponentName . "calendar_item_idID = 1;\n";
        $script .= "\nfunction initItemsElements() {\n";
        $script .= "\tvar ED = document.forms[\"Items\"];\n";
        $script .= "\tItemsElements = new Array (\n";
        for($i = 1; $i <= $TotalRows; $i++) {
            $script .= "\t\tnew Array(" . "ED.CheckBox_Delete_" . $i . ", " . "ED.calendar_item_id_" . $i . ")";
            if($i != $TotalRows) $script .= ",\n";
        }
        $script .= ");\n";
        $script .= "}\n";
        $script .= "\n//-->\n</script>";
        return $script;
    }
//End FormScript Method

//SetFormState Method @9-3E091A0A
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
                $this->CachedColumns["calendar_item_id"][$RowNumber] = $piece;
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $this->CachedColumns["calendar_item_id"][$RowNumber] = "";
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @9-11D6E4EF
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["calendar_item_id"][$i]));
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @9-C6A1C2E2
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
        $this->ControlsVisible["calendar_item_start"] = $this->calendar_item_start->Visible;
        $this->ControlsVisible["calendar_item_end"] = $this->calendar_item_end->Visible;
        $this->ControlsVisible["calendar_item_title"] = $this->calendar_item_title->Visible;
        $this->ControlsVisible["Data_ColumnAction"] = $this->Data_ColumnAction->Visible;
        $this->ControlsVisible["CheckBox_Delete"] = $this->CheckBox_Delete->Visible;
        $this->ControlsVisible["calendar_item_id"] = $this->calendar_item_id->Visible;
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
                    $this->CachedColumns["calendar_item_id"][$this->RowNumber] = $this->DataSource->CachedColumns["calendar_item_id"];
                    $this->CheckBox_Delete->SetValue("");
                    $this->calendar_item_start->SetValue($this->DataSource->calendar_item_start->GetValue());
                    $this->calendar_item_end->SetValue($this->DataSource->calendar_item_end->GetValue());
                    $this->calendar_item_title->SetValue($this->DataSource->calendar_item_title->GetValue());
                    $this->calendar_item_title->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                    $this->calendar_item_title->Parameters = CCAddParam($this->calendar_item_title->Parameters, "action", "AddEdit");
                    $this->calendar_item_title->Parameters = CCAddParam($this->calendar_item_title->Parameters, "id", $this->DataSource->f("calendar_item_id"));
                    $this->calendar_item_id->SetValue($this->DataSource->calendar_item_id->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->calendar_item_start->SetText("");
                    $this->calendar_item_end->SetText("");
                    $this->calendar_item_title->SetText("");
                    $this->calendar_item_start->SetValue($this->DataSource->calendar_item_start->GetValue());
                    $this->calendar_item_end->SetValue($this->DataSource->calendar_item_end->GetValue());
                    $this->calendar_item_title->SetValue($this->DataSource->calendar_item_title->GetValue());
                    $this->calendar_item_title->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                    $this->calendar_item_title->Parameters = CCAddParam($this->calendar_item_title->Parameters, "action", "AddEdit");
                    $this->calendar_item_title->Parameters = CCAddParam($this->calendar_item_title->Parameters, "id", $this->DataSource->f("calendar_item_id"));
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                    $this->calendar_item_id->SetText($this->FormParameters["calendar_item_id"][$this->RowNumber], $this->RowNumber);
                    $this->calendar_item_title->Parameters = CCAddParam($this->calendar_item_title->Parameters, "action", "AddEdit");
                    $this->calendar_item_title->Parameters = CCAddParam($this->calendar_item_title->Parameters, "id", $this->DataSource->f("calendar_item_id"));
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["calendar_item_id"][$this->RowNumber] = "";
                    $this->calendar_item_start->SetText("");
                    $this->calendar_item_end->SetText("");
                    $this->calendar_item_title->SetText("");
                    $this->calendar_item_id->SetText("");
                    $this->calendar_item_title->Parameters = CCAddParam($this->calendar_item_title->Parameters, "action", "AddEdit");
                    $this->calendar_item_title->Parameters = CCAddParam($this->calendar_item_title->Parameters, "id", $this->DataSource->f("calendar_item_id"));
                } else {
                    $this->calendar_item_start->SetText("");
                    $this->calendar_item_end->SetText("");
                    $this->calendar_item_title->SetText("");
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                    $this->calendar_item_id->SetText($this->FormParameters["calendar_item_id"][$this->RowNumber], $this->RowNumber);
                    $this->calendar_item_title->Parameters = CCAddParam($this->calendar_item_title->Parameters, "action", "AddEdit");
                    $this->calendar_item_title->Parameters = CCAddParam($this->calendar_item_title->Parameters, "id", $this->DataSource->f("calendar_item_id"));
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->calendar_item_start->Show($this->RowNumber);
                $this->calendar_item_end->Show($this->RowNumber);
                $this->calendar_item_title->Show($this->RowNumber);
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
                        if (($this->DataSource->CachedColumns["calendar_item_id"] == $this->CachedColumns["calendar_item_id"][$this->RowNumber])) {
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
        $this->HeaderPanel->Show();
        $this->FooterPanel->Show();

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

} //End Items Class @9-FCB6E20C

class clsCalendar_CalendarItemsItemsDataSource extends clsDBConnection1 {  //ItemsDataSource Class @9-CF41224F

//DataSource Variables @9-28BEA3A4
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
    public $calendar_item_start;
    public $calendar_item_end;
    public $calendar_item_title;
    public $CheckBox_Delete;
    public $calendar_item_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @9-DBCA0AE3
    function clsCalendar_CalendarItemsItemsDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid Items/Error";
        $this->Initialize();
        $this->calendar_item_start = new clsField("calendar_item_start", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        
        $this->calendar_item_end = new clsField("calendar_item_end", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        
        $this->calendar_item_title = new clsField("calendar_item_title", ccsText, "");
        
        $this->CheckBox_Delete = new clsField("CheckBox_Delete", ccsBoolean, $this->BooleanFormat);
        
        $this->calendar_item_id = new clsField("calendar_item_id", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @9-A0CFE047
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "calendar_item_start";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_calendar_item_start" => array("calendar_item_start", ""), 
            "Sorter_calendar_item_title" => array("calendar_item_title", "")));
    }
//End SetOrder Method

//Prepare Method @9-7557CF73
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlc", ccsInteger, "", "", $this->Parameters["urlc"], "", false);
        $this->wp->AddParameter("2", "urlCalStart", ccsDate, array("yyyy", "-", "mm", "-", "dd"), array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"), $this->Parameters["urlCalStart"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "calendar_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opGreaterThanOrEqual, "calendar_item_start", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsDate),false);
        $this->wp->Criterion[3] = "( calendar_item_end <= DATE_ADD(" . CCToSQL(CCGetParam("CalEnd", ""), ccsDate) . ", INTERVAL 1 DAY) )";
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], $this->wp->opAND(
             true, 
             $this->wp->Criterion[2], 
             $this->wp->Criterion[3]));
    }
//End Prepare Method

//Open Method @9-B21B5041
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM tbl_calendars_items";
        $this->SQL = "SELECT calendar_item_id, calendar_id, calendar_item_start, calendar_item_end, calendar_item_title \n\n" .
        "FROM tbl_calendars_items {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @9-F6DB4DE1
    function SetValues()
    {
        $this->CachedColumns["calendar_item_id"] = $this->f("calendar_item_id");
        $this->calendar_item_start->SetDBValue(trim($this->f("calendar_item_start")));
        $this->calendar_item_end->SetDBValue(trim($this->f("calendar_item_end")));
        $this->calendar_item_title->SetDBValue($this->f("calendar_item_title"));
        $this->calendar_item_id->SetDBValue(trim($this->f("calendar_item_id")));
    }
//End SetValues Method

//Delete Method @9-F4109CCF
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "calendar_item_id=" . $this->ToSQL($this->CachedColumns["calendar_item_id"], ccsInteger);
        $this->SQL = "DELETE FROM tbl_calendars_items";
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

} //End ItemsDataSource Class @9-FCB6E20C

class clsRecordCalendar_CalendarItemsItemAddEdit { //ItemAddEdit Class @47-C15C9F69

//Variables @47-9E315808

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

//Class_Initialize Event @47-DECBEE02
    function clsRecordCalendar_CalendarItemsItemAddEdit($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record ItemAddEdit/Error";
        $this->DataSource = new clsCalendar_CalendarItemsItemAddEditDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "ItemAddEdit";
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
            $this->calendar_id = new clsControl(ccsListBox, "calendar_id", "calendar_id", ccsInteger, "", CCGetRequestParam("calendar_id", $Method, NULL), $this);
            $this->calendar_id->DSType = dsTable;
            $this->calendar_id->DataSource = new clsDBConnection1();
            $this->calendar_id->ds = & $this->calendar_id->DataSource;
            $this->calendar_id->DataSource->SQL = "SELECT CONCAT(calendar_name, ' (', calendar_view, ')') AS CalendarNameView, tbl_calendars.* \n" .
"FROM tbl_calendars LEFT JOIN tbl_calendars_private_users ON\n" .
"tbl_calendars.calendar_id = tbl_calendars_private_users.calendar_id {SQL_Where}\n" .
"GROUP BY tbl_calendars.calendar_id {SQL_OrderBy}";
            list($this->calendar_id->BoundColumn, $this->calendar_id->TextColumn, $this->calendar_id->DBFormat) = array("calendar_id", "CalendarNameView", "");
            $this->calendar_id->DataSource->Parameters["expr125"] = "Public";
            $this->calendar_id->DataSource->wp = new clsSQLParameters();
            $this->calendar_id->DataSource->wp->AddParameter("1", "expr125", ccsText, "", "", $this->calendar_id->DataSource->Parameters["expr125"], "", false);
            $this->calendar_id->DataSource->wp->Criterion[1] = $this->calendar_id->DataSource->wp->Operation(opEqual, "tbl_calendars.calendar_view", $this->calendar_id->DataSource->wp->GetDBValue("1"), $this->calendar_id->DataSource->ToSQL($this->calendar_id->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->calendar_id->DataSource->Where = 
                 $this->calendar_id->DataSource->wp->Criterion[1];
            $this->StartDate = new clsControl(ccsTextBox, "StartDate", "StartDate", ccsText, "", CCGetRequestParam("StartDate", $Method, NULL), $this);
            $this->DatePicker_StartDate = new clsDatePicker("DatePicker_StartDate", "ItemAddEdit", "StartDate", $this);
            $this->EndDate = new clsControl(ccsTextBox, "EndDate", "EndDate", ccsText, "", CCGetRequestParam("EndDate", $Method, NULL), $this);
            $this->DatePicker_EndDate = new clsDatePicker("DatePicker_EndDate", "ItemAddEdit", "EndDate", $this);
            $this->calendar_item_title = new clsControl(ccsTextBox, "calendar_item_title", $CCSLocales->GetText("calendar_item_title"), ccsText, "", CCGetRequestParam("calendar_item_title", $Method, NULL), $this);
            $this->calendar_item_description = new clsControl(ccsTextArea, "calendar_item_description", $CCSLocales->GetText("calendar_item_description"), ccsMemo, "", CCGetRequestParam("calendar_item_description", $Method, NULL), $this);
            $this->calendar_item_entered_by = new clsControl(ccsHidden, "calendar_item_entered_by", $CCSLocales->GetText("calendar_item_entered_by"), ccsInteger, "", CCGetRequestParam("calendar_item_entered_by", $Method, NULL), $this);
            $this->calendar_item_entered_date = new clsControl(ccsHidden, "calendar_item_entered_date", $CCSLocales->GetText("calendar_item_entered_date"), ccsDate, $DefaultDateFormat, CCGetRequestParam("calendar_item_entered_date", $Method, NULL), $this);
            $this->calendar_item_updated_by = new clsControl(ccsHidden, "calendar_item_updated_by", $CCSLocales->GetText("calendar_item_updated_by"), ccsInteger, "", CCGetRequestParam("calendar_item_updated_by", $Method, NULL), $this);
            $this->calendar_item_updated_date = new clsControl(ccsHidden, "calendar_item_updated_date", $CCSLocales->GetText("calendar_item_updated_date"), ccsDate, $DefaultDateFormat, CCGetRequestParam("calendar_item_updated_date", $Method, NULL), $this);
            $this->AddEditLabel = new clsControl(ccsLabel, "AddEditLabel", "AddEditLabel", ccsText, "", CCGetRequestParam("AddEditLabel", $Method, NULL), $this);
            $this->StartTime = new clsControl(ccsListBox, "StartTime", "StartTime", ccsText, "", CCGetRequestParam("StartTime", $Method, NULL), $this);
            $this->StartTime->DSType = dsTable;
            $this->StartTime->DataSource = new clsDBConnection1();
            $this->StartTime->ds = & $this->StartTime->DataSource;
            $this->StartTime->DataSource->SQL = "SELECT * \n" .
"FROM lu_calendars_times {SQL_Where} {SQL_OrderBy}";
            $this->StartTime->DataSource->Order = "HHiiSS";
            list($this->StartTime->BoundColumn, $this->StartTime->TextColumn, $this->StartTime->DBFormat) = array("id", "time", "");
            $this->StartTime->DataSource->Order = "HHiiSS";
            $this->EndTime = new clsControl(ccsListBox, "EndTime", "EndTime", ccsText, "", CCGetRequestParam("EndTime", $Method, NULL), $this);
            $this->EndTime->DSType = dsTable;
            $this->EndTime->DataSource = new clsDBConnection1();
            $this->EndTime->ds = & $this->EndTime->DataSource;
            $this->EndTime->DataSource->SQL = "SELECT * \n" .
"FROM lu_calendars_times {SQL_Where} {SQL_OrderBy}";
            $this->EndTime->DataSource->Order = "HHiiSS";
            list($this->EndTime->BoundColumn, $this->EndTime->TextColumn, $this->EndTime->DBFormat) = array("id", "time", "");
            $this->EndTime->DataSource->Order = "HHiiSS";
            $this->calendar_item_start = new clsControl(ccsHidden, "calendar_item_start", "calendar_item_start", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"), CCGetRequestParam("calendar_item_start", $Method, NULL), $this);
            $this->calendar_item_end = new clsControl(ccsHidden, "calendar_item_end", "calendar_item_end", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"), CCGetRequestParam("calendar_item_end", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->calendar_id->Value) && !strlen($this->calendar_id->Value) && $this->calendar_id->Value !== false)
                    $this->calendar_id->SetText(CCGetParam("c", ""));
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @47-2832F4DC
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlid"] = CCGetFromGet("id", NULL);
    }
//End Initialize Method

//Validate Method @47-8A30EF60
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        if(! (CCStrLen($this->calendar_id->GetText()) > 0)) {
            $this->calendar_id->Errors->addError($CCSLocales->GetText("CRM_ChooseCalendarError"));
        }
        if(! (CCStrLen($this->StartTime->GetText()) > 0)) {
            $this->StartTime->Errors->addError($CCSLocales->GetText("CRM_ErrorChooseStartTime"));
        }
        if(! (CCStrLen($this->EndTime->GetText()) > 0)) {
            $this->EndTime->Errors->addError($CCSLocales->GetText("CRM_ErrorChooseEndTime"));
        }
        $Validation = ($this->calendar_id->Validate() && $Validation);
        $Validation = ($this->StartDate->Validate() && $Validation);
        $Validation = ($this->EndDate->Validate() && $Validation);
        $Validation = ($this->calendar_item_title->Validate() && $Validation);
        $Validation = ($this->calendar_item_description->Validate() && $Validation);
        $Validation = ($this->calendar_item_entered_by->Validate() && $Validation);
        $Validation = ($this->calendar_item_entered_date->Validate() && $Validation);
        $Validation = ($this->calendar_item_updated_by->Validate() && $Validation);
        $Validation = ($this->calendar_item_updated_date->Validate() && $Validation);
        $Validation = ($this->StartTime->Validate() && $Validation);
        $Validation = ($this->EndTime->Validate() && $Validation);
        $Validation = ($this->calendar_item_start->Validate() && $Validation);
        $Validation = ($this->calendar_item_end->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->calendar_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->StartDate->Errors->Count() == 0);
        $Validation =  $Validation && ($this->EndDate->Errors->Count() == 0);
        $Validation =  $Validation && ($this->calendar_item_title->Errors->Count() == 0);
        $Validation =  $Validation && ($this->calendar_item_description->Errors->Count() == 0);
        $Validation =  $Validation && ($this->calendar_item_entered_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->calendar_item_entered_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->calendar_item_updated_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->calendar_item_updated_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->StartTime->Errors->Count() == 0);
        $Validation =  $Validation && ($this->EndTime->Errors->Count() == 0);
        $Validation =  $Validation && ($this->calendar_item_start->Errors->Count() == 0);
        $Validation =  $Validation && ($this->calendar_item_end->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @47-E2312832
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->calendar_id->Errors->Count());
        $errors = ($errors || $this->StartDate->Errors->Count());
        $errors = ($errors || $this->DatePicker_StartDate->Errors->Count());
        $errors = ($errors || $this->EndDate->Errors->Count());
        $errors = ($errors || $this->DatePicker_EndDate->Errors->Count());
        $errors = ($errors || $this->calendar_item_title->Errors->Count());
        $errors = ($errors || $this->calendar_item_description->Errors->Count());
        $errors = ($errors || $this->calendar_item_entered_by->Errors->Count());
        $errors = ($errors || $this->calendar_item_entered_date->Errors->Count());
        $errors = ($errors || $this->calendar_item_updated_by->Errors->Count());
        $errors = ($errors || $this->calendar_item_updated_date->Errors->Count());
        $errors = ($errors || $this->AddEditLabel->Errors->Count());
        $errors = ($errors || $this->StartTime->Errors->Count());
        $errors = ($errors || $this->EndTime->Errors->Count());
        $errors = ($errors || $this->calendar_item_start->Errors->Count());
        $errors = ($errors || $this->calendar_item_end->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @47-ED598703
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

//Operation Method @47-0595D1F7
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
                $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "action"));
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

//InsertRow Method @47-BD0CF614
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->calendar_id->SetValue($this->calendar_id->GetValue(true));
        $this->DataSource->StartDate->SetValue($this->StartDate->GetValue(true));
        $this->DataSource->EndDate->SetValue($this->EndDate->GetValue(true));
        $this->DataSource->calendar_item_title->SetValue($this->calendar_item_title->GetValue(true));
        $this->DataSource->calendar_item_description->SetValue($this->calendar_item_description->GetValue(true));
        $this->DataSource->calendar_item_entered_by->SetValue($this->calendar_item_entered_by->GetValue(true));
        $this->DataSource->calendar_item_entered_date->SetValue($this->calendar_item_entered_date->GetValue(true));
        $this->DataSource->calendar_item_updated_by->SetValue($this->calendar_item_updated_by->GetValue(true));
        $this->DataSource->calendar_item_updated_date->SetValue($this->calendar_item_updated_date->GetValue(true));
        $this->DataSource->AddEditLabel->SetValue($this->AddEditLabel->GetValue(true));
        $this->DataSource->StartTime->SetValue($this->StartTime->GetValue(true));
        $this->DataSource->EndTime->SetValue($this->EndTime->GetValue(true));
        $this->DataSource->calendar_item_start->SetValue($this->calendar_item_start->GetValue(true));
        $this->DataSource->calendar_item_end->SetValue($this->calendar_item_end->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @47-EB5BF924
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->calendar_id->SetValue($this->calendar_id->GetValue(true));
        $this->DataSource->StartDate->SetValue($this->StartDate->GetValue(true));
        $this->DataSource->EndDate->SetValue($this->EndDate->GetValue(true));
        $this->DataSource->calendar_item_title->SetValue($this->calendar_item_title->GetValue(true));
        $this->DataSource->calendar_item_description->SetValue($this->calendar_item_description->GetValue(true));
        $this->DataSource->calendar_item_entered_by->SetValue($this->calendar_item_entered_by->GetValue(true));
        $this->DataSource->calendar_item_entered_date->SetValue($this->calendar_item_entered_date->GetValue(true));
        $this->DataSource->calendar_item_updated_by->SetValue($this->calendar_item_updated_by->GetValue(true));
        $this->DataSource->calendar_item_updated_date->SetValue($this->calendar_item_updated_date->GetValue(true));
        $this->DataSource->AddEditLabel->SetValue($this->AddEditLabel->GetValue(true));
        $this->DataSource->StartTime->SetValue($this->StartTime->GetValue(true));
        $this->DataSource->EndTime->SetValue($this->EndTime->GetValue(true));
        $this->DataSource->calendar_item_start->SetValue($this->calendar_item_start->GetValue(true));
        $this->DataSource->calendar_item_end->SetValue($this->calendar_item_end->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @47-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @47-D07D9EFD
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

        $this->calendar_id->Prepare();
        $this->StartTime->Prepare();
        $this->EndTime->Prepare();

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
                    $this->calendar_id->SetValue($this->DataSource->calendar_id->GetValue());
                    $this->calendar_item_title->SetValue($this->DataSource->calendar_item_title->GetValue());
                    $this->calendar_item_description->SetValue($this->DataSource->calendar_item_description->GetValue());
                    $this->calendar_item_entered_by->SetValue($this->DataSource->calendar_item_entered_by->GetValue());
                    $this->calendar_item_entered_date->SetValue($this->DataSource->calendar_item_entered_date->GetValue());
                    $this->calendar_item_updated_by->SetValue($this->DataSource->calendar_item_updated_by->GetValue());
                    $this->calendar_item_updated_date->SetValue($this->DataSource->calendar_item_updated_date->GetValue());
                    $this->calendar_item_start->SetValue($this->DataSource->calendar_item_start->GetValue());
                    $this->calendar_item_end->SetValue($this->DataSource->calendar_item_end->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->calendar_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->StartDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_StartDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->EndDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_EndDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->calendar_item_title->Errors->ToString());
            $Error = ComposeStrings($Error, $this->calendar_item_description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->calendar_item_entered_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->calendar_item_entered_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->calendar_item_updated_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->calendar_item_updated_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddEditLabel->Errors->ToString());
            $Error = ComposeStrings($Error, $this->StartTime->Errors->ToString());
            $Error = ComposeStrings($Error, $this->EndTime->Errors->ToString());
            $Error = ComposeStrings($Error, $this->calendar_item_start->Errors->ToString());
            $Error = ComposeStrings($Error, $this->calendar_item_end->Errors->ToString());
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
        $this->calendar_id->Show();
        $this->StartDate->Show();
        $this->DatePicker_StartDate->Show();
        $this->EndDate->Show();
        $this->DatePicker_EndDate->Show();
        $this->calendar_item_title->Show();
        $this->calendar_item_description->Show();
        $this->calendar_item_entered_by->Show();
        $this->calendar_item_entered_date->Show();
        $this->calendar_item_updated_by->Show();
        $this->calendar_item_updated_date->Show();
        $this->AddEditLabel->Show();
        $this->StartTime->Show();
        $this->EndTime->Show();
        $this->calendar_item_start->Show();
        $this->calendar_item_end->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End ItemAddEdit Class @47-FCB6E20C

class clsCalendar_CalendarItemsItemAddEditDataSource extends clsDBConnection1 {  //ItemAddEditDataSource Class @47-6D71C060

//DataSource Variables @47-C16368F1
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
    public $calendar_id;
    public $StartDate;
    public $EndDate;
    public $calendar_item_title;
    public $calendar_item_description;
    public $calendar_item_entered_by;
    public $calendar_item_entered_date;
    public $calendar_item_updated_by;
    public $calendar_item_updated_date;
    public $AddEditLabel;
    public $StartTime;
    public $EndTime;
    public $calendar_item_start;
    public $calendar_item_end;
//End DataSource Variables

//DataSourceClass_Initialize Event @47-84D19D2C
    function clsCalendar_CalendarItemsItemAddEditDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record ItemAddEdit/Error";
        $this->Initialize();
        $this->calendar_id = new clsField("calendar_id", ccsInteger, "");
        
        $this->StartDate = new clsField("StartDate", ccsText, "");
        
        $this->EndDate = new clsField("EndDate", ccsText, "");
        
        $this->calendar_item_title = new clsField("calendar_item_title", ccsText, "");
        
        $this->calendar_item_description = new clsField("calendar_item_description", ccsMemo, "");
        
        $this->calendar_item_entered_by = new clsField("calendar_item_entered_by", ccsInteger, "");
        
        $this->calendar_item_entered_date = new clsField("calendar_item_entered_date", ccsDate, $this->DateFormat);
        
        $this->calendar_item_updated_by = new clsField("calendar_item_updated_by", ccsInteger, "");
        
        $this->calendar_item_updated_date = new clsField("calendar_item_updated_date", ccsDate, $this->DateFormat);
        
        $this->AddEditLabel = new clsField("AddEditLabel", ccsText, "");
        
        $this->StartTime = new clsField("StartTime", ccsText, "");
        
        $this->EndTime = new clsField("EndTime", ccsText, "");
        
        $this->calendar_item_start = new clsField("calendar_item_start", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        
        $this->calendar_item_end = new clsField("calendar_item_end", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        

        $this->InsertFields["calendar_id"] = array("Name" => "calendar_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["calendar_item_title"] = array("Name" => "calendar_item_title", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["calendar_item_description"] = array("Name" => "calendar_item_description", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["calendar_item_entered_by"] = array("Name" => "calendar_item_entered_by", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["calendar_item_entered_date"] = array("Name" => "calendar_item_entered_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["calendar_item_updated_by"] = array("Name" => "calendar_item_updated_by", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["calendar_item_updated_date"] = array("Name" => "calendar_item_updated_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["calendar_item_start"] = array("Name" => "calendar_item_start", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["calendar_item_end"] = array("Name" => "calendar_item_end", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["calendar_id"] = array("Name" => "calendar_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["calendar_item_title"] = array("Name" => "calendar_item_title", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["calendar_item_description"] = array("Name" => "calendar_item_description", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["calendar_item_entered_by"] = array("Name" => "calendar_item_entered_by", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["calendar_item_entered_date"] = array("Name" => "calendar_item_entered_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["calendar_item_updated_by"] = array("Name" => "calendar_item_updated_by", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["calendar_item_updated_date"] = array("Name" => "calendar_item_updated_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["calendar_item_start"] = array("Name" => "calendar_item_start", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["calendar_item_end"] = array("Name" => "calendar_item_end", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @47-C3D8EB65
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlid", ccsInteger, "", "", $this->Parameters["urlid"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "calendar_item_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @47-B739B77D
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tbl_calendars_items {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @47-0B7A70FB
    function SetValues()
    {
        $this->calendar_id->SetDBValue(trim($this->f("calendar_id")));
        $this->calendar_item_title->SetDBValue($this->f("calendar_item_title"));
        $this->calendar_item_description->SetDBValue($this->f("calendar_item_description"));
        $this->calendar_item_entered_by->SetDBValue(trim($this->f("calendar_item_entered_by")));
        $this->calendar_item_entered_date->SetDBValue(trim($this->f("calendar_item_entered_date")));
        $this->calendar_item_updated_by->SetDBValue(trim($this->f("calendar_item_updated_by")));
        $this->calendar_item_updated_date->SetDBValue(trim($this->f("calendar_item_updated_date")));
        $this->calendar_item_start->SetDBValue(trim($this->f("calendar_item_start")));
        $this->calendar_item_end->SetDBValue(trim($this->f("calendar_item_end")));
    }
//End SetValues Method

//Insert Method @47-E9B6FEB7
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["calendar_id"]["Value"] = $this->calendar_id->GetDBValue(true);
        $this->InsertFields["calendar_item_title"]["Value"] = $this->calendar_item_title->GetDBValue(true);
        $this->InsertFields["calendar_item_description"]["Value"] = $this->calendar_item_description->GetDBValue(true);
        $this->InsertFields["calendar_item_entered_by"]["Value"] = $this->calendar_item_entered_by->GetDBValue(true);
        $this->InsertFields["calendar_item_entered_date"]["Value"] = $this->calendar_item_entered_date->GetDBValue(true);
        $this->InsertFields["calendar_item_updated_by"]["Value"] = $this->calendar_item_updated_by->GetDBValue(true);
        $this->InsertFields["calendar_item_updated_date"]["Value"] = $this->calendar_item_updated_date->GetDBValue(true);
        $this->InsertFields["calendar_item_start"]["Value"] = $this->calendar_item_start->GetDBValue(true);
        $this->InsertFields["calendar_item_end"]["Value"] = $this->calendar_item_end->GetDBValue(true);
        $this->SQL = CCBuildInsert("tbl_calendars_items", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @47-E0964F85
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["calendar_id"]["Value"] = $this->calendar_id->GetDBValue(true);
        $this->UpdateFields["calendar_item_title"]["Value"] = $this->calendar_item_title->GetDBValue(true);
        $this->UpdateFields["calendar_item_description"]["Value"] = $this->calendar_item_description->GetDBValue(true);
        $this->UpdateFields["calendar_item_entered_by"]["Value"] = $this->calendar_item_entered_by->GetDBValue(true);
        $this->UpdateFields["calendar_item_entered_date"]["Value"] = $this->calendar_item_entered_date->GetDBValue(true);
        $this->UpdateFields["calendar_item_updated_by"]["Value"] = $this->calendar_item_updated_by->GetDBValue(true);
        $this->UpdateFields["calendar_item_updated_date"]["Value"] = $this->calendar_item_updated_date->GetDBValue(true);
        $this->UpdateFields["calendar_item_start"]["Value"] = $this->calendar_item_start->GetDBValue(true);
        $this->UpdateFields["calendar_item_end"]["Value"] = $this->calendar_item_end->GetDBValue(true);
        $this->SQL = CCBuildUpdate("tbl_calendars_items", $this->UpdateFields, $this);
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

//Delete Method @47-5CC3B795
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM tbl_calendars_items";
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

} //End ItemAddEditDataSource Class @47-FCB6E20C

class clsCalendar_CalendarItems { //Calendar_CalendarItems class @1-594C7A3E

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

//Class_Initialize Event @1-9DE37BF7
    function clsCalendar_CalendarItems($RelativePath, $ComponentName, & $Parent)
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = $ComponentName;
        $this->RelativePath = $RelativePath;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->FileName = "Calendar_CalendarItems.php";
        $this->Redirect = "";
        $this->TemplateFileName = "Calendar_CalendarItems.html";
        $this->BlockToParse = "main";
        $this->TemplateEncoding = "UTF-8";
        $this->ContentType = "text/html";
    }
//End Class_Initialize Event

//Class_Terminate Event @1-675330FF
    function Class_Terminate()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
        unset($this->ItemsSearch);
        unset($this->Items);
        unset($this->ItemAddEdit);
    }
//End Class_Terminate Event

//BindEvents Method @1-2E8E51A5
    function BindEvents()
    {
        $this->ItemsSearch->Button_DoSearch->CCSEvents["OnClick"] = "Calendar_CalendarItems_ItemsSearch_Button_DoSearch_OnClick";
        $this->ItemsSearch->CalEnd->CCSEvents["BeforeShow"] = "Calendar_CalendarItems_ItemsSearch_CalEnd_BeforeShow";
        $this->ItemsSearch->c->ds->CCSEvents["BeforeBuildSelect"] = "Calendar_CalendarItems_ItemsSearch_c_ds_BeforeBuildSelect";
        $this->ItemsSearch->CalStart->CCSEvents["BeforeShow"] = "Calendar_CalendarItems_ItemsSearch_CalStart_BeforeShow";
        $this->ItemsSearch->Button_Add->CCSEvents["OnClick"] = "Calendar_CalendarItems_ItemsSearch_Button_Add_OnClick";
        $this->ItemsSearch->CCSEvents["BeforeShow"] = "Calendar_CalendarItems_ItemsSearch_BeforeShow";
        $this->Items->TotalRecords->CCSEvents["BeforeShow"] = "Calendar_CalendarItems_Items_TotalRecords_BeforeShow";
        $this->Items->Button_Submit->CCSEvents["OnClick"] = "Calendar_CalendarItems_Items_Button_Submit_OnClick";
        $this->Items->CCSEvents["BeforeShow"] = "Calendar_CalendarItems_Items_BeforeShow";
        $this->ItemAddEdit->calendar_id->ds->CCSEvents["BeforeBuildSelect"] = "Calendar_CalendarItems_ItemAddEdit_calendar_id_ds_BeforeBuildSelect";
        $this->ItemAddEdit->StartDate->CCSEvents["BeforeShow"] = "Calendar_CalendarItems_ItemAddEdit_StartDate_BeforeShow";
        $this->ItemAddEdit->StartDate->CCSEvents["OnValidate"] = "Calendar_CalendarItems_ItemAddEdit_StartDate_OnValidate";
        $this->ItemAddEdit->EndDate->CCSEvents["BeforeShow"] = "Calendar_CalendarItems_ItemAddEdit_EndDate_BeforeShow";
        $this->ItemAddEdit->EndDate->CCSEvents["OnValidate"] = "Calendar_CalendarItems_ItemAddEdit_EndDate_OnValidate";
        $this->ItemAddEdit->calendar_item_title->CCSEvents["OnValidate"] = "Calendar_CalendarItems_ItemAddEdit_calendar_item_title_OnValidate";
        $this->ItemAddEdit->AddEditLabel->CCSEvents["BeforeShow"] = "Calendar_CalendarItems_ItemAddEdit_AddEditLabel_BeforeShow";
        $this->ItemAddEdit->StartTime->CCSEvents["BeforeShow"] = "Calendar_CalendarItems_ItemAddEdit_StartTime_BeforeShow";
        $this->ItemAddEdit->EndTime->CCSEvents["BeforeShow"] = "Calendar_CalendarItems_ItemAddEdit_EndTime_BeforeShow";
        $this->ItemAddEdit->CCSEvents["BeforeShow"] = "Calendar_CalendarItems_ItemAddEdit_BeforeShow";
        $this->ItemAddEdit->CCSEvents["OnValidate"] = "Calendar_CalendarItems_ItemAddEdit_OnValidate";
        $this->ItemAddEdit->CCSEvents["AfterUpdate"] = "Calendar_CalendarItems_ItemAddEdit_AfterUpdate";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInitialize", $this);
    }
//End BindEvents Method

//Operations Method @1-E381B394
    function Operations()
    {
        global $Redirect;
        if(!$this->Visible)
            return "";
        $this->ItemsSearch->Operation();
        $this->Items->Operation();
        $this->ItemAddEdit->Operation();
    }
//End Operations Method

//Initialize Method @1-4765A94E
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
        $this->ItemsSearch = new clsRecordCalendar_CalendarItemsItemsSearch($this->RelativePath, $this);
        $this->Items = new clsEditableGridCalendar_CalendarItemsItems($this->RelativePath, $this);
        $this->ItemAddEdit = new clsRecordCalendar_CalendarItemsItemAddEdit($this->RelativePath, $this);
        $this->Items->Initialize();
        $this->ItemAddEdit->Initialize();
        $this->BindEvents();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
    }
//End Initialize Method

//Show Method @1-D7DFAB31
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
        $this->ItemsSearch->Show();
        $this->Items->Show();
        $this->ItemAddEdit->Show();
        $Tpl->Parse();
        $Tpl->block_path = $block_path;
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
        $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
    }
//End Show Method

} //End Calendar_CalendarItems Class @1-FCB6E20C

//Include Event File @1-0921945A
include_once(RelativePath . "/Calendar/Calendar_CalendarItems_events.php");
//End Include Event File


?>
