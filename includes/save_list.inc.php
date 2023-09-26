<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $htmlContent = $_POST["html_content"];

    print_r($htmlContent);

    echo "HTML content posted and saved.";
}
function tdrows($elements)
{
    $str = "";
    foreach ($elements as $element) {
        $str .= $element->nodeValue;
    }

    return $str;
}

function getdata()
{
    $html = file_get_contents('../index.php');

    $document = new \DOMDocument('1.0', 'UTF-8');


    $internalErrors = libxml_use_internal_errors(true);


    $document->loadHTML($html);


    libxml_use_internal_errors($internalErrors);

    $array = array();

    $items = $document->getElementsByTagName('tr');

    foreach ($items as $node) {
        array_push($array, tdrows($node->childNodes));
    }

    return $array;
}
var_dump(getdata());