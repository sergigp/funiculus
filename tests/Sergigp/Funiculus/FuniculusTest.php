<?php

namespace Sergigp\Funiculus\Tests;

use Sergigp\Funiculus as f;
use Sergigp\Funiculus\Tests\Stub\SimpleIterableObject;

class FuniculusTest extends \PHPUnit_Framework_TestCase
{
    private $integerSequence = [1, 2, 3, 4, 5];
    private $iterableObject;

    public function setUp()
    {
        $this->iterableObject = new SimpleIterableObject(range(0,100));
    }

    /** @test **/
    public function it_map_closure_functions_to_array()
    {
        $mapFunction = function($i){ return ++$i; };

        $this->compareArrayWithLazySeq(
            [2, 3, 4, 5, 6],
            f\map($mapFunction, $this->integerSequence)
        );

        $this->compareArrayWithLazySeq(
            range(1, 101),
            f\map($mapFunction, $this->iterableObject)
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

        $this->compareArrayWithLazySeq(range(100, 0), f\map('abs', new SimpleIterableObject(range(-100,0))));
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

        $this->compareArrayWithLazySeq(range(-1, 99), f\map(f\op('dec'), $this->iterableObject));
        $this->compareArrayWithLazySeq(range(-3, 97), f\map(f\op('-', 3), $this->iterableObject));
    }

    /** @test **/
    public function it_should_throw_an_exception_with_invalid_operator()
    {
        $this->setExpectedException('\InvalidArgumentException');
        f\op('non_existent_operator');
    }

    /** @test **/
    public function it_should_return_first()
    {
        $this->assertEquals(1, f\first($this->integerSequence));
        $this->assertEquals('foo', f\first(['a' => 'foo', 'b' => 'bar']));
        $this->assertEquals(null, f\first([]));

        $this->assertEquals(0, f\first($this->iterableObject));
        $this->assertEquals(1, f\first(f\map(f\op('+', 1), $this->iterableObject)));
    }

    /** @test **/
    public function it_should_return_the_rest_of_array()
    {
        $this->assertEquals([2, 3, 4, 5], f\rest($this->integerSequence));
        $this->assertEquals(['b' => 'bar', 'c' => 'baz'], f\rest(['a' => 'foo', 'b' => 'bar', 'c' => 'baz']));

        $this->assertEquals(range(1, 100), f\rest($this->iterableObject));
        $this->assertEquals(range(2, 101), f\rest(f\map(f\op('+', 1), $this->iterableObject)));
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

        $this->assertTrue(f\is_empty(new SimpleIterableObject([])));
    }

    /** @test **/
    public function it_should_reduce_an_array()
    {
        $this->assertEquals(15, f\reduce(f\op('+'), $this->integerSequence));
        $this->assertEquals(-13, f\reduce(f\op('-'), $this->integerSequence));
        $this->assertEquals(120, f\reduce(f\op('*'), $this->integerSequence));
        $this->assertEquals(1, f\reduce(f\op('/'), [100, 2, 5, 10]));

        $this->assertEquals(15, f\reduce(f\op('+'), new SimpleIterableObject($this->integerSequence)));
    }

    /** @test **/
    public function it_should_filter_an_array()
    {
        $this->compareArrayWithLazySeq([1, 2], f\filter(f\op('pos'), [-1, 0, 1, 2]));
        $this->compareArrayWithLazySeq([-1], f\filter(f\op('neg'), [-1, 0, 1, 2]));
        $this->compareArrayWithLazySeq([], f\filter(f\op('neg'), [0, 1, 2]));

        $this->compareArrayWithLazySeq([1], f\filter(f\op('odd'), new SimpleIterableObject([0, 1, 2])));
    }

    /** @test **/
    public function it_should_check_if_every_element_satisfies_condition()
    {
        $this->assertTrue(f\every(f\op('pos'), $this->integerSequence));
        $this->assertFalse(f\every(f\op('pos'), [1, 2, 3, 4, -1]));

        $this->assertTrue(f\every(f\op('pos'), new SimpleIterableObject($this->integerSequence)));
        $this->assertFalse(f\every(f\op('neg'), new SimpleIterableObject($this->integerSequence)));
    }

    /** @test **/
    public function it_should_check_if_some_element_satisfies_condition()
    {
        $this->assertTrue(f\some(f\op('pos'), $this->integerSequence));
        $this->assertFalse(f\some(f\op('pos'), [-1, -2, -3]));

        $this->assertTrue(f\some(f\op('pos'), $this->iterableObject));
        $this->assertFalse(f\some(f\op('pos'), new SimpleIterableObject([-1, -2, -3])));
    }

    /** @test **/
    public function it_should_take_n_elements_of_a_sequence()
    {
        $this->compareArrayWithLazySeq([1, 2], f\take(2, $this->integerSequence));
        $this->compareArrayWithLazySeq([1], f\take(1, f\filter(f\op('pos'), [-1, 0, 1, 2])));

        $this->compareArrayWithLazySeq([0, 1], f\take(2, $this->iterableObject));
        $this->compareArrayWithLazySeq([1], f\take(1, f\filter(f\op('pos'), new SimpleIterableObject([-1, 0, 1, 2]))));
    }

    /** @test **/
    public function it_should_return_count()
    {
        $this->assertEquals(5, f\get_count($this->integerSequence));

        $this->assertEquals(101, f\get_count($this->iterableObject));
    }

    /** @test **/
    public function it_should_repeat()
    {
        $this->compareArrayWithLazySeq(['na', 'na', 'na'], f\take(3, f\repeat('na')));
        $this->compareArrayWithLazySeq([1, 1, 1, 1], f\take(4, f\repeat(1)));

        $this->compareArrayWithLazySeq([1, 1, 1, 1], f\take(4, f\repeat(function () { return 1; })));
    }

    /** @test **/
    public function it_should_generate_progression()
    {
        $this->compareArrayWithLazySeq([0, 2, 4, 6], f\take(4, f\progression(function ($i) { return $i * 2; })));
        $this->compareArrayWithLazySeq([0, 1, 4, 9, 16, 25, 36, 49], f\take(8, f\progression(f\op('square'))));
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
