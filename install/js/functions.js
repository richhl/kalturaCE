function toggle_cdnhost(to_state)
{
    if(to_state)
    {
        document.getElementById('field_cdnhost').disabled = '';
    }
    else
    {
        document.getElementById('field_cdnhost').disabled = 'disabled';
    }
}

function get(id)
{
    return document.getElementById(id);
}

function not_valid_email(email)
{
    if ((email.indexOf('@') > 0) && (email.indexOf('@') < email.lastIndexOf('.'))) return false;
    return true;
}

function hide_all_errors()
{
    error = get('verify_host');
    error.className = 'error_hidden';    
    error = get('verify_name');
    error.className = 'error_hidden';
    error = get('verify_email');
    error.className = 'error_hidden';    
    error = get('verify_pass1');
    error.className = 'error_hidden';    
    error = get('verify_pass2');
    error.className = 'error_hidden';    
    error = get('verify_passwords');
    error.className = 'error_hidden';    
}

function validate_general_form(){
    name = get('general_name');
    email = get('account_email');
    pass1 = get('account_pass1');
    pass2 = get('account_pass2');
    host = get('host');
    
    hide_all_errors();

    if (!try_host(host.value))
    {
        error = get('verify_host');
        error.className = 'error_visible';
        return false;
    }
    
    if (!name.value || name.value == '')
    {
        error = get('verify_name');
        error.className = 'error_visible';
        return false;
    }
    
    if (!email.value || email.value == '' || not_valid_email(email.value))
    {
        error = get('verify_email');
        error.className = 'error_visible';
        return false;
    }
    
    if (!pass1.value || pass1.value == '')
    {
        error = get('verify_pass1');
        error.className = 'error_visible';
        return false;
    }
    
    if (!pass2.value || pass2.value == '')
    {
        error = get('verify_pass2');
        error.className = 'error_visible';
        return false;
    }
    
    if (pass1.value != pass2.value)
    {
        error = get('verify_passwords');
        error.className = 'error_visible';
        return false;
    }
    return true;
}
var ajaxHostTest = false;
function setHostTrue()
{
    ajaxHostTest = true;
}

function setHostFalse()
{
    ajaxHostTest = false;
}
function try_host(hostname)
{
    if ( hostname.indexOf('http://') == -1)
    {
        hostname = 'http://'+hostname+"/install/index.php";
    }
    url_hit = "test_host.php?hostname="+hostname;
    $.ajax( {url: url_hit, async: false, success: function(msg){ if(msg == '0') setHostFalse(); else setHostTrue();} } );
    return ajaxHostTest;
}