<?php


namespace Sergigp\Funiculus
{
    function op ($op, $arg = null)
    {
        $funs = [
            'inc'       => function($x, $arg = 1) { return $x + $arg; },
            'dec'       => function($x, $arg = 1) { return $x - $arg; },
            'square'    => function($x) { return $x * $x; },
            'pow'       => function($x, $arg) { return pow($x, $arg); },
        ];

        if (!array_key_exists($op, $funs)) {
            throw new \InvalidArgumentException(sprintf('Unknown operator: %s', $op));
        }

        $fn = $funs[$op];

        if (is_null($arg)) {
            return $funs[$op];
        }

        return function ($a) use ($fn, $arg) {
            return $fn ($a, $arg);
        };
    }

    function map (callable $fun, $seq)
    {
        foreach ($seq as $el) {
            yield $fun($el);
        }
    }
}
