$(function(){
        $("#send_investigate").click(function(){
                var page = $("html").html();
                var base = '<base href="http://www.kaltura.com/api_v3/system/" />';
                var head = "";
                report_start_tag = '<div id="error_get_help">' ;
                if ($.browser.msie)
                {
                    head = "<head>"+$("head").html();
                    page = head+page;
                    report_start_tag = '<DIV id=error_get_help>' ;
                }
                page = page.replace('<head>','<head>'+base);
                report_start = page.indexOf(report_start_tag);
                report_end_tag = '<!-- endReportorm -->';
                report_end = page.indexOf(report_end_tag) + report_end_tag.length;
                replace_report = page.substr(report_start, report_end - report_start);
                page = page.replace(replace_report, '');
                $("#investigate_post").html(escape('<html>'+page+'</html>'));
                $("#error_report_form").trigger("submit");
                return false;
        });
        
        if (this_investigate_page)
        {
            $('table th').mouseover(function(e){
                    $(this).find('.tooltip').show();
                    if ((e.pageX + $(this).find('.tooltip').width()+100) >= $(window).width()){
                            $(this).find('.tooltip').css('margin-left', '-200px');
                    }
            }).mouseout(function(){
                    $('.tooltip').hide();
            });
        }
});
// header functions
  function gotoPage( page_to_go ) {
	pg = document.getElementById('page');
	pg.value= page_to_go;
	document.getElementById('form1').submit();
  }

  function investigate ( entryId ) {
	window.location = "./investigate.php?entry_id=" + entryId;
  }

  function get(id) {
	return document.getElementById(id);
  }

  function sh(obj) {
	os=get(obj).style;
    if (os) {
		if(os.display=='none' || !os.display) 
			os.display='block';
		else
			os.display='none';
	}
  }

// investigate functions
//jQuery.noConflict();
function show ( elem )
{
//	alert ( "1" );
	e = jQuery ( elem );
	t = e.find( "textarea" ).text() ;
	_the_text = jQuery ( "#the_text" );
	text_area  = _the_text.find ( "textarea" );
	text_area.text ( t );
	_the_text.css ( "display" , "block" );
}

function closeText()
{
	_the_text = jQuery ( "#the_text" );
	_the_text.css ( "display" , "none" );
}

function restartJob(url)
{
	if (confirm("Restart Job?"))
		document.location = url;
}

function reconvert ( url )
{
	if (confirm("Reconvert ?"))
		document.location = url;
}

function resendNotification(url)
{
	if (confirm("Resend Notification?"))
		document.location = url;
}

function update ( val , id , property_name )
{
//	val = elem.innerHTML; 
	var new_val = prompt ( "Change propery '" +  property_name + "' from [" + val + "]" );
	if ( new_val )
	{
		res = confirm  ("are you sure you'd like to update propery '" +  property_name + "' with value [" + new_val + "] ??" );
		if ( res )
		{
			// TODO - executeCommand .... 
			url = "./executeCommand?command=updateEntry&id=" + id + "&name=" + property_name + "&value=" + new_val;
			// ajax for the poor :-()
			var temp_image = new Image();
			temp_image.src = url; 
			
			setTimeout ( 'delayedReload()' , 1000 );
		}
	} 
}

var conv_window = null;
function conversionProfileMgr ( conv_quality )
{
	partner_id = '<? echo $entry ? $entry->getpartnerId() : "" ?>';
	// TODO - conversionProfileMgr
	url = "./conversionProfileMgr?go=go&filter__eq_partner_id=" + partner_id + "&filter__eq_profile_type=" + conv_quality;
	conv_window = window.open ( url , "conv_window" );
}

function delayedReload()
{
	window.location.reload();
}