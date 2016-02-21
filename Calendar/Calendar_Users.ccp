<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\Calendar" secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="UsersSearch" wizardCaption="{res:CCS_SearchFormPrefix} {res:tbl_users} {res:CCS_SearchFormSuffix}" wizardOrientation="Horizontal" wizardFormMethod="post" PathID="Calendar_UsersUsersSearch" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="True" name="Button_DoSearch" operation="Search" wizardCaption="{res:CCS_Search}" PathID="Calendar_UsersUsersSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<ListBox id="5" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" name="u" wizardCaption="{res:user_login}" wizardSize="50" wizardMaxLength="75" wizardIsPassword="False" PathID="Calendar_UsersUsersSearchu" sourceType="Table" connection="Connection1" dataSource="tbl_users" boundColumn="user_id" textColumn="user_login">
					<Components/>
					<Events>
						<Event name="BeforeBuildSelect" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="167"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="166" tableName="tbl_users" posLeft="10" posTop="10" posWidth="200" posHeight="297"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
				</ListBox>
				<ListBox id="6" visible="Dynamic" fieldSourceType="DBColumn" dataType="Integer" name="g" wizardCaption="{res:group_id}" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" PathID="Calendar_UsersUsersSearchg" sourceType="Table" connection="Connection1" dataSource="tbl_groups" boundColumn="group_id" textColumn="group_name">
					<Components/>
					<Events>
						<Event name="BeforeBuildSelect" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="168"/>
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
				</ListBox>
				<TextBox id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="n" wizardCaption="{res:first_name}" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" PathID="Calendar_UsersUsersSearchn">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="8" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Clear" PathID="Calendar_UsersUsersSearchButton_Clear" removeParameters="action;id;g;n;u;UsersGridOrder;UsersGridDir;SorterLastName;SorterLogin;SorterGroup;UsersGridPage;UsersGridPageSize">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="9" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Add" PathID="Calendar_UsersUsersSearchButton_Add">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Declare Variable" actionCategory="General" id="10" name="Redirect" initialValue="&quot;?p=Users&amp;action=AddEdit&quot;"/>
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
						<Action actionName="Hide-Show Component" actionCategory="General" id="119" action="Hide" conditionType="Expression" dataType="Text" componentName="UsersSearch" condition="CCGetParam(&quot;action&quot;, &quot;&quot;) == &quot;AddEdit&quot;"/>
					</Actions>
				</Event>
				<Event name="OnValidate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="121"/>
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
		<EditableGrid id="11" urlType="Relative" secured="False" emptyRows="0" allowInsert="False" allowUpdate="False" allowDelete="True" validateData="True" preserveParameters="GET" sourceType="Table" defaultPageSize="10" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Connection1" dataSource="tbl_users" name="UsersGrid" pageSizeLimit="100" wizardCaption="{res:CCS_GridFormPrefix} {res:tbl_users} {res:CCS_GridFormSuffix}" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAltRecord="False" wizardRecordSeparator="True" wizardNoRecords="{res:CCS_NoRecords}" PathID="Calendar_UsersUsersGrid" deleteControl="CheckBox_Delete" activeCollection="TableParameters" pasteActions="pasteActions">
			<Components>
				<Label id="13" fieldSourceType="DBColumn" dataType="Text" html="False" name="TotalRecords" wizardUseTemplateBlock="False" PathID="Calendar_UsersUsersGridTotalRecords">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="14"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="19" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="user_name" required="False" caption="{res:last_name}" wizardCaption="{res:last_name}" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_UsersUsersGriduser_name" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" fieldSource="Name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<LinkParameters>
						<LinkParameter id="34" sourceType="Expression" name="action" source="&quot;AddEdit&quot;"/>
						<LinkParameter id="35" sourceType="DataField" name="id" source="user_id"/>
					</LinkParameters>
				</Link>
				<Label id="21" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="user_login" fieldSource="user_login" required="False" caption="{res:user_login}" wizardCaption="{res:user_login}" wizardSize="50" wizardMaxLength="75" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_UsersUsersGriduser_login" html="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="22" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="group" required="False" caption="{res:group_id}" wizardCaption="{res:group_id}" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_UsersUsersGridgroup" html="False">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="DLookup" actionCategory="Database" id="38" typeOfTarget="Control" expression="&quot;group_name&quot;" domain="&quot;tbl_groups&quot;" criteria="&quot;group_id=&quot; . CCToSQL($Container-&gt;ds-&gt;f(&quot;group_id&quot;), ccsInteger)" connection="Connection1" dataType="Text" target="group"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Panel id="134" visible="True" name="Data_ColumnAction" PathID="Calendar_UsersUsersGridData_ColumnAction" pasteActions="pasteActions">
					<Components>
						<CheckBox id="24" visible="Dynamic" fieldSourceType="CodeExpression" dataType="Boolean" name="CheckBox_Delete" checkedValue="true" uncheckedValue="false" wizardCaption="{res:CCS_Delete}" wizardAddNbsp="True" PathID="Calendar_UsersUsersGridData_ColumnActionCheckBox_Delete">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</CheckBox>
						<Hidden id="139" fieldSourceType="DBColumn" dataType="Integer" name="user_id" PathID="Calendar_UsersUsersGridData_ColumnActionuser_id" fieldSource="user_id">
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
				<Panel id="136" visible="True" name="FooterPanel" PathID="Calendar_UsersUsersGridFooterPanel" pasteActions="pasteActions">
					<Components>
						<Navigator id="25" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="{res:CCS_First}" wizardPrev="True" wizardPrevText="{res:CCS_Previous}" wizardNext="True" wizardNextText="{res:CCS_Next}" wizardLast="True" wizardLastText="{res:CCS_Last}" wizardImages="Images" wizardPageNumbers="Simple" wizardSize="5" wizardTotalPages="True" wizardHideDisabled="True" wizardPageSize="True" wizardImagesScheme="{ccs_style}">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Navigator>
						<Panel id="145" visible="True" name="ActionPanel" PathID="Calendar_UsersUsersGridFooterPanelActionPanel" pasteActions="pasteActions">
							<Components>
								<ListBox id="137" visible="Dynamic" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="action" wizardEmptyCaption="{res:CCS_SelectValue}" PathID="Calendar_UsersUsersGridFooterPanelActionPanelaction" connection="Connection1" _valueOfList="delete" _nameOfList="{res:CCS_Delete}" dataSource="delete;{res:CCS_Delete}">
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
								<Button id="26" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="{res:CCS_Update}" PathID="Calendar_UsersUsersGridFooterPanelActionPanelButton_Submit">
									<Components/>
									<Events>
										<Event name="OnClick" type="Client">
											<Actions>
												<Action actionName="Confirmation Message" actionCategory="General" id="27" message="{res:CCS_SubmitConfirmation}" eventType="Client"/>
											</Actions>
										</Event>
										<Event name="OnClick" type="Server">
											<Actions>
												<Action actionName="Custom Code" actionCategory="General" id="138" eventType="Server"/>
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
				<Panel id="140" visible="True" name="HeaderPanel" PathID="Calendar_UsersUsersGridHeaderPanel" pasteActions="pasteActions">
					<Components>
						<Sorter id="15" visible="True" name="SorterLastName" column="last_name" wizardCaption="{res:last_name}" wizardSortingType="SimpleDir" wizardControl="last_name" PathID="Calendar_UsersUsersGridHeaderPanelSorterLastName">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
						<Sorter id="17" visible="True" name="SorterLogin" column="user_login" wizardCaption="{res:user_login}" wizardSortingType="SimpleDir" wizardControl="user_login" PathID="Calendar_UsersUsersGridHeaderPanelSorterLogin">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
						<Sorter id="18" visible="True" name="SorterGroup" column="group_id" wizardCaption="{res:group_id}" wizardSortingType="SimpleDir" wizardControl="group_id" PathID="Calendar_UsersUsersGridHeaderPanelSorterGroup">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
						<Panel id="133" visible="True" name="Header_ColumnAction" PathID="Calendar_UsersUsersGridHeaderPanelHeader_ColumnAction" pasteActions="pasteActions">
							<Components>
								<CheckBox id="132" visible="Dynamic" fieldSourceType="DBColumn" dataType="Boolean" name="CheckBox_SelectAll" PathID="Calendar_UsersUsersGridHeaderPanelHeader_ColumnActionCheckBox_SelectAll">
									<Components/>
									<Events>
										<Event name="OnClick" type="Client">
											<Actions>
												<Action actionName="Custom Code" actionCategory="General" id="135" eventType="Client"/>
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
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Hide-Show Component" actionCategory="General" id="28" action="Hide" conditionType="Expression" dataType="Text" componentName="UsersGrid" condition="!CCGetParam(&quot;n&quot;, &quot;&quot;) AND !CCGetParam(&quot;g&quot;, &quot;&quot;) AND !CCGetParam(&quot;u&quot;, &quot;&quot;)"/>
						<Action actionName="Hide-Show Component" actionCategory="General" id="141" action="Hide" conditionType="Expression" dataType="Text" componentName="Header_ColumnAction" condition="CCGetParam(&quot;action&quot;, &quot;&quot;)"/>
						<Action actionName="Hide-Show Component" actionCategory="General" id="142" action="Hide" conditionType="Expression" dataType="Text" componentName="Data_ColumnAction" condition="CCGetParam(&quot;action&quot;, &quot;&quot;)"/>
						<Action actionName="Hide-Show Component" actionCategory="General" id="146" action="Hide" conditionType="Expression" dataType="Text" componentName="ActionPanel" condition="CCGetParam(&quot;action&quot;, &quot;&quot;)"/>
					</Actions>
				</Event>
				<Event name="BeforeBuildSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="169"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="30" conditionType="Parameter" useIsNull="False" field="user_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="u"/>
				<TableParameter id="31" conditionType="Parameter" useIsNull="False" field="group_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="g"/>
				<TableParameter id="32" conditionType="Parameter" useIsNull="False" field="first_name" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="Or" parameterSource="n" leftBrackets="1"/>
				<TableParameter id="33" conditionType="Parameter" useIsNull="False" field="last_name" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="And" parameterSource="n" rightBrackets="1"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="29" tableName="tbl_users" posLeft="10" posTop="10" posWidth="270" posHeight="330"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="37" fieldName="*"/>
				<Field id="36" fieldName="CONCAT(last_name, ', ', first_name)" isExpression="True" alias="Name"/>
			</Fields>
			<PKFields>
				<PKField id="12" tableName="tbl_users" fieldName="user_id" dataType="Integer"/>
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
		<Record id="39" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Connection1" name="UserAddEdit" dataSource="tbl_users" errorSummator="Error" wizardCaption="{res:CCS_RecordFormPrefix} {res:tbl_users} {res:CCS_RecordFormSuffix}" wizardFormMethod="post" PathID="Calendar_UsersUserAddEdit" customInsertType="Table" customInsert="tbl_users" customUpdateType="Table" customUpdate="tbl_users" activeCollection="UFormElements" activeTableType="tbl_users" pasteActions="pasteActions">
			<Components>
				<Button id="41" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="{res:CCS_Insert}" PathID="Calendar_UsersUserAddEditButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="43" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="{res:CCS_Update}" PathID="Calendar_UsersUserAddEditButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="45" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="{res:CCS_Delete}" PathID="Calendar_UsersUserAddEditButton_Delete">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="46" message="{res:CCS_DeleteConfirmation}"/>
							</Actions>
						</Event>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Hide-Show Component" actionCategory="General" id="130" action="Hide" conditionType="Expression" dataType="Text" componentName="Button_Delete" condition="CCGetGroupID() &gt; 2 OR CCGetUserID() == CCGetParam(&quot;id&quot;, &quot;&quot;)"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="47" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="{res:CCS_Cancel}" PathID="Calendar_UsersUserAddEditButton_Cancel" removeParameters="action;id">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Hide-Show Component" actionCategory="General" id="131" action="Hide" conditionType="Expression" dataType="Text" componentName="Button_Cancel" condition="!CCGetParam(&quot;u&quot;,&quot;&quot;) AND !CCGetParam(&quot;g&quot;,&quot;&quot;) AND !CCGetParam(&quot;n&quot;,&quot;&quot;)"/>
								<Action actionName="Hide-Show Component" actionCategory="General" id="143" action="Show" conditionType="Expression" dataType="Text" componentName="Button_Cancel" condition="CCGetGroupID() &lt; 3 AND CCGetParam(&quot;action&quot;, &quot;&quot;) == &quot;AddEdit&quot; AND CCGetParam(&quot;u&quot;, &quot;&quot;) AND CCGetParam(&quot;g&quot;, &quot;&quot;) AND CCGetParam(&quot;n&quot;, &quot;&quot;)"/>
								<Action actionName="Hide-Show Component" actionCategory="General" id="144" action="Show" conditionType="Expression" dataType="Text" componentName="Button_Cancel" condition="CCGetGroupID() &lt; 3 AND CCGetParam(&quot;action&quot;, &quot;&quot;) == &quot;AddEdit&quot; AND !CCGetParam(&quot;id&quot;, &quot;&quot;)"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="49" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="user_login" fieldSource="user_login" caption="{res:user_login}" wizardCaption="{res:user_login}" wizardSize="50" wizardMaxLength="75" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_UsersUserAddEdituser_login">
					<Components/>
					<Events>
						<Event name="OnValidate" type="Server">
							<Actions>
								<Action actionName="Validate Minimum Length" actionCategory="Validation" id="122" name="user_login" minimumLength="8" errorMessage="{res:CRM_ErrorValidLogin}"/>
								<Action actionName="Validate Email" actionCategory="Validation" id="123" name="user_login" errorMessage="{res:CRM_ErrorValidLogin}"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="53" visible="Dynamic" fieldSourceType="DBColumn" dataType="Integer" name="group_id" fieldSource="group_id" wizardCaption="{res:group_id}" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_UsersUserAddEditgroup_id" sourceType="Table" connection="Connection1" dataSource="tbl_groups" boundColumn="group_id" textColumn="group_name" validationRule="$this-&gt;group_id-&gt;Visible == true OR CCStrLen($this-&gt;group_id-&gt;GetText()) &gt; 0" validationText="{res:CRM_ErrorSelectGroup}" activeCollection="TableParameters">
					<Components/>
					<Events>
						<Event name="BeforeBuildSelect" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="159"/>
							</Actions>
						</Event>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Hide-Show Component" actionCategory="General" id="164" action="Hide" conditionType="Expression" dataType="Text" componentName="group_id" condition="$Container-&gt;ds-&gt;f(&quot;group_id&quot;) == 1 OR CCGetGroupID() &gt; 2"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
					<TableParameters>
						<TableParameter id="161" conditionType="Parameter" useIsNull="False" field="group_id" dataType="Integer" searchConditionType="NotEqual" parameterType="Expression" logicOperator="And" parameterSource="1"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="160" tableName="tbl_groups" posLeft="10" posTop="10" posWidth="212" posHeight="115"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
				</ListBox>
				<ListBox id="54" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" name="prefix" fieldSource="prefix" wizardCaption="{res:prefix}" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_UsersUserAddEditprefix" sourceType="Table" connection="Connection1" dataSource="lu_prefix" boundColumn="prefix" textColumn="prefix">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
				</ListBox>
				<TextBox id="55" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="first_name" fieldSource="first_name" caption="{res:first_name}" wizardCaption="{res:first_name}" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_UsersUserAddEditfirst_name">
					<Components/>
					<Events>
						<Event name="OnValidate" type="Server">
							<Actions>
								<Action actionName="Validate Minimum Length" actionCategory="Validation" id="147" name="first_name" minimumLength="1" errorMessage="{res:CRM_ErrorEnterFirstName}"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="56" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="last_name" fieldSource="last_name" required="False" caption="{res:last_name}" wizardCaption="{res:last_name}" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_UsersUserAddEditlast_name">
					<Components/>
					<Events>
						<Event name="OnValidate" type="Server">
							<Actions>
								<Action actionName="Validate Minimum Length" actionCategory="Validation" id="148" name="last_name" minimumLength="1" errorMessage="{res:CRM_ErrorEnterLastName}"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="57" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" name="suffix" fieldSource="suffix" wizardCaption="{res:suffix}" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_UsersUserAddEditsuffix" sourceType="Table" connection="Connection1" dataSource="lu_suffix" boundColumn="suffix" textColumn="suffix">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
				</ListBox>
				<TextBox id="58" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="company" fieldSource="company" required="False" caption="{res:company}" wizardCaption="{res:company}" wizardSize="50" wizardMaxLength="75" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_UsersUserAddEditcompany">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="59" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="title" fieldSource="title" required="False" caption="{res:title}" wizardCaption="{res:title}" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_UsersUserAddEdittitle">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="60" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address1" fieldSource="address1" required="False" caption="{res:address1}" wizardCaption="{res:address1}" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_UsersUserAddEditaddress1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="61" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address2" fieldSource="address2" required="False" caption="{res:address2}" wizardCaption="{res:address2}" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_UsersUserAddEditaddress2">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="62" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="city" fieldSource="city" required="False" caption="{res:city}" wizardCaption="{res:city}" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_UsersUserAddEditcity">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="64" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="post_code" fieldSource="post_code" required="False" caption="{res:post_code}" wizardCaption="{res:post_code}" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_UsersUserAddEditpost_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="65" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" name="country" fieldSource="country" wizardCaption="{res:country}" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_UsersUserAddEditcountry" sourceType="Table" connection="Connection1" dataSource="lu_countries" boundColumn="country_id" textColumn="country_name" validationRule="CCStrLen($this-&gt;country-&gt;GetText()) &gt; 0" validationText="{res:CRM_ErrorSelectCountry}">
					<Components/>
					<Events>
						<Event name="OnChange" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="157"/>
							</Actions>
						</Event>
						<Event name="OnLoad" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="158"/>
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
				</ListBox>
				<TextBox id="67" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="phone_work" fieldSource="phone_work" required="False" caption="{res:phone_work}" wizardCaption="{res:phone_work}" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_UsersUserAddEditphone_work">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="68" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="phone_cell" fieldSource="phone_cell" required="False" caption="{res:phone_cell}" wizardCaption="{res:phone_cell}" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_UsersUserAddEditphone_cell">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="69" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="fax" fieldSource="fax" required="False" caption="{res:fax}" wizardCaption="{res:fax}" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_UsersUserAddEditfax">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextArea id="70" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="notes" fieldSource="notes" required="False" caption="{res:notes}" wizardCaption="{res:notes}" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="Calendar_UsersUserAddEditnotes">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<Hidden id="71" fieldSourceType="DBColumn" dataType="Text" name="user_password_Shadow" PathID="Calendar_UsersUserAddEdituser_password_Shadow">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="115" fieldSourceType="DBColumn" dataType="Text" html="False" name="AddEditLabel" PathID="Calendar_UsersUserAddEditAddEditLabel">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Declare Variable" actionCategory="General" id="116" name="CCSLocales" initialValue="$CCSLocales"/>
								<Action actionName="Retrieve Value for Control" actionCategory="General" id="117" name="AddEditLabel" sourceType="Expression" sourceName="(CCGetParam(&quot;action&quot;, &quot;&quot;) == &quot;AddEdit&quot; AND !CCGetParam(&quot;id&quot;, &quot;&quot;)) ? $CCSLocales-&gt;GetText(&quot;CRM_NewUser&quot;) : $CCSLocales-&gt;GetText(&quot;CRM_EditUser&quot;)"/>
								<Action actionName="Retrieve Value for Control" actionCategory="General" id="127" name="AddEditLabel" sourceType="Expression" sourceName="(!CCGetParam(&quot;u&quot;, &quot;&quot;) AND !CCGetParam(&quot;g&quot;, &quot;&quot;) AND !CCGetParam(&quot;n&quot;, &quot;&quot;) AND CCGetParam(&quot;id&quot;, &quot;&quot;) == CCGetUserID()) ? $CCSLocales-&gt;GetText(&quot;CRM_MyProfile&quot;) : $Component-&gt;GetValue()"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<TextBox id="124" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="NewPassword" PathID="Calendar_UsersUserAddEditNewPassword" fieldSource="user_password">
					<Components/>
					<Events>
						<Event name="OnValidate" type="Server">
							<Actions>
								<Action actionName="Reset Password Validation" actionCategory="Security" id="128" passwordControlName="NewPassword"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="125" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="ConfirmNewPassword" PathID="Calendar_UsersUserAddEditConfirmNewPassword" validationRule="$this-&gt;ConfirmNewPassword-&gt;GetText() == $this-&gt;NewPassword-&gt;GetText()" validationText="{res:CRM_ErrorPasswordsDoNotMatch}">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Panel id="149" visible="True" name="ActivePanel" PathID="Calendar_UsersUserAddEditActivePanel" pasteActions="pasteActions">
					<Components>
						<CheckBox id="52" visible="Yes" fieldSourceType="DBColumn" dataType="Boolean" name="user_active" fieldSource="user_active" required="False" caption="{res:user_active}" wizardCaption="{res:user_active}" wizardSize="4" wizardMaxLength="4" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_UsersUserAddEditActivePaneluser_active">
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
				<Label id="162" fieldSourceType="DBColumn" dataType="Text" html="False" name="GroupLabel" PathID="Calendar_UsersUserAddEditGroupLabel">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Hide-Show Component" actionCategory="General" id="165" action="Hide" conditionType="Expression" dataType="Text" componentName="GroupLabel" condition="$Container-&gt;group_id-&gt;Visible == true"/>
								<Action actionName="DLookup" actionCategory="Database" id="163" typeOfTarget="Control" expression="&quot;group_name&quot;" domain="&quot;tbl_groups&quot;" criteria="&quot;group_id=&quot; . CCToSQL(CCGetGroupID(), ccsInteger)" connection="Connection1" dataType="Text" target="GroupLabel"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<TextBox id="66" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="county" fieldSource="county" required="False" caption="{res:county}" wizardCaption="{res:county}" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_UsersUserAddEditcounty">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<ListBox id="63" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" name="state" wizardCaption="{res:state}" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Calendar_UsersUserAddEditstate" sourceType="Table" connection="Connection1" dataSource="lu_states" boundColumn="state_id" textColumn="abbrv" fieldSource="state">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
				</ListBox>
