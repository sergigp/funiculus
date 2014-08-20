<?php


namespace Sergigp\Funiculus
{
    function predefinedClosures($n)
    {
        $funs = [
            'inc'       => function($i) { return ++$i; },
            'dec'       => function($i) { return --$i; },
            'square'    => function($i) { return $i * $i; },
        ];

        return array_key_exists($n, $funs) ? $funs[$n] : false;
    }

    function map ($fun, $seq)
    {
        $fun = is_callable($fun) ? $fun : predefinedClosures($fun);

        foreach ($seq as $el) {
            yield $fun($el);
        }
    }
}
