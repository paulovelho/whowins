<?php

include(__DIR__."/Base/SettingsBase.php");

class Settings extends SettingsBase {
}

class SettingsControl extends SettingsControlBase {
	public function Update(){
		if(count($this->GetAll()) == 0){
			$this->InsertNewOne();
		}
		$activeSetting = $this->GetActive();
		$activeSetting->qtd_events = EventControl::GetMax();
		$activeSetting->qtd_people = PersonControl::GetMax();
		$activeSetting->qtd_battles = BattleControl::GetMax();
		$activeSetting->Save();
		return $activeSetting;
	}

	public static function GetActive(){
		$query = MagratheaQuery::Select()
			->Obj(new Settings())
			->Where(array("active" => 1))
			->Limit(1)
			->Order("id DESC");
		return self::RunRow($query->SQL());
	}

	private function InsertNewOne(){
		$s = new Settings();
		$s->Insert();
	}
}

?>