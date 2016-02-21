<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\Calendar" secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Connection1" name="Settings" dataSource="tbl_config" errorSummator="Error" wizardCaption="{res:CCS_RecordFormPrefix} {res:tbl_config} {res:CCS_RecordFormSuffix}" wizardFormMethod="post" PathID="Calendar_SettingsSettings" activeCollection="TableParameters">
<Components>
<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="{res:CCS_Update}" PathID="Calendar_SettingsSettingsButton_Update">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Button>
<CheckBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="active" fieldSource="active" required="False" caption="{res:active}" wizardCaption="{res:active}" wizardSize="4" wizardMaxLength="4" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_SettingsSettingsactive" checkedValue="1" uncheckedValue="0">
<Components/>
<Events/>
<Attributes/>
<Features/>
</CheckBox>
<TextBox id="6" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="inactive_message" fieldSource="inactive_message" required="False" caption="{res:inactive_message}" wizardCaption="{res:inactive_message}" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_SettingsSettingsinactive_message">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<ListBox id="7" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" name="default_style" fieldSource="default_style" wizardCaption="{res:default_style}" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_SettingsSettingsdefault_style" sourceType="Table" connection="Connection1" dataSource="tbl_styles" boundColumn="style_name" textColumn="style_name" activeCollection="TableParameters">
<Components/>
<Events/>
<Attributes/>
<Features/>
<TableParameters>
<TableParameter id="14" conditionType="Parameter" useIsNull="False" field="site_id" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="&quot;www.codechargecalendar.com&quot;"/>
</TableParameters>
<SPParameters/>
<SQLParameters/>
<JoinTables>
<JoinTable id="13" tableName="tbl_styles" posLeft="10" posTop="10" posWidth="158" posHeight="180"/>
</JoinTables>
<JoinLinks/>
<Fields/>
</ListBox>
<ListBox id="8" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" name="default_locale" fieldSource="default_locale" wizardCaption="{res:default_locale}" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_SettingsSettingsdefault_locale" sourceType="Table" connection="Connection1" dataSource="lu_locales" boundColumn="locale" textColumn="description">
<Components/>
<Events/>
<Attributes/>
<Features/>
<TableParameters/>
<SPParameters/>
<SQLParameters/>
<JoinTables/>
<JoinLinks/>
<Fields/>
</ListBox>
<TextBox id="9" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="site_title" fieldSource="site_title" required="False" caption="{res:site_title}" wizardCaption="{res:site_title}" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_SettingsSettingssite_title">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<TextBox id="10" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="site_subtitle" fieldSource="site_subtitle" required="False" caption="{res:site_subtitle}" wizardCaption="{res:site_subtitle}" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_SettingsSettingssite_subtitle">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<ListBox id="11" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" name="default_calendar_view" fieldSource="default_calendar_view" wizardCaption="{res:default_calendar_view}" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_SettingsSettingsdefault_calendar_view" sourceType="ListOfValues" connection="Connection1" _valueOfList="Day" _nameOfList="Day" dataSource="Year;Year;Month;Month;Week;Week;Day;Day">
<Components/>
<Events/>
<Attributes/>
<Features/>
<TableParameters/>
<SPParameters/>
<SQLParameters/>
<JoinTables/>
<JoinLinks/>
<Fields/>
</ListBox>
</Components>
<Events>
<Event name="AfterUpdate" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="15"/>
</Actions>
</Event>
</Events>
<TableParameters>
<TableParameter id="4" conditionType="Parameter" useIsNull="False" field="site_id" dataType="Text" logicOperator="And" searchConditionType="Equal" parameterType="Expression" orderNumber="1" parameterSource="&quot;www.codechargecalendar.com&quot;"/>
</TableParameters>
<SPParameters/>
<SQLParameters/>
<JoinTables>
<JoinTable id="12" tableName="tbl_config" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
</JoinTables>
<JoinLinks/>
<Fields/>
<ISPParameters/>
<ISQLParameters/>
<IFormElements/>
<USPParameters/>
<USQLParameters/>
<UConditions/>
<UFormElements/>
<DSPParameters/>
<DSQLParameters/>
<DConditions/>
<SecurityGroups/>
<Attributes/>
<Features/>
</Record>
</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="Calendar_Settings.php" forShow="True" url="Calendar_Settings.php" comment="//" codePage="utf-8"/>
<CodeFile id="Events" language="PHPTemplates" name="Calendar_Settings_events.php" forShow="False" comment="//" codePage="utf-8"/>
</CodeFiles>
	<SecurityGroups/>
<CachingParameters/>
<Attributes/>
<Features/>
<Events/>
</Page>
