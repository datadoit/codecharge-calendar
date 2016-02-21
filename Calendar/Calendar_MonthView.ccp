<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\Calendar" secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Panel id="34" visible="Dynamic" name="EventDetailPanel" PathID="Calendar_MonthViewEventDetailPanel" features="(assigned)">
			<Components>
				<Record id="36" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Connection1" name="EventDetailRecord" dataSource="tbl_calendars_items" errorSummator="Error" wizardCaption="{res:CCS_RecordFormPrefix} {res:tbl_calendars_items} {res:CCS_RecordFormSuffix}" wizardFormMethod="post" PathID="Calendar_MonthViewEventDetailPanelEventDetailRecord" activeCollection="TableParameters" visible="Dynamic" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions">
					<Components>
						<Button id="37" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="{res:CCS_Insert}" PathID="Calendar_MonthViewEventDetailPanelEventDetailRecordButton_Insert">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Button>
						<Button id="41" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Close" operation="Cancel" wizardCaption="{res:CCS_Cancel}" PathID="Calendar_MonthViewEventDetailPanelEventDetailRecordButton_Close">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Button>
						<Label id="43" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="CalendarName" required="True" wizardCaption="{res:calendar_id}" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_MonthViewEventDetailPanelEventDetailRecordCalendarName" html="False">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="DLookup" actionCategory="Database" id="69" typeOfTarget="Control" expression="&quot;calendar_name&quot;" domain="&quot;tbl_calendars&quot;" criteria="&quot;calendar_id=&quot; . CCToSQL($Container-&gt;calendar_id-&gt;GetValue(), ccsInteger)" connection="Connection1" dataType="Text" target="CalendarName"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</Label>
						<TextBox id="48" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" name="calendar_item_title" wizardCaption="{res:calendar_item_title}" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_MonthViewEventDetailPanelEventDetailRecordcalendar_item_title">
							<Components/>
							<Events>
								<Event name="OnValidate" type="Server">
									<Actions>
										<Action actionName="Validate Minimum Length" actionCategory="Validation" id="93" name="calendar_item_title" minimumLength="5" errorMessage="{res:CRM_ErrorMoreDescriptiveTitle}"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</TextBox>
						<TextArea id="49" visible="Dynamic" fieldSourceType="DBColumn" dataType="Memo" name="calendar_item_description" wizardCaption="{res:calendar_item_description}" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="Calendar_MonthViewEventDetailPanelEventDetailRecordcalendar_item_description">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextArea>
						<Hidden id="58" fieldSourceType="DBColumn" dataType="Integer" name="calendar_item_id" PathID="Calendar_MonthViewEventDetailPanelEventDetailRecordcalendar_item_id" visible="Dynamic">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<Hidden id="59" fieldSourceType="DBColumn" dataType="Integer" name="calendar_id" PathID="Calendar_MonthViewEventDetailPanelEventDetailRecordcalendar_id">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<Hidden id="63" fieldSourceType="DBColumn" dataType="Text" name="calendar_item_start" PathID="Calendar_MonthViewEventDetailPanelEventDetailRecordcalendar_item_start">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<Hidden id="64" fieldSourceType="DBColumn" dataType="Text" name="calendar_item_end" PathID="Calendar_MonthViewEventDetailPanelEventDetailRecordcalendar_item_end">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<Panel id="75" visible="True" name="TitleLabelPanel" PathID="Calendar_MonthViewEventDetailPanelEventDetailRecordTitleLabelPanel" pasteActions="pasteActions">
							<Components>
								<Label id="67" fieldSourceType="DBColumn" dataType="Text" html="False" name="TitleLabel" PathID="Calendar_MonthViewEventDetailPanelEventDetailRecordTitleLabelPanelTitleLabel">
									<Components/>
									<Events>
										<Event name="BeforeShow" type="Server">
											<Actions>
												<Action actionName="Declare Variable" actionCategory="General" id="74" name="DBConnection1" initialValue="$DBConnection1"/>
												<Action actionName="Retrieve Value for Control" actionCategory="General" id="73" name="TitleLabel" sourceType="Expression" sourceName="!CCGetUserID() ? CCDLookUp(&quot;calendar_item_title&quot;, &quot;tbl_calendars_items&quot;, &quot;calendar_item_id=&quot; . CCToSQL($Container-&gt;calendar_item_id-&gt;GetValue(), ccsInteger), $DBConnection1) : &quot;&quot;"/>
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
						<Panel id="79" visible="True" name="StartDateTimePanel" wizardInnerHTML="&lt;input id=&quot;Calendar_MonthViewEventDetailPanelEventDetailRecordStartDate&quot; value=&quot;{StartDate}&quot; maxlength=&quot;10&quot; size=&quot;12&quot; name=&quot;{StartDate_Name}&quot; /&gt;
              &lt;!-- BEGIN DatePicker DatePicker_StartDate --&gt;&lt;a href=&quot;javascript:showDatePicker('{Name}','{FormName}','{DateControl}');&quot; id=&quot;Calendar_MonthViewEventDetailPanelEventDetailRecordDatePicker_StartDate&quot;&gt;&lt;img style=&quot;BORDER-BOTTOM: 0px; BORDER-LEFT: 0px; BORDER-TOP: 0px; BORDER-RIGHT: 0px&quot; id=&quot;Calendar_MonthViewEventDetailPanelEventDetailRecordDatePicker_StartDate_Image&quot; alt=&quot;Show Date Picker&quot; src=&quot;{page:pathToRoot}Styles/{CCS_Style}/Images/DatePicker.gif&quot; /&gt;&lt;/a&gt;&lt;!-- END DatePicker DatePicker_StartDate --&gt;&amp;nbsp; 
              &lt;!-- BEGIN ListBox StartTime --&gt;
              &lt;select id=&quot;Calendar_MonthViewEventDetailPanelEventDetailRecordStartTime&quot; name=&quot;{StartTime_Name}&quot;&gt;
                &lt;option selected=&quot;selected&quot; value=&quot;&quot;&gt;{res:CCS_SelectValue}&lt;/option&gt;
 {StartTime_Options} 
              &lt;/select&gt;
 &lt;!-- END ListBox StartTime --&gt;" PathID="Calendar_MonthViewEventDetailPanelEventDetailRecordStartDateTimePanel">
							<Components>
								<TextBox id="44" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="StartDate" wizardCaption="{res:calendar_item_start}" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_MonthViewEventDetailPanelEventDetailRecordStartDateTimePanelStartDate">
									<Components/>
									<Events>
										<Event name="OnValidate" type="Server">
											<Actions>
												<Action actionName="Validate Minimum Length" actionCategory="Validation" id="94" name="StartDate" minimumLength="1" errorMessage="{res:CRM_ErrorEnterStartDate}"/>
												<Action actionName="Regular Expression Validation" actionCategory="Validation" id="102" name="StartDate" regExp="/^\d{2}\/\d{2}\/\d{4}$/" errorMessage="{res:CRM_ErrorDateFormat}"/>
											</Actions>
										</Event>
									</Events>
									<Attributes/>
									<Features/>
								</TextBox>
								<DatePicker id="45" name="DatePicker_StartDate" control="StartDate" wizardSatellite="True" wizardControl="calendar_item_start" wizardDatePickerType="Image" wizardPicture="{page:pathToRoot}Styles/{CCS_Style}/Images/DatePicker.gif" style="{page:pathToRoot}Styles/{CCS_Style}/Style.css" PathID="Calendar_MonthViewEventDetailPanelEventDetailRecordStartDateTimePanelDatePicker_StartDate">
									<Components/>
									<Events/>
									<Attributes/>
									<Features/>
								</DatePicker>
								<ListBox id="60" visible="Dynamic" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="StartTime" wizardEmptyCaption="{res:CCS_SelectValue}" PathID="Calendar_MonthViewEventDetailPanelEventDetailRecordStartDateTimePanelStartTime" connection="Connection1" dataSource="lu_calendars_times" boundColumn="id" textColumn="time" validationRule="CCStrLen($this-&gt;StartTime-&gt;GetText()) &gt; 0" validationText="{res:CRM_ErrorChooseStartTime}" orderBy="HHiiSS">
									<Components/>
									<Events/>
									<TableParameters/>
									<SPParameters/>
									<SQLParameters/>
									<JoinTables>
										<JoinTable id="100" tableName="lu_calendars_times" posLeft="10" posTop="10" posWidth="95" posHeight="104"/>
									</JoinTables>
									<JoinLinks/>
									<Fields/>
									<Attributes/>
									<Features/>
								</ListBox>
							</Components>
							<Events/>
							<Attributes/>
							<Features/>
						</Panel>
						<Panel id="80" visible="True" name="EndDateTimePanel" wizardInnerHTML="&lt;input id=&quot;Calendar_MonthViewEventDetailPanelEventDetailRecordEndDate&quot; value=&quot;{EndDate}&quot; maxlength=&quot;10&quot; size=&quot;12&quot; name=&quot;{EndDate_Name}&quot; /&gt;
              &lt;!-- BEGIN DatePicker DatePicker_EndDate --&gt;&lt;a href=&quot;javascript:showDatePicker('{Name}','{FormName}','{DateControl}');&quot; id=&quot;Calendar_MonthViewEventDetailPanelEventDetailRecordDatePicker_EndDate&quot;&gt;&lt;img style=&quot;BORDER-BOTTOM: 0px; BORDER-LEFT: 0px; BORDER-TOP: 0px; BORDER-RIGHT: 0px&quot; id=&quot;Calendar_MonthViewEventDetailPanelEventDetailRecordDatePicker_EndDate_Image&quot; alt=&quot;Show Date Picker&quot; src=&quot;{page:pathToRoot}Styles/{CCS_Style}/Images/DatePicker.gif&quot; /&gt;&lt;/a&gt;&lt;!-- END DatePicker DatePicker_EndDate --&gt;&amp;nbsp; 
              &lt;!-- BEGIN ListBox EndTime --&gt;
              &lt;select id=&quot;Calendar_MonthViewEventDetailPanelEventDetailRecordEndTime&quot; name=&quot;{EndTime_Name}&quot;&gt;
                &lt;option selected=&quot;selected&quot; value=&quot;&quot;&gt;{res:CCS_SelectValue}&lt;/option&gt;
 {EndTime_Options} 
              &lt;/select&gt;
 &lt;!-- END ListBox EndTime --&gt;" PathID="Calendar_MonthViewEventDetailPanelEventDetailRecordEndDateTimePanel">
							<Components>
								<TextBox id="46" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="EndDate" wizardCaption="{res:calendar_item_end}" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_MonthViewEventDetailPanelEventDetailRecordEndDateTimePanelEndDate">
									<Components/>
									<Events>
										<Event name="OnValidate" type="Server">
											<Actions>
												<Action actionName="Validate Minimum Length" actionCategory="Validation" id="95" name="EndDate" minimumLength="1" errorMessage="{res:CRM_ErrorEnterEndDate}"/>
												<Action actionName="Regular Expression Validation" actionCategory="Validation" id="103" name="EndDate" regExp="/^\d{2}\/\d{2}\/\d{4}$/" errorMessage="{res:CRM_ErrorDateFormat}"/>
											</Actions>
										</Event>
									</Events>
									<Attributes/>
									<Features/>
								</TextBox>
								<DatePicker id="47" name="DatePicker_EndDate" control="EndDate" wizardSatellite="True" wizardControl="calendar_item_end" wizardDatePickerType="Image" wizardPicture="{page:pathToRoot}Styles/{CCS_Style}/Images/DatePicker.gif" style="{page:pathToRoot}Styles/{CCS_Style}/Style.css" PathID="Calendar_MonthViewEventDetailPanelEventDetailRecordEndDateTimePanelDatePicker_EndDate">
									<Components/>
									<Events/>
									<Attributes/>
									<Features/>
								</DatePicker>
								<ListBox id="61" visible="Dynamic" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="EndTime" wizardEmptyCaption="{res:CCS_SelectValue}" PathID="Calendar_MonthViewEventDetailPanelEventDetailRecordEndDateTimePanelEndTime" connection="Connection1" dataSource="lu_calendars_times" boundColumn="id" textColumn="time" validationRule="CCStrLen($this-&gt;EndTime-&gt;GetText()) &gt; 0" validationText="{res:CRM_ErrorChooseEndTime}" orderBy="HHiiSS">
									<Components/>
									<Events/>
									<TableParameters/>
									<SPParameters/>
									<SQLParameters/>
									<JoinTables>
										<JoinTable id="101" tableName="lu_calendars_times" posLeft="10" posTop="10" posWidth="95" posHeight="104"/>
									</JoinTables>
									<JoinLinks/>
									<Fields/>
									<Attributes/>
									<Features/>
								</ListBox>
							</Components>
							<Events/>
							<Attributes/>
							<Features/>
						</Panel>
						<Panel id="81" visible="True" name="StartDateTimeLabelPanel" PathID="Calendar_MonthViewEventDetailPanelEventDetailRecordStartDateTimeLabelPanel">
							<Components>
								<Label id="82" fieldSourceType="DBColumn" dataType="Text" html="False" name="StartDateTimeLabel" PathID="Calendar_MonthViewEventDetailPanelEventDetailRecordStartDateTimeLabelPanelStartDateTimeLabel">
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
						<Panel id="83" visible="True" name="EndDateTimeLabelPanel" PathID="Calendar_MonthViewEventDetailPanelEventDetailRecordEndDateTimeLabelPanel">
							<Components>
								<Label id="84" fieldSourceType="DBColumn" dataType="Text" html="False" name="EndDateTimeLabel" PathID="Calendar_MonthViewEventDetailPanelEventDetailRecordEndDateTimeLabelPanelEndDateTimeLabel">
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
						<Panel id="85" visible="True" name="DescriptionLabelPanel" PathID="Calendar_MonthViewEventDetailPanelEventDetailRecordDescriptionLabelPanel">
							<Components>
								<Label id="86" fieldSourceType="DBColumn" dataType="Text" html="True" name="DescriptionLabel" PathID="Calendar_MonthViewEventDetailPanelEventDetailRecordDescriptionLabelPanelDescriptionLabel">
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
					</Components>
					<Events>
						<Event name="OnLoad" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="54"/>
							</Actions>
						</Event>
						<Event name="BeforeInsert" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="62"/>
							</Actions>
						</Event>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Hide-Show Component" actionCategory="General" id="78" action="Hide" conditionType="Expression" dataType="Text" componentName="Button_Insert" condition="!CCGetUserID()"/>
								<Action actionName="Hide-Show Component" actionCategory="General" id="89" action="Hide" conditionType="Expression" dataType="Text" componentName="StartDateTimePanel" condition="!CCGetUserID()"/>
								<Action actionName="Hide-Show Component" actionCategory="General" id="90" action="Hide" conditionType="Expression" dataType="Text" componentName="StartDateTimeLabelPanel" condition="CCGetUserID()"/>
								<Action actionName="Hide-Show Component" actionCategory="General" id="91" action="Hide" conditionType="Expression" dataType="Text" componentName="EndDateTimePanel" condition="!CCGetUserID()"/>
								<Action actionName="Hide-Show Component" actionCategory="General" id="92" action="Hide" conditionType="Expression" dataType="Text" componentName="EndDateTimeLabelPanel" condition="CCGetUserID()"/>
								<Action actionName="Hide-Show Component" actionCategory="General" id="77" action="Hide" conditionType="Expression" dataType="Text" componentName="calendar_item_title" condition="!CCGetUserID()"/>
								<Action actionName="Hide-Show Component" actionCategory="General" id="76" action="Hide" conditionType="Expression" dataType="Text" componentName="TitleLabelPanel" condition="CCGetUserID()"/>
								<Action actionName="Hide-Show Component" actionCategory="General" id="87" action="Hide" conditionType="Expression" dataType="Text" componentName="calendar_item_description" condition="!CCGetUserID()"/>
								<Action actionName="Hide-Show Component" actionCategory="General" id="88" action="Hide" conditionType="Expression" dataType="Text" componentName="DescriptionLabelPanel" condition="CCGetUserID()"/>
							</Actions>
						</Event>
						<Event name="OnValidate" type="Server">
							<Actions>
								<Action actionName="Retrieve Value for Control" actionCategory="General" id="98" name="calendar_item_start" sourceType="Expression" sourceName="CCFormatDate(CCParseDate($Container-&gt;StartDate-&gt;GetValue() . &quot; &quot; . $Container-&gt;StartTime-&gt;GetValue(), array(&quot;mm&quot;,&quot;/&quot;,&quot;dd&quot;,&quot;/&quot;,&quot;yyyy&quot;,&quot; &quot;,&quot;HH&quot;,&quot;:&quot;,&quot;nn&quot;,&quot;:&quot;,&quot;ss&quot;)), array(&quot;yyyy&quot;,&quot;-&quot;,&quot;mm&quot;,&quot;-&quot;,&quot;dd&quot;,&quot; &quot;,&quot;HH&quot;,&quot;:&quot;,&quot;nn&quot;,&quot;:&quot;,&quot;ss&quot;))"/>
								<Action actionName="Retrieve Value for Control" actionCategory="General" id="99" name="calendar_item_end" sourceType="Expression" sourceName="CCFormatDate(CCParseDate($Container-&gt;EndDate-&gt;GetValue() . &quot; &quot; . $Container-&gt;EndTime-&gt;GetValue(), array(&quot;mm&quot;,&quot;/&quot;,&quot;dd&quot;,&quot;/&quot;,&quot;yyyy&quot;,&quot; &quot;,&quot;HH&quot;,&quot;:&quot;,&quot;nn&quot;,&quot;:&quot;,&quot;ss&quot;)), array(&quot;yyyy&quot;,&quot;-&quot;,&quot;mm&quot;,&quot;-&quot;,&quot;dd&quot;,&quot; &quot;,&quot;HH&quot;,&quot;:&quot;,&quot;nn&quot;,&quot;:&quot;,&quot;ss&quot;))"/>
								<Action actionName="Custom Code" actionCategory="General" id="97"/>
							</Actions>
						</Event>
					</Events>
					<TableParameters>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="50" tableName="tbl_calendars_items" posLeft="10" posTop="10" posWidth="279" posHeight="310"/>
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
			<Events/>
			<Attributes/>
			<Features>
				<UpdatePanel id="35" enabled="True" childrenAsTriggers="True" name="UpdatePanel" category="Ajax">
					<Components/>
					<Events/>
					<ControlPoints/>
					<Features/>
				</UpdatePanel>
				<ShowModal id="53" enabled="True" name="ShowModal1" category="Ajax" featureNameChanged="No">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<ControlPoints/>
					<Features/>
				</ShowModal>
			</Features>
		</Panel>
		<Panel id="55" visible="True" name="CalendarPanel" PathID="Calendar_MonthViewCalendarPanel" features="(assigned)" pasteActions="pasteActions">
			<Components>
				<IncludePage id="23" name="Calendar_Select" PathID="Calendar_MonthViewCalendarPanelCalendar_Select" page="Calendar_Select.ccp">
					<Components/>
					<Events/>
					<Features/>
				</IncludePage>
				<Calendar id="2" months="1" secured="False" showOtherMonthsDays="True" monthsInRow="4" sourceType="Table" name="Cal" connection="Connection1" dataSource="tbl_calendars_items" dateField="calendar_item_start">
					<Components>
						<Link id="15" fieldSourceType="CalendarSpecialValue" dataType="Date" html="False" name="DayOfWeek" fieldSource="CurrentProcessingDate" format="dddd" PathID="Calendar_MonthViewCalendarPanelCalDayOfWeek" visible="Dynamic" hrefType="Page" urlType="Relative" preserveParameters="GET">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="104"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
							<LinkParameters/>
						</Link>
						<Link id="17" fieldSourceType="CalendarSpecialValue" dataType="Date" html="False" name="DayNumber" fieldSource="CurrentProcessingDate" format="d" PathID="Calendar_MonthViewCalendarPanelCalDayNumber" visible="Dynamic" hrefType="Page" urlType="Relative" preserveParameters="GET">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="105"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
							<LinkParameters/>
						</Link>
						<CalendarNavigator id="4" yearsRange="10" name="Navigator">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</CalendarNavigator>
						<Hidden id="28" fieldSourceType="DBColumn" dataType="Integer" name="calendar_item_id" fieldSource="calendar_item_id" PathID="Calendar_MonthViewCalendarPanelCalcalendar_item_id">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<Hidden id="29" fieldSourceType="DBColumn" dataType="Date" name="calendar_item_start" fieldSource="calendar_item_start" PathID="Calendar_MonthViewCalendarPanelCalcalendar_item_start">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<Hidden id="30" fieldSourceType="DBColumn" dataType="Text" name="calendar_item_end" fieldSource="calendar_item_end" PathID="Calendar_MonthViewCalendarPanelCalcalendar_item_end">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<Hidden id="31" fieldSourceType="DBColumn" dataType="Text" name="calendar_item_title" fieldSource="calendar_item_title" PathID="Calendar_MonthViewCalendarPanelCalcalendar_item_title">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<Hidden id="32" fieldSourceType="DBColumn" dataType="Text" name="calendar_item_description" fieldSource="calendar_item_description" PathID="Calendar_MonthViewCalendarPanelCalcalendar_item_description">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<Panel id="51" visible="True" name="EventPanel" features="(assigned)" PathID="Calendar_MonthViewCalendarPanelCalEventPanel">
							<Components>
								<Link id="26" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="None" name="EventLink" fieldSource="calendar_item_id" PathID="Calendar_MonthViewCalendarPanelCalEventPanelEventLink" hrefSource="modal">
									<Components/>
									<Events>
										<Event name="BeforeShow" type="Server">
											<Actions>
												<Action actionName="Custom Code" actionCategory="General" id="57" eventType="Server"/>
											</Actions>
										</Event>
									</Events>
									<LinkParameters>
										<LinkParameter id="33" sourceType="DataField" format="yyyy-mm-dd" name="id" source="calendar_item_id"/>
									</LinkParameters>
									<Attributes/>
									<Features/>
								</Link>
							</Components>
							<Events/>
							<Attributes/>
							<Features/>
						</Panel>
					</Components>
					<Events/>
					<TableParameters>
						<TableParameter id="25" conditionType="Parameter" useIsNull="False" field="calendar_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" parameterSource="c" logicOperator="And"/>
						<TableParameter id="3" conditionType="Parameter" useIsNull="False" field="calendar_item_start" dataType="Date" searchConditionType="Between" parameterType="CalendarSpecialValue" parameterSource="DateRange" logicOperator="AND" orderNumber="2" leftBrackets="0" rightBrackets="0"/>
					</TableParameters>
					<JoinTables>
						<JoinTable id="24" tableName="tbl_calendars_items" posWidth="260" posHeight="399" posLeft="10" posTop="10"/>
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
			</Components>
			<Events/>
			<Attributes/>
			<Features>
				<UpdatePanel id="56" enabled="True" childrenAsTriggers="True" name="UpdatePanel1" category="Ajax">
					<Components/>
					<Events/>
					<ControlPoints/>
					<Features/>
				</UpdatePanel>
			</Features>
		</Panel>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="Calendar_MonthView.php" forShow="True" url="Calendar_MonthView.php" comment="//" codePage="utf-8"/>
		<CodeFile id="Events" language="PHPTemplates" name="Calendar_MonthView_events.php" forShow="False" comment="//" codePage="utf-8"/>
		<CodeFile id="modal" language="PHPTemplates" name="Calendar_MonthView_style.css" forShow="False" comment="/*" commentEnd="*/" codePage="utf-8"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="BeforeShow" type="Server">
			<Actions>
				<Action actionName="Declare Variable" actionCategory="General" id="106" name="FileName" initialValue="$FileName"/>
