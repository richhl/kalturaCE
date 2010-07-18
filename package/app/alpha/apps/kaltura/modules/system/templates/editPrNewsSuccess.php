<?php

?>

	<script type="text/javascript">
		jQuery.noConflict();
		jQuery(document).ready(function(){
	
			jQuery("#current_news_list > li span.delete").click(function(){
				var conf=confirm("Are you sure?");
				if (conf==true){
					jQuery(this).parents("li").fadeOut("normal");
					sendDelete ( this );
				}
			});
			
			jQuery("#current_news_list > li span.edit").click(function(){
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
				url = "<?php echo url_for ( "system" ) ?>/editPrNews?mode=delete&news_id=" + id ;
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
				<label>News' title</label>
				<input name="text" type="text" />
			</div>
			<div class="item">
				<label>News' date</label>
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
		<ul id="current_news_list" class="items_list">
<?php foreach ( $news_list as $news ) { ?>
			<li id="news_id_<?php echo $news->getId() ?>">
				<form style="display:none" method="post" action="" class="clearfix" enctype="multipart/form-data" >
					<input type="hidden" name="mode" value="modify">
					<input type="hidden" name="id" value="<?php echo $news->getId() ?>">
					<div class="item">
						<label>Upload image</label>
						<input size="30" name="Filedata" type="file" />
					</div>
					<div class="item">
						<label>News' title</label>
						<input name="text" type="text" value="<?php echo $news->getText() ?>"/>
					</div>
					<div class="item">
						<label>News' date</label>
						<input name="press_date" type="text" value="<?php echo $news->getPressDate() ?>"/>
					</div>
					<div class="item">
						<label>href</label>
						<input name="href" type="text"  value="<?php echo $news->getHref() ?>"/>
					</div>
					<div class="item">
						<label>alt</label>
						<input name="alt" type="text"  value="<?php echo $news->getAlt() ?>"/>
					</div>
					<div class="item">
						<label>order</label>
						<input name="pr_order" type="text"  value="<?php echo $news->getPrOrder() ?>"/>
					</div>
				
					<input type='submit' value='Done' />
					<input type='submit' value='Cancel' onclick='cancle_change(event, this)' />
				</form>			
				<div>
					<span class="btn floatr delete" id="delete_<?php echo $news->getId() ?>">Delete</span>
					<span class="btn floatr edit" id="delete_<?php echo $news->getId() ?>">Edit</span>
					<span class="floatr"><?php echo $news->getId() ?> (<?php echo $news->getPrOrder() ?> )</span><img src="<?php echo $path . $news->getImagePath() ?>" alt="<?php echo $news->getAlt() ?>" />
					<div><a rel="nofollow" href="<?php echo $news->getHref() ?>"><?php echo $news->getText() ?></a></div>
				</div>
				
			</li>
<?php } ?>			
		</ul>
	</div><!-- #wraper -->	