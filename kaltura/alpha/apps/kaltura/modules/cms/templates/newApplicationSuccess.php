<div class="page_header">
	<button style="float:right; margin-top:0.5em;" onclick='change_page("reports_last30");'>Cancel</button>
	<h1>New Application</h1>
</div>

<div id="page_new_app">

	<table id="steps" cellpadding="0" cellspacing="0">
		<tr>
			<td class="current selected"><span>Info</span></td>
			<td><span>Permissions</span></td>
			<td><span>Template</span></td>
			<td><span>Sources</span></td>
			<td><span>Notifications</span></td>
			<td><span>Advertising</span></td>
			<td class="last"><span>Get Code</span></td>
		</tr>
	</table>
	
<!--////////////// 	Info	///////////////// -->

	<div class="step info" style="display:block;">
		<form action="">
			<fieldset>
				<div class="item">
					<label>Application Name:</label>
					<input id="username" name="username" type="text"/>
				</div>
				<div class="item">
					<label>Start Date:</label>
					<input id="start_date" name="start_date" type="text" value="11/16/2007"/>
				</div>
				<div class="item">
					<label>Description:</label>
					<textarea rows="10" cols="60"></textarea>
				</div>
				<div class="item" style="margin-top:50px;">
					<label>Clone Show:</label>
					<label class="radio"><input type="radio" value="yes" name="cloneShow" checked="checked" />Yes</label>
					<label class="radio"><input type="radio" value="no" name="cloneShow" />No</label>
				</div>
				<div class="item item2">
					<label>Include this application’s content in the Kaltura Global Network</label>
					<label class="radio"><input type="radio" value="yes" name="kgn_content" checked="checked" />Yes</label>
					<label class="radio"><input type="radio" value="no" name="kgn_content" />No</label>
				</div>
				<div class="item item2">
					<label>Include this application’s users in the Kaltura Global Network</label>
					<label class="radio"><input type="radio" value="yes" name="kgn_users" checked="checked" />Yes</label>
					<label class="radio"><input type="radio" value="no" name="kgn_users" />No</label>
				</div>
			</fieldset>
		</form>
		<div class="bottom">
			<button class="save">Save</button>
		</div>
	</div><!-- step -->
	
<!--//////////////  Permissions	///////////////// -->

	<div class="step permissions">
		<form action="" class="clearfix">
			<fieldset>
				<h2>Who can view</h4>
				<div class="item"><label class="radio"><input type="radio" name="who_can_view" value="everyone" />Everyone</label></div>
				<div class="item"><label class="radio"><input type="radio" name="who_can_view" value="admin" />Admin Only</label></div>
				<div class="item" style="margin-bottom:0;"><label class="radio"><input type="radio" name="who_can_view" value="password"  />Selected group<br /><small>(password protected)</small></label></div>
				<input type="password" name="viewers_pass" class="pass" />
			</fieldset>
			<fieldset>
				<h2>Who can contribute</h4>
				<div class="item"><label class="radio"><input type="radio" name="who_can_contribute" value="everyone" />Everyone</label></div>
				<div class="item"><label class="radio"><input type="radio" name="who_can_contribute" value="admin" />Admin Only</label></div>
				<div class="item" style="margin-bottom:0;"><label class="radio"><input type="radio" name="who_can_contribute" value="password" />Selected group<br /><small>(password protected)</small></label></div>
				<input type="password" name="contributors_pass" class="pass" />
			</fieldset>
			<fieldset>
				<h2>Who can edit</h4>
				<div class="item"><label class="radio"><input type="radio" name="who_can_edit" value="everyone" />Everyone</label></div>
				<div class="item"><label class="radio"><input type="radio" name="who_can_edit" value="admin" />Admin Only</label></div>
				<div class="item" style="margin-bottom:0;"><label class="radio"><input type="radio" name="who_can_edit" value="password"  />Selected group<br /><small>(password protected)</small></label></div>
				<input type="password" name="editors_pass" class="pass" />
			</fieldset>
		</form>
		<div class="bottom">
			<button class="save">Save</button>
		</div>
	</div><!-- step -->
	
