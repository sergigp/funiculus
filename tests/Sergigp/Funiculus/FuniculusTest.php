<?php

use Sergigp\Funiculus as f;

class FuniculusTest extends PHPUnit_Framework_TestCase
{
    /** @test **/
    public function it_map_closure_functions_to_array()
    {
        $test = [1, 2, 3, 4];

        $mapFunction = function($i){ return ++$i; };

        $this->assertEquals([2, 3, 4, 5], f\map($mapFunction, $test));
    }

    /** @test **/
    public function it_should_map_php_function_literals_to_array()
    {
        $this->assertEquals([1, 2, 3, 4], f\map('abs', [-1, -2, -3, -4]));
        $this->assertEquals([1, 2, 3, 4], f\map('ceil', [0.9, 1.1, 2.6, 3.9]));
        $this->assertEquals([0, 1, 2, 3], f\map('floor', [0.9, 1.1, 2.6, 3.9]));
        $this->assertEquals([1, 1, 3, 4], f\map('round', [0.9, 1.1, 2.6, 3.9]));
        $this->assertEquals([1, 2, 3, 4], f\map('sqrt', [1, 4, 9, 16]));
    }

    /** @test **/
    public function it_should_map_closure_refference_to_array ()
    {
        $test1 = [1, 2, 3, 4];

        $this->assertEquals([2, 3, 4, 5], f\map('inc', $test1));
        $this->assertEquals([0, 1, 2, 3], f\map('dec', $test1));
        $this->assertEquals([1, 4, 9, 16], f\map('square', $test1));
    }
}
