<?php
if(isset($_GET['dir']) && $_GET['fileName'] && $_GET['newName']){
    $dir = $_GET['dir'];
    $filename = $_GET['fileName'];
    $newname = $_GET['newName'];
    $oldpath = "{$dir}/{$filename}";
    $newpath = "{$dir}/{$newname}";
    rename($oldpath, $newpath);
    $redirect = dirname($_SERVER[PHP_SELF]) . "/index.php?dir={$dir}";
    header("Location:{$redirect}");
}