<!--////////////// 	Template	///////////////// -->
	
	<div class="step template">
		<ul class="types clearfix">
			<li class="active"><div></div>Select Template</li>
			<li><div></div>Select Components</li>
			<li><div></div>Design Skin</li>
			<li><div></div>Player Properties</li>
		</ul>
		
		<div class="temp select" style="display:block;">
			<div class="choose_player floatl">
				<h2>Simple Player</h2>
				<img src="/images/cms/newApp/simplePlayer.jpg" alt="Simple Player" /><br />
				<button>Preview</button>
				<button onclick="chooseTemplate('simple')">Select</button>
			</div>
			
			<div class="choose_player floatr">
				<h2>Extended Player</h2>
				<img src="/images/cms/newApp/exPlayer.jpg" alt="Simple Player" /><br />
				<button>Preview</button>
				<button onclick="chooseTemplate('extended')">Select</button>
			</div>
			
		</div><!-- temp -->
		
		<div class="temp components">
			<img id="templateImg" src="" alt="Template type" style="float:right;" />
			<form class="clearfix">
				<fieldset class="checkboxs">
					<div class="item"><label class="chkbx"><input type="checkbox" value="comments" />Comments</label></div>
					<div class="item"><label class="chkbx"><input type="checkbox" value="search" />Search</label></div>
					<div class="item">
						<label class="chkbx"><input type="checkbox" value="userList" />User list</label>
						<div class="opts">
							<label>Link to profile?</label>
							<label class="radio"><input type="radio" name="userList_link_to_profile" value="yes" checked="checked" />Yes</label>
							<label class="radio"><input type="radio" name="userList_link_to_profile" value="no" />No</label>
						</div>
					</div>
					<div class="item">
						<label class="chkbx"><input type="checkbox" value="relatedShows" />Related Shows</label>
						<div class="opts">
							<label>Num of related shows:</label>
							<input type="text" name="num_related_shows" value="5" style="width:20px;" />
						</div>
					</div>
					<div class="item">
						<label class="chkbx"><input type="checkbox" value="numOfClips" />Clips in this video</label>
						<div class="opts">
							<label>Num of clips to display:</label>
							<input type="text" name="num_related_shows" value="5" style="width:20px;" />
						</div>
					</div>
				</fieldset>
			</form>
			<div class="bottom">
				<button onclick="nextTemplatePage(this)">Next</button>
			</div>
		</div><!-- temp -->
		
		<div class="temp skin">
			<form class="clearfix">
				<fieldset class="step1">
					<h2>Step 1</h2>
					<p>Download background images and CSS file</p>
					<br /><br />
					<a href="#">Download</a>
				</fieldset>
				<fieldset class="step2">
					<h2>Step 2</h2>
					<p>Upload custom background images and CSS file</p><br />
					<input type="file" size="30" />
				</fieldset>
			</form>
			<div class="bottom">
				<button onclick="nextTemplatePage(this)">Next</button>
			</div>
		</div><!-- temp -->
		
		
		<div class="temp properties">
			<form class="clearfix unselectable">
				<fieldset>
					<div class="item">
						<label>Autoplay</label>
						<div class="opts">
							<label class="radio"><input type="radio" value="yes" name="autoplay" checked="checked" />Yes</label>
							<label class="radio"><input type="radio" value="no" name="autoplay" />No</label>
						</div>
					</div>
					<div class="item">
						<label>Dimensions</label>
						<div class="opts" style="padding-right:6px">
							<label class="radio"><input type="radio" value="yes" name="dimensions" checked="checked" />Large (400x420)</label>
							<label class="radio"><input type="radio" value="yes" name="dimensions" checked="checked" />Medium (340x400)</label>
						</div>
					</div>
					<div class="item">
						<label>Allow Fullscreen</label>
						<div class="opts">
							<label class="radio"><input type="radio" value="yes" name="fullscreen" checked="checked" />Yes</label>
							<label class="radio"><input type="radio" value="no" name="fullscreen" />No</label>
						</div>
					</div>
					<div class="item">
						<label>Credit Roll</label>
						<div class="opts">
							<label class="radio"><input type="radio" value="yes" name="creditroll" checked="checked" />Yes</label>
							<label class="radio"><input type="radio" value="no" name="creditroll" />No</label>
						</div>
					</div>
				</fieldset>
			</form>
			<div class="bottom">
				<button class="save">Save</button>
			</div>
		</div><!-- temp -->
		
	</div><!-- step -->
	
