<?php

declare(strict_types=1);

namespace BackEndTea\BcMath;

use BackEndTea\BcMath\Exception\BadLocale;
use BackEndTea\BcMath\Exception\NonNumericString;
use DivisionByZeroError;
use TypeError;
use function get_class;
use function gettype;
use function is_float;
use function is_int;
use function is_numeric;
use function is_object;
use function is_string;
use function sprintf;
use function stripos;

/**
 * @internal
 */
final class NumberValidator
{
    private function __construct()
    {
    }

    /**
     * @param mixed $input
     *
     * @psalm-pure
     */
    public static function validateInput($input) : string
    {
        if (! is_string($input) && ! is_float($input) && ! is_int($input)) {
            throw new TypeError(
                sprintf(
                    'Expected an int, string or float, got %s',
                    is_object($input) ? 'Class: ' . get_class($input): gettype($input)
                )
            );
        }

        if (is_string($input) && ! is_numeric($input)) {
            throw NonNumericString::fromString($input);
        }

        $output = (string) $input;
        if (! is_numeric($output)) {
            throw BadLocale::withMessage();
        }

        if (stripos($output, 'e') !== false) {
            throw NonNumericString::fromScientificNotation($output);
        }

        return $output;
    }

    /**
     * @psalm-pure
     */
    public static function assertNotZero(string $input) : void
    {
        $floatInput = (float) $input;

        // phpcs:ignore SlevomatCodingStandard.Operators.DisallowEqualOperators.DisallowedEqualOperator
        if ($floatInput === 0.0) {
            throw new DivisionByZeroError();
        }
    }
}
