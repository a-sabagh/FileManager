<?php
if(isset($_GET['dir']) && isset($_GET['fileName']) && $_GET['path']){
    $dir = $_GET['dir'];
    $filename = $_GET['fileName'];
    $path = $_GET['path'];
    $filepath = "{$dir}/{$filename}";
    $copypath = "{$path}/{$filename}"; 
    copy($filepath, $copypath);
    $redirect = dirname($_SERVER[PHP_SELF]) . "/index.php?dir={$dir}";
    header("Location:{$redirect}");
}