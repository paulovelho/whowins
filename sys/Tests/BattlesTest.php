<?php

	MagratheaModel::IncludeAllModels();

	class TestOfBattles extends UnitTestCase{

		function setUp(){

		}
		function tearDown(){

		}

		function testGetTwoRandomBattles(){
			// how many times we are going to do this test?
			for($i=0; $i<100; $i++){
				$players = BattleControl::TwoRandomPlayers();
				$p1 = $players[0];
				$p2 = $players[1];
//				echo utf8_encode("fight: ".$p1->name." x ".$p2->name."<br/>");
				$this->assertNotNull($p1);
				$this->assertNotNull($p2);
				$this->assertEqual($p1->level, $p2->level);
				$this->assertNotEqual($p1->id, $p2->id);
			}
		}

		function testIfLookingForSomeoneThatDoesNotExistsShouldGiveMeOther(){
			$person = PersonControl::GiveMeSomeone(1542);
			$this->assertNotNull($person);
		}

		function testIfLookingForSomethingThatDoesNotExistsShouldGiveMeOther(){
			$evt = EventControl::GiveMeSomething(1542);
			$this->assertNotNull($evt);
		}

		function testGetTwoRandomPeople(){
			for($i=0; $i<100; $i++){
				$players = PersonControl::TwoRandomPlayers();
				$p1 = $players[0];
				$p2 = $players[1];
//				echo utf8_encode("fight: ".$p1->name." x ".$p2->name."<br/>");
				$this->assertNotNull($p1);
				$this->assertNotNull($p2);
				$this->assertNotEqual($p1->id, $p2->id);
			}
		}

		function testGetRandomEvent(){
			$ev = EventControl::GetRandom();
			$this->assertNotNull($ev);
		}

	}

?>