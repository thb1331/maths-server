<?php
    header("Acces-Control-Allow-Origin : *");
    $book = $_REQUEST["book"];
    $filename = "";
    if ($book == "4unit") {
        $filename = "files/index4u.xml";
    } else {
        $filename = "files/indexCam.xml";
    }
    $file = fopen($filename, "r");

    echo fread($file, filesize($filename));
    fclose($file);
?>