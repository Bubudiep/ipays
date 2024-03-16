<?php
    session_start();
    $app = parse_ini_file("app.ini", true);
    $tablet_browser = 0;
	$mobile_browser = 0;
    if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
        $tablet_browser++;
    }   
    if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
        $mobile_browser++;
    } 
    if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
        $mobile_browser++;
    }
    if ($mobile_browser>0){
        include('include/mobile/main.php');
        exit();
    }
    include('include/layout/header.php');
    include('include/layout/main.php');
    include('include/layout/footer.php');
?>