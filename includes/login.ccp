<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\includes" secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" pasteActions="pasteActions" needGeneration="0" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0">
	<Components>
		<Label id="10" fieldSourceType="DBColumn" dataType="Text" html="True" name="CRMInactive" PathID="loginCRMInactive">
			<Components/>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="DLookup" actionCategory="Database" id="11" typeOfTarget="Control" expression="&quot;inactive_message&quot;" domain="&quot;tbl_config&quot;" connection="Connection1" dataType="Text" target="CRMInactive" eventType="Server" criteria="&quot;site_id=&quot; . CCToSQL(CCGetSession(&quot;SiteID&quot;, &quot;&quot;), ccsInteger)"/>
					</Actions>
				</Event>
			</Events>
			<Attributes/>
			<Features/>
		</Label>
		<Record id="16" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="LoginForm" wizardCaption="{res:CCS_Login_Form_Caption}" wizardOrientation="Vertical" wizardFormMethod="post" PathID="loginLoginForm">
			<Components>
				<Button id="17" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoLogin" wizardCaption="{res:CCS_LoginBtn}" PathID="loginLoginFormButton_DoLogin">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Login" actionCategory="Security" id="18" redirectToPreviousPage="True" loginParameter="login" passwordParameter="password" autoLoginParameter="autoLogin"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="19" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="login" fieldSource="user_login" wizardCaption="{res:CCS_Login}" wizardSize="20" wizardMaxLength="100" wizardIsPassword="False" PathID="loginLoginFormlogin">
					<Components/>
					<Events>
					</Events>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="20" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="password" fieldSource="user_password" wizardCaption="{res:CCS_Password}" wizardSize="20" wizardMaxLength="100" wizardIsPassword="True" PathID="loginLoginFormpassword">
					<Components/>
					<Events>
					</Events>
					<Attributes/>
					<Features/>
				</TextBox>
				<CheckBox id="21" visible="Yes" fieldSourceType="DBColumn" dataType="Boolean" name="autoLogin" fieldSource="autoLogin" wizardDefaultValue="{res:CCS_Login_AutoLogin_Caption}" PathID="loginLoginFormautoLogin">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
			</Components>
			<Events>
<Event name="OnValidate" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="25"/>
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
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="login_events.php" forShow="False" comment="//" codePage="utf-8"/>
		<CodeFile id="Code" language="PHPTemplates" name="login.php" forShow="True" url="login.php" comment="//" codePage="utf-8"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="BeforeShow" type="Server">
			<Actions>
				<Action actionName="Declare Variable" actionCategory="General" id="14" name="DBConnection1" initialValue="$DBConnection1"/>
				<Action actionName="Hide-Show Component" actionCategory="General" id="13" action="Hide" conditionType="Expression" dataType="Text" componentName="LoginForm" condition="CCDLookUp(&quot;active&quot;, &quot;tbl_config&quot;, &quot;site_id=&quot; . CCToSQL(CCGetSession(&quot;SiteID&quot;, &quot;&quot;), ccsInteger), $DBConnection1) &lt; 1"/>
				<Action actionName="Hide-Show Component" actionCategory="General" id="15" action="Hide" conditionType="Expression" dataType="Text" componentName="CRMInactive" condition="CCDLookUp(&quot;active&quot;, &quot;tbl_config&quot;, &quot;site_id=&quot; . CCToSQL(CCGetSession(&quot;SiteID&quot;, &quot;&quot;), ccsInteger), $DBConnection1) == 1"/>
			</Actions>
		</Event>
		<Event name="OnLoad" type="Client">
			<Actions>
				<Action actionName="Set Focus" actionCategory="General" id="22" form="LoginForm" name="login"/>
			</Actions>
		</Event>
	</Events>
</Page>
