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
    $mail_server_status['msg'] = '<div class="verify optional">Failed to connect to mailserver at "'.$smtp_server.'" port '.$port.', verify your "SMTP" and "smtp_port" setting in php.ini<br />
    Mails that are supposed to be sent on different events will not be sent.</div>';
  }
?>
<h3>System Status</h3>
<div class="smtp_status">
<h5>Mail Server</h5>
<ul>
<li class="title">Status: <span class="value <?php echo ($mail_server_status['status'])? 'passed': 'error'; ?>"><?php echo ($mail_server_status['status'])? 'Up': 'Down'; ?></span>
<?php if (($mail_server_status['status'])): ?>
(Host: <?php echo $smtp_server; ?>, Port: <?php echo $port; ?>)
<?php else: ?></li>
<li class="error_message"><?php echo $mail_server_status['msg']; ?></li>
<?php endif; ?>
</ul>
</div>