<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\Calendar" secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="ItemsSearch" wizardCaption="{res:CCS_SearchFormPrefix} {res:tbl_calendars_items} {res:CCS_SearchFormSuffix}" wizardOrientation="Horizontal" wizardFormMethod="post" PathID="Calendar_CalendarItemsItemsSearch" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions">
			<Components>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="{res:CCS_Search}" PathID="Calendar_CalendarItemsItemsSearchButton_DoSearch" removeParameters="ItemsPage;ItemsPageSize;ItemsOrder;ItemsDir">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="130"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="CalEnd" wizardCaption="{res:calendar_item_end}" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" PathID="Calendar_CalendarItemsItemsSearchCalEnd">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve Value for Control" actionCategory="General" id="132" name="CalEnd" sourceType="Expression" sourceName="CCGetParam(&quot;ccsForm&quot;, &quot;&quot;) ? $Container-&gt;CalEnd-&gt;GetValue() : CCFormatDate(CCParseDate(CCGetParam(&quot;CalEnd&quot;,&quot;&quot;), array(&quot;yyyy&quot;,&quot;-&quot;,&quot;mm&quot;,&quot;-&quot;,&quot;dd&quot;)), array(&quot;mm&quot;,&quot;/&quot;,&quot;dd&quot;,&quot;/&quot;,&quot;yyyy&quot;))"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="8" name="DatePicker_CalEnd" control="CalEnd" wizardSatellite="True" wizardControl="s_calendar_item_end" wizardDatePickerType="Image" wizardPicture="{page:pathToRoot}Styles/{CCS_Style}/Images/DatePicker.gif" style="{page:pathToRoot}Styles/{CCS_Style}/Style.css" PathID="Calendar_CalendarItemsItemsSearchDatePicker_CalEnd">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<ListBox id="4" visible="Dynamic" fieldSourceType="DBColumn" dataType="Integer" name="c" wizardCaption="{res:calendar_id}" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" PathID="Calendar_CalendarItemsItemsSearchc" sourceType="Table" connection="Connection1" dataSource="tbl_calendars, tbl_calendars_private_users" boundColumn="calendar_id" textColumn="CalendarNameView" validationRule="CCStrLen($this-&gt;c-&gt;GetText()) &gt; 0" validationText="{res:CRM_ChooseCalendarError}" activeCollection="TableParameters" groupBy="tbl_calendars.calendar_id">
					<Components/>
					<Events>
						<Event name="BeforeBuildSelect" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="112"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
					<TableParameters>
						<TableParameter id="113" conditionType="Parameter" useIsNull="False" field="tbl_calendars.calendar_view" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="&quot;Public&quot;"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="74" tableName="tbl_calendars" posLeft="10" posTop="10" posWidth="226" posHeight="186"/>
						<JoinTable id="114" tableName="tbl_calendars_private_users" posLeft="335" posTop="10" posWidth="226" posHeight="131"/>
					</JoinTables>
					<JoinLinks>
						<JoinTable2 id="117" tableLeft="tbl_calendars" tableRight="tbl_calendars_private_users" fieldLeft="tbl_calendars.calendar_id" fieldRight="tbl_calendars_private_users.calendar_id" joinType="left" conditionType="Equal"/>
					</JoinLinks>
					<Fields>
						<Field id="110" fieldName="CONCAT(calendar_name, ' (', calendar_view, ')')" isExpression="True" alias="CalendarNameView"/>
						<Field id="116" tableName="tbl_calendars" fieldName="tbl_calendars.*"/>
					</Fields>
				</ListBox>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="CalStart" wizardCaption="{res:calendar_item_start}" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" PathID="Calendar_CalendarItemsItemsSearchCalStart">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve Value for Control" actionCategory="General" id="131" name="CalStart" sourceType="Expression" sourceName="CCGetParam(&quot;ccsForm&quot;, &quot;&quot;) ? $Container-&gt;CalStart-&gt;GetValue() : CCFormatDate(CCParseDate(CCGetParam(&quot;CalStart&quot;,&quot;&quot;), array(&quot;yyyy&quot;,&quot;-&quot;,&quot;mm&quot;,&quot;-&quot;,&quot;dd&quot;)), array(&quot;mm&quot;,&quot;/&quot;,&quot;dd&quot;,&quot;/&quot;,&quot;yyyy&quot;))"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="6" name="DatePicker_CalStart" control="CalStart" wizardSatellite="True" wizardControl="s_calendar_item_start" wizardDatePickerType="Image" wizardPicture="{page:pathToRoot}Styles/{CCS_Style}/Images/DatePicker.gif" style="{page:pathToRoot}Styles/{CCS_Style}/Style.css" PathID="Calendar_CalendarItemsItemsSearchDatePicker_CalStart">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<Button id="45" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Clear" PathID="Calendar_CalendarItemsItemsSearchButton_Clear" operation="Cancel" removeParameters="c;CalStart;CalEnd;ItemsPage;ItemsPageSize;ItemsOrder;ItemsDir">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="46" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Add" PathID="Calendar_CalendarItemsItemsSearchButton_Add">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Declare Variable" actionCategory="General" id="67" name="Redirect" initialValue="&quot;?p=CalendarItems&amp;action=AddEdit&quot;"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Hide-Show Component" actionCategory="General" id="68" action="Hide" conditionType="Expression" dataType="Text" componentName="ItemsSearch" condition="CCGetParam(&quot;action&quot;, &quot;&quot;) == &quot;AddEdit&quot;"/>
					</Actions>
				</Event>
			</Events>
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
		<EditableGrid id="9" urlType="Relative" secured="False" emptyRows="0" allowInsert="False" allowUpdate="False" allowDelete="True" validateData="True" preserveParameters="GET" sourceType="Table" defaultPageSize="10" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Connection1" dataSource="tbl_calendars_items" name="Items" orderBy="calendar_item_start" pageSizeLimit="100" wizardCaption="{res:CCS_GridFormPrefix} {res:tbl_calendars_items} {res:CCS_GridFormSuffix}" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAltRecord="False" wizardRecordSeparator="True" wizardNoRecords="{res:CCS_NoRecords}" PathID="Calendar_CalendarItemsItems" deleteControl="CheckBox_Delete" pasteActions="pasteActions" activeCollection="TableParameters">
			<Components>
				<Label id="11" fieldSourceType="DBColumn" dataType="Text" html="False" name="TotalRecords" wizardUseTemplateBlock="False" PathID="Calendar_CalendarItemsItemsTotalRecords">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="12"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="18" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="calendar_item_start" fieldSource="calendar_item_start" required="False" caption="{res:calendar_item_start}" wizardCaption="{res:calendar_item_start}" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_CalendarItemsItemscalendar_item_start" html="False" format="m/d/yy h:nnam/pm" DBFormat="yyyy-mm-dd HH:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="20" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="calendar_item_end" fieldSource="calendar_item_end" required="False" caption="{res:calendar_item_end}" wizardCaption="{res:calendar_item_end}" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_CalendarItemsItemscalendar_item_end" html="False" format="m/d/yy h:nnam/pm" DBFormat="yyyy-mm-dd HH:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="22" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="calendar_item_title" fieldSource="calendar_item_title" required="False" caption="{res:calendar_item_title}" wizardCaption="{res:calendar_item_title}" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_CalendarItemsItemscalendar_item_title" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<LinkParameters>
						<LinkParameter id="72" sourceType="Expression" name="action" source="&quot;AddEdit&quot;"/>
						<LinkParameter id="73" sourceType="DataField" name="id" source="calendar_item_id"/>
					</LinkParameters>
				</Link>
				<Panel id="39" visible="True" name="HeaderPanel" PathID="Calendar_CalendarItemsItemsHeaderPanel" pasteActions="pasteActions">
					<Components>
						<Sorter id="14" visible="True" name="Sorter_calendar_item_start" column="calendar_item_start" wizardCaption="{res:calendar_item_start}" wizardSortingType="SimpleDir" wizardControl="calendar_item_start" PathID="Calendar_CalendarItemsItemsHeaderPanelSorter_calendar_item_start">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
						<Sorter id="16" visible="True" name="Sorter_calendar_item_title" column="calendar_item_title" wizardCaption="{res:calendar_item_title}" wizardSortingType="SimpleDir" wizardControl="calendar_item_title" PathID="Calendar_CalendarItemsItemsHeaderPanelSorter_calendar_item_title">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
						<Panel id="40" visible="True" name="Header_ColumnAction" PathID="Calendar_CalendarItemsItemsHeaderPanelHeader_ColumnAction" pasteActions="pasteActions">
							<Components>
								<CheckBox id="28" visible="Yes" fieldSourceType="DBColumn" dataType="Boolean" name="CheckBox_SelectAll" PathID="Calendar_CalendarItemsItemsHeaderPanelHeader_ColumnActionCheckBox_SelectAll">
									<Components/>
									<Events>
										<Event name="OnClick" type="Client">
											<Actions>
												<Action actionName="Custom Code" actionCategory="General" id="104"/>
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
					</Components>
					<Events/>
					<Attributes/>
					<Features/>
				</Panel>
				<Panel id="41" visible="True" name="Data_ColumnAction" PathID="Calendar_CalendarItemsItemsData_ColumnAction" pasteActions="pasteActions">
					<Components>
						<CheckBox id="24" visible="Dynamic" fieldSourceType="CodeExpression" dataType="Boolean" name="CheckBox_Delete" checkedValue="true" uncheckedValue="false" wizardCaption="{res:CCS_Delete}" wizardAddNbsp="True" PathID="Calendar_CalendarItemsItemsData_ColumnActionCheckBox_Delete">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</CheckBox>
						<Hidden id="17" fieldSourceType="DBColumn" dataType="Integer" html="False" name="calendar_item_id" fieldSource="calendar_item_id" required="False" wizardCaption="{res:calendar_item_id}" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="Calendar_CalendarItemsItemsData_ColumnActioncalendar_item_id">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
					</Components>
					<Events/>
					<Attributes/>
					<Features/>
				</Panel>
				<Panel id="42" visible="True" name="FooterPanel" PathID="Calendar_CalendarItemsItemsFooterPanel" pasteActions="pasteActions">
					<Components>
						<Navigator id="25" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="{res:CCS_First}" wizardPrev="True" wizardPrevText="{res:CCS_Previous}" wizardNext="True" wizardNextText="{res:CCS_Next}" wizardLast="True" wizardLastText="{res:CCS_Last}" wizardImages="Images" wizardPageNumbers="Simple" wizardSize="5" wizardTotalPages="True" wizardHideDisabled="True" wizardPageSize="True" wizardImagesScheme="{ccs_style}">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Navigator>
						<Panel id="108" visible="True" name="ActionPanel" PathID="Calendar_CalendarItemsItemsFooterPanelActionPanel" pasteActions="pasteActions">
							<Components>
								<Button id="26" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="{res:CCS_Update}" PathID="Calendar_CalendarItemsItemsFooterPanelActionPanelButton_Submit">
									<Components/>
									<Events>
										<Event name="OnClick" type="Client">
											<Actions>
												<Action actionName="Confirmation Message" actionCategory="General" id="27" message="{res:CCS_SubmitConfirmation}" eventType="Client"/>
											</Actions>
										</Event>
										<Event name="OnClick" type="Server">
											<Actions>
												<Action actionName="Custom Code" actionCategory="General" id="44" eventType="Server"/>
											</Actions>
										</Event>
									</Events>
									<Attributes/>
									<Features/>
								</Button>
								<ListBox id="43" visible="Dynamic" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="action" wizardEmptyCaption="{res:CCS_SelectValue}" PathID="Calendar_CalendarItemsItemsFooterPanelActionPanelaction" connection="Connection1" _valueOfList="delete" _nameOfList="{res:CCS_Delete}" dataSource="delete;{res:CCS_Delete}">
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
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Hide-Show Component" actionCategory="General" id="29" action="Hide" conditionType="Expression" dataType="Text" componentName="Items" condition="!CCGetParam(&quot;c&quot;, &quot;&quot;)"/>
						<Action actionName="Hide-Show Component" actionCategory="General" id="106" action="Hide" conditionType="Expression" dataType="Text" componentName="Header_ColumnAction" condition="CCGetParam(&quot;action&quot;, &quot;&quot;)"/>
						<Action actionName="Hide-Show Component" actionCategory="General" id="107" action="Hide" conditionType="Expression" dataType="Text" componentName="Data_ColumnAction" condition="CCGetParam(&quot;action&quot;, &quot;&quot;)"/>
						<Action actionName="Hide-Show Component" actionCategory="General" id="109" action="Hide" conditionType="Expression" dataType="Text" componentName="ActionPanel" condition="CCGetParam(&quot;action&quot;, &quot;&quot;)"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="36" conditionType="Parameter" useIsNull="False" field="calendar_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="c"/>
				<TableParameter id="37" conditionType="Parameter" useIsNull="False" field="calendar_item_start" dataType="Date" searchConditionType="GreaterThanOrEqual" parameterType="URL" logicOperator="And" DBFormat="yyyy-mm-dd HH:nn:ss" format="yyyy-mm-dd" leftBrackets="1" parameterSource="CalStart"/>
				<TableParameter id="38" conditionType="Expression" useIsNull="False" field="calendar_item_end" dataType="Date" searchConditionType="LessThanOrEqual" parameterType="URL" logicOperator="And" DBFormat="yyyy-mm-dd HH:nn:ss" format="yyyy-mm-dd" rightBrackets="1" expression="calendar_item_end &lt;= DATE_ADD(&quot; . CCToSQL(CCGetParam(&quot;CalEnd&quot;, &quot;&quot;), ccsDate) . &quot;, INTERVAL 1 DAY)" parameterSource="CalEnd"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="30" tableName="tbl_calendars_items" posLeft="10" posTop="10" posWidth="273" posHeight="401"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="31" tableName="tbl_calendars_items" fieldName="calendar_item_id"/>
				<Field id="32" tableName="tbl_calendars_items" fieldName="calendar_id"/>
				<Field id="33" tableName="tbl_calendars_items" fieldName="calendar_item_start"/>
				<Field id="34" tableName="tbl_calendars_items" fieldName="calendar_item_end"/>
				<Field id="35" tableName="tbl_calendars_items" fieldName="calendar_item_title"/>
			</Fields>
			<PKFields>
				<PKField id="10" tableName="tbl_calendars_items" fieldName="calendar_item_id" dataType="Integer"/>
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
		<Record id="47" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Connection1" name="ItemAddEdit" dataSource="tbl_calendars_items" errorSummator="Error" wizardCaption="{res:CCS_RecordFormPrefix} {res:tbl_calendars_items} {res:CCS_RecordFormSuffix}" wizardFormMethod="post" PathID="Calendar_CalendarItemsItemAddEdit" activeCollection="TableParameters">
			<Components>
				<Button id="48" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="{res:CCS_Insert}" PathID="Calendar_CalendarItemsItemAddEditButton_Insert" removeParameters="action">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="49" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="{res:CCS_Update}" PathID="Calendar_CalendarItemsItemAddEditButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="50" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="{res:CCS_Delete}" PathID="Calendar_CalendarItemsItemAddEditButton_Delete">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="51" message="{res:CCS_DeleteConfirmation}"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="52" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="{res:CCS_Cancel}" PathID="Calendar_CalendarItemsItemAddEditButton_Cancel" removeParameters="action;id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<ListBox id="54" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" returnValueType="Number" name="calendar_id" fieldSource="calendar_id" wizardCaption="{res:calendar_id}" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="{res:CCS_SelectValue}" PathID="Calendar_CalendarItemsItemAddEditcalendar_id" connection="Connection1" dataSource="tbl_calendars, tbl_calendars_private_users" boundColumn="calendar_id" textColumn="CalendarNameView" validationRule="CCStrLen($this-&gt;calendar_id-&gt;GetText()) &gt; 0" validationText="{res:CRM_ChooseCalendarError}" defaultValue="CCGetParam(&quot;c&quot;, &quot;&quot;)" groupBy="tbl_calendars.calendar_id" activeCollection="TableParameters">
					<Components/>
					<Events>
						<Event name="BeforeBuildSelect" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="126"/>
							</Actions>
						</Event>
					</Events>
					<TableParameters>
						<TableParameter id="125" conditionType="Parameter" useIsNull="False" field="tbl_calendars.calendar_view" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="&quot;Public&quot;"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="118" tableName="tbl_calendars" posLeft="10" posTop="10" posWidth="182" posHeight="164"/>
						<JoinTable id="121" tableName="tbl_calendars_private_users" posLeft="262" posTop="10" posWidth="232" posHeight="112"/>
					</JoinTables>
					<JoinLinks>
						<JoinTable2 id="124" tableLeft="tbl_calendars" tableRight="tbl_calendars_private_users" fieldLeft="tbl_calendars.calendar_id" fieldRight="tbl_calendars_private_users.calendar_id" joinType="left" conditionType="Equal"/>
					</JoinLinks>
					<Fields>
						<Field id="119" fieldName="CONCAT(calendar_name, ' (', calendar_view, ')')" isExpression="True" alias="CalendarNameView"/>
						<Field id="123" tableName="tbl_calendars" fieldName="tbl_calendars.*"/>
					</Fields>
					<Attributes/>
					<Features/>
				</ListBox>
				<TextBox id="55" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="StartDate" wizardCaption="{res:calendar_item_start}" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_CalendarItemsItemAddEditStartDate">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve Value for Control" actionCategory="General" id="98" name="StartDate" sourceType="Expression" sourceName="CCFormatDate(CCParseDate($Container-&gt;ds-&gt;f(&quot;calendar_item_start&quot;), array(&quot;yyyy&quot;, &quot;-&quot;, &quot;mm&quot;, &quot;-&quot;, &quot;dd&quot;, &quot; &quot;, &quot;HH&quot;, &quot;:&quot;, &quot;nn&quot;, &quot;:&quot;, &quot;ss&quot;)), array(&quot;mm&quot;, &quot;/&quot;, &quot;dd&quot;, &quot;/&quot;, &quot;yyyy&quot;))"/>
							</Actions>
						</Event>
						<Event name="OnValidate" type="Server">
							<Actions>
								<Action actionName="Validate Minimum Length" actionCategory="Validation" id="102" name="StartDate" minimumLength="1" errorMessage="{res:CRM_ErrorEnterStartDate}"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="56" name="DatePicker_StartDate" control="StartDate" wizardSatellite="True" wizardControl="calendar_item_start" wizardDatePickerType="Image" wizardPicture="{page:pathToRoot}Styles/{CCS_Style}/Images/DatePicker.gif" style="{page:pathToRoot}Styles/{CCS_Style}/Style.css" PathID="Calendar_CalendarItemsItemAddEditDatePicker_StartDate">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<TextBox id="57" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="EndDate" wizardCaption="{res:calendar_item_end}" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_CalendarItemsItemAddEditEndDate">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve Value for Control" actionCategory="General" id="100" name="EndDate" sourceType="Expression" sourceName="CCFormatDate(CCParseDate($Container-&gt;ds-&gt;f(&quot;calendar_item_end&quot;), array(&quot;yyyy&quot;, &quot;-&quot;, &quot;mm&quot;, &quot;-&quot;, &quot;dd&quot;, &quot; &quot;, &quot;HH&quot;, &quot;:&quot;, &quot;nn&quot;, &quot;:&quot;, &quot;ss&quot;)), array(&quot;mm&quot;, &quot;/&quot;, &quot;dd&quot;, &quot;/&quot;, &quot;yyyy&quot;))"/>
							</Actions>
						</Event>
						<Event name="OnValidate" type="Server">
							<Actions>
								<Action actionName="Validate Minimum Length" actionCategory="Validation" id="127" name="EndDate" minimumLength="1" errorMessage="{res:CRM_ErrorEnterEndDate}"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="58" name="DatePicker_EndDate" control="EndDate" wizardSatellite="True" wizardControl="calendar_item_end" wizardDatePickerType="Image" wizardPicture="{page:pathToRoot}Styles/{CCS_Style}/Images/DatePicker.gif" style="{page:pathToRoot}Styles/{CCS_Style}/Style.css" PathID="Calendar_CalendarItemsItemAddEditDatePicker_EndDate">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<TextBox id="59" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="calendar_item_title" fieldSource="calendar_item_title" caption="{res:calendar_item_title}" wizardCaption="{res:calendar_item_title}" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_CalendarItemsItemAddEditcalendar_item_title">
					<Components/>
					<Events>
						<Event name="OnValidate" type="Server">
							<Actions>
								<Action actionName="Validate Minimum Length" actionCategory="Validation" id="82" name="calendar_item_title" minimumLength="5" errorMessage="{res:CRM_ErrorMoreDescriptiveTitle}"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextArea id="60" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="calendar_item_description" fieldSource="calendar_item_description" required="False" caption="{res:calendar_item_description}" wizardCaption="{res:calendar_item_description}" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="Calendar_CalendarItemsItemAddEditcalendar_item_description">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<Hidden id="61" fieldSourceType="DBColumn" dataType="Integer" name="calendar_item_entered_by" fieldSource="calendar_item_entered_by" required="False" caption="{res:calendar_item_entered_by}" wizardCaption="{res:calendar_item_entered_by}" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_CalendarItemsItemAddEditcalendar_item_entered_by">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="62" fieldSourceType="DBColumn" dataType="Date" name="calendar_item_entered_date" fieldSource="calendar_item_entered_date" required="False" caption="{res:calendar_item_entered_date}" wizardCaption="{res:calendar_item_entered_date}" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_CalendarItemsItemAddEditcalendar_item_entered_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="63" fieldSourceType="DBColumn" dataType="Integer" name="calendar_item_updated_by" fieldSource="calendar_item_updated_by" required="False" caption="{res:calendar_item_updated_by}" wizardCaption="{res:calendar_item_updated_by}" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_CalendarItemsItemAddEditcalendar_item_updated_by">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="64" fieldSourceType="DBColumn" dataType="Date" name="calendar_item_updated_date" fieldSource="calendar_item_updated_date" required="False" caption="{res:calendar_item_updated_date}" wizardCaption="{res:calendar_item_updated_date}" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_CalendarItemsItemAddEditcalendar_item_updated_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="69" fieldSourceType="DBColumn" dataType="Text" html="False" name="AddEditLabel" PathID="Calendar_CalendarItemsItemAddEditAddEditLabel">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Declare Variable" actionCategory="General" id="70" name="CCSLocales" initialValue="$CCSLocales"/>
								<Action actionName="Retrieve Value for Control" actionCategory="General" id="71" name="AddEditLabel" sourceType="Expression" sourceName="(CCGetParam(&quot;action&quot;, &quot;&quot;) == &quot;AddEdit&quot; AND !CCGetParam(&quot;id&quot;, &quot;&quot;)) ? $CCSLocales-&gt;GetText(&quot;CRM_NewCalendarItem&quot;) : $CCSLocales-&gt;GetText(&quot;CRM_EditCalendarItem&quot;)"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<ListBox id="76" visible="Dynamic" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="StartTime" wizardEmptyCaption="{res:CCS_SelectValue}" PathID="Calendar_CalendarItemsItemAddEditStartTime" connection="Connection1" dataSource="lu_calendars_times" boundColumn="id" textColumn="time" validationRule="CCStrLen($this-&gt;StartTime-&gt;GetText()) &gt; 0" validationText="{res:CRM_ErrorChooseStartTime}" orderBy="HHiiSS">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve Value for Control" actionCategory="General" id="99" name="StartTime" sourceType="Expression" sourceName="CCFormatDate(CCParseDate($Container-&gt;ds-&gt;f(&quot;calendar_item_start&quot;), array(&quot;yyyy&quot;, &quot;-&quot;, &quot;mm&quot;, &quot;-&quot;, &quot;dd&quot;, &quot; &quot;, &quot;HH&quot;, &quot;:&quot;, &quot;nn&quot;, &quot;:&quot;, &quot;ss&quot;)), array(&quot;HH&quot;, &quot;:&quot;, &quot;nn&quot;, &quot;:&quot;, &quot;ss&quot;))"/>
							</Actions>
						</Event>
					</Events>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="89" tableName="lu_calendars_times" posLeft="10" posTop="10" posWidth="95" posHeight="104"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<ListBox id="77" visible="Dynamic" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="EndTime" wizardEmptyCaption="{res:CCS_SelectValue}" PathID="Calendar_CalendarItemsItemAddEditEndTime" connection="Connection1" dataSource="lu_calendars_times" boundColumn="id" textColumn="time" validationRule="CCStrLen($this-&gt;EndTime-&gt;GetText()) &gt; 0" validationText="{res:CRM_ErrorChooseEndTime}" orderBy="HHiiSS">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve Value for Control" actionCategory="General" id="101" name="EndTime" sourceType="Expression" sourceName="CCFormatDate(CCParseDate($Container-&gt;ds-&gt;f(&quot;calendar_item_end&quot;), array(&quot;yyyy&quot;, &quot;-&quot;, &quot;mm&quot;, &quot;-&quot;, &quot;dd&quot;, &quot; &quot;, &quot;HH&quot;, &quot;:&quot;, &quot;nn&quot;, &quot;:&quot;, &quot;ss&quot;)), array(&quot;HH&quot;, &quot;:&quot;, &quot;nn&quot;, &quot;:&quot;, &quot;ss&quot;))"/>
							</Actions>
						</Event>
					</Events>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="90" tableName="lu_calendars_times" posLeft="10" posTop="10" posWidth="95" posHeight="104"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<Hidden id="83" fieldSourceType="DBColumn" dataType="Date" name="calendar_item_start" PathID="Calendar_CalendarItemsItemAddEditcalendar_item_start" fieldSource="calendar_item_start" DBFormat="yyyy-mm-dd HH:nn:ss" format="yyyy-mm-dd HH:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="84" fieldSourceType="DBColumn" dataType="Date" name="calendar_item_end" PathID="Calendar_CalendarItemsItemAddEditcalendar_item_end" fieldSource="calendar_item_end" format="yyyy-mm-dd HH:nn:ss" DBFormat="yyyy-mm-dd HH:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Hide-Show Component" actionCategory="General" id="65" action="Hide" conditionType="Expression" dataType="Text" componentName="ItemAddEdit" condition="CCGetParam(&quot;action&quot;, &quot;&quot;) &lt;&gt; &quot;AddEdit&quot;"/>
					</Actions>
				</Event>
				<Event name="OnLoad" type="Client">
					<Actions>
						<Action actionName="Set Focus" actionCategory="General" id="75" name="calendar_id"/>
					</Actions>
				</Event>
				<Event name="OnValidate" type="Server">
					<Actions>
						<Action actionName="Retrieve Value for Control" actionCategory="General" id="92" name="calendar_item_start" sourceType="Expression" sourceName="CCParseDate($Container-&gt;StartDate-&gt;GetValue() . &quot; &quot; . $Container-&gt;StartTime-&gt;GetValue(), array(&quot;mm&quot;,&quot;/&quot;,&quot;dd&quot;,&quot;/&quot;,&quot;yyyy&quot;,&quot; &quot;,&quot;HH&quot;,&quot;:&quot;,&quot;nn&quot;,&quot;:&quot;,&quot;ss&quot;))"/>
						<Action actionName="Retrieve Value for Control" actionCategory="General" id="97" name="calendar_item_end" sourceType="Expression" sourceName="CCParseDate($Container-&gt;EndDate-&gt;GetValue() . &quot; &quot; . $Container-&gt;EndTime-&gt;GetValue(), array(&quot;mm&quot;,&quot;/&quot;,&quot;dd&quot;,&quot;/&quot;,&quot;yyyy&quot;,&quot; &quot;,&quot;HH&quot;,&quot;:&quot;,&quot;nn&quot;,&quot;:&quot;,&quot;ss&quot;))"/>
						<Action actionName="Custom Code" actionCategory="General" id="105"/>
					</Actions>
				</Event>
				<Event name="AfterUpdate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="103"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="53" conditionType="Parameter" useIsNull="False" field="calendar_item_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1" parameterSource="id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="66" tableName="tbl_calendars_items" posLeft="10" posTop="10" posWidth="236" posHeight="357"/>
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
		<CodeFile id="Code" language="PHPTemplates" name="Calendar_CalendarItems.php" forShow="True" url="Calendar_CalendarItems.php" comment="//" codePage="utf-8"/>
		<CodeFile id="Events" language="PHPTemplates" name="Calendar_CalendarItems_events.php" forShow="False" comment="//" codePage="utf-8"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
