<?php 
    $file = $_GET['uploaded_docu'];
    $filepath = "../img/".$file;
    // Header content type
    //header("Content-type: application/pdf");
    // Send the file to the browser.
    //readfile($filepath);

?>
<?php
/*
$file = $_GET['uploaded_docu'];
$filename = $_GET['uploaded_docu'];
header('Content-type: application/pdf');
header('Content-Disposition: inline; filename="' . $filename . '"');
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize($file));
header('Accept-Ranges: bytes');
@readfile($file);
*/
?>
<a href="http://docs.google.com/viewer?url=http://localhost/project5/img/<?php echo rawurlencode($file); ?>">click</a>
<!--
<iframe src="../img/<?php echo $file;?>" height="200" width="300" title="Iframe Example"></iframe>
-->