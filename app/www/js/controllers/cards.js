whowins
.controller('CardsCtrl', function($scope, $ionicSwipeCardDelegate) {

  $scope.MODE_BATTLE = 1;
  $scope.MODE_PLAYER = 2;
  $scope.MODE_SETTINGS = 3;

  $scope.mode = $scope.MODE_PLAYER;

  $scope.getRandomBattle = function(){
    var cardTypes = [{
      question: 'Quem ganha num confronto entre',
      player1: 'p1',
      player2: 'p2'
    }, {
      question: 'Quem ganha num confronto entre',
      player1: '11',
      player2: '12'
    }, {
      question: 'Quem ganha num confronto entre',
      player1: 'q1',
      player2: 'q2'
    }, {
      question: 'Quem ganha num confronto entre',
      player1: 'r1',
      player2: 'r2'
    }, {
      question: 'Quem ganha num confronto entre',
      player1: 'c1',
      player2: 'c2'
    }];
    return cardTypes[Math.floor(Math.random() * cardTypes.length)];
  };

  $scope.getRandomPlayer = function(){
    var players = [{
      name: 'Wolverine'
    }, {
      name: 'Jack Bauer'
    }, {
      name: 'Capitão Nascimento'
    }, {
      name: 'Alice'
    }, {
      name: 'Silvio Santos'
    }];
    return players[Math.floor(Math.random() * players.length)];
  };


  $scope.battles = [];
  $scope.players = [];

  $scope.cardSwiped = function(index) {
    $scope.addCard();
  };

  $scope.cardDestroyed = function(index) {
    $scope.battles.splice(index, 1);
  };

  $scope.addCard = function() {
    var newCard = null;

    if($scope.mode == $scope.MODE_BATTLE){
      newCard = $scope.getRandomBattle();
      newCard.id = Math.random();
      $scope.battles.push(angular.extend({}, newCard));
    } else {
      newCard = $scope.getRandomPlayer();
      newCard.id = Math.random();
      $scope.players.push(angular.extend({}, newCard));
    }
  }




  $scope.settings = function(){
    $scope.mode = $scope.MODE_SETTINGS;
  }
  $scope.removeSetting = function(){
    $scope.mode = $scope.MODE_PLAYER;
  }

  $scope.cardSwiped()
});