<?php

class clsMenuCalendar_MenuCalendarMenu extends clsMenu { //CalendarMenu class @2-FA0C6D0C

//Class_Initialize Event @2-20C0BB13
    function clsMenuCalendar_MenuCalendarMenu($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "CalendarMenu";
        $this->Visible = True;
        $this->controls = array();
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->ErrorBlock = "Menu CalendarMenu";

        $this->StaticItems = array();
        $this->StaticItems[] = array("item_id" => "MenuItem1", "item_id_parent" => null, "item_caption" => $CCSLocales->GetText("CRM_MyProfile"), "item_url" => array("Page" => "", "Parameters" => null), "item_target" => "_self", "item_title" => $CCSLocales->GetText(""));
        $this->StaticItems[] = array("item_id" => "MenuItem2", "item_id_parent" => null, "item_caption" => $CCSLocales->GetText("CRM_Calendars"), "item_url" => array("Page" => "?", "Parameters" => array("p" => "Calendars")), "item_target" => "_self", "item_title" => $CCSLocales->GetText(""));
        $this->StaticItems[] = array("item_id" => "MenuItem3", "item_id_parent" => null, "item_caption" => $CCSLocales->GetText("CRM_CalendarItems"), "item_url" => array("Page" => "?", "Parameters" => array("p" => "CalendarItems")), "item_target" => "_self", "item_title" => $CCSLocales->GetText(""));
        $this->StaticItems[] = array("item_id" => "MenuItem4", "item_id_parent" => null, "item_caption" => $CCSLocales->GetText("CRM_Users"), "item_url" => array("Page" => "?", "Parameters" => array("p" => "Users")), "item_target" => "_self", "item_title" => $CCSLocales->GetText(""));
        $this->StaticItems[] = array("item_id" => "MenuItem5", "item_id_parent" => null, "item_caption" => $CCSLocales->GetText("CRM_Settings"), "item_url" => array("Page" => "?", "Parameters" => array("p" => "Settings")), "item_target" => "_self", "item_title" => $CCSLocales->GetText(""));

        $this->DataSource = new clsCalendar_MenuCalendarMenuDataSource($this);
        $this->ds = & $this->DataSource;
        $this->DataSource->SetProvider(array("DBLib" => "Array"));

        parent::clsMenu("item_id_parent", "item_id", null);

        $this->ItemLink = new clsControl(ccsLink, "ItemLink", "ItemLink", ccsText, "", CCGetRequestParam("ItemLink", ccsGet, NULL), $this);
        $this->controls["ItemLink"] = & $this->ItemLink;
        $this->ItemLink->Page = "";
        $this->LinkStartParameters = $this->ItemLink->Parameters;
    }
//End Class_Initialize Event

//SetControlValues Method @2-B7BF812B
    function SetControlValues() {
        $this->ItemLink->SetValue($this->DataSource->ItemLink->GetValue());
        $LinkUrl = $this->DataSource->f("item_url");
        $this->ItemLink->Page = $LinkUrl["Page"];
        $this->ItemLink->Parameters = $this->SetParamsFromDB($this->LinkStartParameters, $LinkUrl["Parameters"]);
    }
//End SetControlValues Method

//ShowAttributes @2-045A7B9A
    function ShowAttributes() {
        $this->Attributes->SetValue("MenuType", "menu_vlr");
        $this->Attributes->Show();
    }
//End ShowAttributes

} //End CalendarMenu Class @2-FCB6E20C

//Calendar_MenuCalendarMenuDataSource Class @2-913506AA
class clsCalendar_MenuCalendarMenuDataSource extends DB_Adapter {
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;
    var $wp;
    var $Record = array();
    var $Index;
    var $FieldsList = array();

    function clsCalendar_MenuCalendarMenuDataSource($parent) {
        $this->Parent = & $parent;
        $this->ErrorBlock = "Menu CalendarMenu";
        $this->ItemLink = new clsField("ItemLink", ccsText, "");
        $this->FieldsList["ItemLink"] = & $this->ItemLink;
    }

    function Prepare()
    {
    }

    function Open()
    {
        $this->query($this->Parent->StaticItems);
    }

    function SetValues()
    {
        $this->ItemLink->SetDBValue($this->f("item_caption"));
    }
}
//End Calendar_MenuCalendarMenuDataSource Class

class clsCalendar_Menu { //Calendar_Menu class @1-516E2236

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

//Class_Initialize Event @1-489186A8
    function clsCalendar_Menu($RelativePath, $ComponentName, & $Parent)
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = $ComponentName;
        $this->RelativePath = $RelativePath;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->FileName = "Calendar_Menu.php";
        $this->Redirect = "";
        $this->TemplateFileName = "Calendar_Menu.html";
        $this->BlockToParse = "main";
        $this->TemplateEncoding = "UTF-8";
        $this->ContentType = "text/html";
    }
//End Class_Initialize Event

//Class_Terminate Event @1-03BFDC3F
    function Class_Terminate()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
        unset($this->CalendarMenu);
    }
//End Class_Terminate Event

//BindEvents Method @1-4BBF75A6
    function BindEvents()
    {
        $this->CalendarMenu->CCSEvents["BeforeShowRow"] = "Calendar_Menu_CalendarMenu_BeforeShowRow";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInitialize", $this);
    }
//End BindEvents Method

//Operations Method @1-7E2A14CF
    function Operations()
    {
        global $Redirect;
        if(!$this->Visible)
            return "";
    }
//End Operations Method

//Initialize Method @1-93BD26B5
    function Initialize()
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInitialize", $this);
        if(!$this->Visible)
            return "";
        $this->Attributes = & $this->Parent->Attributes;

        // Create Components
        $this->CalendarMenu = new clsMenuCalendar_MenuCalendarMenu($this->RelativePath, $this);
        $this->BindEvents();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
    }
//End Initialize Method

//Show Method @1-53864CD2
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
        $this->CalendarMenu->Show();
        $Tpl->Parse();
        $Tpl->block_path = $block_path;
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
        $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
    }
//End Show Method

} //End Calendar_Menu Class @1-FCB6E20C

//Include Event File @1-A9E4CF6E
include_once(RelativePath . "/Calendar/Calendar_Menu_events.php");
//End Include Event File


?>