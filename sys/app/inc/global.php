<?php

	session_start();

//	error_reporting(E_ALL ^ E_STRICT);

	$magrathea_path = "/Users/paulovelho/Sites/Magrathea/Magrathea";
	$site_path = "/Users/paulovelho/Sites/whowins/sys";
//	$magrathea_path = "/home/platypusweb/Magrathea";
//	$site_path = "/home/platypusweb/whowins/sys";

	include($magrathea_path."/LOAD.php");

	MagratheaDebugger::Instance()->SetType("debug");

	$Smarty = new Smarty;
	$Smarty->template_dir = $site_path."/app/Views/";
	$Smarty->compile_dir  = $site_path."/app/Views/_compiled";
	$Smarty->config_dir   = $site_path."/app/Views/configs";
	$Smarty->cache_dir    = $site_path."/app/Views/_cache";
	$Smarty->configLoad("site.conf");
	
	$View = new MagratheaView();
	$Smarty->assign("View", $View);

	$View->IsRelativePath(false); // for mod_rewrite

	MagratheaDebugger::Instance()->SetType(MagratheaDebugger::DEV);

?>
