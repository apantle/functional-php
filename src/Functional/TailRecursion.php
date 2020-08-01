<?php

/**
 * @package   Functional-php
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2017 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 * @link      https://github.com/lstrojny/functional-php
 */

namespace Functional;

/**
 * Decorates given function with tail recursion optimization.
 *
 * I took the solution from here https://gist.github.com/beberlei/4145442
 * but reworked it and made without classes.
 *
 * @template TArg
 * @template TReturn
 * @param callable(...TArg): TReturn $fn
 * @return callable(...TArg): TReturn
 * @psalm-pure
 */
function tail_recursion(callable $fn): callable
{
    $underCall = false;
    $queue = [];
    return
    /**
     * @param TArg $args
     */
    static function (...$args) use (&$fn, &$underCall, &$queue) {
        $result = null;
        $queue[] = $args;

        if (!$underCall) {
            $underCall = true;
            while ($head = \array_shift($queue)) {
                $result = $fn(...$head);
            }
            $underCall = false;
        }

        return $result;
    };
}
