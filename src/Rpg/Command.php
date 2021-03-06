<?php

namespace Kugi\Rpg;

use Kugi\Rpg\iStatus;
use Kugi\Rpg\iCharacter;
use Kugi\Rpg\Growth;

class Command {
    const LV = 'lv';
    const HP = 'hp';
    const MAXHP = 'maxhp';
    const AP = 'ap';
    const DP = 'dp';
    const SP = 'sp';
    const EXP = 'exp';
    const DAMAGED = 'damaged';

    public function init() {

    }

    public function encounter() {

    }

    public function grow() {

    }

    private function preparation(iCharacter $c1, iCharacter $c2) {
        $c1->init();
        $c2->init();
    }

    public function fight(iCharacter $c1, iCharacter $c2) {
        $this->preparation($c1, $c2);

        // compare speed
        if (!is_null($c1->get(self::SP)) && !is_null($c2->get(self::SP))) {
            if ($c1->get(self::SP) > $c2->get(self::SP)) {
                $c1->first = true;
            }
        } else {
            // not exits speed. ramdom switch
        }

        // start fight
        $tern = array();

        if (isset($c1->first) && $c1->first === true) {
            $tern[] = $c1;
            $tern[] = $c2;
        } else {
            $tern[] = $c2;
            $tern[] = $c1;
        }

        $tern_no = 0;
        $winner = null;
        while (true) {
        // for ($i = 0; $i < 10; $i++) {
            // attack
            $tern[1 - $tern_no] = $tern[$tern_no]->attack($tern[1 - $tern_no]);

            // if end
            if ($tern[1 - $tern_no]->get(Command::HP) === 0) {
                // winner
                $winner = $tern[$tern_no];
                break;
            }

            if ($tern_no === 0) {
                $tern_no = 1;
            } else {
                $tern_no = 0;
            }
        }

        // grow
        $g = new Growth();
        // var_dump($winner->getRecord());
        $res = $g->makeResult($winner->getRecord());
        // var_dump($res);
        $winner = $g->grow($res, $winner);

        return $winner;
    }
}
