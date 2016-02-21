<?php

class clsMenutopmenuTopMenu extends clsMenu { //TopMenu class @17-C8DAA288

//Class_Initialize Event @17-DE45F468
    function clsMenutopmenuTopMenu($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "TopMenu";
        $this->Visible = True;
        $this->controls = array();
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->ErrorBlock = "Menu TopMenu";

        $this->StaticItems = array();
        $this->StaticItems[] = array("item_id" => "MenuItem1", "item_id_parent" => null, "item_caption" => $CCSLocales->GetText("CRM_YearView"), "item_url" => array("Page" => "?", "Parameters" => array("m" => "Calendar", "v" => "Year")), "item_target" => "_self", "item_title" => $CCSLocales->GetText(""));
        $this->StaticItems[] = array("item_id" => "MenuItem2", "item_id_parent" => null, "item_caption" => $CCSLocales->GetText("CRM_MonthView"), "item_url" => array("Page" => "?", "Parameters" => array("m" => "Calendar", "v" => "Month")), "item_target" => "_self", "item_title" => $CCSLocales->GetText(""));
        $this->StaticItems[] = array("item_id" => "MenuItem3", "item_id_parent" => null, "item_caption" => $CCSLocales->GetText("CRM_WeekView"), "item_url" => array("Page" => "?", "Parameters" => array("m" => "Calendar", "v" => "Week")), "item_target" => "_self", "item_title" => $CCSLocales->GetText(""));
        $this->StaticItems[] = array("item_id" => "MenuItem4", "item_id_parent" => null, "item_caption" => $CCSLocales->GetText("CRM_DayView"), "item_url" => array("Page" => "?", "Parameters" => array("m" => "Calendar", "v" => "Day")), "item_target" => "_self", "item_title" => $CCSLocales->GetText(""));

        $this->DataSource = new clstopmenuTopMenuDataSource($this);
        $this->ds = & $this->DataSource;
        $this->DataSource->SetProvider(array("DBLib" => "Array"));

        parent::clsMenu("item_id_parent", "item_id", null);

        $this->ItemLink = new clsControl(ccsLink, "ItemLink", "ItemLink", ccsText, "", CCGetRequestParam("ItemLink", ccsGet, NULL), $this);
        $this->controls["ItemLink"] = & $this->ItemLink;
        $this->ItemLink->Parameters = CCGetQueryString("QueryString", array("p", "Login", "ccsForm"));
        $this->ItemLink->Page = "";
        $this->LinkStartParameters = $this->ItemLink->Parameters;
    }
//End Class_Initialize Event

//SetControlValues Method @17-B7BF812B
    function SetControlValues() {
        $this->ItemLink->SetValue($this->DataSource->ItemLink->GetValue());
        $LinkUrl = $this->DataSource->f("item_url");
        $this->ItemLink->Page = $LinkUrl["Page"];
        $this->ItemLink->Parameters = $this->SetParamsFromDB($this->LinkStartParameters, $LinkUrl["Parameters"]);
    }
//End SetControlValues Method

//ShowAttributes @17-17684C76
    function ShowAttributes() {
        $this->Attributes->SetValue("MenuType", "menu_htb");
        $this->Attributes->Show();
    }
//End ShowAttributes

} //End TopMenu Class @17-FCB6E20C

//topmenuTopMenuDataSource Class @17-BF653400
class clstopmenuTopMenuDataSource extends DB_Adapter {
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;
    var $wp;
    var $Record = array();
    var $Index;
    var $FieldsList = array();

    function clstopmenuTopMenuDataSource($parent) {
        $this->Parent = & $parent;
        $this->ErrorBlock = "Menu TopMenu";
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
//End topmenuTopMenuDataSource Class

class clstopmenu { //topmenu class @1-914881A6

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

//Class_Initialize Event @1-6C865A8C
    function clstopmenu($RelativePath, $ComponentName, & $Parent)
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = $ComponentName;
        $this->RelativePath = $RelativePath;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->FileName = "topmenu.php";
        $this->Redirect = "";
        $this->TemplateFileName = "topmenu.html";
        $this->BlockToParse = "main";
        $this->TemplateEncoding = "UTF-8";
        $this->ContentType = "text/html";
    }
//End Class_Initialize Event

//Class_Terminate Event @1-16D22F85
    function Class_Terminate()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
        unset($this->TopMenu);
    }
//End Class_Terminate Event

//BindEvents Method @1-466C8CDA
    function BindEvents()
    {
        $this->TopMenu->CCSEvents["BeforeShowRow"] = "topmenu_TopMenu_BeforeShowRow";
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

//Initialize Method @1-9316CE3C
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
        $this->TopMenu = new clsMenutopmenuTopMenu($this->RelativePath, $this);
        $this->BindEvents();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
    }
//End Initialize Method

//Show Method @1-EA3E1C7A
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
        $this->TopMenu->Show();
        $Tpl->Parse();
        $Tpl->block_path = $block_path;
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
        $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
    }
//End Show Method

} //End topmenu Class @1-FCB6E20C

//Include Event File @1-B820A993
include_once(RelativePath . "/includes/topmenu_events.php");
//End Include Event File


?>
