<?php

// 返却はobject


require_once('kugi/vendor/autoload.php');

use Kugi\Rpg\Character;
use Kugi\Rpg\Status;
use Kugi\Rpg\Command;

$filepath = 'xxxxxxxxx\hero.json';

// ファイル読み込み
$status = @file_get_contents($filepath);

if ($status === false) {
    $status1 = array(
        Command::LV => 1,
        Command::HP => 30,
        Command::MAXHP => 30,
        Command::AP => 10,
        Command::DP => 5,
        Command::SP => 3,
    );
} else {
    $status1 = (array)json_decode($status);
}

$status2 = array(
    Command::LV => 1,
    Command::HP => 20,
    Command::MAXHP => 20,
    Command::AP => 8,
    Command::DP => 2,
    Command::SP => 11,
);

$s1 = new Status($status1);
$hero = new Character($s1);
$zako = new Character(new Status($status2));

$hero->name = 'hero';
$zako->name = 'ork';

$com = new Command();
// Preparation

// fight start
$winner = $com->fight($hero, $zako);
echo $winner->name. ' win!';
if ($winner->name !== 'hero') exit;
var_dump($winner->getStatus());

if (!file_exists($filepath)) {
	touch($filepath);
}

if (!file_exists($filepath) && !is_writable($filepath)
	|| !is_writable(dirname($filepath))) {
	echo "書き込みできないか、ファイルがありません。",PHP_EOL;
	exit(-1);
}

$fp = fopen($filepath,'w') or die('ファイルを開けません');

fwrite($fp, sprintf(json_encode($winner->getStatus())));

fclose($fp);
