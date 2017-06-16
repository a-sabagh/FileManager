<?php

if (isset($_GET['dir']) && isset($_GET['dirName']) && isset($_GET['copypath'])) {
    $dir = $_GET['dir'];
    $copy = $_GET['copypath'];
    $dirname = $_GET['dirName'];
    $dirpath = "{$dir}/{$dirname}";
    $copypath = "{$copy}/{$dirname}";
    echo "$dir-$copy-$dirname-$dirpath-$copypath";
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
            if(mkdir($copypath)){
                echo 'it work';
            }else{
                echo 'not work';
            }
        } else {
            //directory not empty
            $dirpath_content = $dirpath;
            $dirpath_content_scanned = scandir($dirpath_content);
            $count = count($dirpath_content_scanned);
            for ($i = 0; $i < $count; $i++) {
                $file = $dirpath_content_scanned[$i];
                if (filetype("{$copypath}/{$file}") === 'dir') {
                    recursive_cpdir("{$dirpath}/{$file}");
                } else {
                    copy("{$dirpath}/{$file}", "{$copypath}/{$file}");
                }
            }
        }
        recursive_cpdir($dirpath, $copypath);
        $redirect = dirname($_SERVER[PHP_SELF]) . "/index.php?dir={$dir}";
        header("Location:{$redirect}");
    }

}