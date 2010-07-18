<div class="page_header">
	<h1>Graphs</h1>
</div>

<div class="section">
	<div class="title">
		<h2>Last 24 Hours (per hour)</h2>
	</div>
	<div class="legend">
		<span class="red">Users</span>
		<span class="green">Shows</span>
		<span class="blue">Entries</span>
	</div>
	<div id="graph1Wrapper"></div>
</div><!-- section -->

<div class="section">
	<div class="title">
		<h2>Last 31 Days (per day)</h2>
	</div>
	<div class="legend">
		<span class="red">Users</span>
		<span class="green">Shows</span>
		<span class="blue">Entries</span>
	</div>
	<div id="graph2Wrapper"></div>
</div><!-- section -->

<script type="text/javascript">
	$(function () {
		var so = new SWFObject("/swf/klinechart.swf", "graph1", "100%", "330", "9", "#ffffff");
		so.addParam("wmode", "opaque");
		so.write("graph1Wrapper");
		
		var so2 = new SWFObject("/swf/klinechart.swf", "graph2", "100%", "330", "9", "#ffffff");
		so2.addParam("wmode", "opaque");
		so2.write("graph2Wrapper");
	});
	
	function loadGarph(){ 
		$("#graph1")[0].loadGraphXML('getLast24HoursReport');
		$("#graph2")[0].loadGraphXML('getLast31DaysReport');
	};
</script>