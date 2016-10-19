<?php

namespace Kugi\Rpg;

use Kugi\Rpg\iStatus;

class Status implements iStatus {
    private $status = array();

    public function __construct(array $status) {
        $this->status = $status;
    }

    public function getAll() {
        return $this->status;
    }

    public function get($key) {
        if (isset($this->status[$key])) {
            return $this->status[$key];
        }
        return null;
    }

    public function set($key, $value) {
        if (isset($this->status[$key])) {
            $this->status[$key] = $value;
        }
    }
}
