<?php
 $file_path=str_replace('\\','/',__DIR__); 
 $file_path =str_replace($_SERVER['DOCUMENT_ROOT'],'',$file_path);
 $path = '//'.$_SERVER['HTTP_HOST'].$file_path;

//$indexpath = 'http://'.$_SERVER['HTTP_HOST'].'/profile/';
?>