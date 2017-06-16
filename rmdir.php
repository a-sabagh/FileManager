<?php

if (isset($_GET['dir']) && isset($_GET['dirName'])) {
    $dir = $_GET['dir'];
    $dirname = $_GET['dirName'];
    $dirpath = "{$dir}/{$dirname}";

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

    function recursive_rmdir($dirpath) {
        if (is_empty_dir($dirpath)) {
            //directory is empty
            rmdir($dirpath);
        } else {
            //directory is not empty
            $dirpath_content = $dirpath;
            $dirpath_content_scanned = scandir($dirpath_content);
            $count = count($dirpath_content_scanned);
            for ($i = 0; $i < $count; $i++) {
                $file = $dirpath_content_scanned[$i];
                if($file !== '.' && $file !== '..'){
                    if(filetype("{$dirpath}/{$file}") === 'dir'){
                        recursive_rmdir("{$dirpath}/{$file}");
                    }else{
                        unlink("{$dirpath}/{$file}");
                    }
                }// file not . and ..
            }//endwhile
            rmdir($dirpath);
        }//directory not empty
    }//recursive_rmdir function
    recursive_rmdir($dirpath);
    $redirect = dirname($_SERVER[PHP_SELF]) . "/index.php?dir={$dir}";
    header("Location:{$redirect}");
}