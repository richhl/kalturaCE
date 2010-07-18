<?php

?>

	<script type="text/javascript">
		jQuery.noConflict();
		jQuery(document).ready(function(){
	
			var obj_list_name = "#current_partnership_list";
			jQuery(obj_list_name + " > li span.delete").click(function(){
				var conf=confirm("Are you sure?");
				if (conf==true){
					jQuery(this).parents("li").fadeOut("normal");
					sendDelete ( this );
				}
			});
			
			jQuery(obj_list_name + " > li span.edit").click(function(){
				jQuery(this).parents("li").children("div:last").hide("fast").prev("form").show("fast");
			});
			
			cancle_change = function(event, el){
				event.preventDefault();
				jQuery(el).parents("form").hide("fast").next("div").show("fast");
			}
			
			function sendDelete ( element )
			{
				id_str = element.id;
				id =   id_str.substr ( 7 );
				url = "<?php echo url_for ( "system" ) ?>/editPartnership?mode=delete&partnership_id=" + id ;
				jQuery.ajax({	url: url,	async: true } );
						
			}			
	/*
			jQuery('#current_news_list').Sortable({
					accept: 'groupItem',
					helperclass: 'sortHelper',
					opacity: 0.5,
					handle: 'div.handle',
					axis: 'vertically',
					onChange : function(ser){
					},
					onStart : function(){
					},
					onStop : function(){
						$.iAutoscroller.stop();
					}
			});		
	*/
				
		});
		

	</script>
	
	<div id="wraper">
		<form method="post" action="" class="clearfix" enctype="multipart/form-data" >
			<input type="hidden" name="mode" value="add">
			<div class="item">
				<label>Upload image</label>
				<input size="30" name="Filedata" type="file" />
			</div>
			<div class="item">
				<label>Partnership's title</label>
				<input name="text" type="text" />
			</div>
			<div class="item">
				<label>Partnership's date</label>
				<input name="press_date" type="text" />
			</div>
			<div class="item">
				<label>href</label>
				<input name="href" type="text" />
			</div>
			<div class="item">
				<label>alt</label>
				<input name="alt" type="text" />
			</div>
			<div class="item">
				<label>order</label>
				<input name="pr_order" type="text" />
			</div>
			
			<input type="submit" value="Add New" />
		</form>
		<ul id="current_partnership_list" class="items_list">
<?php foreach ( $partnership_list as $partnership ) { ?>
			<li id="news_id_<?php echo $partnership->getId() ?>">
				<form style="display:none" method="post" action="" class="clearfix" enctype="multipart/form-data" >
					<input type="hidden" name="mode" value="modify">
					<input type="hidden" name="id" value="<?php echo $partnership->getId() ?>">
					<div class="item">
						<label>Upload image</label>
						<input size="30" name="Filedata" type="file" />
					</div>
					<div class="item">
						<label>Partnership's title</label>
						<input name="text" type="text" value="<?php echo $partnership->getText() ?>"/>
					</div>
					<div class="item">
						<label>Partnership's date</label>
						<input name="press_date" type="text" value="<?php echo $partnership->getPartnershipDate() ?>"/>
					</div>
					<div class="item">
						<label>href</label>
						<input name="href" type="text"  value="<?php echo $partnership->getHref() ?>"/>
					</div>
					<div class="item">
						<label>alt</label>
						<input name="alt" type="text"  value="<?php echo $partnership->getAlt() ?>"/>
					</div>
					<div class="item">
						<label>order</label>
						<input name="pr_order" type="text"  value="<?php echo $partnership->getPartnershipOrder() ?>"/>
					</div>
				
					<input type='submit' value='Done' />
					<input type='submit' value='Cancel' onclick='cancle_change(event, this)' />
				</form>			
				<div>
					<span class="btn floatr delete" id="delete_<?php echo $partnership->getId() ?>">Delete</span>
					<span class="btn floatr edit" id="delete_<?php echo $partnership->getId() ?>">Edit</span>
					<span class="floatr"><?php echo $partnership->getId() ?> (<?php echo $partnership->getPartnershipOrder() ?> )</span><img src="<?php echo $path . $partnership->getImagePath() ?>" alt="<?php echo $partnership->getAlt() ?>" />
					<div><a rel="nofollow" href="<?php echo $partnership->getHref() ?>"><?php echo $partnership->getText() ?></a></div>
				</div>
				
			</li>
<?php } ?>			
		</ul>
	</div><!-- #wraper -->	