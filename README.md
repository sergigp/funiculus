#Funiculus (WIP)

[![Build Status](https://travis-ci.org/sergigp/funiculus.svg?branch=master)](https://travis-ci.org/sergigp/funiculus)

Funiculus is a toy project to help me understand some Clojure concepts and how PHP can (or cannot) work with it. This project is strongly inspired by [pablodip/felpado](https://github.com/pablodip/felpado) and [nikic/iter](https://github.com/nikic/iter]).

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
