<?php //This file is property of Duckcode company, Russia

include_once "config.php";

session_start();

$query = (isset($_GET['q'])) ? $_GET['q'] : '';

$route = new M_Route($query);
$route->request();


