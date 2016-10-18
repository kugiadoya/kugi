<?php

namespace Kugi\Rpg;

use Kugi\Rpg\iStatus;
use Kugi\Rpg\iCharacter;
use Kugi\Rpg\Command;

class Character implements iCharacter {

    public $status;

    public function __construct(iStatus $status) {
        $this->status = $status;
    }

    public function attack(iCharacter $target) {
        $target_dp = 0;
        if (!is_null($target->get(Command::DP))) {
            $target_dp = $target->get(Command::DP);
        }

        $result = 0;
        $damage = $this->get(Command::AP) - $target_dp;

        echo $this->name. ' attacked to '. $target->name. ' :'. $damage. ' ';

        if ($target->get(Command::HP) > $damage) {
            $result = $target->get(Command::HP) - $damage;
        }

        $target->set(Command::HP, $result);

        echo '(HP : '. $target->get(Command::HP). ')'. PHP_EOL;

        return $target;
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
