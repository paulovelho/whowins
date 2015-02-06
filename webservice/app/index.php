<?php

	include("inc/global.php");

	include("Controls/_Controller.php");

	$View->IncludeCSS("css/style.css");
	$View->IncludeJavascript("javascript/jquery/jquery.min.js");

	// plugins:
//	include("plugins/Font-awesome/load.php");

//	p_r($_GET);

	// set default Controls:
	$control = "Home";
	$action = "Index";
	$params = array();

	if(isset($_GET["control"]) && !empty($_GET["control"])) $control = $_GET["control"];
	if(isset($_GET["action"]) && !empty($_GET["action"])) $action = $_GET["action"];
	if(isset($_GET["params"]) && !empty($_GET["params"])) $params = $_GET["params"];

	try{
		MagratheaController::Load($control, $action, $params);
	} catch (Exception $ex) {
		BaseControl::Go404();
	}

?>







