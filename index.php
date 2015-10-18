<?php
header("Charset: UTF8");
session_start();
include_once("m/m_lib.php");

/* $mUsers = M_User::getInstance();

$user = $mUsers->get(); */


switch($_GET["c"]){
	case "news": $controller = new C_News(); break;
	case "services": $controller = new C_Services(); break;
	case "portfolio": $controller = new C_Portfolio(); break;
	case "about": $controller = new C_About(); break;
	case "contacts": $controller = new C_Contacts(); break;
	case "singlenews": $controller = new C_SingleNews(); break;
	case "newnews": $controller = new C_New(); break;
	default : $controller = new C_Main();
}

$controller->request();