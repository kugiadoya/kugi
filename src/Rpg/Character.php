<?php

namespace Kugi\Rpg;

use Kugi\Rpg\iStatus;
use Kugi\Rpg\iCharacter;
use Kugi\Rpg\Command;

class Character implements iCharacter {

    public $status;

    private $record;

    public function __construct(iStatus $status) {
        $this->status = $status;
        $this->record = array();
    }

    public function init() {
        $this->record = array();
    }

    public function attack(iCharacter $target) {
        $target_dp = 0;
        if (!is_null($target->get(Command::DP))) {
            $target_dp = $target->get(Command::DP);
        }

        $result = 0;
        $damage = $this->get(Command::AP) - $target_dp;

        if ($damage <= 0) $damage = 1;

        echo $this->name. ' attacked to '. $target->name. ' :'. $damage. ' ';
        $this->setRecord(Command::AP, $damage);

        if ($target->get(Command::HP) > $damage) {
            $result = $target->get(Command::HP) - $damage;
        }

        $target->set(Command::HP, $result);

        echo '(HP : '. $target->get(Command::HP). ')'. PHP_EOL;
        $target->setRecord(Command::HP, $damage);

        return $target;
    }

    public function getStatus() {
        return $this->status->getAll();
    }

    public function setRecord($key, $value) {
        $this->record[] = array($key => $value);
    }

    public function getRecord() {
        return $this->record;
    }

    // rapping
    public function get($key) {
        return $this->status->get($key);
    }

    // rapping
    public function set($key, $value) {
        $this->status->set($key, $value);
    }
}
