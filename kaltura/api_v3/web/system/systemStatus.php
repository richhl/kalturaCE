<?php
  $smtp_server = (ini_get('SMTP'))? ini_get('SMTP') :"localhost";
  $port = (ini_get('smtp_port'))? ini_get('smtp_port'): 25;
  $handle = @fsockopen($smtp_server,$port);
  if ($handle)
  {
    fputs($handle, "QUIT\r\n");
    $mail_server_status['status'] = 1;
    $mail_server_status['msg'] = '<div class="verify passed">mailserver found at '.$smtp_server.':'.$port.'</div>';
  }
  else {
    $mail_server_status['status'] = 0;
    $mail_server_status['msg'] = 'Failed to connect to mailserver at "'.$smtp_server.'" port '.$port.', verify your "SMTP" and "smtp_port" setting in php.ini<br />
    Mails that are supposed to be sent on different events will not be sent.';
  }
?>
<h2>System Status</h2>

    <h3>Mail Server: <span>
        <span class="value <?php echo ($mail_server_status['status'])? '': 'smtperror'; ?>"><?php echo ($mail_server_status['status'])? 'UP': 'DOWN'; ?></span>
        <?php if (($mail_server_status['status']))
        {
            echo '(Host: '.$smtp_server.'; Port: '.$port.')';
        }
        else
        {
            echo $mail_server_status['msg']; 
        }
        ?>
    </span></h3><br />
