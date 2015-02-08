<?php

class BaseControl extends MagratheaController {

	private $selectedMenu = "";
	public static function Go404(){
		global $Smarty;
		$Smarty->display("help_pages/404.html");
		return;
	}

}

?>