﻿<?php  
    header("Content-type: text/html; charset=utf-8");
    if (isset($_GET['view-source'])) { 
        show_source(__FILE__); 
        exit(); 
    } 

    include('flag.php'); 

    $smile = 1;  

   if (!isset ($_GET['^_^'])) $smile = 0;  
    if (preg_match ('/\./', $_GET['^_^'])) $smile = 0;  
    if (preg_match ('/%/', $_GET['^_^'])) $smile = 0;  
    if (preg_match ('/[0-9]/', $_GET['^_^'])) $smile = 0;  
    if (preg_match ('/http/', $_GET['^_^']) ) $smile = 0;  
    if (preg_match ('/https/', $_GET['^_^']) ) $smile = 0;  
    if (preg_match ('/ftp/', $_GET['^_^'])) $smile = 0;  
    if (preg_match ('/telnet/', $_GET['^_^'])) $smile = 0;  
    if (preg_match ('/_/', $_SERVER['QUERY_STRING'])) $smile = 0; 
    if ($smile) { 
        if (@file_exists ($_GET['^_^'])) $smile = 0;  
    }  
    if ($smile) { 
        $smile = @file_get_contents ($_GET['^_^']);  
        if ($smile === "(●'◡'●)") die($flag);  
    }  
?> 
