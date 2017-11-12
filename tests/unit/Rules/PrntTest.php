<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

use PHPUnit\Framework\TestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Prnt
 * @covers \Respect\Validation\Exceptions\PrntException
 */
class PrntTest extends TestCase
{
    /**
     * @dataProvider providerForValidPrint
     */
    public function testValidDataWithPrintCharsShouldReturnTrue($validPrint, $additional = '')
    {
        $validator = new Prnt($additional);
        self::assertTrue($validator->validate($validPrint));
    }

    /**
     * @dataProvider providerForInvalidPrint
     * @expectedException \Respect\Validation\Exceptions\PrntException
     */
    public function testInvalidPrintShouldFailAndThrowPrntException($invalidPrint, $additional = '')
    {
        $validator = new Prnt($additional);
        self::assertFalse($validator->validate($invalidPrint));
        self::assertFalse($validator->assert($invalidPrint));
    }

    /**
     * @dataProvider providerForInvalidParams
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidConstructorParamsShouldThrowComponentExceptionUponInstantiation($additional)
    {
        $validator = new Prnt($additional);
    }

    /**
     * @dataProvider providerAdditionalChars
     */
    public function testAdditionalCharsShouldBeRespected($additional, $query)
    {
        $validator = new Prnt($additional);
        self::assertTrue($validator->validate($query));
    }

    public function providerAdditionalChars()
    {
        return [
            ["\t\n", "\t\n "],
            ["\v\r", "\v\r "],
        ];
    }

    public function providerForInvalidParams()
    {
        return [
            [new \stdClass()],
            [[]],
            [0x2],
        ];
    }

    public function providerForValidPrint()
    {
        return [
            [' '],
            ['LKA#@%.54'],
            ['foobar'],
            ['16-50'],
            ['123'],
            ['foo bar'],
            ['#$%&*_'],
        ];
    }

    public function providerForInvalidPrint()
    {
        return [
            [''],
            [null],
            ['foo'.chr(7).'bar'],
            ['foo'.chr(10).'bar'],
        ];
    }
}
