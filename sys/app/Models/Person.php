<?php

include(__DIR__."/Base/PersonBase.php");

class Person extends PersonBase {
	// your code goes here!
}

class PersonControl extends PersonControlBase {

	public static function Truncate(){
		$sql = "TRUNCATE TABLE people";
		self::RunQuery($sql);
	}

	public static function GetMax(){
		$query = MagratheaQuery::Select()
			->Fields("MAX(id)")
			->Table("people")
			->Limit(1);
		return self::QueryOne($query->SQL());
	}

	public static function TwoRandomPlayers(){
		$qtdBattles = SettingsControl::GetActive()->qtd_people;
		$rand1 = rand(1, $qtdBattles);
		$rand2 = rand(1, $qtdBattles);
		try{
			$player1 = self::GiveMeSomeone($rand1);
			$player2 = self::GiveMeSomeone($rand2);
			if($player1 == null || $player2 == null)
				return self::TwoRandomPlayers();
			if($player1->id == $player2->id)
				return self::TwoRandomPlayers();
			else 
				return array($player1, $player2);
		} catch(Exception $ex){
			return self::TwoRandomPlayers();
		}
	}

	public static function GiveMeRandom(){
		$qtdBattles = SettingsControl::GetActive()->qtd_people;
		$rand = rand(1, $qtdBattles);
		return $rand;
	}

	public static function GiveMeSomeone($id=0){
		try{
			if(empty($id)) $id = self::GiveMeRandom();
			$p = new Person($id);
			if(empty($p->id)){
				return self::GiveMeSomeone(self::GiveMeRandom());
			} else {
				return $p;
			}
		} catch(Exception $ex){
			return self::GiveMeSomeone(self::GiveMeRandom());
		}
	}

}

?>