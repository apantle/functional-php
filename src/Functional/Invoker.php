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
 * Returns a function that invokes method `$method` with arguments `$methodArguments` on the object
 *
 * @param string $methodName
 * @param array $arguments
 * @return callable(object): mixed
 * @psalm-pure
 */
function invoker($methodName, array $arguments = [])
{
    InvalidArgumentException::assertMethodName($methodName, __FUNCTION__, 1);

    return
    /**
     * @param object $object
     * @return mixed
     */
    static function ($object) use ($methodName, $arguments) {
        return $object->{$methodName}(...$arguments);
    };
}
