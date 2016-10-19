<?php

namespace Kugi\Rpg;

use Kugi\Rpg\iStatus;
use Kugi\Rpg\iCharacter;
use Kugi\Rpg\Command;

// 成長
class Growth {
    const GROW_POINT = 0.1;

    // status or LV
    public function __construct() {

    }

    public function makeResult(array $record) {
        $result = array();
        if (empty($record)) return $result;

        // grow points
        foreach ($record as $row) {
            foreach ($row as $key => $value) {
                $result[] = array($key => ceil($value * self::GROW_POINT));
            }
        }
        return $result;
    }

    public function grow(array $points, iCharacter $c) {
        foreach ($points as $point) {
            foreach ($point as $key => $value) {
                $this->apply($c, $key, $value);
            }
        }
        return $c;
    }

    private function apply(iCharacter &$c, $key, $value) {
        if ($key === Command::HP) {
            //
            $c->set(Command::DP, $c->get(Command::DP) + $value);
            $c->set(Command::MAXHP, $c->get(Command::MAXHP) + $value);
        }

        $c->set($key, $c->get($key) + $value);
    }
}
