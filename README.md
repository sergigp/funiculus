#Funiculus (WIP)

[![Build Status](https://travis-ci.org/sergigp/funiculus.svg?branch=master)](https://travis-ci.org/sergigp/funiculus)

##Use
```
use Sergigp\Funiculus as f;
``


#map

Returns a lazy sequence with functions applied.

You can use some syntactic sugar functions like `inc`, `dec`, `square`; a closure or a native php function:
```
f\map('inc', [1, 2, 3, 4]);
f\map(function($a) { return ++$a; }, [1, 2, 3, 4]);
f\map('abs', [-1, -2, -3, -4]));
```
