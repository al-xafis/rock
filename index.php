<?php
require './Error.php';
require './Table.php';
require './Crypto.php';
require './Game.php';

// input handling
foreach(array_count_values(array_slice($argv, 1)) as $val => $c) {
    if($c > 1) {
      new InvalidArguments("All moves must be unique!" ) . PHP_EOL;
      exit;
    }
}

if (count($argv) < 3) {
  new InvalidLength("The number of moves must be more than 3!") . PHP_EOL;
  exit;
}

if (count($argv) % 2 !== 0) {
  new InvalidArgumentsNumber('The number of moves must be odd!') . PHP_EOL;
  exit;
}

$moves = array_slice($argv, 1);

// table
$table = new Table($moves);
$table->generateTable();

// random secret key
$crypto = new Crypto();
$crypto->generateKey();

$computerMove = array_rand($moves);
$computerMoveName = $moves[$computerMove];

// hmac
$crypto->generateHmac($computerMoveName);
echo 'HMAC: ' . $crypto->getHmac() . PHP_EOL;


function showMenu($argv) {
  echo "Available moves:" . PHP_EOL;
  for ($i = 1; $i<count($argv); $i++) {
    echo $i . ' - ' . $argv[$i] . PHP_EOL;
  }
  echo "0 - exit" . PHP_EOL;
  echo "? - help" . PHP_EOL;
  echo "Enter your move: ";
}

// choose user move
do {
  showMenu($argv);
  $userMove = trim(fgets(STDIN));
  if (array_key_exists($userMove, $argv)) {
    break;
  } elseif ($userMove == '?') {
    $table->show();
  } else {
    echo "Please enter one of the available moves..." . PHP_EOL;
  }
} while (true);


if ($userMove == 0) {
  echo "Exiting the program..." . PHP_EOL;
  exit;
}

echo $userMove .'-'. $computerMove+1 . '' . PHP_EOL;

// calculate winner
$game = new Game($moves);
$game->defineWinner($computerMove, $userMove);
$message = $game->displayState();

echo "Your move: " . $argv[$userMove] . PHP_EOL;
echo "Computer move: " . $computerMoveName . PHP_EOL;
echo $message . PHP_EOL;
echo "HMAC key: " . $crypto->getSecretKey() . PHP_EOL;
echo "URL for checking SHA3-256 of HMAC: " . 'https://cryptotools.net/hmac' . PHP_EOL . 'or' . PHP_EOL .'https://www.liavaag.org/English/SHA-Generator/HMAC/' . PHP_EOL;

?>
