#Funiculus (WIP)

[![Build Status](https://travis-ci.org/sergigp/funiculus.svg?branch=master)](https://travis-ci.org/sergigp/funiculus)

Funiculus is a port of some Clojure functions and ideas to PHP for manage collections.

Funiculus is forged with some principles in mind:

* A collection can be any iterable PHP object, arrays or generators.
* Play with generators when it's possible.
* Work with closures (some syntactic sugar for operator available sacrificing some performance).
* Composition.
* Immutabilty.
* Simplicity over easiness.

 
This project is strongly inspired by [pablodip/felpado](https://github.com/pablodip/felpado) and [nikic/iter](https://github.com/nikic/iter]).

##Use

Install through composer:

```
composer require sergigp/funiculus:dev-master
```

Use and enjoy!

```
use Sergigp\Funiculus as f;
```

##Functions

You can see [available functions](https://github.com/sergigp/funiculus/blob/master/functions.md)
