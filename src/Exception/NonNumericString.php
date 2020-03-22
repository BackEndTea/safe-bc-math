<?php

declare(strict_types=1);

namespace BackEndTea\BcMath\Exception;

use InvalidArgumentException;
use function sprintf;

final class NonNumericString extends InvalidArgumentException
{
    /**
     * @psalm-pure
     */
    private function __construct(string $message)
    {
        parent::__construct($message);
    }

    /**
     * @psalm-pure
     */
    public static function fromString(string $input) : self
    {
        return new self(
            sprintf(
                'Expected a numeric string, instead got: "%s"',
                $input
            )
        );
    }

    /**
     * @psalm-pure
     */
    public static function fromScientificNotation(string $input) : self
    {
        return new self(
            sprintf(
                'The input "%s" is numeric, but is not valid according to the bc math functions ' .
                'most likely you have provided a number with a lot of decimals, which was cast to its scientific notation. ' .
                'Consider using number_format to format the number before passing it to this function.',
                $input
            )
        );
    }
}
