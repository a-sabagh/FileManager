<?php

if (isset($_GET['dir']) && isset($_GET['dirName']) && isset($_GET['copypath'])) {
    $dir = $_GET['dir'];
    $copy = $_GET['copypath'];
    $dirname = $_GET['dirName'];
    $dirpath = "{$dir}/{$dirname}";
    $copypath = "{$copy}/{$dirname}";

    function is_empty_dir($dirpath) {
        if (!is_readable($dirpath))
            return null;
        $dircontent = scandir($dirpath);
        if (count($dircontent) == 2) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function recursive_cpdir($dirpath, $copypath) {
        if (is_empty_dir($dirpath)) {
            //empty dir
            mkdir($copypath);
        } else {
            //directory not empty
            mkdir($copypath);
            $dirpath_content_scanned = scandir($dirpath);
            $count = count($dirpath_content_scanned);
            for ($i = 0; $i < $count; $i++) {
                $file = $dirpath_content_scanned[$i];
                if ($file !== '.' && $file !== '..') {
                    if (filetype("{$dirpath}/{$file}") === 'dir') {
                        recursive_cpdir("{$dirpath}/{$file}", "{$copypath}/{$file}");
                    } else {
                        copy("{$dirpath}/{$file}", "{$copypath}/{$file}");
                    }//is file
                }
            }// end for
        }// recursive_cpdir function
    }

    recursive_cpdir($dirpath, $copypath);
    $redirect = dirname($_SERVER[PHP_SELF]) . "/index.php?dir={$dir}";
    header("Location:{$redirect}");
}