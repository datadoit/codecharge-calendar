<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\includes" secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" pasteActions="pasteActions" needGeneration="0">
	<Components>
		<IncludePage id="2" name="login" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="contentlogin" page="login.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<IncludePage id="4" name="Calendar_YearView" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="contentCalendar_YearView" page="../Calendar/Calendar_YearView.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<IncludePage id="7" name="Calendar_MonthView" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="contentCalendar_MonthView" page="../Calendar/Calendar_MonthView.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<IncludePage id="10" name="Calendar_WeekView" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="contentCalendar_WeekView" page="../Calendar/Calendar_WeekView.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<IncludePage id="11" name="Calendar_DayView" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="contentCalendar_DayView" page="../Calendar/Calendar_DayView.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<IncludePage id="14" name="Calendar_Calendars" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="contentCalendar_Calendars" page="../Calendar/Calendar_Calendars.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<IncludePage id="16" name="Calendar_CalendarItems" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="contentCalendar_CalendarItems" page="../Calendar/Calendar_CalendarItems.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<IncludePage id="20" name="Calendar_Users" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="contentCalendar_Users" page="../Calendar/Calendar_Users.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<IncludePage id="21" name="Calendar_Settings" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="contentCalendar_Settings" page="../Calendar/Calendar_Settings.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="content.php" forShow="True" url="content.php" comment="//" codePage="utf-8"/>
		<CodeFile id="Events" language="PHPTemplates" name="content_events.php" forShow="False" comment="//" codePage="utf-8"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="BeforeShow" type="Server">
			<Actions>
				<Action actionName="Hide-Show Component" actionCategory="General" id="3" action="Hide" conditionType="Expression" dataType="Text" componentName="login" condition="CCGetParam(&quot;Login&quot;,&quot;&quot;) &lt;&gt; True"/>
				<Action actionName="Hide-Show Component" actionCategory="General" id="8" action="Hide" conditionType="Expression" dataType="Text" componentName="Calendar_YearView" condition="CCGetParam(&quot;m&quot;, &quot;&quot;) != &quot;Calendar&quot; OR CCGetParam(&quot;v&quot;, &quot;&quot;) != &quot;Year&quot;"/>
				<Action actionName="Hide-Show Component" actionCategory="General" id="9" action="Hide" conditionType="Expression" dataType="Text" componentName="Calendar_MonthView" condition="CCGetParam(&quot;m&quot;, &quot;&quot;) != &quot;Calendar&quot; OR CCGetParam(&quot;v&quot;, &quot;&quot;) != &quot;Month&quot;"/>
				<Action actionName="Hide-Show Component" actionCategory="General" id="12" action="Hide" conditionType="Expression" dataType="Text" componentName="Calendar_WeekView" condition="CCGetParam(&quot;m&quot;, &quot;&quot;) != &quot;Calendar&quot; OR CCGetParam(&quot;v&quot;, &quot;&quot;) != &quot;Week&quot;"/>
				<Action actionName="Hide-Show Component" actionCategory="General" id="13" action="Hide" conditionType="Expression" dataType="Text" componentName="Calendar_DayView" condition="CCGetParam(&quot;m&quot;, &quot;&quot;) != &quot;Calendar&quot; OR CCGetParam(&quot;v&quot;, &quot;&quot;) != &quot;Day&quot;"/>
				<Action actionName="Hide-Show Component" actionCategory="General" id="15" action="Hide" conditionType="Expression" dataType="Text" componentName="Calendar_Calendars" condition="!CCGetUserID() OR CCGetParam(&quot;p&quot;, &quot;&quot;) &lt;&gt; &quot;Calendars&quot;"/>
				<Action actionName="Hide-Show Component" actionCategory="General" id="17" action="Hide" conditionType="Expression" dataType="Text" componentName="Calendar_CalendarItems" condition="!CCGetUserID() OR CCGetParam(&quot;p&quot;, &quot;&quot;) &lt;&gt; &quot;CalendarItems&quot;"/>
				<Action actionName="Hide-Show Component" actionCategory="General" id="19" action="Hide" conditionType="Expression" dataType="Text" componentName="Calendar_Users" condition="!CCGetUserID() OR CCGetParam(&quot;p&quot;, &quot;&quot;) &lt;&gt; &quot;Users&quot;"/>
				<Action actionName="Hide-Show Component" actionCategory="General" id="22" action="Hide" conditionType="Expression" dataType="Text" componentName="Calendar_Settings" condition="!CCGetUserID() OR CCGetParam(&quot;p&quot;, &quot;&quot;) &lt;&gt; &quot;Settings&quot;"/>
				<Action actionName="Custom Code" actionCategory="General" id="23"/>
</Actions>
		</Event>
	</Events>
</Page>
