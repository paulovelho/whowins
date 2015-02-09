<?php

include(__DIR__."/Base/EventBase.php");

class Event extends EventBase {
	// your code goes here!
}

class EventControl extends EventControlBase {

	public static function Truncate(){
		$sql = "TRUNCATE TABLE events";
		self::RunQuery($sql);
	}

	public static function GetMax(){
		$query = MagratheaQuery::Select()
			->Fields("MAX(id)")
			->Table("events")
			->Limit(1);
		return self::QueryOne($query->SQL());
	}

	public static function GetRandom(){
		$max = SettingsControl::GetActive()->qtd_events;
		$rand = rand(1, $max);
		$ev = new Event($rand);
		if($ev == null){
			return self::GetRandom();
		} else {
			return $ev;
		}
	}

	public static function GiveMeRandom(){
		$qtdEvents = SettingsControl::GetActive()->qtd_events;
		$rand = rand(1, $qtdEvents);
		return $rand;
	}

	public static function GiveMeSomething($id){
		try{
			$p = new Event($id);
			if(empty($p->id)){
				return self::GiveMeSomething(self::GiveMeRandom());
			} else {
				return $p;
			}
		} catch(Exception $ex){
			return self::GiveMeSomething(self::GiveMeRandom());
		}
	}

}

?>