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
        if (!is_callable($fun) && predefinedClosures($fun)) {
            return array_map(predefinedClosures($fun), $seq);
        }
        return array_map($fun, $seq);
    }
}
