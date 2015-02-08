<?php

class GameControl{
	
	public static function GetGame(){
		// 40% of the games will be fights:
		if(self::TheOddsAre(0.4)){
			$event = new Event(1);
			// if in a fight, half of the fights will be battles:
			if(self::TheOddsAre(0.5)){
				$players = BattleControl::TwoRandomPlayers();
			} else {
				$players = PersonControl::TwoRandomPlayers();
			}
		} else {
			$event = EventControl::GetRandom();
			$players = PersonControl::TwoRandomPlayers();
		}
		return array("event" => $event, "players" => $players);

	}


	public static function TheOddsAre($odds){
		$rand = (float)rand()/(float)getrandmax();
		return($rand<$odds);
	}

}


?>