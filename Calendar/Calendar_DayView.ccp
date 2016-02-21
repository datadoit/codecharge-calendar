<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\Calendar" secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" connection="Connection1" dataSource="lu_calendars_times" name="Cal" orderBy="HHiiSS" pageSizeLimit="100" wizardCaption="{res:CCS_GridFormPrefix} {res:lu_calendar_times} {res:CCS_GridFormSuffix}" wizardGridType="Columnar" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Controls" wizardRecordSeparator="True" wizardNoRecords="{res:CCS_NoRecords}" activeCollection="TableParameters" pasteActions="pasteActions">
			<Components>
				<Label id="3" fieldSourceType="DBColumn" dataType="Text" html="False" name="TimeOfDay" fieldSource="time" wizardCaption="{res:time}" wizardSize="8" wizardMaxLength="8" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="Calendar_DayViewCalTimeOfDay">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<ImageLink id="8" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="PreviousDay" PathID="Calendar_DayViewCalPreviousDay" hrefSource="{PreviousDay}">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</ImageLink>
				<Label id="9" fieldSourceType="DBColumn" dataType="Text" html="True" name="Today" PathID="Calendar_DayViewCalToday">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<ImageLink id="10" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="NextDay" PathID="Calendar_DayViewCalNextDay" hrefSource="{NextDay}">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</ImageLink>
				<Label id="12" fieldSourceType="DBColumn" dataType="Text" html="True" name="Event" PathID="Calendar_DayViewCalEvent">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeBuildSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="11"/>
					</Actions>
				</Event>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="14"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="5" conditionType="Parameter" useIsNull="False" field="HHiiSS" dataType="Text" searchConditionType="NotEndsWith" parameterType="Expression" logicOperator="And" parameterSource="&quot;1500&quot;"/>
				<TableParameter id="6" conditionType="Parameter" useIsNull="False" field="HHiiSS" dataType="Text" searchConditionType="NotEndsWith" parameterType="Expression" logicOperator="And" parameterSource="&quot;4500&quot;"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="15" tableName="lu_calendars_times" posLeft="10" posTop="10" posWidth="180" posHeight="136"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<IncludePage id="16" name="Calendar_Select" PathID="Calendar_DayViewCalendar_Select" page="Calendar_Select.ccp">
<Components/>
<Events/>
<Features/>
</IncludePage>
</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="Calendar_DayView.php" forShow="True" url="Calendar_DayView.php" comment="//" codePage="utf-8"/>
		<CodeFile id="Events" language="PHPTemplates" name="Calendar_DayView_events.php" forShow="False" comment="//" codePage="utf-8"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="BeforeShow" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="13"/>
			</Actions>
		</Event>
	</Events>
</Page>
