#Functions

* [map](#map)
* [reduce](#reduce)
* [filter](#filter)
* [first](#first)
* [rest](#rest)
* [cons](#cons)
* [is_empty](#is_empty)
* [every](#every)
* [some](#some)
* [take](#take)
* [repeat](#repeat)
* [progression](#progression)

###map

Returns a lazy sequence with functions applied.

You can use some syntactic sugar functions like `f\op('inc')`, `f\op('dec')`, `f\op('square'), f\op('pow', 3)`; php native function literals or a closure.
```
$test = [1, 2, 3, 4];

f\map(f\op('inc'), $test);
// [2, 3, 4, 5] (generator)

f\map(f\op('inc', 3), $test);
// [4, 5, 6, 7] (generator)

f\map(function($a) { return ++$a; }, $test);
// [2, 3, 4, 5] (generator)

f\map('abs', [-1, -2, -3, -4]);
// [1, 2, 3, 4] (generator)

```

### reduce

Reduce an array giving a closure

```

$test = [1, 2, 3, 4];

f\reduce(f\op('+'), $test));
// 1 + 2 + 3 + 4 = 10

f\reduce(f\op('-'), $test);
// 1 - 2 - 3 - 4 = -8
```

### filter

Returns a lazy sequence with array filtered.

```
f\filter(f\op('pos'), [-2, -1, 0, 1, 2]);
// [1, 2] (generator)
```


### first

Returns the first element of array. It delegates in ```array_shift```

```
f\first([1, 2, 3, 4]));
// 1
```

### rest

Removes the first element of an array and return the rest.

```
f\rest([1, 2, 3, 4]));
// [2, 3, 4]
```

### cons

Insert an element at the beginning of an array. This function only works with ```array```.

```
f\cons(1, [2, 3, 4]));
// 1
```

### is_empty

Returns true if an array is empty.

```
f\is_empty([]));
// true
```

### every

Returns true if every of a sequence accomplishes a condition.

```
f\every(f\op('pos'), [1, 2, 3, 4]);
// true
f\every(f\op('pos'), [-1, 2, 3, 4]);
// false
```

### some 

Returns true if some element of a sequence accomplishes a condition.

```
f\some(f\op('neg'), [1, 2, 3, -4]);
// true
f\some(f\op('pos'), [-1, -2, -3, -4]);
// false
```

### take 

Returns a lazy sequence with the N first elements of a sequence.

```
f\take(2, [1, 2, 3, 4]);
// [1, 2] (generator)```

### get_count

Returns the count of an iterable
```
f\get_count([1, 2, 3, 4]);
// 4
```

### repeat

Generate a lazy infinite sequence. You probably should use it with ```take```
```
f\take(4, f\repeat(1));
// [1, 1, 1, 1] (generator)
f\take(4, f\repeat(function () { return rand(1,10); }))
// [6, 9, 1, 5] (generator)
```

### progression

Generate a lazy infinite progression. The index of the sequence is the seed for its value.
```
f\take(4, f\progression(function ($i) { return $i * 2; }));
// [0, 2, 4, 6] // generator
f\take(5, f\progression(f\op('square'));
// [0, 1, 4, 9, 27] // generator
```
