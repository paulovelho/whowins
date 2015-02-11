whowins
.controller('CardsCtrl', function($scope, $ionicSwipeCardDelegate) {
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

  $scope.cards = Array.prototype.slice.call(cardTypes, 0, 0);

  $scope.cardSwiped = function(index) {
    $scope.addCard();
  };

  $scope.cardDestroyed = function(index) {
    $scope.cards.splice(index, 1);
  };

  $scope.addCard = function() {
    var newCard = cardTypes[Math.floor(Math.random() * cardTypes.length)];
    newCard.id = Math.random();
    $scope.cards.push(angular.extend({}, newCard));
  }

  $scope.cardSwiped()
});