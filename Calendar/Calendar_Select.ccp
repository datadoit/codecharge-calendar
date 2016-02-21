<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\Calendar" secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="All" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="CalendarForm" actionPage="Calendar_Select" errorSummator="Error" wizardFormMethod="post" PathID="Calendar_SelectCalendarForm" wizardCaption="{res:NewRecord1}" wizardOrientation="Vertical">
			<Components>
				<ListBox id="3" visible="Dynamic" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="c" wizardEmptyCaption="{res:CCS_SelectValue}" PathID="Calendar_SelectCalendarFormc" connection="Connection1" dataSource="tbl_calendars, tbl_calendars_private_users" boundColumn="calendar_id" textColumn="calendar_name" activeCollection="TableParameters" groupBy="tbl_calendars.calendar_id">
					<Components/>
					<Events>
						<Event name="OnChange" type="Client">
							<Actions>
								<Action actionName="Submit Form" actionCategory="General" id="4" formName="CalendarForm"/>
							</Actions>
						</Event>
						<Event name="BeforeBuildSelect" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="5"/>
							</Actions>
						</Event>
					</Events>
					<TableParameters>
<TableParameter id="12" conditionType="Parameter" useIsNull="False" field="tbl_calendars.calendar_view" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="&quot;Public&quot;"/>
</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
<JoinTable id="7" tableName="tbl_calendars" posLeft="10" posTop="10" posWidth="233" posHeight="154"/>
<JoinTable id="8" tableName="tbl_calendars_private_users" posLeft="329" posTop="10" posWidth="215" posHeight="115"/>
</JoinTables>
					<JoinLinks>
<JoinTable2 id="11" tableLeft="tbl_calendars" tableRight="tbl_calendars_private_users" fieldLeft="tbl_calendars.calendar_id" fieldRight="tbl_calendars_private_users.calendar_id" joinType="left" conditionType="Equal"/>
</JoinLinks>
					<Fields>
<Field id="10" tableName="tbl_calendars" fieldName="tbl_calendars.*"/>
</Fields>
					<Attributes/>
					<Features/>
				</ListBox>
			</Components>
			<Events/>
			<TableParameters/>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
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
		<CodeFile id="Code" language="PHPTemplates" name="Calendar_Select.php" forShow="True" url="Calendar_Select.php" comment="//" codePage="utf-8"/>
		<CodeFile id="Events" language="PHPTemplates" name="Calendar_Select_events.php" forShow="False" comment="//" codePage="utf-8"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="BeforeShow" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="6"/>
			</Actions>
		</Event>
	</Events>
</Page>
