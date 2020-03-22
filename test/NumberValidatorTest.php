<?php

declare(strict_types=1);

namespace BackEndTea\BcMath;

use BackEndTea\BcMath\Exception\NonNumericString;
use Exception;
use Generator;
use PHPUnit\Framework\TestCase;
use TypeError;

/**
 * @preserveGlobalState
 */
final class NumberValidatorTest extends TestCase
{
    /**
     * @param mixed $input
     *
     * @dataProvider provideWrongTypes
     */
    public function testItThrowsATypeErrorOnInvalidInput($input) : void
    {
        $this->expectException(TypeError::class);
        NumberValidator::validateInput($input);
    }

    /**
     * @return Generator<array<mixed>>
     */
    public function provideWrongTypes() : Generator
    {
        yield [[]];

        yield [new class {
        },
        ];

        yield [new Exception()];
    }

    /**
     * @dataProvider provideNonNumericStrings
     */
    public function testItThrowsOnNonNumericString(string $input) : void
    {
        $this->expectException(NonNumericString::class);
        NumberValidator::validateInput($input);
    }

    /**
     * @return Generator<array<string>>
     */
    public function provideNonNumericStrings() : Generator
    {
        yield [''];
        yield ['foo'];
        yield ['12,7'];
        yield ['14 000.8'];
        yield ['12.888,2'];
    }
}
