<?php

define ('ROOT', dirname(__FILE__));
define ('APP', 'rp');
include(ROOT."/config/routing.php");
include(ROOT."/config/inflection.php");
include(ROOT."/library/config.php");
include(ROOT."/library/windowpane.php");

global $windowpane;
$windowpane = new Windowpane();

//Generate views
$headerView = $windowpane->generate("View");
$pageView = $windowpane->generate("View");
$footerView = $windowpane->generate("View");

$postView = $windowpane->generate("View");
$postModel = $windowpane->generate("Model");
//Set view paths
$headerView->setFile(ROOT."/app/".APP."/header.tpl");
$pageView->setFile(ROOT."/app/".APP."/index.tpl");
$footerView->setFile(ROOT."/app/".APP."/footer.tpl");

//
$postView->setFile(ROOT."/app/".APP."/v/posts.tpl");
$postData = $postModel->loadData();
$postView->posts = $postData;
$renderedPosts = $postView->render();

//Set view variables
$pageView->title = "Template Test";
$pageView->posts = $renderedPosts;

//render views
echo $headerView->render();
echo $pageView->render();
echo $footerView->render();

?>
