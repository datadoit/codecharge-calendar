<?php
//Include Common Files @1-82042FB9
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "index.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @2-F99F725C
include_once(RelativePath . "/includes/header.php");
//End Include Page implementation

//Include Page implementation @5-002718C4
include_once(RelativePath . "/includes/topmenu.php");
//End Include Page implementation

//Include Page implementation @9-0439E792
include_once(RelativePath . "/includes/leftcolumn.php");
//End Include Page implementation

//Include Page implementation @10-FF604A5A
include_once(RelativePath . "/includes/content.php");
//End Include Page implementation

//Include Page implementation @3-9C963C63
include_once(RelativePath . "/includes/footer.php");
//End Include Page implementation

//Initialize Page @1-B8BCB1F8
// Variables
$FileName = "";
$Redirect = "";
$Tpl = "";
$TemplateFileName = "";
$BlockToParse = "";
$ComponentName = "";
$Attributes = "";

// Events;
$CCSEvents = "";
$CCSEventResult = "";

$FileName = FileName;
$Redirect = "";
$TemplateFileName = "index.html";
$BlockToParse = "main";
$TemplateEncoding = "UTF-8";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "utf-8";
//End Initialize Page

//Include events file @1-B7D86394
include_once("./index_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-915319ED
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$header = new clsheader("includes/", "header", $MainPage);
$header->Initialize();
$topmenu = new clstopmenu("includes/", "topmenu", $MainPage);
$topmenu->Initialize();
$SiteTitle = new clsControl(ccsLabel, "SiteTitle", "SiteTitle", ccsText, "", CCGetRequestParam("SiteTitle", ccsGet, NULL), $MainPage);
$leftcolumn = new clsleftcolumn("includes/", "leftcolumn", $MainPage);
$leftcolumn->Initialize();
$content = new clscontent("includes/", "content", $MainPage);
$content->Initialize();
$footer = new clsfooter("includes/", "footer", $MainPage);
$footer->Initialize();
$MainPage->header = & $header;
$MainPage->topmenu = & $topmenu;
$MainPage->SiteTitle = & $SiteTitle;
$MainPage->leftcolumn = & $leftcolumn;
$MainPage->content = & $content;
$MainPage->footer = & $footer;

BindEvents();

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize", $MainPage);

if ($Charset) {
    header("Content-Type: " . $ContentType . "; charset=" . $Charset);
} else {
    header("Content-Type: " . $ContentType);
}
//End Initialize Objects

//Initialize HTML Template @1-A06E9207
$CCSEventResult = CCGetEvent($CCSEvents, "OnInitializeView", $MainPage);
$Tpl = new clsTemplate($FileEncoding, $TemplateEncoding);
$Tpl->LoadTemplate(PathToCurrentPage . $TemplateFileName, $BlockToParse, "UTF-8", "replace");
$Tpl->block_path = "/$BlockToParse";
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeShow", $MainPage);
$Attributes->SetValue("pathToRoot", "");
$Attributes->Show();
//End Initialize HTML Template

//Execute Components @1-39116884
$header->Operations();
$topmenu->Operations();
$leftcolumn->Operations();
$content->Operations();
$footer->Operations();
//End Execute Components

//Go to destination page @1-8925BF11
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    $header->Class_Terminate();
    unset($header);
    $topmenu->Class_Terminate();
    unset($topmenu);
    $leftcolumn->Class_Terminate();
    unset($leftcolumn);
    $content->Class_Terminate();
    unset($content);
    $footer->Class_Terminate();
    unset($footer);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-27EF76AB
$header->Show();
$topmenu->Show();
$leftcolumn->Show();
$content->Show();
$footer->Show();
$SiteTitle->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-EDB6BBE0
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
$header->Class_Terminate();
unset($header);
$topmenu->Class_Terminate();
unset($topmenu);
$leftcolumn->Class_Terminate();
unset($leftcolumn);
$content->Class_Terminate();
unset($content);
$footer->Class_Terminate();
unset($footer);
unset($Tpl);
//End Unload Page


?>
