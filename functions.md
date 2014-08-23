#Functions


###map

Returns a lazy sequence with functions applied.

You can use some syntactic sugar functions like `f\op('inc')`, `f\op('dec')`, `f\op('square'), f\op('pow', 3)` or a closure.
```
$test = [1, 2, 3, 4]

f\map(f\op('inc'), $test);
// [2, 3, 4, 5] (generator)

f\map(f\op('inc', 3), $test);
// [4, 5, 6, 7] (generator)

f\map(function($a) { return ++$a; }, $test);
// [2, 3, 4, 5] (generator)

f\map('abs', [-1, -2, -3, -4]));
// [1, 2, 3, 4] (generator)

```

### reduce

Reduce an array giving a closure

```
f\reduce(f\op('+'), [1, 2, 3, 4]));
// 1 + 2 + 3 + 4 = 10

f\reduce(f\op('-'), [1, 2, 3, 4, 5]);
// 1 - 2 - 3 - 4 - 5 = -13
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

Insert an element at the beginning of an array. It delegates in ```array_unshift```

```
f\first(1, [2, 3, 4]));
// 1
```

### is_empty

Returns true if an array is empty.

```
f\is_empty([]));
// true
```
