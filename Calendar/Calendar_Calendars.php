<?php

class clsEditableGridCalendar_CalendarsCalendars { //Calendars Class @2-CEAB384E

//Variables @2-47F1E6C8

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
    public $Sorter_calendar_name;
    public $Sorter_calendar_type;
    public $Sorter_calendar_view;
//End Variables

//Class_Initialize Event @2-04B34DA1
    function clsEditableGridCalendar_CalendarsCalendars($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid Calendars/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "Calendars";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["calendar_id"][0] = "calendar_id";
        $this->DataSource = new clsCalendar_CalendarsCalendarsDataSource($this);
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

        $this->SorterName = CCGetParam("CalendarsOrder", "");
        $this->SorterDirection = CCGetParam("CalendarsDir", "");

        $this->FooterPanel = new clsPanel("FooterPanel", $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->ActionPanel = new clsPanel("ActionPanel", $this);
        $this->action = new clsControl(ccsListBox, "action", "action", ccsText, "", NULL, $this);
        $this->action->DSType = dsListOfValues;
        $this->action->Values = array(array("delete", $CCSLocales->GetText("CCS_Delete")));
        $this->Button_Submit = new clsButton("Button_Submit", $Method, $this);
        $this->HeaderPanel = new clsPanel("HeaderPanel", $this);
        $this->Sorter_calendar_name = new clsSorter($this->ComponentName, "Sorter_calendar_name", $FileName, $this);
        $this->Sorter_calendar_type = new clsSorter($this->ComponentName, "Sorter_calendar_type", $FileName, $this);
        $this->Header_ColumnAction = new clsPanel("Header_ColumnAction", $this);
        $this->CheckBox_SelectAll = new clsControl(ccsCheckBox, "CheckBox_SelectAll", "CheckBox_SelectAll", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->CheckBox_SelectAll->CheckedValue = true;
        $this->CheckBox_SelectAll->UncheckedValue = false;
        $this->Sorter_calendar_view = new clsSorter($this->ComponentName, "Sorter_calendar_view", $FileName, $this);
        $this->TotalRecordsPanel = new clsPanel("TotalRecordsPanel", $this);
        $this->TotalRecords = new clsControl(ccsLabel, "TotalRecords", "TotalRecords", ccsText, "", NULL, $this);
        $this->Button_Add = new clsButton("Button_Add", $Method, $this);
        $this->Data_ColumnAction = new clsPanel("Data_ColumnAction", $this);
        $this->calendar_id = new clsControl(ccsHidden, "calendar_id", "calendar_id", ccsText, "", NULL, $this);
        $this->CheckBox_Delete = new clsControl(ccsCheckBox, "CheckBox_Delete", "CheckBox_Delete", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->CheckBox_Delete->CheckedValue = true;
        $this->CheckBox_Delete->UncheckedValue = false;
        $this->calendar_name = new clsControl(ccsLink, "calendar_name", $CCSLocales->GetText("calendar_name"), ccsText, "", NULL, $this);
        $this->calendar_name->Page = "";
        $this->calendar_type = new clsControl(ccsLabel, "calendar_type", $CCSLocales->GetText("calendar_type"), ccsText, "", NULL, $this);
        $this->calendar_view = new clsControl(ccsLabel, "calendar_view", "calendar_view", ccsText, "", NULL, $this);
        $this->FooterPanel->AddComponent("Navigator", $this->Navigator);
        $this->FooterPanel->AddComponent("ActionPanel", $this->ActionPanel);
        $this->ActionPanel->AddComponent("action", $this->action);
        $this->ActionPanel->AddComponent("Button_Submit", $this->Button_Submit);
        $this->HeaderPanel->AddComponent("Sorter_calendar_name", $this->Sorter_calendar_name);
        $this->HeaderPanel->AddComponent("Sorter_calendar_type", $this->Sorter_calendar_type);
        $this->HeaderPanel->AddComponent("Sorter_calendar_view", $this->Sorter_calendar_view);
        $this->HeaderPanel->AddComponent("Header_ColumnAction", $this->Header_ColumnAction);
        $this->Header_ColumnAction->AddComponent("CheckBox_SelectAll", $this->CheckBox_SelectAll);
        $this->TotalRecordsPanel->AddComponent("TotalRecords", $this->TotalRecords);
        $this->Data_ColumnAction->AddComponent("calendar_id", $this->calendar_id);
        $this->Data_ColumnAction->AddComponent("CheckBox_Delete", $this->CheckBox_Delete);
    }
//End Class_Initialize Event

//Initialize Method @2-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

    }
//End Initialize Method

//SetPrimaryKeys Method @2-EBC3F86C
    function SetPrimaryKeys($PrimaryKeys) {
        $this->PrimaryKeys = $PrimaryKeys;
        return $this->PrimaryKeys;
    }
//End SetPrimaryKeys Method

//GetPrimaryKeys Method @2-74F9A772
    function GetPrimaryKeys() {
        return $this->PrimaryKeys;
    }
//End GetPrimaryKeys Method

//GetFormParameters Method @2-CA5C5305
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["calendar_id"][$RowNumber] = CCGetFromPost("calendar_id_" . $RowNumber, NULL);
            $this->FormParameters["CheckBox_Delete"][$RowNumber] = CCGetFromPost("CheckBox_Delete_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @2-F805CEAB
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["calendar_id"] = $this->CachedColumns["calendar_id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->calendar_id->SetText($this->FormParameters["calendar_id"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
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

//ValidateRow Method @2-2C88E8DD
    function ValidateRow()
    {
        global $CCSLocales;
        $this->calendar_id->Validate();
        $this->CheckBox_Delete->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->calendar_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CheckBox_Delete->Errors->ToString());
        $this->calendar_id->Errors->Clear();
        $this->CheckBox_Delete->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @2-B221306E
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["calendar_id"][$this->RowNumber]) && count($this->FormParameters["calendar_id"][$this->RowNumber])) || strlen($this->FormParameters["calendar_id"][$this->RowNumber]));
        return $filed;
    }
//End CheckInsert Method

//CheckErrors Method @2-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @2-436B16A5
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
        } else if($this->Button_Add->Pressed) {
            $this->PressedButton = "Button_Add";
        }

        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Submit") {
            if(!CCGetEvent($this->Button_Submit->CCSEvents, "OnClick", $this->Button_Submit) || !$this->UpdateGrid()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Add") {
            if(!CCGetEvent($this->Button_Add->CCSEvents, "OnClick", $this->Button_Add)) {
                $Redirect = "";
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//UpdateGrid Method @2-72AF1FED
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["calendar_id"] = $this->CachedColumns["calendar_id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->calendar_id->SetText($this->FormParameters["calendar_id"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
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

//DeleteRow Method @2-A4A656F6
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

//FormScript Method @2-37DC2512
    function FormScript($TotalRows)
    {
        $script = "";
        $script .= "\n<script language=\"JavaScript\" type=\"text/javascript\">\n<!--\n";
        $script .= "var CalendarsElements;\n";
        $script .= "var CalendarsEmptyRows = 0;\n";
        $script .= "var " . $this->ComponentName . "calendar_idID = 0;\n";
        $script .= "var " . $this->ComponentName . "DeleteControl = 1;\n";
        $script .= "\nfunction initCalendarsElements() {\n";
        $script .= "\tvar ED = document.forms[\"Calendars\"];\n";
        $script .= "\tCalendarsElements = new Array (\n";
        for($i = 1; $i <= $TotalRows; $i++) {
            $script .= "\t\tnew Array(" . "ED.calendar_id_" . $i . ", " . "ED.CheckBox_Delete_" . $i . ")";
            if($i != $TotalRows) $script .= ",\n";
        }
        $script .= ");\n";
        $script .= "}\n";
        $script .= "\n//-->\n</script>";
        return $script;
    }
//End FormScript Method

//SetFormState Method @2-E71F643D
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
                $this->CachedColumns["calendar_id"][$RowNumber] = $piece;
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $this->CachedColumns["calendar_id"][$RowNumber] = "";
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @2-E022D759
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["calendar_id"][$i]));
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @2-8BD9224E
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
        $this->ControlsVisible["Data_ColumnAction"] = $this->Data_ColumnAction->Visible;
        $this->ControlsVisible["calendar_id"] = $this->calendar_id->Visible;
        $this->ControlsVisible["CheckBox_Delete"] = $this->CheckBox_Delete->Visible;
        $this->ControlsVisible["calendar_name"] = $this->calendar_name->Visible;
        $this->ControlsVisible["calendar_type"] = $this->calendar_type->Visible;
        $this->ControlsVisible["calendar_view"] = $this->calendar_view->Visible;
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
                    $this->CachedColumns["calendar_id"][$this->RowNumber] = $this->DataSource->CachedColumns["calendar_id"];
                    $this->CheckBox_Delete->SetValue("");
                    $this->calendar_id->SetValue($this->DataSource->calendar_id->GetValue());
                    $this->calendar_name->SetValue($this->DataSource->calendar_name->GetValue());
                    $this->calendar_name->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                    $this->calendar_name->Parameters = CCAddParam($this->calendar_name->Parameters, "action", "AddEdit");
                    $this->calendar_name->Parameters = CCAddParam($this->calendar_name->Parameters, "id", $this->DataSource->f("calendar_id"));
                    $this->calendar_type->SetValue($this->DataSource->calendar_type->GetValue());
                    $this->calendar_view->SetValue($this->DataSource->calendar_view->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->calendar_name->SetText("");
                    $this->calendar_type->SetText("");
                    $this->calendar_view->SetText("");
                    $this->calendar_name->SetValue($this->DataSource->calendar_name->GetValue());
                    $this->calendar_name->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                    $this->calendar_name->Parameters = CCAddParam($this->calendar_name->Parameters, "action", "AddEdit");
                    $this->calendar_name->Parameters = CCAddParam($this->calendar_name->Parameters, "id", $this->DataSource->f("calendar_id"));
                    $this->calendar_type->SetValue($this->DataSource->calendar_type->GetValue());
                    $this->calendar_view->SetValue($this->DataSource->calendar_view->GetValue());
                    $this->calendar_id->SetText($this->FormParameters["calendar_id"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                    $this->calendar_name->Parameters = CCAddParam($this->calendar_name->Parameters, "action", "AddEdit");
                    $this->calendar_name->Parameters = CCAddParam($this->calendar_name->Parameters, "id", $this->DataSource->f("calendar_id"));
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["calendar_id"][$this->RowNumber] = "";
                    $this->calendar_id->SetText("");
                    $this->calendar_name->SetText("");
                    $this->calendar_type->SetText("");
                    $this->calendar_view->SetText("");
                    $this->calendar_name->Parameters = CCAddParam($this->calendar_name->Parameters, "action", "AddEdit");
                    $this->calendar_name->Parameters = CCAddParam($this->calendar_name->Parameters, "id", $this->DataSource->f("calendar_id"));
                } else {
                    $this->calendar_name->SetText("");
                    $this->calendar_type->SetText("");
                    $this->calendar_view->SetText("");
                    $this->calendar_id->SetText($this->FormParameters["calendar_id"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                    $this->calendar_name->Parameters = CCAddParam($this->calendar_name->Parameters, "action", "AddEdit");
                    $this->calendar_name->Parameters = CCAddParam($this->calendar_name->Parameters, "id", $this->DataSource->f("calendar_id"));
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->Data_ColumnAction->Show($this->RowNumber);
                $this->calendar_name->Show($this->RowNumber);
                $this->calendar_type->Show($this->RowNumber);
                $this->calendar_view->Show($this->RowNumber);
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
                        if (($this->DataSource->CachedColumns["calendar_id"] == $this->CachedColumns["calendar_id"][$this->RowNumber])) {
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
        $this->FooterPanel->Show();
        $this->HeaderPanel->Show();
        $this->TotalRecordsPanel->Show();
        $this->Button_Add->Show();

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

} //End Calendars Class @2-FCB6E20C

class clsCalendar_CalendarsCalendarsDataSource extends clsDBConnection1 {  //CalendarsDataSource Class @2-53DE9ECA

//DataSource Variables @2-C7520CB7
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
    public $calendar_id;
    public $CheckBox_Delete;
    public $calendar_name;
    public $calendar_type;
    public $calendar_view;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-E803B589
    function clsCalendar_CalendarsCalendarsDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid Calendars/Error";
        $this->Initialize();
        $this->calendar_id = new clsField("calendar_id", ccsText, "");
        
        $this->CheckBox_Delete = new clsField("CheckBox_Delete", ccsBoolean, $this->BooleanFormat);
        
        $this->calendar_name = new clsField("calendar_name", ccsText, "");
        
        $this->calendar_type = new clsField("calendar_type", ccsText, "");
        
        $this->calendar_view = new clsField("calendar_view", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-BFA0F6F3
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_calendar_name" => array("calendar_name", ""), 
            "Sorter_calendar_type" => array("calendar_type", ""), 
            "Sorter_calendar_view" => array("calendar_view", "")));
    }
//End SetOrder Method

//Prepare Method @2-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @2-979566CC
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM tbl_calendars";
        $this->SQL = "SELECT * \n\n" .
        "FROM tbl_calendars {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-C77592CD
    function SetValues()
    {
        $this->CachedColumns["calendar_id"] = $this->f("calendar_id");
        $this->calendar_id->SetDBValue($this->f("calendar_id"));
        $this->calendar_name->SetDBValue($this->f("calendar_name"));
        $this->calendar_type->SetDBValue($this->f("calendar_type"));
        $this->calendar_view->SetDBValue($this->f("calendar_view"));
    }
//End SetValues Method

//Delete Method @2-9F16C025
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "calendar_id=" . $this->ToSQL($this->CachedColumns["calendar_id"], ccsInteger);
        $this->SQL = "DELETE FROM tbl_calendars";
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
        $this->Where = $SelectWhere;
    }
//End Delete Method

} //End CalendarsDataSource Class @2-FCB6E20C

class clsRecordCalendar_CalendarsCalendarAddEdit { //CalendarAddEdit Class @27-7D3F7055

//Variables @27-9E315808

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

//Class_Initialize Event @27-B6485525
    function clsRecordCalendar_CalendarsCalendarAddEdit($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record CalendarAddEdit/Error";
        $this->DataSource = new clsCalendar_CalendarsCalendarAddEditDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "CalendarAddEdit";
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
            $this->calendar_name = new clsControl(ccsTextBox, "calendar_name", $CCSLocales->GetText("calendar_name"), ccsText, "", CCGetRequestParam("calendar_name", $Method, NULL), $this);
            $this->calendar_type = new clsControl(ccsRadioButton, "calendar_type", "calendar_type", ccsText, "", CCGetRequestParam("calendar_type", $Method, NULL), $this);
            $this->calendar_type->DSType = dsListOfValues;
            $this->calendar_type->Values = array(array("Events", "Events"), array("Reservations", "Reservations"));
            $this->calendar_type->HTML = true;
            $this->AddEditLabel = new clsControl(ccsLabel, "AddEditLabel", "AddEditLabel", ccsText, "", CCGetRequestParam("AddEditLabel", $Method, NULL), $this);
            $this->calendar_view = new clsControl(ccsRadioButton, "calendar_view", "calendar_view", ccsText, "", CCGetRequestParam("calendar_view", $Method, NULL), $this);
            $this->calendar_view->DSType = dsListOfValues;
            $this->calendar_view->Values = array(array("Public", "Public"), array("Private", "Private"));
            $this->calendar_view->HTML = true;
            $this->Lsb_Available = new clsControl(ccsListBox, "Lsb_Available", "Lsb_Available", ccsInteger, "", CCGetRequestParam("Lsb_Available", $Method, NULL), $this);
            $this->Lsb_Available->Multiple = true;
            $this->Lsb_Available->DSType = dsTable;
            $this->Lsb_Available->DataSource = new clsDBConnection1();
            $this->Lsb_Available->ds = & $this->Lsb_Available->DataSource;
            $this->Lsb_Available->DataSource->SQL = "SELECT CONCAT(first_name, ' ', last_name) AS UserName, user_id \n" .
"FROM tbl_users {SQL_Where} {SQL_OrderBy}";
            list($this->Lsb_Available->BoundColumn, $this->Lsb_Available->TextColumn, $this->Lsb_Available->DBFormat) = array("user_id", "UserName", "");
            $this->Lsb_Available->DataSource->Parameters["expr71"] = 2;
            $this->Lsb_Available->DataSource->wp = new clsSQLParameters();
            $this->Lsb_Available->DataSource->wp->AddParameter("1", "expr71", ccsInteger, "", "", $this->Lsb_Available->DataSource->Parameters["expr71"], "", false);
            $this->Lsb_Available->DataSource->wp->Criterion[1] = $this->Lsb_Available->DataSource->wp->Operation(opGreaterThan, "group_id", $this->Lsb_Available->DataSource->wp->GetDBValue("1"), $this->Lsb_Available->DataSource->ToSQL($this->Lsb_Available->DataSource->wp->GetDBValue("1"), ccsInteger),false);
            $this->Lsb_Available->DataSource->Where = 
                 $this->Lsb_Available->DataSource->wp->Criterion[1];
            $this->Lsb_Assigned = new clsControl(ccsListBox, "Lsb_Assigned", "Lsb_Assigned", ccsInteger, "", CCGetRequestParam("Lsb_Assigned", $Method, NULL), $this);
            $this->Lsb_Assigned->Multiple = true;
            $this->Lsb_Assigned->DSType = dsTable;
            $this->Lsb_Assigned->DataSource = new clsDBConnection1();
            $this->Lsb_Assigned->ds = & $this->Lsb_Assigned->DataSource;
            $this->Lsb_Assigned->DataSource->SQL = "SELECT calendar_id, tbl_calendars_private_users.user_id AS tbl_calendars_private_users_user_id, CONCAT(first_name,' ',last_name) AS UserName \n" .
"FROM tbl_calendars_private_users INNER JOIN tbl_users ON\n" .
"tbl_calendars_private_users.user_id = tbl_users.user_id {SQL_Where} {SQL_OrderBy}";
            $this->Lsb_Assigned->DataSource->Order = "tbl_calendars_private_users.user_id";
            list($this->Lsb_Assigned->BoundColumn, $this->Lsb_Assigned->TextColumn, $this->Lsb_Assigned->DBFormat) = array("tbl_calendars_private_users_user_id", "UserName", "");
            $this->Lsb_Assigned->DataSource->Parameters["urlid"] = CCGetFromGet("id", NULL);
            $this->Lsb_Assigned->DataSource->Parameters["expr98"] = 2;
            $this->Lsb_Assigned->DataSource->wp = new clsSQLParameters();
            $this->Lsb_Assigned->DataSource->wp->AddParameter("1", "urlid", ccsInteger, "", "", $this->Lsb_Assigned->DataSource->Parameters["urlid"], -1, false);
            $this->Lsb_Assigned->DataSource->wp->AddParameter("2", "expr98", ccsInteger, "", "", $this->Lsb_Assigned->DataSource->Parameters["expr98"], "", false);
            $this->Lsb_Assigned->DataSource->wp->Criterion[1] = $this->Lsb_Assigned->DataSource->wp->Operation(opEqual, "tbl_calendars_private_users.calendar_id", $this->Lsb_Assigned->DataSource->wp->GetDBValue("1"), $this->Lsb_Assigned->DataSource->ToSQL($this->Lsb_Assigned->DataSource->wp->GetDBValue("1"), ccsInteger),false);
            $this->Lsb_Assigned->DataSource->wp->Criterion[2] = $this->Lsb_Assigned->DataSource->wp->Operation(opGreaterThan, "tbl_users.group_id", $this->Lsb_Assigned->DataSource->wp->GetDBValue("2"), $this->Lsb_Assigned->DataSource->ToSQL($this->Lsb_Assigned->DataSource->wp->GetDBValue("2"), ccsInteger),false);
            $this->Lsb_Assigned->DataSource->Where = $this->Lsb_Assigned->DataSource->wp->opAND(
                 false, 
                 $this->Lsb_Assigned->DataSource->wp->Criterion[1], 
                 $this->Lsb_Assigned->DataSource->wp->Criterion[2]);
            $this->Lsb_Assigned->DataSource->Order = "tbl_calendars_private_users.user_id";
            $this->Button_Right = new clsButton("Button_Right", $Method, $this);
            $this->Button_Left = new clsButton("Button_Left", $Method, $this);
            $this->LinkedID = new clsControl(ccsHidden, "LinkedID", "LinkedID", ccsText, "", CCGetRequestParam("LinkedID", $Method, NULL), $this);
            $this->calendar_default = new clsControl(ccsCheckBox, "calendar_default", "calendar_default", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), CCGetRequestParam("calendar_default", $Method, NULL), $this);
            $this->calendar_default->CheckedValue = true;
            $this->calendar_default->UncheckedValue = false;
        }
    }
//End Class_Initialize Event

//Initialize Method @27-2832F4DC
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlid"] = CCGetFromGet("id", NULL);
    }
//End Initialize Method

//Validate Method @27-A1905959
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->calendar_name->Validate() && $Validation);
        $Validation = ($this->calendar_type->Validate() && $Validation);
        $Validation = ($this->calendar_view->Validate() && $Validation);
        $Validation = ($this->Lsb_Available->Validate() && $Validation);
        $Validation = ($this->Lsb_Assigned->Validate() && $Validation);
        $Validation = ($this->LinkedID->Validate() && $Validation);
        $Validation = ($this->calendar_default->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->calendar_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->calendar_type->Errors->Count() == 0);
        $Validation =  $Validation && ($this->calendar_view->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Lsb_Available->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Lsb_Assigned->Errors->Count() == 0);
        $Validation =  $Validation && ($this->LinkedID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->calendar_default->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @27-13EED801
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->calendar_name->Errors->Count());
        $errors = ($errors || $this->calendar_type->Errors->Count());
        $errors = ($errors || $this->AddEditLabel->Errors->Count());
        $errors = ($errors || $this->calendar_view->Errors->Count());
        $errors = ($errors || $this->Lsb_Available->Errors->Count());
        $errors = ($errors || $this->Lsb_Assigned->Errors->Count());
        $errors = ($errors || $this->LinkedID->Errors->Count());
        $errors = ($errors || $this->calendar_default->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @27-ED598703
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

//Operation Method @27-D2AF0818
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
            } else if($this->Button_Right->Pressed) {
                $this->PressedButton = "Button_Right";
            } else if($this->Button_Left->Pressed) {
                $this->PressedButton = "Button_Left";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "action", "id"));
        if($this->PressedButton == "Button_Delete") {
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "action", "id", "action", "id"));
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Right") {
            if(!CCGetEvent($this->Button_Right->CCSEvents, "OnClick", $this->Button_Right)) {
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
            } else if($this->PressedButton == "Button_Left") {
                if(!CCGetEvent($this->Button_Left->CCSEvents, "OnClick", $this->Button_Left)) {
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

//InsertRow Method @27-464954C6
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->calendar_name->SetValue($this->calendar_name->GetValue(true));
        $this->DataSource->calendar_type->SetValue($this->calendar_type->GetValue(true));
        $this->DataSource->AddEditLabel->SetValue($this->AddEditLabel->GetValue(true));
        $this->DataSource->calendar_view->SetValue($this->calendar_view->GetValue(true));
        $this->DataSource->LinkedID->SetValue($this->LinkedID->GetValue(true));
        $this->DataSource->calendar_default->SetValue($this->calendar_default->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @27-5BFDE453
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->calendar_name->SetValue($this->calendar_name->GetValue(true));
        $this->DataSource->calendar_type->SetValue($this->calendar_type->GetValue(true));
        $this->DataSource->AddEditLabel->SetValue($this->AddEditLabel->GetValue(true));
        $this->DataSource->calendar_view->SetValue($this->calendar_view->GetValue(true));
        $this->DataSource->LinkedID->SetValue($this->LinkedID->GetValue(true));
        $this->DataSource->calendar_default->SetValue($this->calendar_default->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @27-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @27-0327FB76
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

        $this->calendar_type->Prepare();
        $this->calendar_view->Prepare();
        $this->Lsb_Available->Prepare();
        $this->Lsb_Assigned->Prepare();

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
                    $this->calendar_name->SetValue($this->DataSource->calendar_name->GetValue());
                    $this->calendar_type->SetValue($this->DataSource->calendar_type->GetValue());
                    $this->calendar_view->SetValue($this->DataSource->calendar_view->GetValue());
                    $this->calendar_default->SetValue($this->DataSource->calendar_default->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->calendar_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->calendar_type->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddEditLabel->Errors->ToString());
            $Error = ComposeStrings($Error, $this->calendar_view->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Lsb_Available->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Lsb_Assigned->Errors->ToString());
            $Error = ComposeStrings($Error, $this->LinkedID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->calendar_default->Errors->ToString());
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
        $this->calendar_name->Show();
        $this->calendar_type->Show();
        $this->AddEditLabel->Show();
        $this->calendar_view->Show();
        $this->Lsb_Available->Show();
        $this->Lsb_Assigned->Show();
        $this->Button_Right->Show();
        $this->Button_Left->Show();
        $this->LinkedID->Show();
        $this->calendar_default->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End CalendarAddEdit Class @27-FCB6E20C

class clsCalendar_CalendarsCalendarAddEditDataSource extends clsDBConnection1 {  //CalendarAddEditDataSource Class @27-E7111078

//DataSource Variables @27-EC1182DE
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
    public $calendar_name;
    public $calendar_type;
    public $AddEditLabel;
    public $calendar_view;
    public $Lsb_Available;
    public $Lsb_Assigned;
    public $LinkedID;
    public $calendar_default;
//End DataSource Variables

//DataSourceClass_Initialize Event @27-45AB8241
    function clsCalendar_CalendarsCalendarAddEditDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record CalendarAddEdit/Error";
        $this->Initialize();
        $this->calendar_name = new clsField("calendar_name", ccsText, "");
        
        $this->calendar_type = new clsField("calendar_type", ccsText, "");
        
        $this->AddEditLabel = new clsField("AddEditLabel", ccsText, "");
        
        $this->calendar_view = new clsField("calendar_view", ccsText, "");
        
        $this->Lsb_Available = new clsField("Lsb_Available", ccsInteger, "");
        
        $this->Lsb_Assigned = new clsField("Lsb_Assigned", ccsInteger, "");
        
        $this->LinkedID = new clsField("LinkedID", ccsText, "");
        
        $this->calendar_default = new clsField("calendar_default", ccsBoolean, $this->BooleanFormat);
        

        $this->InsertFields["calendar_name"] = array("Name" => "calendar_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["calendar_type"] = array("Name" => "calendar_type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["calendar_view"] = array("Name" => "calendar_view", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["calendar_default"] = array("Name" => "calendar_default", "Value" => "", "DataType" => ccsBoolean);
        $this->UpdateFields["calendar_name"] = array("Name" => "calendar_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["calendar_type"] = array("Name" => "calendar_type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["calendar_view"] = array("Name" => "calendar_view", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["calendar_default"] = array("Name" => "calendar_default", "Value" => "", "DataType" => ccsBoolean);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @27-F0BBA31E
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlid", ccsInteger, "", "", $this->Parameters["urlid"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "calendar_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @27-8268D591
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tbl_calendars {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @27-C6BAA042
    function SetValues()
    {
        $this->calendar_name->SetDBValue($this->f("calendar_name"));
        $this->calendar_type->SetDBValue($this->f("calendar_type"));
        $this->calendar_view->SetDBValue($this->f("calendar_view"));
        $this->calendar_default->SetDBValue(trim($this->f("calendar_default")));
    }
//End SetValues Method

//Insert Method @27-A97D3042
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["calendar_name"]["Value"] = $this->calendar_name->GetDBValue(true);
        $this->InsertFields["calendar_type"]["Value"] = $this->calendar_type->GetDBValue(true);
        $this->InsertFields["calendar_view"]["Value"] = $this->calendar_view->GetDBValue(true);
        $this->InsertFields["calendar_default"]["Value"] = $this->calendar_default->GetDBValue(true);
        $this->SQL = CCBuildInsert("tbl_calendars", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @27-D0CB763B
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["calendar_name"]["Value"] = $this->calendar_name->GetDBValue(true);
        $this->UpdateFields["calendar_type"]["Value"] = $this->calendar_type->GetDBValue(true);
        $this->UpdateFields["calendar_view"]["Value"] = $this->calendar_view->GetDBValue(true);
        $this->UpdateFields["calendar_default"]["Value"] = $this->calendar_default->GetDBValue(true);
        $this->SQL = CCBuildUpdate("tbl_calendars", $this->UpdateFields, $this);
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

//Delete Method @27-4C8B4EC2
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM tbl_calendars";
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

} //End CalendarAddEditDataSource Class @27-FCB6E20C

class clsCalendar_Calendars { //Calendar_Calendars class @1-4DCC41C1

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

//Class_Initialize Event @1-119FE2E9
    function clsCalendar_Calendars($RelativePath, $ComponentName, & $Parent)
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = $ComponentName;
        $this->RelativePath = $RelativePath;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->FileName = "Calendar_Calendars.php";
        $this->Redirect = "";
        $this->TemplateFileName = "Calendar_Calendars.html";
        $this->BlockToParse = "main";
        $this->TemplateEncoding = "UTF-8";
        $this->ContentType = "text/html";
    }
//End Class_Initialize Event

//Class_Terminate Event @1-1B0DA6B4
    function Class_Terminate()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
        unset($this->Calendars);
        unset($this->CalendarAddEdit);
    }
//End Class_Terminate Event

//BindEvents Method @1-3D9ED987
    function BindEvents()
    {
        $this->Calendars->Button_Submit->CCSEvents["OnClick"] = "Calendar_Calendars_Calendars_Button_Submit_OnClick";
        $this->Calendars->TotalRecords->CCSEvents["BeforeShow"] = "Calendar_Calendars_Calendars_TotalRecords_BeforeShow";
        $this->Calendars->Button_Add->CCSEvents["OnClick"] = "Calendar_Calendars_Calendars_Button_Add_OnClick";
        $this->Calendars->Button_Add->CCSEvents["BeforeShow"] = "Calendar_Calendars_Calendars_Button_Add_BeforeShow";
        $this->Calendars->calendar_name->CCSEvents["BeforeShow"] = "Calendar_Calendars_Calendars_calendar_name_BeforeShow";
        $this->Calendars->CCSEvents["BeforeShow"] = "Calendar_Calendars_Calendars_BeforeShow";
        $this->CalendarAddEdit->calendar_name->CCSEvents["OnValidate"] = "Calendar_Calendars_CalendarAddEdit_calendar_name_OnValidate";
        $this->CalendarAddEdit->calendar_type->CCSEvents["OnValidate"] = "Calendar_Calendars_CalendarAddEdit_calendar_type_OnValidate";
        $this->CalendarAddEdit->AddEditLabel->CCSEvents["BeforeShow"] = "Calendar_Calendars_CalendarAddEdit_AddEditLabel_BeforeShow";
        $this->CalendarAddEdit->calendar_view->CCSEvents["OnValidate"] = "Calendar_Calendars_CalendarAddEdit_calendar_view_OnValidate";
        $this->CalendarAddEdit->Lsb_Available->ds->CCSEvents["BeforeBuildSelect"] = "Calendar_Calendars_CalendarAddEdit_Lsb_Available_ds_BeforeBuildSelect";
        $this->CalendarAddEdit->LinkedID->CCSEvents["BeforeShow"] = "Calendar_Calendars_CalendarAddEdit_LinkedID_BeforeShow";
        $this->CalendarAddEdit->CCSEvents["BeforeUpdate"] = "Calendar_Calendars_CalendarAddEdit_BeforeUpdate";
        $this->CalendarAddEdit->CCSEvents["BeforeInsert"] = "Calendar_Calendars_CalendarAddEdit_BeforeInsert";
        $this->CalendarAddEdit->CCSEvents["OnValidate"] = "Calendar_Calendars_CalendarAddEdit_OnValidate";
        $this->CalendarAddEdit->CCSEvents["BeforeShow"] = "Calendar_Calendars_CalendarAddEdit_BeforeShow";
        $this->CalendarAddEdit->CCSEvents["AfterUpdate"] = "Calendar_Calendars_CalendarAddEdit_AfterUpdate";
        $this->CalendarAddEdit->CCSEvents["AfterInsert"] = "Calendar_Calendars_CalendarAddEdit_AfterInsert";
        $this->CalendarAddEdit->CCSEvents["BeforeDelete"] = "Calendar_Calendars_CalendarAddEdit_BeforeDelete";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInitialize", $this);
    }
//End BindEvents Method

//Operations Method @1-636A93DA
    function Operations()
    {
        global $Redirect;
        if(!$this->Visible)
            return "";
        $this->Calendars->Operation();
        $this->CalendarAddEdit->Operation();
    }
//End Operations Method

//Initialize Method @1-073BB2E3
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
        $this->Calendars = new clsEditableGridCalendar_CalendarsCalendars($this->RelativePath, $this);
        $this->CalendarAddEdit = new clsRecordCalendar_CalendarsCalendarAddEdit($this->RelativePath, $this);
        $this->Calendars->Initialize();
        $this->CalendarAddEdit->Initialize();
        $this->BindEvents();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
    }
//End Initialize Method

//Show Method @1-66D033F1
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
        $this->Calendars->Show();
        $this->CalendarAddEdit->Show();
        $Tpl->Parse();
        $Tpl->block_path = $block_path;
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
        $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
    }
//End Show Method

} //End Calendar_Calendars Class @1-FCB6E20C

//Include Event File @1-252012AA
include_once(RelativePath . "/Calendar/Calendar_Calendars_events.php");
//End Include Event File
?>