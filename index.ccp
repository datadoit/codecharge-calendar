<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<IncludePage id="2" name="header" PathID="header" page="includes/header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<IncludePage id="5" name="topmenu" PathID="topmenu" page="includes/topmenu.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Label id="6" fieldSourceType="DBColumn" dataType="Text" html="False" name="SiteTitle" PathID="SiteTitle">
			<Components/>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="DLookup" actionCategory="Database" id="7" typeOfTarget="Control" expression="&quot;site_title&quot;" domain="&quot;tbl_config&quot;" criteria="&quot;site_id=&quot; . CCToSQL(CCGetSession(&quot;SiteID&quot;, &quot;&quot;), ccsInteger)" connection="Connection1" dataType="Text" target="SiteTitle"/>
					</Actions>
				</Event>
			</Events>
			<Attributes/>
			<Features/>
		</Label>
		<IncludePage id="9" name="leftcolumn" PathID="leftcolumn" page="includes/leftcolumn.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<IncludePage id="10" name="content" PathID="content" page="includes/content.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<IncludePage id="3" name="footer" PathID="footer" page="includes/footer.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="index.php" forShow="True" url="index.php" comment="//" codePage="utf-8"/>
		<CodeFile id="Events" language="PHPTemplates" name="index_events.php" forShow="False" comment="//" codePage="utf-8"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Logout" actionCategory="Security" id="4" pageRedirects="False" parameterName="Logout"/>
				<Action actionName="Custom Code" actionCategory="General" id="12"/>
			</Actions>
		</Event>
		<Event name="BeforeInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="11"/>
			</Actions>
		</Event>
		<Event name="BeforeShow" type="Server">
			<Actions>
				<Action actionName="Hide-Show Component" actionCategory="General" id="15" action="Hide" conditionType="Expression" dataType="Text" componentName="leftcolumn" condition="!CCGetUserID()"/>
				<Action actionName="Hide-Show Component" actionCategory="General" id="14" action="Hide" conditionType="Expression" dataType="Text" componentName="topmenu" condition="CCGetSession(&quot;SiteType&quot;, &quot;&quot;) == &quot;CRM&quot; AND !CCGetUserID()"/>
				<Action actionName="Custom Code" actionCategory="General" id="13"/>
			</Actions>
		</Event>
	</Events>
</Page>
