<?php

use Kugi\Util\Format;

class FormatTest extends PHPUnit_Framework_TestCase
{
    public function testExe1()
    {
        $y = Format::way(2016);
        $this->assertEquals($y, '平成28年');
    }

    public function testExe2()
    {
        $p = Format::pf(2000000, '');
        $this->assertEquals($p, '2,000,000');
        $p = Format::pf(2000000.0456, '');
        $this->assertEquals($p, '2,000,000.0456');
    }
}