#Funiculus (WIP)

[![Build Status](https://travis-ci.org/sergigp/funiculus.svg?branch=master)](https://travis-ci.org/sergigp/funiculus)

##Use
```
use Sergigp\Funiculus as f;
```

###map

Returns a lazy sequence with functions applied.

You can use some syntactic sugar functions like `f\op('inc')`, `f\op('dec')`, `f\op('square'), f\op('pow', 3)`; a closure or a native php function:

```
$test = [1, 2, 3, 4]

f\map(f\op('inc'), $test); // [2, 3, 4, 5] 
f\map(function($a) { return ++$a; }, $test); // [2, 3, 4, 5]
f\map('abs', [-1, -2, -3, -4])); // [1, 2, 3, 4]
```
