<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\Calendar" secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0">
	<Components>
		<EditableGrid id="2" urlType="Relative" secured="False" emptyRows="0" allowInsert="False" allowUpdate="False" allowDelete="True" validateData="True" preserveParameters="GET" sourceType="Table" defaultPageSize="10" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Connection1" dataSource="tbl_calendars" name="Calendars" pageSizeLimit="100" wizardCaption="{res:CCS_GridFormPrefix} {res:tbl_calendars} {res:CCS_GridFormSuffix}" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAltRecord="False" wizardRecordSeparator="True" wizardNoRecords="{res:CCS_NoRecords}" PathID="Calendar_CalendarsCalendars" deleteControl="CheckBox_Delete" pasteActions="pasteActions">
			<Components>
				<Panel id="19" visible="True" name="FooterPanel" PathID="Calendar_CalendarsCalendarsFooterPanel" pasteActions="pasteActions">
					<Components>
						<Navigator id="12" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Simple" wizardFirst="True" wizardFirstText="{res:CCS_First}" wizardPrev="True" wizardPrevText="{res:CCS_Previous}" wizardNext="True" wizardNextText="{res:CCS_Next}" wizardLast="True" wizardLastText="{res:CCS_Last}" wizardImages="Images" wizardPageNumbers="Simple" wizardSize="5" wizardTotalPages="True" wizardHideDisabled="False" wizardPageSize="False" wizardImagesScheme="{ccs_style}">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Navigator>
						<Panel id="67" visible="True" name="ActionPanel" PathID="Calendar_CalendarsCalendarsFooterPanelActionPanel" pasteActions="pasteActions">
							<Components>
								<ListBox id="16" visible="Dynamic" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="action" wizardEmptyCaption="{res:CCS_SelectValue}" PathID="Calendar_CalendarsCalendarsFooterPanelActionPanelaction" connection="Connection1" _valueOfList="delete" _nameOfList="{res:CCS_Delete}" dataSource="delete;{res:CCS_Delete}">
									<Components/>
									<Events/>
									<TableParameters/>
									<SPParameters/>
									<SQLParameters/>
									<JoinTables/>
									<JoinLinks/>
									<Fields/>
									<Attributes/>
									<Features/>
								</ListBox>
								<Button id="13" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="{res:CCS_Update}" PathID="Calendar_CalendarsCalendarsFooterPanelActionPanelButton_Submit">
									<Components/>
									<Events>
										<Event name="OnClick" type="Client">
											<Actions>
												<Action actionName="Confirmation Message" actionCategory="General" id="14" message="{res:CCS_SubmitConfirmation}" eventType="Client"/>
											</Actions>
										</Event>
										<Event name="OnClick" type="Server">
											<Actions>
												<Action actionName="Custom Code" actionCategory="General" id="17" eventType="Server"/>
											</Actions>
										</Event>
									</Events>
									<Attributes/>
									<Features/>
								</Button>
							</Components>
							<Events/>
							<Attributes/>
							<Features/>
						</Panel>
					</Components>
					<Events/>
					<Attributes/>
					<Features/>
				</Panel>
				<Panel id="20" visible="True" name="HeaderPanel" PathID="Calendar_CalendarsCalendarsHeaderPanel" pasteActions="pasteActions" wizardAllowSorting="True">
					<Components>
						<Sorter id="6" visible="True" name="Sorter_calendar_name" column="calendar_name" wizardCaption="{res:calendar_name}" wizardSortingType="SimpleDir" wizardControl="calendar_name" PathID="Calendar_CalendarsCalendarsHeaderPanelSorter_calendar_name">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
						<Sorter id="7" visible="True" name="Sorter_calendar_type" column="calendar_type" wizardCaption="{res:calendar_type}" wizardSortingType="SimpleDir" wizardControl="calendar_type" PathID="Calendar_CalendarsCalendarsHeaderPanelSorter_calendar_type">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
						<Panel id="47" visible="True" name="Header_ColumnAction" PathID="Calendar_CalendarsCalendarsHeaderPanelHeader_ColumnAction">
							<Components>
								<CheckBox id="15" visible="Dynamic" fieldSourceType="DBColumn" dataType="Boolean" name="CheckBox_SelectAll" PathID="Calendar_CalendarsCalendarsHeaderPanelHeader_ColumnActionCheckBox_SelectAll">
									<Components/>
									<Events>
										<Event name="OnClick" type="Client">
											<Actions>
												<Action actionName="Custom Code" actionCategory="General" id="53"/>
											</Actions>
										</Event>
									</Events>
									<Attributes/>
									<Features/>
								</CheckBox>
							</Components>
							<Events/>
							<Attributes/>
							<Features/>
						</Panel>
						<Sorter id="56" visible="True" name="Sorter_calendar_view" wizardSortingType="SimpleDir" PathID="Calendar_CalendarsCalendarsHeaderPanelSorter_calendar_view" wizardCaption="Sorter_calendar_view" column="calendar_view">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
					</Components>
					<Events/>
					<Attributes/>
					<Features/>
				</Panel>
				<Panel id="23" visible="True" name="TotalRecordsPanel" PathID="Calendar_CalendarsCalendarsTotalRecordsPanel" pasteActions="pasteActions">
					<Components>
						<Label id="4" fieldSourceType="DBColumn" dataType="Text" html="False" name="TotalRecords" wizardUseTemplateBlock="False" PathID="Calendar_CalendarsCalendarsTotalRecordsPanelTotalRecords">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Retrieve number of records" actionCategory="Database" id="5"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</Label>
					</Components>
					<Events/>
					<Attributes/>
					<Features/>
				</Panel>
				<Button id="25" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Add" PathID="Calendar_CalendarsCalendarsButton_Add">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Declare Variable" actionCategory="General" id="26" name="Redirect" initialValue="&quot;?p=Calendars&amp;action=AddEdit&quot;"/>
							</Actions>
						</Event>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Hide-Show Component" actionCategory="General" id="46" action="Hide" conditionType="Expression" dataType="Text" componentName="Button_Add" condition="CCGetParam(&quot;action&quot;, &quot;&quot;)"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Panel id="48" visible="True" name="Data_ColumnAction" PathID="Calendar_CalendarsCalendarsData_ColumnAction" pasteActions="pasteActions">
					<Components>
						<Hidden id="18" fieldSourceType="DBColumn" dataType="Text" name="calendar_id" PathID="Calendar_CalendarsCalendarsData_ColumnActioncalendar_id" fieldSource="calendar_id">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<CheckBox id="11" visible="Dynamic" fieldSourceType="CodeExpression" dataType="Boolean" name="CheckBox_Delete" checkedValue="true" uncheckedValue="false" wizardCaption="{res:CCS_Delete}" wizardAddNbsp="True" PathID="Calendar_CalendarsCalendarsData_ColumnActionCheckBox_Delete">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</CheckBox>
					</Components>
					<Events/>
					<Attributes/>
					<Features/>
				</Panel>
				<Link id="8" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="calendar_name" fieldSource="calendar_name" required="True" caption="{res:calendar_name}" wizardCaption="{res:calendar_name}" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_CalendarsCalendarscalendar_name" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Declare Variable" actionCategory="General" id="62" name="CCSLocales" initialValue="$CCSLocales"/>
								<Action actionName="Retrieve Value for Control" actionCategory="General" id="61" name="calendar_name" sourceType="Expression" sourceName="$Container-&gt;ds-&gt;f(&quot;calendar_default&quot;) == 1 ? $Component-&gt;GetValue() . &quot; (&quot; . $CCSLocales-&gt;GetText(&quot;CRM_Default&quot;) . &quot;)&quot; : $Component-&gt;GetValue()"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
					<LinkParameters>
						<LinkParameter id="44" sourceType="Expression" name="action" source="&quot;AddEdit&quot;"/>
						<LinkParameter id="45" sourceType="DataField" name="id" source="calendar_id"/>
					</LinkParameters>
				</Link>
				<Label id="9" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="calendar_type" fieldSource="calendar_type" required="True" caption="{res:calendar_type}" wizardCaption="{res:calendar_type}" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_CalendarsCalendarscalendar_type" html="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="55" fieldSourceType="DBColumn" dataType="Text" html="False" name="calendar_view" PathID="Calendar_CalendarsCalendarscalendar_view" fieldSource="calendar_view">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Hide-Show Component" actionCategory="General" id="52" action="Hide" conditionType="Expression" dataType="Text" componentName="Calendars" condition="$Container-&gt;ds-&gt;RecordsCount == 0 AND CCGetParam(&quot;action&quot;, &quot;&quot;) == &quot;AddEdit&quot;"/>
						<Action actionName="Hide-Show Component" actionCategory="General" id="24" action="Hide" conditionType="Expression" dataType="Text" componentName="TotalRecordsPanel" condition="$Container-&gt;ds-&gt;RecordsCount == 0"/>
						<Action actionName="Hide-Show Component" actionCategory="General" id="21" action="Hide" conditionType="Expression" dataType="Text" componentName="HeaderPanel" condition="$Container-&gt;ds-&gt;RecordsCount == 0"/>
						<Action actionName="Hide-Show Component" actionCategory="General" id="22" action="Hide" conditionType="Expression" dataType="Text" componentName="FooterPanel" condition="$Container-&gt;ds-&gt;RecordsCount == 0"/>
						<Action actionName="Hide-Show Component" actionCategory="General" id="49" action="Hide" conditionType="Expression" dataType="Text" componentName="Header_ColumnAction" condition="CCGetParam(&quot;action&quot;, &quot;&quot;)"/>
						<Action actionName="Hide-Show Component" actionCategory="General" id="50" action="Hide" conditionType="Expression" dataType="Text" componentName="Data_ColumnAction" condition="CCGetParam(&quot;action&quot;, &quot;&quot;)"/>
						<Action actionName="Hide-Show Component" actionCategory="General" id="51" action="Hide" conditionType="Expression" dataType="Text" componentName="ActionPanel" condition="CCGetParam(&quot;action&quot;, &quot;&quot;)"/>
						<Action actionName="Hide-Show Component" actionCategory="General" id="68" action="Hide" conditionType="Expression" dataType="Text" componentName="Calendars" condition="CCGetParam(&quot;action&quot;, &quot;&quot;) == &quot;AddEdit&quot; AND !CCGetParam(&quot;id&quot;, &quot;&quot;)"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters/>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<PKFields>
				<PKField id="3" tableName="tbl_calendars" fieldName="calendar_id" dataType="Integer"/>
			</PKFields>
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
		</EditableGrid>
		<Record id="27" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Connection1" name="CalendarAddEdit" dataSource="tbl_calendars" errorSummator="Error" wizardCaption="{res:CCS_RecordFormPrefix} {res:tbl_calendars} {res:CCS_RecordFormSuffix}" wizardFormMethod="post" PathID="Calendar_CalendarsCalendarAddEdit" activeCollection="TableParameters" removeParameters="action;id" pasteActions="pasteActions">
			<Components>
				<Button id="28" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="{res:CCS_Insert}" PathID="Calendar_CalendarsCalendarAddEditButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="29" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="{res:CCS_Update}" PathID="Calendar_CalendarsCalendarAddEditButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="30" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="{res:CCS_Delete}" PathID="Calendar_CalendarsCalendarAddEditButton_Delete">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="31" message="{res:CCS_DeleteConfirmation}"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="32" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="{res:CCS_Cancel}" PathID="Calendar_CalendarsCalendarAddEditButton_Cancel" removeParameters="action;id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="34" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="calendar_name" fieldSource="calendar_name" caption="{res:calendar_name}" wizardCaption="{res:calendar_name}" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_CalendarsCalendarAddEditcalendar_name">
					<Components/>
					<Events>
						<Event name="OnValidate" type="Server">
							<Actions>
								<Action actionName="Validate Minimum Length" actionCategory="Validation" id="42" name="calendar_name" minimumLength="5" errorMessage="{res:CRM_MoreDescriptiveCalendarName}"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</TextBox>
				<RadioButton id="35" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="calendar_type" fieldSource="calendar_type" wizardCaption="{res:calendar_type}" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_CalendarsCalendarAddEditcalendar_type" sourceType="ListOfValues" html="True" connection="Connection1" _valueOfList="Reservations" _nameOfList="Reservations" dataSource="Events;Events;Reservations;Reservations">
					<Components/>
					<Events>
						<Event name="OnValidate" type="Server">
							<Actions>
								<Action actionName="Validate Minimum Length" actionCategory="Validation" id="43" name="calendar_type" minimumLength="1" errorMessage="{res:CRM_ChooseCalendarType}"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
				</RadioButton>
				<Label id="38" fieldSourceType="DBColumn" dataType="Text" html="False" name="AddEditLabel" PathID="Calendar_CalendarsCalendarAddEditAddEditLabel">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Declare Variable" actionCategory="General" id="39" name="CCSLocales" initialValue="$CCSLocales"/>
								<Action actionName="Retrieve Value for Control" actionCategory="General" id="40" name="AddEditLabel" sourceType="Expression" sourceName="(CCGetParam(&quot;action&quot;, &quot;&quot;) == &quot;AddEdit&quot; AND !CCGetParam(&quot;id&quot;, &quot;&quot;)) ? $CCSLocales-&gt;GetText(&quot;CRM_NewCalendar&quot;) : $CCSLocales-&gt;GetText(&quot;CRM_EditCalendar&quot;)"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<RadioButton id="54" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" html="True" returnValueType="Number" name="calendar_view" PathID="Calendar_CalendarsCalendarAddEditcalendar_view" fieldSource="calendar_view" connection="Connection1" _valueOfList="Private" _nameOfList="Private" dataSource="Public;Public;Private;Private">
					<Components/>
					<Events>
						<Event name="OnValidate" type="Server">
							<Actions>
								<Action actionName="Validate Minimum Length" actionCategory="Validation" id="57" name="calendar_view" minimumLength="1" errorMessage="{res:CRM_ChooseCalendarView}"/>
							</Actions>
						</Event>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="60"/>
							</Actions>
						</Event>
					</Events>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</RadioButton>
				<ListBox id="69" visible="Dynamic" fieldSourceType="CodeExpression" sourceType="Table" dataType="Integer" returnValueType="Number" name="Lsb_Available" wizardEmptyCaption="{res:CCS_SelectValue}" PathID="Calendar_CalendarsCalendarAddEditLsb_Available" connection="Connection1" dataSource="tbl_users" boundColumn="user_id" textColumn="UserName" activeCollection="TableParameters">
					<Components/>
					<Events>
						<Event name="BeforeBuildSelect" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="70"/>
							</Actions>
						</Event>
					</Events>
					<TableParameters>
						<TableParameter id="71" conditionType="Parameter" useIsNull="False" field="group_id" dataType="Integer" searchConditionType="GreaterThan" parameterType="Expression" logicOperator="And" parameterSource="2"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="89" tableName="tbl_users" posLeft="10" posTop="10" posWidth="288" posHeight="313"/>
					</JoinTables>
					<JoinLinks/>
					<Fields>
						<Field id="90" fieldName="CONCAT(first_name, ' ', last_name)" isExpression="True" alias="UserName"/>
						<Field id="92" tableName="tbl_users" fieldName="user_id"/>
					</Fields>
					<Attributes/>
					<Features/>
				</ListBox>
				<ListBox id="73" visible="Dynamic" fieldSourceType="CodeExpression" sourceType="Table" dataType="Integer" returnValueType="Number" name="Lsb_Assigned" wizardEmptyCaption="{res:CCS_SelectValue}" PathID="Calendar_CalendarsCalendarAddEditLsb_Assigned" connection="Connection1" boundColumn="tbl_calendars_private_users_user_id" textColumn="UserName" activeCollection="TableParameters" orderBy="tbl_calendars_private_users.user_id" dataSource="tbl_calendars_private_users, tbl_users">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="74" conditionType="Parameter" useIsNull="False" field="tbl_calendars_private_users.calendar_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="-1" leftBrackets="0" rightBrackets="0" parameterSource="id"/>
						<TableParameter id="98" conditionType="Parameter" useIsNull="False" field="tbl_users.group_id" dataType="Integer" searchConditionType="GreaterThan" parameterType="Expression" logicOperator="And" parameterSource="2"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="75" tableName="tbl_calendars_private_users" posLeft="10" posTop="10" posWidth="306" posHeight="128"/>
						<JoinTable id="76" tableName="tbl_users" posLeft="389" posTop="5" posWidth="265" posHeight="286"/>
					</JoinTables>
					<JoinLinks>
						<JoinTable2 id="77" tableLeft="tbl_calendars_private_users" tableRight="tbl_users" fieldLeft="tbl_calendars_private_users.user_id" fieldRight="tbl_users.user_id" joinType="inner" conditionType="Equal"/>
					</JoinLinks>
					<Fields>
						<Field id="79" tableName="tbl_calendars_private_users" fieldName="calendar_id"/>
						<Field id="80" tableName="tbl_calendars_private_users" fieldName="tbl_calendars_private_users.user_id" alias="tbl_calendars_private_users_user_id"/>
						<Field id="81" fieldName="CONCAT(first_name,' ',last_name)" isExpression="True" alias="UserName"/>
					</Fields>
					<Attributes/>
					<Features/>
				</ListBox>
				<Button id="82" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Right" PathID="Calendar_CalendarsCalendarAddEditButton_Right">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="83"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="84" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Left" PathID="Calendar_CalendarsCalendarAddEditButton_Left">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="85"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="86" fieldSourceType="DBColumn" dataType="Text" name="LinkedID" PathID="Calendar_CalendarsCalendarAddEditLinkedID">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="97"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Hidden>
				<CheckBox id="58" visible="Yes" fieldSourceType="DBColumn" dataType="Boolean" name="calendar_default" PathID="Calendar_CalendarsCalendarAddEditcalendar_default" fieldSource="calendar_default">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
