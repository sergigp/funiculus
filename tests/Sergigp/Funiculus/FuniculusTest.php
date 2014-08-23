<?php

use Sergigp\Funiculus as f;

class FuniculusTest extends PHPUnit_Framework_TestCase
{
    private $integerSequence = [1, 2, 3, 4, 5];

    /** @test **/
    public function it_map_closure_functions_to_array()
    {
        $mapFunction = function($i){ return ++$i; };

        $this->compareArrayWithLazySeq(
            [2, 3, 4, 5, 6],
            f\map($mapFunction, $this->integerSequence)
        );
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
        $this->compareArrayWithLazySeq([2, 3, 4, 5, 6], f\map(f\op('inc'), $this->integerSequence));
        $this->compareArrayWithLazySeq([0, 1, 2, 3, 4], f\map(f\op('dec'), $this->integerSequence));
        $this->compareArrayWithLazySeq([1, 4, 9, 16, 25], f\map(f\op('square'), $this->integerSequence));

        $this->compareArrayWithLazySeq([3, 4, 5, 6, 7], f\map(f\op('+', 2), $this->integerSequence));
        $this->compareArrayWithLazySeq([-2, -1, 0, 1, 2], f\map(f\op('-', 3), $this->integerSequence));
        $this->compareArrayWithLazySeq([1, 8, 27, 64, 125], f\map(f\op('pow', 3), $this->integerSequence));

    }
    
    /** @test **/
    public function it_should_throw_an_exception_with_invalid_operator()
    {
        $this->setExpectedException('InvalidArgumentException');
        f\op('non_existent_operator');
    }

    /** @test **/
    public function it_should_return_first()
    {
        $this->assertEquals(1, f\first($this->integerSequence));
        $this->assertEquals('foo', f\first(['a' => 'foo', 'b' => 'bar']));
        $this->assertEquals(null, f\first([]));
    }
    
    /** @test **/
    public function it_should_return_the_rest_of_array()
    {
        $this->assertEquals([2, 3, 4, 5], f\rest($this->integerSequence));
        $this->assertEquals(['b' => 'bar', 'c' => 'baz'], f\rest(['a' => 'foo', 'b' => 'bar', 'c' => 'baz']));
    }
    
    /** @test **/
    public function it_should_add_element_to_the_beginning()
    {
        $this->assertEquals([0, 1, 2, 3, 4, 5], f\cons(0, $this->integerSequence));
    }

    /** @test **/
    public function it_should_identify_emtpy_array()
    {
        $this->assertTrue(f\is_empty([]));
        $this->assertFalse(f\is_empty($this->integerSequence));
    }

    /** @test **/
    public function it_should_reduce_an_array()
    {
        $this->assertEquals(15, f\reduce(f\op('+'), $this->integerSequence));
        $this->assertEquals(-13, f\reduce(f\op('-'), $this->integerSequence));
        $this->assertEquals(120, f\reduce(f\op('*'), $this->integerSequence));
        $this->assertEquals(1, f\reduce(f\op('/'), [100, 2, 5, 10]));
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
