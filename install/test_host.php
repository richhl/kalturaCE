<?php
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $_GET['hostname']);
    curl_setopt($ch, CURLOPT_USERAGENT, "curl/7.11.1");
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_NOBODY, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER , true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    $headers = curl_exec($ch);
    $error = curl_error($ch);

    if ($headers && !$error && !(substr_count($headers, ' 404 ')) && !(substr_count($headers, ' 403 ')))
    {
        echo 1;
    }
    else
    {
        echo 0;
    }
?>