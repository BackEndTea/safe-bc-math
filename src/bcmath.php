<?php

declare(strict_types=1);

namespace BackEndTea;

use BackEndTea\BcMath\NumberValidator;
use DomainException;

/**
 * @param string|int|float $left
 * @param string|int|float $right
 *
 * @psalm-pure
 */
function bcadd($left, $right, int $scale = 0) : string
{
    return \bcadd(
        NumberValidator::validateInput($left),
        NumberValidator::validateInput($right),
        $scale
    );
}

/**
 * @param string|int|float $left
 * @param string|int|float $right
 *
 * @psalm-pure
 */
function bccomp($left, $right, int $scale = 0) : int
{
    return \bccomp(
        NumberValidator::validateInput($left),
        NumberValidator::validateInput($right),
        $scale
    );
}

/**
 * @param string|int|float $left
 * @param string|int|float $right
 *
 * @psalm-pure
 */
function bcdiv($left, $right, int $scale = 0) : string
{
    $right = NumberValidator::validateInput($right);
    NumberValidator::assertNotZero($right);

    return \bcdiv(
        NumberValidator::validateInput($left),
        $right,
        $scale
    );
}

/**
 * @param string|int|float $dividend
 * @param string|int|float $divisor
 *
 * @psalm-pure
 */
function bcmod($dividend, $divisor, int $scale = 0) : string
{
    $divisor = NumberValidator::validateInput($divisor);
    NumberValidator::assertNotZero($divisor);

    return \bcmod(
        NumberValidator::validateInput($dividend),
        $divisor,
        $scale
    );
}

/**
 * @param string|int|float $left
 * @param string|int|float $right
 *
 * @psalm-pure
 */
function bcmul($left, $right, int $scale = 0) : string
{
    return \bcmul(
        NumberValidator::validateInput($left),
        NumberValidator::validateInput($right),
        $scale
    );
}

/**
 * @param string|int|float $base
 * @param string|int|float $exponent
 *
 * @psalm-pure
 */
function bcpow($base, $exponent, int $scale = 0) : string
{
    return \bcpow(
        NumberValidator::validateInput($base),
        NumberValidator::validateInput($exponent),
        $scale
    );
}

/**
 * @param string|int|float $base
 * @param string|int|float $exponent
 * @param string|int|float $modulus
 *
 * @psalm-pure
 */
function bcpowmod($base, $exponent, $modulus, int $scale = 0) : string
{
    $modulus = NumberValidator::validateInput($modulus);
    NumberValidator::assertNotZero($modulus);

    return \bcpowmod(
        NumberValidator::validateInput($base),
        NumberValidator::validateInput($exponent),
        $modulus,
        $scale
    );
}

function bcscale(?int $scale = null) : void
{
    throw new DomainException('Setting a default scale is not supported');
}

/**
 * @param string|int|float $operand
 *
 * @psalm-pure
 */
function bcsqrt($operand, int $scale = 0) : string
{
    return \bcsqrt(
        NumberValidator::validateInput($operand),
        $scale
    );
}

/**
 * @param string|int|float $left
 * @param string|int|float $right
 *
 * @psalm-pure
 */
function bcsub($left, $right, int $scale = 0) : string
{
    return \bcsub(
        NumberValidator::validateInput($left),
        NumberValidator::validateInput($right),
        $scale
    );
}
