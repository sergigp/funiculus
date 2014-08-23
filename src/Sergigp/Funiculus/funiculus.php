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
            '+'         => function($x, $y) { return $x + $y; },
            '-'         => function($x, $y) { return $x - $y; },
            '*'         => function($x, $y) { return $x * $y; },
            '/'         => function($x, $y) { return $x / $y; },
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

    function first ($seq)
    {
        return array_shift($seq);
    }

    function rest ($seq)
    {
        return array_slice($seq, 1);
    }

    function cons ($el, $seq)
    {
        array_unshift($seq, $el);
        return $seq;
    }

    function is_empty ($seq)
    {
        return empty($seq);
    }

    function reduce (callable $fun, $seq)
    {
        $r = first($seq);

        for ($i = 0; $i < (count($seq) - 1); $i++) {
            $r = $fun($r, $seq[$i + 1]);
        }

        return $r;
    }
}
