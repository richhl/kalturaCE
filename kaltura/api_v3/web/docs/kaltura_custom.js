jQuery(function() {
    fullURL = parent.document.URL;
    query_string = fullURL.substring(fullURL.indexOf('?')+1,fullURL.length);
    splitted_q = query_string.split("&");
    q = Array();
    for(i=0;i<splitted_q.length;i++)
    {
        split_value = splitted_q[i].split("=");
        q[split_value[0]] = split_value[1];
    }
    
    $('a[href*='+q['goto']+']').click(function(){
        window.open(this.href , "right");
    }).trigger('click');
    
});