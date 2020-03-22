<?php

declare(strict_types=1);

namespace BackEndTea\BcMath\Exception;

use RuntimeException;

final class BadLocale extends RuntimeException
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
    public static function withMessage() : self
    {
        return new self(
            'The current locale can not properly cast floats to string, ' .
            'most likely it uses a different decimal seperator. Consider using ' .
            'another locale, or using number_format() to create a valid numeric string, ' .
            'regardless of locale'
        );
    }
}
