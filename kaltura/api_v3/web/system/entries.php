<?php
require_once("systembase.php");
require_once("investigateHelper.class.php");

define ( 'DEFAULT_PARTNER' , "" );

function getList ( $input_map , $prefix )
{
	$arr = array();
	foreach ( $input_map as $name => $value)
	{
		if ( strpos ( $name , $prefix ) === 0 )
		{
			$arr[] = substr ( $name , strlen( $prefix ) + 1 );
		}
	}

	return implode ( "," , $arr );
}

// pager function 
function createPageFor ( $p , $current_page , $page_size , $count )
{
	$p = (int)$p;
	$a = $p * $page_size + 1;
	$b = (($p+1) * $page_size) ;
	$b = min ( $b , $count ) ;// don't let the page-end be bigger than the total count
	if ( $p == $current_page ) 
	{
		$str = "{$a}-{$b} &nbsp; ";
//		$str =  "[{$a}-{$b}] ";
	}
	else
		$str =  "[<a href='javascript:gotoPage ($p)'>{$a}-{$b}</a>] &nbsp; "; 
		
	return $str;
}

// function for creating the input fields
function filterText ( $name , $def_value=null, $width_px=100)
{
	global $filter;
	$type = "text";
	$value = $filter->get ( "$name");
	if ( $value == null ) $value = $def_value;
	return "<input style='width:{$width_px}px;' type='$type' id='filter_{$name}' name='filter_{$name}' value='$value'>";
}

function filterSelect( $name ,  $map )
{
	global $filter;
	$str = "<select id='filter_{$name}' name='filter_{$name}'>";
	foreach ( $map as $value => $display )
	{
		$selected = $filter->get ( $name ) == $value ? "selected='selected'" : "";		
		if ( $filter->get ( $name ) === null ) $selected = "";
		
		$str .= "<option value='$value' $selected >$display</option>";
	}
	$str .= "</select>";
	return $str;
}

function filterCheck ( $name , $map , $value , $force_check = false )
{
	global $filter ;
	$str = "<input type='checkbox' id='filter_{$name}_{$value}' name='filter_{$name}_{$value}' value='1'  ";
	
	$filter_val = $filter->get ( $name );
	$filter_val_arr = explode ("," , $filter_val );
	if ( $force_check || in_array ( $value , $filter_val_arr ))
		$str .= " checked='checked' ";
/*	if ( strpos ( $filter_val , "" . $value ) !== FALSE )
		$str .= " checked='checked' ";
		*/
	$str .= ">";
	$str .= getFromMap( $value , $map , true ) . "&nbsp;&nbsp;";
	return $str;
}

// TODO - use calendar
function filterDate( $name )
{
	$type="text";
	global $filter;
	return "<input class='datepicker' style='width:80px;' type='$type' id='filter_{$name}' name='filter_{$name}' value='" . $filter->get ( "$name") . "'>";
}




$start = microtime(true);
$page_size = $limit = min ( getP ( "page_size" , 20 ) , 100 );  // default page_size and maximum page_size 
$page = getP ( "page" , 0 );

// the parameter 'page' always passes - use it as an indicator for the first_time
$first_time = ($page === null);

//echo "[$page][$first_time]";

$offset = $page* $limit;

		
$c = new Criteria();

// filter only clips and roughcuts NOT all the other playslits or such 
$c->add ( entryPeer::TYPE , array ( entry::ENTRY_TYPE_MEDIACLIP , entry::ENTRY_TYPE_SHOW ) , Criteria::IN ); 
$filter = new entryFilter();
$filter->set ( "_eq_partner_id" , DEFAULT_PARTNER ); // by default - filter out all the other partners
$filter->fillObjectFromRequest( $_REQUEST , "filter_" , null);
$filter->set ( "_in_media_type" , getList ( $_REQUEST , "filter__in_media_type" ) );
$status_filter = getList ( $_REQUEST , "filter__in_status" );
if (!$status_filter) $status_filter = '-1,0,1';
$filter->set ( "_in_status" , $status_filter );
$filter->attachToCriteria( $c );
$c->addDescendingOrderByColumn( entryPeer::CREATED_AT );
$count = entryPeer::doCount ( $c );
$c->setLimit( $limit );

