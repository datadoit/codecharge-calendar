<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\Calendar" secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" connection="Connection1" dataSource="lu_calendars_times" name="Cal" orderBy="HHiiSS" pageSizeLimit="100" wizardCaption="{res:CCS_GridFormPrefix} {res:lu_calendar_times} {res:CCS_GridFormSuffix}" wizardGridType="Columnar" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Controls" wizardRecordSeparator="True" wizardNoRecords="{res:CCS_NoRecords}" activeCollection="TableParameters" wizardUsePageScroller="True" pasteActions="pasteActions">
			<Components>
				<Panel id="4" visible="True" name="Data_time" pasteActions="pasteActions">
					<Components>
						<Label id="5" fieldSourceType="DBColumn" dataType="Text" html="False" name="TimeOfDay" fieldSource="time" wizardCaption="{res:time}" wizardSize="8" wizardMaxLength="8" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="Calendar_WeekViewCalData_timeTimeOfDay">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
					</Components>
					<Events/>
					<Attributes/>
					<Features/>
				</Panel>
				<ImageLink id="15" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="PreviousWeek" PathID="Calendar_WeekViewCalPreviousWeek" hrefSource="{PreviousWeek}">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</ImageLink>
				<Label id="16" fieldSourceType="DBColumn" dataType="Text" html="False" name="ThisWeek" PathID="Calendar_WeekViewCalThisWeek">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<ImageLink id="17" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="NextWeek" PathID="Calendar_WeekViewCalNextWeek" hrefSource="{NextWeek}">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</ImageLink>
				<Link id="18" fieldSourceType="DBColumn" dataType="Text" html="False" name="Sunday" PathID="Calendar_WeekViewCalSunday" visible="Dynamic" hrefType="Page" urlType="Relative" preserveParameters="GET">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="34"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
					<LinkParameters/>
				</Link>
				<Link id="19" fieldSourceType="DBColumn" dataType="Text" html="False" name="Monday" PathID="Calendar_WeekViewCalMonday" visible="Dynamic" hrefType="Page" urlType="Relative" preserveParameters="GET">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="35"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
					<LinkParameters/>
				</Link>
				<Link id="20" fieldSourceType="DBColumn" dataType="Text" html="False" name="Tuesday" PathID="Calendar_WeekViewCalTuesday" visible="Dynamic" hrefType="Page" urlType="Relative" preserveParameters="GET">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="36"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
					<LinkParameters/>
				</Link>
				<Link id="21" fieldSourceType="DBColumn" dataType="Text" html="False" name="Wednesday" PathID="Calendar_WeekViewCalWednesday" visible="Dynamic" hrefType="Page" urlType="Relative" preserveParameters="GET">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="37"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
					<LinkParameters/>
				</Link>
				<Link id="22" fieldSourceType="DBColumn" dataType="Text" html="False" name="Thursday" PathID="Calendar_WeekViewCalThursday" visible="Dynamic" hrefType="Page" urlType="Relative" preserveParameters="GET">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="38"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
					<LinkParameters/>
				</Link>
				<Link id="23" fieldSourceType="DBColumn" dataType="Text" html="False" name="Friday" PathID="Calendar_WeekViewCalFriday" visible="Dynamic" hrefType="Page" urlType="Relative" preserveParameters="GET">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="39"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
					<LinkParameters/>
				</Link>
				<Link id="24" fieldSourceType="DBColumn" dataType="Text" html="False" name="Saturday" PathID="Calendar_WeekViewCalSaturday" visible="Dynamic" hrefType="Page" urlType="Relative" preserveParameters="GET">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="40"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
					<LinkParameters/>
				</Link>
				<Label id="25" fieldSourceType="DBColumn" dataType="Text" html="True" name="MondayEvents" PathID="Calendar_WeekViewCalMondayEvents">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="26" fieldSourceType="DBColumn" dataType="Text" html="True" name="SundayEvents" PathID="Calendar_WeekViewCalSundayEvents">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="27" fieldSourceType="DBColumn" dataType="Text" html="True" name="TuesdayEvents" PathID="Calendar_WeekViewCalTuesdayEvents">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="28" fieldSourceType="DBColumn" dataType="Text" html="True" name="WednesdayEvents" PathID="Calendar_WeekViewCalWednesdayEvents">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="29" fieldSourceType="DBColumn" dataType="Text" html="True" name="ThursdayEvents" PathID="Calendar_WeekViewCalThursdayEvents">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="30" fieldSourceType="DBColumn" dataType="Text" html="True" name="FridayEvents" PathID="Calendar_WeekViewCalFridayEvents">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="31" fieldSourceType="DBColumn" dataType="Text" html="True" name="SaturdayEvents" PathID="Calendar_WeekViewCalSaturdayEvents">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="10"/>
					</Actions>
				</Event>
				<Event name="BeforeBuildSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="11"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="8" conditionType="Parameter" useIsNull="False" field="HHiiSS" dataType="Text" searchConditionType="NotEndsWith" parameterType="Expression" logicOperator="And" parameterSource="&quot;1500&quot;"/>
				<TableParameter id="9" conditionType="Parameter" useIsNull="False" field="HHiiSS" dataType="Text" searchConditionType="NotEndsWith" parameterType="Expression" logicOperator="And" parameterSource="&quot;4500&quot;"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="32" tableName="lu_calendars_times" posLeft="10" posTop="10" posWidth="180" posHeight="120"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<IncludePage id="33" name="Calendar_Select" PathID="Calendar_WeekViewCalendar_Select" page="Calendar_Select.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="Calendar_WeekView.php" forShow="True" url="Calendar_WeekView.php" comment="//" codePage="utf-8"/>
		<CodeFile id="Events" language="PHPTemplates" name="Calendar_WeekView_events.php" forShow="False" comment="//" codePage="utf-8"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="BeforeShow" type="Server">
			<Actions>
				<Action actionName="Declare Variable" actionCategory="General" id="46" name="FileName" initialValue="$FileName"/>
<Action actionName="Call Function" actionCategory="General" id="47" function="header" parameter1="($Container-&gt;Visible == true AND !CCGetParam(&quot;CalDate&quot;, &quot;&quot;)) ? &quot;Location: &quot; . $FileName . &quot;?&quot; . CCAddParam(CCGetQueryString(&quot;QueryString&quot;, &quot;&quot;), &quot;CalDate&quot;, date('Y') . &quot;-&quot; . date('m')) : &quot;&quot;"/><Action actionName="Custom Code" actionCategory="General" id="12"/>
			</Actions>
		</Event>
	</Events>
</Page>
