<?php

require("inc/global.php");
include($magrathea_path."/MagratheaServer.php");
include("Controls/GameControl.php");

MagratheaModel::IncludeAllModels();


//error_reporting(E_ALL ^ E_STRICT);

class WhoWinsServer extends MagratheaServer{

	public function UpdateSettings(){
		$sControl = new SettingsControl();
		$this->Json($sControl->Update());
	}

	public function GetSettings(){
		$this->Json(SettingsControl::GetActive());
	}

	public function GetBattle(){
		$this->Json(BattleControl::TwoRandomPlayers());
	}

	public function GetEvent(){
		$this->Json(EventControl::GetRandom());
	}

	public function GetPeople(){
		$this->Json(PersonControl::TwoRandomPlayers());
	}

	public function GetGame(){
		$this->Json(GameControl::GetGame());
	}

	public function Someone(){
		$this->Json(PersonControl::GiveMeSomeone());
	}

}

$server = new WhoWinsServer();
$server->Start();


// cron job:
//
//	*/30 * * * * wget --delete-after -q http://contato.paulovelho.com.br/server.php?sendMail 
//



?>


