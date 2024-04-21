<?php

require './vendor/phplucidframe/console-table/src/LucidFrame/Console/ConsoleTable.php';

class Table {
  private $table;
  private $moves;
  private $movesCount;
  private $halfMovesCount;

  public function __construct($moves) {
    $this->table = new LucidFrame\Console\ConsoleTable();;
    $this->moves = $moves;
    $this->movesCount = count($this->moves);
    $this->halfMovesCount = floor($this->movesCount / 2);
  }

  public function generateTable() {
    // $this->table = new LucidFrame\Console\ConsoleTable();
    $this->table->addHeader('v PC\User >');

    foreach($this->moves as $key => $val) {
      $this->table->addHeader($val);
      $this->table->addRow()->addColumn($val);
      foreach($this->moves as $k => $v) {
        if ($key != $k) {
          $distance = ($k - $key + $this->movesCount) % $this->movesCount;
          if ($distance <= $this->halfMovesCount) {
            $this->table->addColumn('Win');
          } else {
            $this->table->addColumn('Lose');
          }
        } else {
          $this->table->addColumn('Draw');
        }
      }
    }

    $this->table->showAllBorders();
  }

  public function show() {
    $this->table->display();
  }




}

// $table = new LucidFrame\Console\ConsoleTable();

// $halfOptions = floor($totalNumberMoves/2);


// $table->addHeader('v PC\User >');

// foreach($arr as $key => $val) {
//   $table->addHeader($val);
//   $table->addRow()->addColumn($val);
//   foreach($arr as $k => $v) {
//     if ($key != $k) {
//       $distance = ($k - $key + $totalNumberMoves) % $totalNumberMoves;
//       if ($distance <= $halfOptions) {
//         $table->addColumn('Win');
//       } else {
//         $table->addColumn('Lose');
//       }
//     } else {
//       $table->addColumn('Draw');
//     }
//   }
// }



