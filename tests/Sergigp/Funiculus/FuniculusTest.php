<?php

use Sergigp\Funiculus as f;

class FuniculusTest extends PHPUnit_Framework_TestCase
{
    /** @test **/
    public function it_map_closure_functions_to_array()
    {
        $test = [1, 2, 3, 4];

        $mapFunction = function($i){ return ++$i; };

        $this->compareArrayWithLazySeq([2, 3, 4, 5], f\map($mapFunction, $test));
    }

    /** @test **/
    public function it_should_map_php_function_literals_to_array()
    {
        $this->compareArrayWithLazySeq([1, 2, 3, 4], f\map('abs', [-1, -2, -3, -4]));
        $this->compareArrayWithLazySeq([1, 2, 3, 4], f\map('ceil', [0.9, 1.1, 2.6, 3.9]));
        $this->compareArrayWithLazySeq([0, 1, 2, 3], f\map('floor', [0.9, 1.1, 2.6, 3.9]));
        $this->compareArrayWithLazySeq([1, 1, 3, 4], f\map('round', [0.9, 1.1, 2.6, 3.9]));
        $this->compareArrayWithLazySeq([1, 2, 3, 4], f\map('sqrt', [1, 4, 9, 16]));
    }

    /** @test **/
    public function it_should_map_closure_refference_to_array ()
    {
        $test1 = [1, 2, 3, 4];

        $this->compareArrayWithLazySeq([2, 3, 4, 5], f\map(f\op('inc'), $test1));
        $this->compareArrayWithLazySeq([0, 1, 2, 3], f\map(f\op('dec'), $test1));
        $this->compareArrayWithLazySeq([1, 4, 9, 16], f\map(f\op('square'), $test1));

        $this->compareArrayWithLazySeq([3, 4, 5, 6], f\map(f\op('inc', 2), $test1));
        $this->compareArrayWithLazySeq([-2, -1, 0, 1], f\map(f\op('dec', 3), $test1));
        $this->compareArrayWithLazySeq([1, 8, 27, 64], f\map(f\op('pow', 3), $test1));

    }

    private function compareArrayWithLazySeq(array $array, $lazySeq)
    {
        $tmpArray = [];

        foreach ($lazySeq as $el) {
            $tmpArray[] = $el;
        }

        $this->assertEquals($array, $tmpArray);
    }
}
