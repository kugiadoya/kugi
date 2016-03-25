<?php

use Kugi\Html\TableConverter;

class TableConverterTest extends PHPUnit_Framework_TestCase
{
    public function testExe1()
    {
        $a = array(
                array(
                        'id' => 100,
                        'name' => 'test1',
                    ),
                array(
                        'id' => 200,
                        'name' => 'test2',
                    ),
            );

        $t = TableConverter::convert($a);
        $this->assertNotEmpty($t);
        $this->assertContains('</table>', $t);

        // echo PHP_EOL. $t. PHP_EOL;
    }

    public function testExe2()
    {
        $o1 = new StdClass();
        $o1->id = 100;
        $o1->name = 'test1';
        $o2 = new StdClass();
        $o2->id = 200;
        $o2->name = 'test2';
        $oa = array($o1, $o2);

        $t = TableConverter::convert($oa);
        $this->assertNotEmpty($t);
        $this->assertContains('</table>', $t);

        // echo PHP_EOL. $t. PHP_EOL;
    }
}