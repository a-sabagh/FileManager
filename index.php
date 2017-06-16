<html dir="ltr" lang="en-US">
    <head>
        <title>fileManger</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="assets/css/reset.css">
        <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        <?php
        if (isset($_GET['dir'])) {
            $dir = $_GET['dir'];
        } else {
            $dir = "myComputer";
        }
        ?>
        <script>
            function goBack(){ window.history.back(); }
            function goForward(){ window.history.forward(); }
            function makeDir() {
                var dirName = prompt("please enter your folder name:");
                if (dirName === '') {
                    dirName = 'newFolder';
                }
                window.location = "mkdir.php?dir=<?php echo $dir; ?>&dirName=" + dirName;
            }
            function makefile(){
                var filename = prompt("please enter your file name");
                if(filename == ''){
                    filename = 'newfile';
                }
                window.location = "makefile.php?dir=<?php echo $dir; ?>&fileName=" + filename;
            }
            function copyfile(filename) {
                var copypath = prompt("please enter your path to copy:");
                if (copypath === '') {
                    copypath = '<?php echo $dir; ?>';
                }
                window.location = "copyfile.php?dir=<?php echo $dir; ?>&fileName=" + filename + "&path=" + copypath;
            }
            function renamefile(filename) {
                var newName = prompt("please enter new name:");
                if (newName === '') {
                    alert('please fill new file name');
                } else {
                    window.location = "rename.php?dir=<?php echo $dir; ?>&fileName=" + filename + "&newName=" + newName;
                }
            }
            function deletefile(filename) {
                if (window.confirm("Do you want to delete file?")) {
                    window.location = "deletefile.php?dir=<?php echo $dir; ?>&fileName=" + filename;
                }
            }
            function copydir(dirname) {
                var copypath = prompt("please enter the copy path");
                if (copypath === '') {
                    alert("please fill copy path");
                } else {
                    window.location = "cpdir.php?dir=<?php echo $dir; ?>&copypath=" + copypath + "&dirName=" + dirname;
                }
            }
            function deletedir(dirname) {
                if (window.confirm("Do you want to delete directory")) {
                    window.location = "rmdir.php?dir=<?php echo $dir; ?>&dirName=" + dirname;
                }
            }
        </script>
    </head>
    <body>
        <a href="<?php echo (dirname($dir) !== '.') ? "?dir=" . dirname($dir) : '#'; ?>" title="backWard">
            <div class="file fa fa-reply"></div>
        </a>
        <a href="" onclick="goBack()" title="">
            <div class="file fa fa-arrow-left"></div>
        </a>
        <a href="" onclick="goForward()" title="">
            <div class="file fa fa-arrow-right"></div>
        </a>
        <a href="#" title="make directory" onclick="makeDir()" >
            <div class="file fa fa-plus-circle"></div>
        </a>
        <a href="#" title="make file" onclick="makefile()" >
            <div class="file fa fa-plus"></div>
        </a>
        <form action="uploadfile.php?dir=<?php echo $dir; ?>" method="post" enctype="multipart/form-data">
            <input type="file" name="uploaded_file" >
            <input type="submit" name="upload_file" value="upload">
        </form>
        <?php
        $filelist = glob($dir . '/*');
        foreach ($filelist as $file) {
            $filetype = filetype($file);
            if ($filetype == 'file') {
                ?>
                <div class="container-file">
                    <a href="#" title="" >
                        <div class="file fa fa-file-text-o"></div>
                        <span class="fname"><?php echo basename($file); ?></span>
                    </a>
                    <a href="#" class="file-action cfile" title="copy file" onclick="copyfile('<?php echo basename($file); ?>')"><i class="fa fa-copy"></i></a>
                    <a href="#" class="file-action rfile" title="rename file" onclick="renamefile('<?php echo basename($file); ?>')"><i class="fa fa-pencil-square"></i></a>
                    <a href="#" class="file-action dfile" title="delete file" onclick="deletefile('<?php echo basename($file); ?>')"><i class="fa fa-trash"></i></a>
                </div><!--.container-file-->
                <?php
            } elseif ($filetype == 'dir') {
                ?>
                <div class="container-file">
                    <a href="?dir=<?php echo $file ?>" title="" >
                        <div class="file fa fa-folder-o"></div>
                        <span><?php echo basename($file); ?></span>
                    </a>
                    <a href="#" class="file-action cfile" title="copy directory" onclick="copydir('<?php echo basename($file); ?>')"><i class="fa fa-copy"></i></a>
                    <a href="#" class="file-action rfile" title="rename directory" onclick="renamefile('<?php echo basename($file); ?>')"><i class="fa fa-pencil-square"></i></a>
                    <a href="#" class="file-action dfile" title="delete directory" onclick="deletedir('<?php echo basename($file); ?>')"><i class="fa fa-trash"></i></a> 
                </div><!--.container-file-->
                <?php
            }
        }
        ?>
    </body>
</html>
