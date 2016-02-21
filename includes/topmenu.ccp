<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\includes" secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="15 minutes" pasteActions="pasteActions" needGeneration="0" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0">
	<Components>
		<Menu id="17" secured="False" sourceType="Table" returnValueType="Number" name="TopMenu" menuType="Horizontal" menuSourceType="Static" PathID="topmenuTopMenu">
			<Components>
				<Link id="18" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ItemLink" PathID="topmenuTopMenuItemLink" removeParameters="p;Login">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="32"/>
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
				<MenuItem id="28" name="MenuItem1" caption="{res:CRM_YearView}" url="?m=Calendar&amp;v=Year" target="_self"/>
				<MenuItem id="29" name="MenuItem2" caption="{res:CRM_MonthView}" url="?m=Calendar&amp;v=Month" target="_self"/>
				<MenuItem id="30" name="MenuItem3" caption="{res:CRM_WeekView}" url="?m=Calendar&amp;v=Week" target="_self"/>
				<MenuItem id="31" name="MenuItem4" caption="{res:CRM_DayView}" url="?m=Calendar&amp;v=Day" target="_self"/>
			</MenuItems>
			<Features/>
		</Menu>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="topmenu.php" forShow="True" url="topmenu.php" comment="//" codePage="utf-8"/>
		<CodeFile id="Events" language="PHPTemplates" name="topmenu_events.php" forShow="False" comment="//" codePage="utf-8"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters>
		<CachingParameter id="27" name="UserID" sourceType="Session" target="Key"/>
	</CachingParameters>
	<Attributes>
	</Attributes>
	<Features/>
	<Events/>
</Page>