</Components>
			<Events>
				<Event name="OnLoad" type="Client">
					<Actions>
						<Action actionName="Set Focus" actionCategory="General" id="41" name="calendar_name"/>
					</Actions>
				</Event>
				<Event name="BeforeUpdate" type="Server">
					<Actions>
						<Action actionName="Call Function" actionCategory="General" id="64" function="CheckDefault"/>
					</Actions>
				</Event>
				<Event name="BeforeInsert" type="Server">
					<Actions>
						<Action actionName="Call Function" actionCategory="General" id="65" function="CheckDefault"/>
					</Actions>
				</Event>
				<Event name="OnValidate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="66"/>
					</Actions>
				</Event>
				<Event name="OnSubmit" type="Client">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="87"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Hide-Show Component" actionCategory="General" id="88" action="Hide" conditionType="Expression" dataType="Text" componentName="CalendarAddEdit" condition="!CCGetParam(&quot;action&quot;,&quot;&quot;)"/>
					</Actions>
				</Event>
				<Event name="AfterUpdate" type="Server">
					<Actions>
						<Action actionName="Call Function" actionCategory="General" id="95" function="CalendarUsersModify" parameter1="&quot;Update&quot;"/>
						<Action actionName="Custom Code" actionCategory="General" id="93"/>
					</Actions>
				</Event>
				<Event name="AfterInsert" type="Server">
					<Actions>
						<Action actionName="Call Function" actionCategory="General" id="94" function="CalendarUsersModify" parameter1="&quot;Insert&quot;"/>
					</Actions>
				</Event>
				<Event name="BeforeDelete" type="Server">
					<Actions>
						<Action actionName="Call Function" actionCategory="General" id="96" function="CalendarUsersModify" parameter1="&quot;Delete&quot;"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="33" conditionType="Parameter" useIsNull="False" field="calendar_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1" parameterSource="id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="36" tableName="tbl_calendars" posLeft="10" posTop="10" posWidth="174" posHeight="129"/>
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
		<CodeFile id="Code" language="PHPTemplates" name="Calendar_Calendars.php" forShow="True" url="Calendar_Calendars.php" comment="//" codePage="utf-8"/>
		<CodeFile id="Events" language="PHPTemplates" name="Calendar_Calendars_events.php" forShow="False" comment="//" codePage="utf-8"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="OnLoad" type="Client">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="59"/>
			</Actions>
		</Event>
	</Events>
</Page>