<!--////////////// 	Sources	///////////////// -->
	
	<div class="step sources">
		<form class="clearfix">
			<h2>Select sources</h2>
			<fieldset class="checkboxs">
				<h3 class="color1">Photos:</h3>
				<div class="item"><label class="chkbx"><input type="checkbox" value="xxx" />Partner site</label></div>
				<div class="item"><label class="chkbx"><input type="checkbox" value="xxx" />Flickr</label></div>
				<div class="item"><label class="chkbx"><input type="checkbox" value="xxx" />Photobucket</label></div>
				<div class="item"><label class="chkbx"><input type="checkbox" value="xxx" />NYPL</label></div>
				<div class="item"><span class="btn">Add new source</span> (json, xml)</div>
			</fieldset>
			
			<fieldset class="checkboxs">
				<h3 class="color1">Videos:</h3>
				<div class="item"><label class="chkbx"><input type="checkbox" value="xxx" />Partner site</label></div>
				<div class="item"><label class="chkbx"><input type="checkbox" value="xxx" />MySpace</label></div>
				<div class="item"><label class="chkbx"><input type="checkbox" value="xxx" />YouTube</label></div>
				<div class="item"><label class="chkbx"><input type="checkbox" value="xxx" />Webcam</label></div>
				<div class="item"><span class="btn">Add new source</span> (json, xml)</div>
			</fieldset>
			
			<fieldset class="checkboxs">
				<h3 class="color1">Editor:</h3>
				<div class="item"><label class="chkbx"><input type="checkbox" value="xxx" />Partner site</label></div>
				<div class="item"><label class="chkbx"><input type="checkbox" value="xxx" />CCMixer</label></div>
				<div class="item"><label class="chkbx"><input type="checkbox" value="xxx" />Jamenjo</label></div>
				<div class="item"><label class="chkbx"><input type="checkbox" value="xxx" />Microphone</label></div>
				<div class="item"><span class="btn">Add new source</span> (json, xml)</div>
			</fieldset>
		</form>
		<div class="bottom">
			<button class="save">Save</button>
		</div>
	</div><!-- step -->

<!--////////////// 	Notifications	///////////////// -->
	
	<div class="step notifications">
		<form action="" class="clearfix">
			<fieldset class="type1" style="float:left; width:45%; height:95px;">
				<legend>Allow Notifications?:</legend>
				<div class="content">
					<label class="radio"><input type="radio" value="yes" name="allow_notifications" checked="checked" />Yes</label>
					<label class="radio"><input type="radio" value="no" name="allow_notifications" />No</label>
					<div class="opts">
						<label class="chkbx"><input type="checkbox" value="user_signed_up" checked="checked" />User signed up (edit)</label>
						<label class="chkbx"><input type="checkbox" value="user_added_content" checked="checked" />User added content</label>
					</div>
				</div><!-- content -->
			</fieldset>
			<fieldset class="type1" style="float:right; width:45%; height:95px;">
				<legend>Notification Method:</legend>
				<div class="content">
					<label class="radio"><input type="radio" value="notifications_method_email" name="notifications_method" checked="checked" />Email</label>
					<label class="radio"><input type="radio" value="notifications_method_aim" name="notifications_method" />AIM</label>
					<label class="radio"><input type="radio" value="notifications_method_text" name="notifications_method" />Text (mobile)</label>
				</div><!-- content -->
			</fieldset>
			<fieldset style="clear:both; padding:0px 0 0 0;">
				<h2>Event</h2>
				<div class="item">
					<label class="floatl">From (email):</label>
					<input name="from_email" type="text"/>
				</div>
				<div class="item">
					<label class="floatl">From (display name):</label>
					<input name="from_name" type="text"/>
				</div>
				<div class="item">
					<label class="floatl">Email Subject:</label>
					<input name="subject" type="text" style="width:50%;"/>
				</div>
				<div class="item">
					<label class="floatl">Email Body:</label>
					<textarea rows="10" cols="40" style="width:50%;"></textarea>
				</div>
			</fieldset>
		</form>
		<div class="bottom">
			<button class="save">Save</button>
			<button>Preview Notification</button>
		</div>
	</div><!-- step -->
	
<!--////////////// 	Advertising	///////////////// -->
	
	<div class="step advertising">
		<form action="" class="clearfix">
			<fieldset>
				<label class="chkbx"><input type="checkbox" value="support_ads" checked="checked" />Support Ads</label>
				<div class="item item2" style="margin:20px 0 0 0;">
					<label>Set key values for this application</label><br />
					<input name="app_ads_key_values" size="50" type="text"/>
				</div>
				<div class="item item2" style="margin:20px 0 40px 0;">
					<label>Number of Ads per show:</label>
					<select>
						<option value="1" selected="selected">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select>
				</div>
			</fieldset>

			<fieldset class="type1" style="float:left; width:30%;">
				<legend>Ad Policy</legend>
				<div class="item"><label class="radio"><input type="radio" value="view_based" name="ad_policy" checked="checked" />View based</label></div>
				<div class="item"><label class="radio"><input type="radio" value="time_based" name="ad_policy" />Time based</label></div>
			</fieldset>
			
			<fieldset class="type1" style="float:right; width:60%;">
				<legend>Ad Types</legend>
				<table cellpadding="0" cellspacing="10px" style="width:100%;">
					<colgroup width="75%"></colgroup>
					<colgroup></colgroup>
					<colgroup></colgroup>
					<tbody>
						<tr>
							<td><label class="chkbx"><input type="checkbox" value="midroll" checked="checked" />Midroll</label></td>
							<td><span class="btn">Details</span></td>
							<td><a href="#">Sample</a></td>
						</tr>
						<tr>
							<td><label class="chkbx"><input type="checkbox" value="postroll" checked="checked" />Postroll</label></td>
							<td><span class="btn">Details</span></td>
							<td><a href="#">Sample</a></td>
						</tr>
						<tr>
							<td><label class="chkbx"><input type="checkbox" value="adjacent" checked="checked" />Adjacent</label></td>
							<td><span class="btn">Details</span></td>
							<td><a href="#">Sample</a></td>
						</tr>
						<tr>
							<td><label class="chkbx"><input type="checkbox" value="overlay" checked="checked" />Overlay</label></td>
							<td><span class="btn">Details</span></td>
							<td><a href="#">Sample</a></td>
						</tr>
						<tr>
							<td><label class="chkbx"><input type="checkbox" value="preroll" checked="checked" />Preroll</label></td>
							<td><span class="btn">Details</span></td>
							<td><a href="#">Sample</a></td>
						</tr>
					</tbody>
				</table>
			</fieldset>
		</form>
		<div class="bottom">
			<button class="save">Save</button>
		</div>
	</div><!-- step -->
		
