<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\Calendar" secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Menu id="2" secured="False" sourceType="Table" returnValueType="Number" name="CalendarMenu" menuType="Vertical" idField="menu_id" parentIdField="menu_parent_id" menuSourceType="Static" PathID="Calendar_MenuCalendarMenu">
			<Components>
				<Link id="3" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="None" name="ItemLink" PathID="Calendar_MenuCalendarMenuItemLink">
					<Components/>
					<Events>
					</Events>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Declare Variable" actionCategory="General" id="14" name="CCSLocales" initialValue="$CCSLocales"/>
						<Action actionName="Hide-Show Component" actionCategory="General" id="13" action="Hide" conditionType="Expression" dataType="Text" componentName="ItemLink" condition="$Component-&gt;ItemLink-&gt;GetValue() == $CCSLocales-&gt;GetText(&quot;CRM_Users&quot;) AND CCGetGroupID() &gt; 2"/>
						<Action actionName="Custom Code" actionCategory="General" id="15"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<MenuItems>
				<MenuItem id="16" name="MenuItem1" caption="{res:CRM_MyProfile}" target="_self"/>
<MenuItem id="17" name="MenuItem2" caption="{res:CRM_Calendars}" url="?p=Calendars" target="_self"/>
<MenuItem id="18" name="MenuItem3" caption="{res:CRM_CalendarItems}" url="?p=CalendarItems" target="_self"/>
<MenuItem id="19" name="MenuItem4" caption="{res:CRM_Users}" url="?p=Users" target="_self"/>
<MenuItem id="20" name="MenuItem5" caption="{res:CRM_Settings}" url="?p=Settings" target="_self"/>
</MenuItems>
			<Features/>
		</Menu>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="Calendar_Menu.php" forShow="True" url="Calendar_Menu.php" comment="//" codePage="utf-8"/>
		<CodeFile id="Events" language="PHPTemplates" name="Calendar_Menu_events.php" forShow="False" comment="//" codePage="utf-8"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
