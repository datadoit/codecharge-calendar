<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\includes" secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="15 minutes" needGeneration="0" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0">
	<Components>
		<Record id="7" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="HeaderForm" actionPage="header" errorSummator="Error" wizardFormMethod="post" PathID="headerHeaderForm" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" connection="Connection1">
			<Components>
				<ListBox id="8" visible="Dynamic" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="style" wizardEmptyCaption="{res:CCS_SelectValue}" PathID="headerHeaderFormstyle" connection="Connection1" _valueOfList="Austere" _nameOfList="Austere" dataSource="tbl_styles" boundColumn="style_name" textColumn="style_name" defaultValue="CCGetSession(&quot;style&quot;,&quot;&quot;)" activeCollection="TableParameters">
					<Components/>
					<Events>
						<Event name="OnChange" type="Client">
							<Actions>
								<Action actionName="Submit Form" actionCategory="General" id="13" formName="HeaderForm"/>
							</Actions>
						</Event>
					</Events>
					<TableParameters>
						<TableParameter id="29" conditionType="Parameter" useIsNull="False" field="site_id" dataType="Integer" searchConditionType="Equal" parameterType="Session" logicOperator="And" parameterSource="SiteID"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="28" tableName="tbl_styles" posLeft="10" posTop="10" posWidth="158" posHeight="180"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<Button id="9" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Search" operation="Search" wizardCaption="{res:CCS_Insert}" PathID="headerHeaderFormButton_Search">
					<Components/>
					<Events>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Link id="4" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="None" name="Logout" wizardDefaultValue="{res:CCS_LogoutBtn}" PathID="headerHeaderFormLogout" wizardUseTemplateBlock="True">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Hide-Show Component" actionCategory="General" id="12" action="Hide" conditionType="Expression" dataType="Text" componentName="Logout" condition="!CCGetUserID()" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<LinkParameters>
						<LinkParameter id="5" sourceType="Expression" format="yyyy-mm-dd" name="Logout" source="&quot;True&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<ListBox id="14" visible="Dynamic" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="locale" wizardEmptyCaption="{res:CCS_SelectValue}" PathID="headerHeaderFormlocale" connection="Connection1" dataSource="lu_locales" boundColumn="locale" textColumn="description" defaultValue="CCGetSession(&quot;locale&quot;)">
					<Components/>
					<Events>
						<Event name="OnChange" type="Client">
							<Actions>
								<Action actionName="Submit Form" actionCategory="General" id="15" formName="HeaderForm"/>
							</Actions>
						</Event>
					</Events>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="27" tableName="lu_locales" posLeft="10" posTop="10" posWidth="95" posHeight="88"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<Label id="16" fieldSourceType="DBColumn" dataType="Text" html="False" name="lbl_Name" PathID="headerHeaderFormlbl_Name">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="DLookup" actionCategory="Database" id="17" typeOfTarget="Control" expression="&quot;CONCAT(first_name, ' ', last_name, '!')&quot;" domain="&quot;tbl_users&quot;" criteria="&quot;user_id=&quot; . CCToSQL(CCGetUserID(), ccsInteger)" connection="Connection1" dataType="Text" target="lbl_Name"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="18" fieldSourceType="DBColumn" dataType="Text" html="False" name="lbl_Welcome" PathID="headerHeaderFormlbl_Welcome" defaultValue="{res:CRM_Welcome}">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Hide-Show Component" actionCategory="General" id="19" action="Hide" conditionType="Expression" dataType="Text" componentName="lbl_Welcome" condition="!CCGetUserID()"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="30" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="None" name="Login" wizardDefaultValue="{res:CCS_LogoutBtn}" PathID="headerHeaderFormLogin" wizardUseTemplateBlock="True">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Hide-Show Component" actionCategory="General" id="31" action="Hide" conditionType="Expression" dataType="Text" componentName="Login" condition="CCGetUserID()" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<LinkParameters>
						<LinkParameter id="32" sourceType="Expression" format="yyyy-mm-dd" name="Login" source="&quot;True&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
			</Components>
			<Events>
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
		<Link id="24" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="None" name="TitleLink" PathID="headerTitleLink" hrefSource="." wizardUseTemplateBlock="False">
			<Components/>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="DLookup" actionCategory="Database" id="25" typeOfTarget="Control" expression="&quot;site_title&quot;" domain="&quot;tbl_config&quot;" connection="Connection1" dataType="Text" target="TitleLink" criteria="&quot;site_id=&quot; . CCToSQL(CCGetSession(&quot;SiteID&quot;, &quot;&quot;), ccsInteger)"/>
					</Actions>
				</Event>
			</Events>
			<LinkParameters/>
			<Attributes/>
			<Features/>
		</Link>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="header.php" forShow="True" url="header.php" comment="//" codePage="utf-8"/>
		<CodeFile id="Events" language="PHPTemplates" name="header_events.php" forShow="False" comment="//" codePage="utf-8"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters>
		<CachingParameter id="20" name="ccsForm" sourceType="URL" target="Disable"/>
		<CachingParameter id="21" name="UserID" sourceType="Session" target="Key"/>
	</CachingParameters>
	<Attributes/>
	<Features/>
	<Events>
	</Events>
</Page>
