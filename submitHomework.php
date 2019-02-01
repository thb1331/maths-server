<?php
    header("Acces-Control-Allow-Origin : *");
    header("Content-Type: text/plain");
    $chapter = $_POST["chap"];
    $exercise = $_POST["ex"];
    $book = $_POST["book"];
    $data = $_POST["data"];
    $file = null;
    $index = null;
    $indexFileName = "";
    if ($book === "4unit") {
        $filename = "files/4u" . $chapter . $exercise .".xml";
        $file = fopen($filename, "w");
        $indexFile = simplexml_load_file("files/index4u.xml");
        $indexFileName = "files/index4u.xml";
    } else {
        $filename = "cam" . $chapter . $exercise . ".xml";
        $file = fopen($filename, "w");
        $index = simplexml_load_file("files/indexCam.xml");
        $indexFileName = "files/indexCam.xml";
    }

    fwrite($file, $data);
    $hasChapter = false;
    $chapterNode = $index->xpath("//chapter[number==" + $chapter + "][1]");
    if (count($chapterNode) == 0) {
        $index->addChild("chapter");
        $chapterNode = $index->xpath("//chapter[last()]");
        $chapterNode->addChild("number", $chapter);
        $chapterNode->addChild("exercises");
    }
    if (count($chapterNode->xpath("//exercises[exercise='" + $exercise + "']/exercise")) == 0) {
        // there is no exercise node
        $chapterNode->exercises->addChild("exercise", $exercise);
    }
    $index->asXml($indexFileName);
    fclose($file);
    echo "success";
?>