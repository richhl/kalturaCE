<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
	<title>Kaltura CMS</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!--
	<script type="text/JavaScript" src="/js/jqkaltura.packed.js"></script>
	<script type="text/JavaScript" src="/js/jquery.datePicker.js"></script>
	<script type="text/JavaScript" src="/js/date.js"></script>
	  -->
	<link rel="stylesheet" type="text/css" href="/css/sdk_admin.css"/>
	<link rel="stylesheet" type="text/css" href="/css/datePicker.css"/>
	
	<script type="text/JavaScript">
		function logout()
		{
			window.location = "login?exit=true";
		}
	</script>
	
</head>
<body>
	<div id="wrapper">
		<div id="header" class="clearfix">
			<div id="client_logo"><img src="/images/cms/temp_logo.jpg" alt="" /></div>
			<div class="top">
				<strong><?php echo $screenName; ?></strong>
				<span><?php echo $fullName; ?></span>	
			</div>
			<div class="header_menu clearfix">
				<ul class="more_options unselectable">
					<li class="hasmenu"><span class="btn">Account</span>
						<ul
							><li><b class="accountInfo">General info</b></li
							><?php /* ?><li><b class="account_users">Admin users</b></li
							><li><b class="account_emails">Batch Emails</b></li
							><li><b class="account_billing">Billing</b></li>
							*/ ?>
						</ul>
					</li>
					<?php
					/*
					<li class="hasmenu"><span class="btn">Support</span>
						<ul>
							<li><b class="support_documentation">Documentation</b></li
							><li><b class="support_bugreports">Bug reports</b></li>
						</ul>
					</li>
					*/
					?>
					<li><span class="btn" onclick="logout();">Logout</span></li>
				</ul>
				<?php
				/* 
				<span>Application name</span>
				<select id="app_name" name="app_name" onchange="change_app($('app_name').selected);">
					<?php //Print the list of applications per partner, per user.
						foreach ($partnerApp as $key => $value) {
							if ($selectedApp == "") $selectedApp = $value;
					?>
							<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php } ?>
				</select>
				<button style="margin-left:8px; font-size:0.9em;" onclick="change_page1('New_Application', true)">New Application</button>
				*/
				?>
			</div><!-- submenu -->
		</div><!-- #header -->
		
		<div id="content" class="clearfix">
			<div id="col0">
				<ul id="main_menu" class="unselectable">
					<li>
						<div class="nav_item_0"><b><b><span class="reports_top30">Reports</span></b></b></div>
						<ul>
							<?php // <li><b><span class="reportsLast30">Last 30</span></b></li>?>
							<li><b><span class="reportsGraphs">Graphs</span></b></li>
							<?php // <li><b><span class="contentTypes">Content Types</span></b></li>?>
							<?php // <li><b><span class="reportsWidgets">Widgets</span></b></li>?>
						</ul>
					</li>
					<li>
						<div class="nav_item_0"><b><b><span>Users</span></b></b></div>
						<ul>
							<li><b><span class="usersList">User list</span></b></li>
							<?php //<li><b><span class="usersAdd">Add users</span></b></li> ?>
							<?php //<li><b><span class="usersReport">Users report</span></b></li> ?>
						</ul>
					</li>
					<li>
						<div class="nav_item_0"><b><b><span>Content</span></b></b></div>
						<ul>
							<li><b><span class="contentShows">All shows</span></b></li>
							<li><b><span class="contentEntries">All entries</span></b></li>
							<?php //<li><b><span class="contentAdd">Add content</span></b></li> ?>
							<?php //<li><b><span class="contentLicensing">Licensing</span></b></li> ?>
							<li><b><span class="contentModeration">Moderation</span></b></li>
							<li><b><span class="bulkUpload">Bulk Upload</span></b></li>
							<?php //<li><b><span class="contentTags">Tag list</span></b></li> ?>
						</ul>
					</li>
					<?php 
					/* 
					<li>
						<div class="nav_item_0"><b><b><span>Edit Application</span></b></b></div>
						<ul>
							<li><b><span class="applicationInfo">Info</span></b></li>
							<li><b><span class="applicationPermissions">Permissions</span></b></li>
							<li><b><span class="applicationComponents">Components</span></b></li>
							<li><b><span class="applicationSkin">Skin</span></b></li>
							<li><b><span class="applicationNotifications">Notifications</span></b></li>
						</ul>
					</li>
					<li>
						<div class="nav_item_0"><b><b><span>Advertising</span></b></b></div>
						<ul>
							<li><b><span class="advertisingSettings">Settings</span></b></li>
							<li><b><span class="advertisingReports">Reports</span></b></li>
						</ul>
					</li>
					*/ 
					?>
				</ul>
			</div><!-- #col0 -->
			<div id="main_content" class="clearfix">
				<div class="innerWrap">
					
				</div><!-- innerWrap -->
			</div><!-- #main_content -->
		</div><!-- #content -->
		
	</div><!-- #wrapper -->

	<script type="text/javascript">
	
		function load_page(url) {
			if (url.length > 1)
			{
				$("#main_content div.innerWrap")
					.html("<div class='ajaxloader'></div>")
					.load(url,null, init_pages);
				var route = Utils.getRoute();
				update_ui_menu(route.page);
			}
		}
		
		function change_page1(url, close_menu) {
			//var url = "content/"+url+".html";
			$("#main_content div.innerWrap").load(url,null, init_pages);
			$("#main_menu ul:visible").children("li.active").removeClass("active").end().prev("div.nav_item_0").removeClass("active");
			if (close_menu) $("#main_menu ul:visible").hide();
		}
		
		function update_ui_menu(url) {
			var jqMenuItem = $("#main_menu ul li:has(."+url+")");
			if (jqMenuItem.size() > 0) 
			{
				if(jqMenuItem[0].className.indexOf('active') == -1) {
					$("#main_menu ul li").removeClass("active");
					jqMenuItem.addClass("active");
				}
				
				var jqMenuCategoryItem = jqMenuItem.parents("ul").siblings(".nav_item_0");
				if (jqMenuCategoryItem.next("ul").css("display") == "none")
					jqMenuCategoryItem.trigger("click");
				
				jqMenuItem.parents("li").siblings().find("ul").slideUp("fast").prev(".nav_item_0").removeClass("active");
			}
		}
		
		function init_pages(responseTest, textStatus, xmlHttp) {
				if (textStatus == "error") {
					$.history.load("reportsGraphs");
					return;				
				}
				$("#main_content  table tbody td.more").click(function(){						/* show/hide more information, opens the next TR */
					if( $(this).hasClass('open') )
						$(this).removeClass("open").parent("tr").next("tr.moreInfo").hide();
					else{
						var dis = ($.browser.msie) ?  "block" : "table-row";
						$(this).addClass("open").parent("tr").next("tr.moreInfo").css("display",dis);
					}
				});
				
				$("#main_content  ul.table_tabs li").click(function(){
					if( $(this)[0].className.indexOf('active') == -1 ){
						$(this).addClass("active").siblings().removeClass("active");
						var open_table = "#"+$(this).find("span").attr("class");
						$(this).parents("div.section_content").children("table"+open_table).show().siblings("table").hide();
					}
				});
		}
		
		jQuery(document).ready(function(){
			$ = jQuery;
			
			jQuery.fn.log = function(msg){   /* for debugging */
				if (window.console || console.firebug){
					msg = msg || '';
					if(msg !== '') msg += ': ';
					console.log("%s%o", msg, this);
				}
				return this;
			};
			
			$("#main_menu > li > div.nav_item_0").click(function(){			/* opens the sub menu under left side main menu */
				if ($(this).next("ul").css("display") == "none")
					$(this).addClass("active").next("ul").slideDown("fast");
				else 
					$(this).removeClass("active").next("ul").slideUp("fast").children("li").removeClass("active");
			});
			
			$("#main_menu ul li").click(function(){							/* Handles the sub-menu items and open pages with Load() ajax */
				var url = $(this).find("span:first").attr("class");
				$.history.load(url);
			});
			
			$("#header div.header_menu li.hasmenu b").click(function(){
				var url = this.className;
				$.history.load(url);
			});
			
			$.history.init(load_page); // if hash exists, load_page callback will be fired
			
			var route = Utils.getRoute(); 
			if (!route.page) {
				$.history.load("reportsGraphs");
			}
		
		});
		
		
		function change_app(appId) {
			alert(appId);
		}
		
	</script>
	
</body>
</html>
