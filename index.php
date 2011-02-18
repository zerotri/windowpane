<?php
define ('DS', DIRECTORY_SEPARATOR);
define ('ROOT', dirname(__FILE__));
include( ROOT . DS . 'library' .DS .'bootstrap.php');
include("public/header.php");

$page = new WView(ROOT . '/app/rp/v/index.tpl');
$page->title = "Template Test";
echo $page->render();

include("public/footer.php");
?>
