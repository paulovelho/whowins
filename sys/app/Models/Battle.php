<?php

include(__DIR__."/Base/BattleBase.php");

class Battle extends BattleBase {
	// your code goes here!
}

class BattleControl extends BattleControlBase {

	public static function Truncate(){
		$sql = "TRUNCATE TABLE battles";
		self::RunQuery($sql);
	}

	public static function GetMax(){
		$query = MagratheaQuery::Select()
			->Fields("MAX(id)")
			->Table("battles")
			->Limit(1);
		return self::QueryOne($query->SQL());
	}

	public static function TwoRandomPlayers(){
		$qtdBattles = SettingsControl::GetActive()->qtd_battles;
		$rand = rand(1, $qtdBattles);
		$player1 = new Battle($rand);
		$player2 = self::GetAnotherPlayerToFight($player1);
		return array($player1, $player2);
	}

	public static function GetAnotherPlayerToFight($oponent){
		$query = MagratheaQuery::Select()
			->Table("battles")
			->Where(array("level" => $oponent->level))
			->Where("id != ".$oponent->id)
			->Limit(1)
			->Order("RAND() ASC");
		return self::RunRow($query->SQL());
	}

}

?>