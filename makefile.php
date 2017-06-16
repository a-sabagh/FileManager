<?php

if (isset($_GET['dir']) && isset($_GET['fileName'])) {
    $dir = $_GET['dir'];
    $filename = $_GET['fileName'];
    $dirpath = "{$dir}/{$filename}";
    $mode = "w+";
    $handler = fopen($dirpath, $mode);
    fclose($handler);
    $redirect = dirname($_SERVER[PHP_SELF]) . "/index.php?dir={$dir}";
    header("Location:{$redirect}");
}