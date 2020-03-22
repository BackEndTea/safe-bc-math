<?php

declare(strict_types=1);

namespace BackEndTea\BcMath;

use BackEndTea\BcMath\Exception\NonNumericString;
use DivisionByZeroError;
use PHPUnit\Framework\TestCase;
use function BackEndTea\bcadd;
use function BackEndTea\bccomp;
use function BackEndTea\bcdiv;
use function BackEndTea\bcmod;

final class MathTest extends TestCase
{
    public function testItAddsTwoNumbers() : void
    {
        $a = '12';
        $b = '13';

        $this->assertSame('25', bcadd($a, $b, 0));
    }

    public function testItCanScale() : void
    {
        $a = '12';
        $b = '13';

        $this->assertSame('25.0000000000', bcadd($a, $b, 10));
    }

    public function testItCanDealWithFloats() : void
    {
        $a = 12.5;
        $b = 14.1;

        $this->assertSame('26.60', bcadd($a, $b, 2));
    }

    public function testItErrorsOnNonNumericStrings() : void
    {
        $a = 'foo';
        $b = '12.3';
        $this->expectException(NonNumericString::class);
        bcadd($a, $b, 10);
    }

    public function testDivThrowsErrorWhenDividingByZero() : void
    {
        $this->expectException(DivisionByZeroError::class);
        bcdiv(12, 0);
    }

    public function testItCanDealWithSmallFloats() : void
    {
        $this->expectException(NonNumericString::class);
        bcdiv(12, 0.000000000000001);
    }

    public function testItCanDivideBySmallNumber() : void
    {
        $this->assertSame('120000000000.0', bcdiv(12, '0.0000000001', 1));
    }

    public function testItcompares() : void
    {
        $this->assertSame(-1, bccomp('12.3', '12.5', 1));
        $this->assertSame(0, bccomp('12.3', '12.5', 0));
    }

    public function testItModulos() : void
    {
        $this->assertSame('1.8', bcmod('11.8', '10', 1));
        $this->assertSame('1', bcmod('11.8', '10'));
    }


    public function testItPows() : void
    {
        $this->assertSame('4.8', \BackEndTea\bcpow('2.2', '2', 1));
        $this->assertSame('4', \BackEndTea\bcpow('2.2', '2'));
    }

    public function testItPowMods() : void
    {
        $this->assertSame('1.0', \BackEndTea\bcpowmod('2', '2', '3', 1));
        $this->assertSame('1', \BackEndTea\bcpowmod('2', '2', '3'));
    }

    public function testItSqrts() : void
    {
        $this->assertSame('2.0', \BackEndTea\bcsqrt('4.1', 1));
        $this->assertSame('2', \BackEndTea\bcsqrt('4.1'));
    }

    public function testItSubs() : void
    {
        $this->assertSame('2.3', \BackEndTea\bcsub('6.1','3.8', 1));
        $this->assertSame('2', \BackEndTea\bcsub('6.1', '3.8'));
    }
}
