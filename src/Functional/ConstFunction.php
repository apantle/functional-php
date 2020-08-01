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
 * Wrap value within a function, which will return it, without any modifications.
 *
 * @template T
 * @param T $value
 * @return callable(): T
 * @psalm-pure
 */
function const_function($value)
{
    return static function () use ($value) {
        return $value;
    };
}
