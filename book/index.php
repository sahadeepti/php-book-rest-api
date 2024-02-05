<?php
require __DIR__."/inc/bootstrap.php";

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/',$uri);
if((isset($uri[1]) && $uri[1] != 'book') || !isset($uri[3])){
    header("HTTP/1.1 404 NOT FOUND");
    exit();
}
require PROJECT_ROOT_PATH."/ApiController/BookController.php";
$objFeedController = new BookController();
$strMethodName = $uri[3].'Action';
$objFeedController->{$strMethodName}();
?>