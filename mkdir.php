<?php
if(isset($_GET['dir']) && isset($_GET['dirName'])){
    $dir = $_GET['dir'];
    $dirName = $_GET['dirName'];
    $pathname = "{$dir}/{$dirName}";
    if(!file_exists($pathname)){
        mkdir($pathname);
    }
    $redirect = dirname($_SERVER[PHP_SELF]) . "/index.php?dir={$dir}";
    header("Location:{$redirect}");
}


