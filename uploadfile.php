<?php
if (isset($_POST['upload_file'])) {
    $dir = (isset($_GET['dir'])) ? $_GET['dir'] : '';
    $file_name = $_FILES['uploaded_file']['name'];
    $file_type = $_FILES['uploaded_file']['type'];
    $file_size = $_FILES['uploaded_file']['size'];
    $file_error = $_FILES['uploaded_file']['error'];
    $file_temp = $_FILES['uploaded_file']['tmp_name'];
    $error = '';
    switch ($file_error):
        case 1;
            $error = '<span class="error">UPLOAD_ERR_INI_SIZE</span>';
            break;
        case 2;
            $error = '<span class="error">UPLOAD_ERR_FORM_SIZE</span>';
            break;
        case 3;
            $error = '<span class="error">UPLOAD_ERR_PARTIAL</span>';
            break;
        case 4;
            $error = '<span class="error">UPLOAD_ERR_NO_FILE</span>';
            break;
        case 6;
            $error = '<span class="error">UPLOAD_ERR_NO_TMP_DIR</span>';
            break;
        case 7;
            $error = '<span class="error">UPLOAD_ERR_CANT_WRITE</span>';
            break;
        case 8;
            $error = '<span class="error">UPLOAD_ERR_EXTENSION</span>';
            break;
    endswitch;
    if ($error !== '') {
        echo 'error when uploading file';
    } else {
        move_uploaded_file($file_temp , "{$dir}/{$file_name}");
    }
    $redirect = dirname($_SERVER[PHP_SELF]) . "/index.php?dir={$dir}";
    header("Location:{$redirect}");
}