<?php

class Game {
  private $win;
  private $moves;
  private $movesCount;
  private $halfMovesCount;

  public function __construct($moves) {
    $this->moves = $moves;
    $this->movesCount = count($this->moves);
    $this->halfMovesCount = floor($this->movesCount / 2);
  }

  public function defineWinner($computerMove, $userMove) {
    $distance = ($computerMove+1 - $userMove+$this->movesCount) % $this->movesCount;
    if ($userMove != $computerMove+1) {
      if ($distance <= $this->halfMovesCount) {
        $this->setWin(false);
      } else {
        $this->setWin(true);
      }
    } else {
      $this->setWin(null);
    }
  }

  public function setWin(bool|null $win) {
    $this->win = $win;
  }

  public function getWin() {
    return $this->win;
  }

  public function displayState() {
    if (!is_null($this->getWin())) {
      if ($this->getWin() == true) {
        return "You win!";
      } else {
        return "You lost!";
      }
    } else {
      return "Draw!";
    }
  }
}
