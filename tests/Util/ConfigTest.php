<?php

use Kugi\Util\Config;

class ConfigTest extends PHPUnit_Framework_TestCase
{
    public function testExe1()
    {
        Config::set(dirname(__FILE__). '/test.ini');
        $this->assertNotEmpty(TEST);
        $this->assertEquals(SAMPLE, 'サンプル');
    }

    public function testExe2()
    {
        Config::set(dirname(__FILE__). '/test.ini');
        $this->assertEquals(Config::is('rakuda', 'らくだ'), 'らくだ');
    }
}