<Action actionName="Call Function" actionCategory="General" id="107" function="header" parameter1="($Container-&gt;Visible == true AND CCGetParam(&quot;YearDate&quot;, &quot;&quot;)) ? &quot;Location: &quot; . $FileName . &quot;?&quot; . CCRemoveParam(CCGetQueryString(&quot;QueryString&quot;, &quot;&quot;), &quot;YearDate&quot;) : &quot;&quot;"/>
<Action actionName="Call Function" actionCategory="General" id="108" function="header" parameter1="($Container-&gt;Visible == true AND CCGetParam(&quot;WeekNum&quot;, &quot;&quot;)) ? &quot;Location: &quot; . $FileName . &quot;?&quot; . CCRemoveParam(CCGetQueryString(&quot;QueryString&quot;, &quot;&quot;), &quot;WeekNum&quot;) : &quot;&quot;"/>
<Action actionName="Call Function" actionCategory="General" id="109" function="header" parameter1="($Container-&gt;Visible == true AND CCGetParam(&quot;DayNum&quot;, &quot;&quot;)) ? &quot;Location: &quot; . $FileName . &quot;?&quot; . CCRemoveParam(CCGetQueryString(&quot;QueryString&quot;, &quot;&quot;), &quot;DayNum&quot;) : &quot;&quot;"/>
</Actions>
		</Event>
	</Events>
</Page>