<!--////////////// 	Get Code	///////////////// -->
	
	<div class="step getCode">
		<h1 style="text-align:center; margin:30px auto; color:#666;">Congratulations!</h1>
	</div><!-- step -->
	
</div><!-- #page_new_app" -->

<script type="text/javascript">
		jQuery(document).ready(function(){
			
			var templateType = null;
			
			$("div.step div.bottom > button.save").click(function(){
				if( !$("#steps td.current").hasClass("last") ){ /* if it's not the last button eg. "get code", procceed. */
					if( $("#steps td.selected").hasClass("current") ){
						$("#steps td.current").attr("class","done lastdone").siblings().removeClass("lastdone").end().next().addClass("current selected");  /* example output: "done","done","done lastdone","current"  */
						$(this).parents("div.step").hide().next(".step").show();
					}
					else
						$("#steps td.selected").next().trigger("click");
				}
			});

			$("#steps td").click(function(){
				if( $(this).hasClass("done") || $(this).hasClass("selected1") ){
					/* mark selected TD in #steps menu */
					$("#steps td").removeClass("selected").removeClass("selected1");  // remove all additional classs', and 'current' if clicked, then its default style is Active, after 'selected1' is removed.
					
					if( $(this).hasClass("done") && !$(this).hasClass("lastdone") )
						$(this).addClass("selected").prev().addClass("selected1").end().siblings(".current").addClass("selected1").siblings(".lastdone").addClass("selected1");
					
					else if( $(this).hasClass("lastdone") ) 
						$(this).addClass("selected").prev().addClass("selected1").end().siblings(".current").addClass("selected1");
					
					else if( $(this).hasClass("current") )
						$(this).addClass("selected");
					
					/* Selects the div.step according to the index of the menu td. [ 2nd TD -> 2nd DIV.step is shown ] */
					var pos = $(this).parent().find("td").index( $(this)[0] );
					$("#page_new_app div.step").hide().eq(pos).show();
				}
			});
			
			chooseTemplate = function(type){
				templateType = type;
				if(templateType == 'simple') 
					$("#templateImg").attr("src","/images/cms/newApp/simplePlayer.jpg")
				else if(templateType == 'extended') 
					$("#templateImg").attr("src","/images/cms/newApp/exPlayer.jpg");
				$("div.step.template ul.types li:eq(1) div").trigger("click");
			}
			
			$("div.step.template ul.types div").click(function(){
				if( templateType != null ){
					var pos = $(this).parents("ul").find("li").index( $(this).parent()[0] );
					$(this).parent().addClass("active").siblings().removeClass("active");
					$(this).parents("div.template").find("div.temp").hide().eq(pos).show();
				}
			});
			
			nextTemplatePage = function(e){
				$("div.step.template ul.types li.active").next("li").find("div").trigger("click");
			}
			
				/* permissions section */

				$("#page_new_app > div.permissions label input[@type='radio']").click(function(){
					if( $(this).attr("value") == "password" )
						$(this).parents("div.item").next().show("fast");
					else
						$(this).parents("div.item").siblings("input.pass").hide("fast");
				});
			
				/* components section */

				$("fieldset.checkboxs input[@type='checkbox']").click(function(){
					var divitem = $(this).parents("div.item")
					if( $(this)[0].checked )
						divitem.find("div.opts").show("fast");
					else
						divitem.find("div.opts").hide("fast");
				});
			
		});
</script>