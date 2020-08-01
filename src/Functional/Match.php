<?php

/**
 * @package   Functional-php
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2017 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 * @link      https://github.com/lstrojny/functional-php
 */

namespace Functional;

use Functional\Exceptions\MatchException;

use function Functional\head;
use function Functional\tail;
use function Functional\if_else;

/**
 * Performs an operation checking for the given conditions
 *
 * @template V
 * @template TReturn
 * @param array<array<callable(V): bool, callable(V): TReturn>> $conditions the conditions to check against
 * @return callable(V): TReturn the function that calls the callable of the first truthy condition
 * @psalm-pure
 */
function match(array $conditions): callable
{
    MatchException::assert($conditions, __FUNCTION__);

    return
    /**
     * @param V $value
     */
    static function ($value) use ($conditions) {
        if (empty($conditions)) {
            return null;
        }

        list($if, $then) = head($conditions);

        return if_else($if, $then, match(tail($conditions)))($value);
    };
}
