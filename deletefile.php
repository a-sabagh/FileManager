<?php
if(isset($_GET['dir']) && isset($_GET['fileName'])){
    $dir = $_GET['dir'];
    $filename = $_GET['fileName'];
    $removepath = "{$dir}/{$filename}";
    unlink($removepath);
    $redirect = dirname($_SERVER[PHP_SELF]) . "/index.php?dir={$dir}";
    header("Location:{$redirect}");
}