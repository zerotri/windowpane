<?php
include("windowpane.php");
global $windowpane;
$windowpane = new Windowpane();
$url = "posts/view/1";

$windowpane->direct($url);
?>
