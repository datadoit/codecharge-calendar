<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\Calendar" secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0">
	<Components>
		<Calendar id="2" months="12" secured="False" showOtherMonthsDays="False" monthsInRow="4" sourceType="Table" connection="Connection1" dataSource="tbl_calendars_items" name="Year" dateField="calendar_item_start" type="12" wizardWeekSeparator="True" wizardProportionalColumns="True" pasteActions="pasteActions" activeCollection="TableParameters">
			<Components>
				<Link id="15" fieldSourceType="CalendarSpecialValue" dataType="Date" html="False" name="DayOfWeek" format="wi" PathID="Calendar_YearViewYearDayOfWeek" visible="Dynamic" hrefType="Page" urlType="Relative" preserveParameters="GET" wizardUseTemplateBlock="True" fieldSource="CurrentProcessingDate">
					<Components/>
					<Events>
					</Events>
					<Attributes/>
					<Features/>
					<LinkParameters>
						<LinkParameter id="30" sourceType="Expression" name="v" source="&quot;Week&quot;"/>
						<LinkParameter id="31" sourceType="CalendarSpecialValue" format="yyyy-mm" name="CalDate" source="CurrentProcessingDate"/>
						<LinkParameter id="32" sourceType="CalendarSpecialValue" format="ww" name="WeekNum" source="CurrentProcessingDate"/>
					</LinkParameters>
				</Link>
				<Link id="16" fieldSourceType="CalendarSpecialValue" dataType="Date" html="False" name="MonthDate" format="mmmm" PathID="Calendar_YearViewYearMonthDate" visible="Dynamic" hrefType="Page" urlType="Relative" preserveParameters="GET" wizardUseTemplateBlock="True" fieldSource="CurrentProcessingDate">
					<Components/>
					<Events>
					</Events>
					<Attributes/>
					<Features/>
					<LinkParameters>
						<LinkParameter id="28" sourceType="Expression" name="v" source="&quot;Month&quot;"/>
						<LinkParameter id="29" sourceType="CalendarSpecialValue" name="CalDate" source="CurrentProcessingDate" format="yyyy-mm"/>
					</LinkParameters>
				</Link>
				<Link id="17" fieldSourceType="CalendarSpecialValue" dataType="Date" html="False" name="DayNumber" PathID="Calendar_YearViewYearDayNumber" format="d" visible="Dynamic" hrefType="Page" urlType="Relative" preserveParameters="GET" wizardUseTemplateBlock="True" fieldSource="CurrentProcessingDate">
					<Components/>
					<Events>
					</Events>
					<Attributes/>
					<Features/>
					<LinkParameters>
						<LinkParameter id="33" sourceType="Expression" name="v" source="&quot;Day&quot;"/>
						<LinkParameter id="34" sourceType="CalendarSpecialValue" format="yyyy-mm" name="CalDate" source="CurrentProcessingDate"/>
						<LinkParameter id="35" sourceType="CalendarSpecialValue" format="y" name="DayNum" source="PrevProcessingDate"/>
					</LinkParameters>
				</Link>
				<Label id="18" fieldSourceType="DBColumn" dataType="Date" html="False" name="EventTime" format="HH:nn" fieldSource="calendar_item_start" PathID="Calendar_YearViewYearEventTime">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="19" fieldSourceType="DBColumn" dataType="Text" html="False" name="EventDescription" fieldSource="calendar_item_title" PathID="Calendar_YearViewYearEventDescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<CalendarNavigator id="4" yearsRange="10" name="Navigator" wizardType="0" wizardCalendarType="12" wizardPrevYear="True" wizardPrevYearText="&lt;&lt;" wizardPrevYearHint="{res:CCS_PrevYearHint}" wizardNextYear="True" wizardNextYearText="&gt;&gt;" wizardNextYearHint="{res:CCS_NextYearHint}" wizardPrev="False" wizardNext="False" wizardPrevMonthHint="{res:CCS_PrevMonthHint}" wizardNextMonthHint="{res:CCS_NextMonthHint}" wizardImages="True" wizardCurrentYear="ListBox" wizardCurrentMonth="None" wizardCurrentQuarter="None" wizardCurrentMonthFormat="Full" wizardOrder="MQY" wizardButton="Submit" wizardImageButton="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CalendarNavigator>
			</Components>
			<Events>
				<Event name="BeforeShowDay" type="Server">
					<Actions>
						<Action actionName="DLookup" actionCategory="Database" id="38" typeOfTarget="Variable" expression="&quot;calendar_item_title&quot;" domain="&quot;tbl_calendars_items&quot;" criteria="&quot;calendar_id=&quot; . CCToSQL(CCGetParam(&quot;c&quot;, &quot;&quot;), ccsInteger) . &quot; AND DATE(calendar_item_start)=&quot; . CCToSQL(CCFormatDate($Container-&gt;CurrentProcessingDate, array(&quot;yyyy&quot;, &quot;-&quot;, &quot;mm&quot;, &quot;-&quot;, &quot;dd&quot;)), ccsDate)" connection="Connection1" dataType="Text" target="Event"/>
						<Action actionName="Set Tag" actionCategory="General" id="39" name="DayNumberStyle" expression="($Event) ? &quot;font-weight: bold; &quot; : &quot;&quot;"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="24" conditionType="Parameter" useIsNull="False" field="calendar_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="c"/>
				<TableParameter id="3" conditionType="Parameter" useIsNull="False" field="calendar_item_start" dataType="Date" parameterType="CalendarSpecialValue" parameterSource="DateRange" searchConditionType="Between" logicOperator="AND" orderNumber="2" leftBrackets="0" rightBrackets="0"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="23" tableName="tbl_calendars_items" posLeft="10" posTop="10" posWidth="277" posHeight="384"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters/>
			<Attributes/>
			<SecurityGroups/>
			<CalendarStyles>
				<CalendarStyle id="5" name="WeekdayName" value="class=&quot;CalendarWeekdayName&quot;"/>
				<CalendarStyle id="6" name="WeekendName" value="class=&quot;CalendarWeekendName&quot;"/>
				<CalendarStyle id="7" name="Day" value="class=&quot;CalendarDay&quot;"/>
				<CalendarStyle id="8" name="Weekend" value="class=&quot;CalendarWeekend&quot;"/>
				<CalendarStyle id="9" name="Today" value="class=&quot;CalendarToday&quot;"/>
				<CalendarStyle id="10" name="WeekendToday" value="class=&quot;CalendarWeekendToday&quot;"/>
				<CalendarStyle id="11" name="OtherMonthDay" value="class=&quot;CalendarOtherMonthDay&quot;"/>
				<CalendarStyle id="12" name="OtherMonthToday" value="class=&quot;CalendarOtherMonthToday&quot;"/>
				<CalendarStyle id="13" name="OtherMonthWeekend" value="class=&quot;CalendarOtherMonthWeekend&quot;"/>
				<CalendarStyle id="14" name="OtherMonthWeekendToday" value="class=&quot;CalendarOtherMonthWeekendToday&quot;"/>
			</CalendarStyles>
			<Features/>
		</Calendar>
		<IncludePage id="22" name="Calendar_Select" PathID="Calendar_YearViewCalendar_Select" page="Calendar_Select.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="Calendar_YearView.php" forShow="True" url="Calendar_YearView.php" comment="//" codePage="utf-8"/>
		<CodeFile id="Events" language="PHPTemplates" name="Calendar_YearView_events.php" forShow="False" comment="//" codePage="utf-8"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="BeforeShow" type="Server">
