<?php

include_once __DIR__ . '/../vendor/autoload.php';

use Sergigp\Funiculus as f;

class FuniculusTest extends PHPUnit_Framework_TestCase
{
    /** @test **/
    public function it_map_closure_functions_to_array()
    {
        $test1 = [1, 2, 3, 4];

        $mapFunction = function($i){
            return ++$i;
        };

        $this->assertEquals([2, 3, 4, 5], f\map($mapFunction, $test1));
    }
}
