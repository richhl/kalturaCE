<graph caption="" bgcolor="0xffffff" 
	border="false" bordercolor="0xffffa7" 
	customxaxis="true" minimumx="0"  maximumx="10" intervalx="1" xaxisname="Date"
	xtype="Category" dataunits="days"
	customyaxis="false" minimumy="0" maximumy="100" intervaly="10" yaxisname=""
	showdatatips="true" mousesensitivity="50" datatipmode="multiple"
	gridlinesdirection="both" customgridlines="true" lineshadow="false"
	horizontalstrokecolor="0xeeeeee" horizontalstrokesize=".3" 
	horizontalfillcolor="0xffffff" horizontalfillsize=".3" horizontalstrokealpha="0.1"
	horizontalalternatefillcolor="0xffffff" horizontalalternatefillsize=".3"
	verticalstrokecolor="0xcccccc" verticalstrokesize=".5"  verticalstrokealpha="0.5"
	verticalfillcolor="0xffffff" verticalfillsize=".3" 
	verticalalternatefillcolor="0xffffff" verticalalternatefillsize=".3">
	
	<xcategory>
		<?php foreach($entries as $entry): ?>
			<point>
				<x><?=$entry['day']; ?></x>
			</point>
		<?php endforeach; ?>
	</xcategory>
	
	<line id="line1" name="Users" color="0xcc0000" strokewidth="2" linetype="curve">	
		<?php foreach($users as $user): ?>
			<point>
				<y><?=$user['activity']; ?></y>
			</point>
		<?php endforeach; ?>
	</line>
	
	<line id="line2" name="Shows" color="0x00cc00" strokewidth="2" linetype="curve">	
		<?php foreach($shows as $show): ?>
			<point>
				<y><?=$show['activity']; ?></y>
			</point>
		<?php endforeach; ?>
	</line>
	
	<line id="line3" name="Entries" color="0x0000cc" strokewidth="2" linetype="curve">	
		<?php foreach($entries as $entry): ?>
			<point>
				<y><?=$entry['activity']; ?></y>
			</point>
		<?php endforeach; ?>
	</line>
	
</graph>