<Actions>
<Action actionName="Declare Variable" actionCategory="General" id="40" name="FileName" initialValue="$FileName"/>
<Action actionName="Call Function" actionCategory="General" id="41" function="header" parameter1="($Container-&gt;Visible == true AND CCGetParam(&quot;CalDate&quot;, &quot;&quot;)) ? &quot;Location: &quot; . $FileName . &quot;?&quot; . CCRemoveParam(CCGetQueryString(&quot;QueryString&quot;, &quot;&quot;), &quot;CalDate&quot;) : &quot;&quot;"/>
<Action actionName="Call Function" actionCategory="General" id="42" function="header" parameter1="($Container-&gt;Visible == true AND CCGetParam(&quot;WeekNum&quot;, &quot;&quot;)) ? &quot;Location: &quot; . $FileName . &quot;?&quot; . CCRemoveParam(CCGetQueryString(&quot;QueryString&quot;, &quot;&quot;), &quot;WeekNum&quot;) : &quot;&quot;"/>
<Action actionName="Call Function" actionCategory="General" id="43" function="header" parameter1="($Container-&gt;Visible == true AND CCGetParam(&quot;DayNum&quot;, &quot;&quot;)) ? &quot;Location: &quot; . $FileName . &quot;?&quot; . CCRemoveParam(CCGetQueryString(&quot;QueryString&quot;, &quot;&quot;), &quot;DayNum&quot;) : &quot;&quot;"/>
</Actions>
</Event>
</Events>
</Page>
