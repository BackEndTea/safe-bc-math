<?php

declare(strict_types=1);

namespace BackEndTea\BcMath;

use BackEndTea\BcMath\Exception\BadLocale;
use Generator;
use PHPUnit\Framework\TestCase;
use function BackEndTea\bcadd;
use function BackEndTea\bccomp;
use function BackEndTea\bcdiv;
use function BackEndTea\bcmod;
use function BackEndTea\bcmul;
use function BackEndTea\bcpow;
use function BackEndTea\bcpowmod;
use function BackEndTea\bcsqrt;
use function BackEndTea\bcsub;
use function setlocale;
use const LC_ALL;

/**
 * @preserveGlobalState
 */
final class LocaleAwareTest extends TestCase
{
    /** @var string */
    private static $oldLocale = '';

    public static function setUpBeforeClass() : void
    {
        self::$oldLocale = setlocale(LC_ALL, '0');
    }

    public static function tearDownAfterClass() : void
    {
        setlocale(LC_ALL, self::$oldLocale);
    }

    protected function setUp() : void
    {
        $locale = setlocale(LC_ALL, 'nl_NL');
        if ($locale !== false) {
            return;
        }

        $this->markTestSkipped('Can not change locale to nl_NL');
    }

    public function testItThrowsBadLocaleException() : void
    {
        $this->expectException(BadLocale::class);
        NumberValidator::validateInput(12.3);
    }

    /**
     * @psalm-param callable(): void $functionCallback
     * @dataProvider provideBCFunctionCallBacks
     */
    public function testBCFunctionsThrowBadLocaleException(callable $functionCallback) : void
    {
        $this->expectException(BadLocale::class);
        $functionCallback();
    }

    /**
     * @return Generator<array<callable>>
     *
     * @psalm-return Generator<array<callable(): void>>
     */
    public function provideBCFunctionCallBacks() : Generator
    {
        yield [
            static function () : void {
                bcadd(12, 10.3);
            },
        ];

        yield [
            static function () : void {
                bcadd(12.2, 10);
            },
        ];

        yield [
            static function () : void {
                bccomp(12.2, 10);
            },
        ];

        yield [
            static function () : void {
                bcdiv(12.2, 10);
            },
        ];

        yield [
            static function () : void {
                bcmod(12.2, 10);
            },
        ];

        yield [
            static function () : void {
                bcmul(12.2, 10);
            },
        ];

        yield [
            static function () : void {
                bcpow(12.2, 10);
            },
        ];

        yield [
            static function () : void {
                bcpowmod(12.2, 10, 8);
            },
        ];

        yield [
            static function () : void {
                bcsqrt(12.2, 8);
            },
        ];

        yield [
            static function () : void {
                bcsub(12.2, 8);
            },
        ];

        yield [
            static function () : void {
                bcmod(12, 10.3);
            },
        ];
    }

    public function testItOutputsWellFormed() : void
    {
        $this->assertSame('22.30', bcadd('12.3', 10, 2));
    }
}