if ( $offset > 0 ) $c->setOffset( $offset );

entryPeer::allowDeletedInCriteriaFilter(); // don't filter out the deleted by default
$entries = entryPeer::doSelect ( $c );
?>

<? require ( "header.php") ?>
<style type="text/css">
.tr1 {background-color: #DDD;}
.tr2 {background-color: #EEE;}
</style>

<script type="text/javascript">
function gotoPage( page_to_go )
{
	pg = document.getElementById('page');
	pg.value= page_to_go;
	
	document.getElementById('form1').submit();
}

function investigate ( entryId )
{
	window.location = "./investigate.php?entry_id=" + entryId;
}
</script>

<h2>Entries In Process</h2>
<ul id="show_options">
 <li><a href="javascript:sh('howwhen');">When / how should I use this ?</a>
  <ul id="howwhen">

	<li>This screen lists the Entries in the system.&nbsp; Entries are any media or file that you have added to your server by any means (such as upload).</li>
	<li>By default, the only Entries shown are those that are being imported or converted or have failed to process. &nbsp;You can control which Entries to see by <a href="javascript:sh('form1')">using filters</a>.</li>
	<li>Click the Entry name to &quot;Investigate&quot; that specifc Entry and learn more about it (for example: why it failed to convert).</li>

    <li>This &quot;Entries In Process&quot; screen is where you want to come back to to check on issues that might have occurred.&nbsp; For example:  if newly added media isn't available yet  or the system hasn't notified you of a conversion conversion being completed after validating that the <a href="batchwatch.php">batches</a> are up, etc.</li>
  </ul>
 </li>
 <li>

  <a href="javascript:sh('form1');">Show Filters</a>
		<form id='form1'>
			<input type='hidden' name='page' id='page' value='<?php $page ?>'>
		<em>Hover over filter names to see description.</em>
		<table class='entries_table' id="entry_filters">
			<tr><td class="entries_filter_title">Media type<span class="tooltip">Check the boxes near the media types (audio, video, image, mix) that you would like to be shown in the Search results.</span></td>
				<td>
<?php 
	echo "<input type=\"hidden\" name=\"filter__in_media_type_-9\" value=\"1\">";
	echo filterCheck ("_in_media_type" , $media_type_list , entry::ENTRY_MEDIA_TYPE_VIDEO , $first_time );
	echo filterCheck ("_in_media_type" , $media_type_list , entry::ENTRY_MEDIA_TYPE_IMAGE , $first_time );
	echo filterCheck ("_in_media_type" , $media_type_list , entry::ENTRY_MEDIA_TYPE_AUDIO , $first_time );
	echo filterCheck ("_in_media_type" , $media_type_list , entry::ENTRY_MEDIA_TYPE_SHOW , $first_time );
?>
				</td>
			</tr>
			<tr><td class="entries_filter_title">Status<span class="tooltip">Check the boxes near the entry status that you would like to be shown in the Search results. The entry status indicates the phase of the entry from importing (import) till it is ready to be played or edited (ready).</span></td>
				<td>
<?php 
	echo "<input type=\"hidden\" name=\"filter__in_status_-9\" value=\"1\">";
	echo filterCheck ("_in_status" , $status_list , entry::ENTRY_STATUS_ERROR_CONVERTING , $first_time );
	echo filterCheck ("_in_status" , $status_list , entry::ENTRY_STATUS_IMPORT , $first_time );
	echo filterCheck ("_in_status" , $status_list , entry::ENTRY_STATUS_PRECONVERT , $first_time );
	echo filterCheck ("_in_status" , $status_list , entry::ENTRY_STATUS_READY , 0 );
	echo filterCheck ("_in_status" , $status_list , entry::ENTRY_STATUS_DELETED , 0 );
	echo filterCheck ("_in_status" , $status_list , entry::ENTRY_STATUS_MODERATE , 0 );
	echo filterCheck ("_in_status" , $status_list , entry::ENTRY_STATUS_BLOCKED , 0 );
?>
				</td>			
			</tr>
			<tr><td class="entries_filter_title">Created Between<span class="tooltip">Select dates to show only the entries that were created during the selected period of time.</span></td>
				<td>From: <?php echo filterDate ("_gte_created_at" ) ?>  To: <?php echo filterDate ("_lte_created_at" ) ?></td>
			 </tr>
			<tr><td class="entries_filter_title">Partner Id<span class="tooltip">Enter the ID of a Partner in the system to display that Partner's entries only. By default the Partner ID is1 for your CE installation.</span></td>
				<td><?php echo filterText ("_eq_partner_id" , DEFAULT_PARTNER , 40 ) ?></td>
			</tr>
			<tr><td class="entries_filter_title">Search Filter</td>
			 	<td><?php echo filterText ("_mlikeor_tags-admin_tags-name" ,null  , 400 ) ?></td>
			</tr>
			<tr><td class="entries_filter_title">Ids<span class="tooltip">Here you can enter a comma separated list of specific entry IDs to be shown in the Search results.</span></td>
			 	<td><?php echo filterText ("_in_id" ) ?></td>
			</tr>
			<tr><td colspan="2"><button type="submit">Search</button></td></tr>
		</table>
			
		</form>  
		<!-- end filters box -->
  </li>
</ul>

<?

$str = "";
$start_page = max ( 0 , $page - 5 );
$very_last_page = $count / $page_size;
$end_page = min ( $very_last_page , $start_page + 10 );
//echo "[$page] [$start_page] [$end_page]";
?>
<p id="pager"><strong>
<?php if (!$page)
{
	$starting_point = 1;
}
else
{
	$starting_point = ($page*$page_size)+1;
}
?>

	Total results: <?= $count ?> &nbsp;&#8226;&nbsp; Showing: <?= $starting_point .' - '. (($page*$page_size)+$page_size); ?> &nbsp;&#8226;&nbsp; Go to:</strong>&nbsp; 
<?
for ( $p=$start_page ; $p < $end_page ; $p++)
{
	$str .= createPageFor ( $p , $page  , $page_size , $count);
}

if ( $start_page > 0 ) echo createPageFor ( 0, $page , $page_size , $count )  ; // add page 0 if not in list  
if ( $start_page > 1 ) echo " &nbsp; ..."; // have some dots if there is a real gap between 0 and the rest
echo $str;
if ( $end_page < $very_last_page -1 ) echo "... &nbsp; "; 
if ( $end_page < $very_last_page ) echo createPageFor ( $very_last_page , $page  , $page_size, $count); //add last page if lot in list
?>
</p>
	<table class="entries_table" id="entries_table">
	<tr>
		<th>Thumbnail<span class="tooltip">The thumbnail of the entry, this is also the image that will be shown in the player when loaded when autoPlay=false.</span></th>
		<th>Name<span class="tooltip">The name of the entry in the system, this field is limited to 60 characters, and currently the language is limited to English only.</span></th>
		<th>Id<span class="tooltip">The ID of this entry in the system. When using the APIs in the system or loading media in the various widgets, this is the unique ID that should be used for this specific entry.</span></th>
		<th>Partner Id<span class="tooltip">The ID of the Partner that the entry belongs to - by default the Partner ID for your CE installation is 1.</span></th>
		<th>Type<span class="tooltip">This defines a conceptual type of the entry. Among other things, this is used internally to determine what APIs can be performed on a given entry.</span></th>
		<th>Media Type<span class="tooltip">The media type of the actual file stored on the disk (for example: a video file or video mix).</span></th>
		<th>Status<span class="tooltip">The entry status indicates the phase of the entry from importing (import) till it is ready to be played or edited (ready) </span></th>
		<th>Data (Size)<span class="tooltip">The version ID of the entry (every entry in the system can have multiple versions. This field represents the latest version ID of the entry) and (inside the parentheses) the dimensions (width x height) of the media file that the entry represents.</span></th>
		<th>Custom Data<span class="tooltip">PHP serialized array that contain additional details regarding the entry (e.g. conversion settings, user ID, dimensions etc.).</span></th>
		<th>Duration<br>(Seconds)<span class="tooltip">The length (i.e. in video or audio files) of the media file this entry represents. While an entry is being imported or converted this value will be 0.</span></th>
		<th>Created At<span class="tooltip">The date this entry was created on.</span></th>
		<th>Modified At<span class="tooltip">This field is updated once on addEntry, deleteEntry and every time a mix (roughcut) is updated (setMetaData). Use this field to determine when the last time a mix entry was changed or when the entry was deleted.</span></th>
		<th>Updated At<span class="tooltip">This field is updated every time an entry object is saved. Use this to determine the most recent date an entry was changed / updated.</span></th>
	</tr>
		
<?php
$even = 1;
foreach ( $entries as $entry )
{
	$class = ($even%2)? ' class="even"': '';
	$even++;

	$duration = round ( $entry->getLengthInMsecs() / 100 ) / 10;
	if ( $duration < 0 ) $duration =0;
	echo "<tr $class>" .
		"<td> <img src=\"" . $entry->getThumbnailUrl() . "\" width=\"60\" height=\"45\"></td>" .
		"<td><a href='javascript:investigate(\"" . $entry->getId() . "\")'>" . $entry->getName() . "</a></td>".
		"<td>" . $entry->getId() . "</td>".
		"<td width=\"50px\">" . $entry->getPartnerId() . "</td>".
		"<td>" . getFromMap ( $entry->getType() , $type_list ) . "</td>".
		"<td>" . getFromMap ( $entry->getMediaType() , $media_type_list ) . "</td>".
		"<td><div class=\"" . investigateHelper::entryStatusClass ($entry->getStatus() ). "\">" . getFromMap ( $entry->getStatus(), $status_list ) . "</div></td>".
		"<td width=\"100px\">" . $entry->getData() . " (" . $entry->getWidth() . "x" . $entry->getHeight() . ") </td>" .
		"<td>" . str_replace ( ";" , "; " , $entry->getCustomData() ) . "</td>".	
		"<td style='text-align: right;'>" . $duration . "</td>" .
		"<td class=''>" . $entry->getCreatedAt() . "</td>" .
		"<td class=''>" . $entry->getModifiedAt() . "</td>" .
		"<td class=''>" . $entry->getUpdatedAt() . "</td>" .
	"</tr>";
}
?>	
	</table>
	<script type="text/javascript">
	jQuery(".datepicker").datepick({dateFormat: 'yy-mm-dd'});
	function toggle_filter_table(obj)
	{
		$('#entry_filters').toggle();
		if ($('#entry_filters').css('display') == 'none')
			$('#filter_toggle').html('show filters');
		else
			$('#filter_toggle').html('hide filters');
	
		return false;
	}
	$(function(){
		$('#entries_table th').mouseover(function(e){
			$(this).find('.tooltip').show();
			if ((e.pageX + $(this).find('.tooltip').width()+100) >= $(window).width()){
				$(this).find('.tooltip').css('margin-left', '-200px');
			}
			
		}).mouseout(function(){
			$('.tooltip').hide();
		});		
		$('#entry_filters td.entries_filter_title').mouseover(function(){
			$(this).find('.tooltip').show();
		}).mouseout(function(){
			$('.tooltip').hide();
		});
	});
	</script>
<? require ( "footer.php") ?>