</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Hide-Show Component" actionCategory="General" id="118" action="Hide" conditionType="Expression" dataType="Text" componentName="UserAddEdit" condition="CCGetParam(&quot;action&quot;, &quot;&quot;) &lt;&gt; &quot;AddEdit&quot;"/>
						<Action actionName="Preserve Password" actionCategory="Security" id="40" passwordControlName="NewPassword" shadowControlName="user_password_Shadow"/>
						<Action actionName="Hide-Show Component" actionCategory="General" id="150" action="Hide" conditionType="Expression" dataType="Text" componentName="ActivePanel" condition="CCGetParam(&quot;id&quot;, &quot;&quot;) == 1 OR CCGetGroupID() &gt; 2 OR CCGetUserID() == CCGetParam(&quot;id&quot;, &quot;&quot;)"/>
					</Actions>
				</Event>
				<Event name="BeforeExecuteInsert" type="Server">
					<Actions>
						<Action actionName="Encrypt Password" actionCategory="Security" id="42" passwordControlName="NewPassword" shadowControlName="user_password_Shadow"/>
					</Actions>
				</Event>
				<Event name="BeforeExecuteUpdate" type="Server">
					<Actions>
						<Action actionName="Encrypt Password" actionCategory="Security" id="44" passwordControlName="NewPassword" shadowControlName="user_password_Shadow"/>
					</Actions>
				</Event>
				<Event name="OnLoad" type="Client">
					<Actions>
						<Action actionName="Set Focus" actionCategory="General" id="126" name="user_login"/>
					</Actions>
				</Event>
				<Event name="AfterUpdate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="129"/>
					</Actions>
				</Event>
				<Event name="OnValidate" type="Server">
					<Actions>
						<Action actionName="Retrieve Value for Control" actionCategory="General" id="154" name="state" sourceType="Expression" sourceName="($Container-&gt;country-&gt;GetValue() &lt;&gt; &quot;1&quot;) ? &quot;&quot; : $Container-&gt;state-&gt;GetValue()"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="48" conditionType="Parameter" useIsNull="False" field="user_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1" parameterSource="id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="120" tableName="tbl_users" posLeft="10" posTop="10" posWidth="225" posHeight="338"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements>
				<CustomParameter id="72" field="user_login" dataType="Text" parameterType="Control" parameterSource="user_login" omitIfEmpty="True"/>
				<CustomParameter id="73" field="user_password" dataType="Text" parameterType="Expression" parameterSource="&quot;{password}&quot;" omitIfEmpty="True"/>
				<CustomParameter id="74" field="user_active" dataType="Integer" parameterType="Control" parameterSource="user_active" omitIfEmpty="True"/>
				<CustomParameter id="75" field="group_id" dataType="Integer" parameterType="Control" parameterSource="group_id" omitIfEmpty="True"/>
				<CustomParameter id="76" field="prefix" dataType="Text" parameterType="Control" parameterSource="prefix" omitIfEmpty="True"/>
				<CustomParameter id="77" field="first_name" dataType="Text" parameterType="Control" parameterSource="first_name" omitIfEmpty="True"/>
				<CustomParameter id="78" field="last_name" dataType="Text" parameterType="Control" parameterSource="last_name" omitIfEmpty="True"/>
				<CustomParameter id="79" field="suffix" dataType="Text" parameterType="Control" parameterSource="suffix" omitIfEmpty="True"/>
				<CustomParameter id="80" field="company" dataType="Text" parameterType="Control" parameterSource="company" omitIfEmpty="True"/>
				<CustomParameter id="81" field="title" dataType="Text" parameterType="Control" parameterSource="title" omitIfEmpty="True"/>
				<CustomParameter id="82" field="address1" dataType="Text" parameterType="Control" parameterSource="address1" omitIfEmpty="True"/>
				<CustomParameter id="83" field="address2" dataType="Text" parameterType="Control" parameterSource="address2" omitIfEmpty="True"/>
				<CustomParameter id="84" field="city" dataType="Text" parameterType="Control" parameterSource="city" omitIfEmpty="True"/>
				<CustomParameter id="85" field="state" dataType="Text" parameterType="Control" parameterSource="state" omitIfEmpty="False" defaultValue="&quot;&quot;"/>
				<CustomParameter id="86" field="post_code" dataType="Text" parameterType="Control" parameterSource="post_code" omitIfEmpty="True"/>
				<CustomParameter id="87" field="country" dataType="Text" parameterType="Control" parameterSource="country" omitIfEmpty="True"/>
				<CustomParameter id="88" field="county" dataType="Text" parameterType="Control" parameterSource="county" omitIfEmpty="True"/>
				<CustomParameter id="89" field="phone_work" dataType="Text" parameterType="Control" parameterSource="phone_work" omitIfEmpty="True"/>
				<CustomParameter id="90" field="phone_cell" dataType="Text" parameterType="Control" parameterSource="phone_cell" omitIfEmpty="True"/>
				<CustomParameter id="91" field="fax" dataType="Text" parameterType="Control" parameterSource="fax" omitIfEmpty="True"/>
				<CustomParameter id="92" field="notes" dataType="Memo" parameterType="Control" parameterSource="notes" omitIfEmpty="True"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters/>
			<UConditions>
				<TableParameter id="93" conditionType="Parameter" useIsNull="False" field="user_id" dataType="Integer" parameterType="URL" searchConditionType="Equal" logicOperator="And" orderNumber="1" omitIfEmpty="True" parameterSource="id"/>
			</UConditions>
			<UFormElements>
				<CustomParameter id="94" field="user_login" dataType="Text" parameterType="Control" parameterSource="user_login" omitIfEmpty="True"/>
				<CustomParameter id="95" field="user_password" dataType="Text" parameterType="Expression" parameterSource="&quot;{password}&quot;" omitIfEmpty="True"/>
				<CustomParameter id="96" field="user_active" dataType="Integer" parameterType="Control" parameterSource="user_active" omitIfEmpty="True"/>
				<CustomParameter id="97" field="group_id" dataType="Integer" parameterType="Control" parameterSource="group_id" omitIfEmpty="True"/>
				<CustomParameter id="98" field="prefix" dataType="Text" parameterType="Control" parameterSource="prefix" omitIfEmpty="True"/>
				<CustomParameter id="99" field="first_name" dataType="Text" parameterType="Control" parameterSource="first_name" omitIfEmpty="True"/>
				<CustomParameter id="100" field="last_name" dataType="Text" parameterType="Control" parameterSource="last_name" omitIfEmpty="True"/>
				<CustomParameter id="101" field="suffix" dataType="Text" parameterType="Control" parameterSource="suffix" omitIfEmpty="True"/>
				<CustomParameter id="102" field="company" dataType="Text" parameterType="Control" parameterSource="company" omitIfEmpty="True"/>
				<CustomParameter id="103" field="title" dataType="Text" parameterType="Control" parameterSource="title" omitIfEmpty="True"/>
				<CustomParameter id="104" field="address1" dataType="Text" parameterType="Control" parameterSource="address1" omitIfEmpty="True"/>
				<CustomParameter id="105" field="address2" dataType="Text" parameterType="Control" parameterSource="address2" omitIfEmpty="True"/>
				<CustomParameter id="106" field="city" dataType="Text" parameterType="Control" parameterSource="city" omitIfEmpty="True"/>
				<CustomParameter id="107" field="state" dataType="Text" parameterType="Control" parameterSource="state" omitIfEmpty="False" defaultValue="&quot;&quot;"/>
				<CustomParameter id="108" field="post_code" dataType="Text" parameterType="Control" parameterSource="post_code" omitIfEmpty="True"/>
				<CustomParameter id="109" field="country" dataType="Text" parameterType="Control" parameterSource="country" omitIfEmpty="True"/>
				<CustomParameter id="110" field="county" dataType="Text" parameterType="Control" parameterSource="county" omitIfEmpty="True"/>
				<CustomParameter id="111" field="phone_work" dataType="Text" parameterType="Control" parameterSource="phone_work" omitIfEmpty="True"/>
				<CustomParameter id="112" field="phone_cell" dataType="Text" parameterType="Control" parameterSource="phone_cell" omitIfEmpty="True"/>
				<CustomParameter id="113" field="fax" dataType="Text" parameterType="Control" parameterSource="fax" omitIfEmpty="True"/>
				<CustomParameter id="114" field="notes" dataType="Memo" parameterType="Control" parameterSource="notes" omitIfEmpty="True"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="Calendar_Users.php" forShow="True" url="Calendar_Users.php" comment="//" codePage="utf-8"/>
		<CodeFile id="Events" language="PHPTemplates" name="Calendar_Users_events.php" forShow="False" comment="//" codePage="utf-8"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
