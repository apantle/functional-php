<?php

/**
 * @package   Functional-php
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2017 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 * @link      https://github.com/lstrojny/functional-php
 */

namespace Functional;

use Functional\Exceptions\InvalidArgumentException;

/**
 * Takes a collection and returns the sum of the elements
 *
 * @param iterable<array-key, numeric|mixed> $collection
 * @param numeric $initial
 * @return numeric
 * @psalm-pure
 */
function sum($collection, $initial = 0)
{
    InvalidArgumentException::assertCollection($collection, __FUNCTION__, 1);

    $result = $initial;
    foreach ($collection as $value) {
        if (\is_numeric($value)) {
            $result += $value;
        }
    }

    return $result;
}
