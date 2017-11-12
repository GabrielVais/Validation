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
 * @covers \Respect\Validation\Rules\Sorted
 * @covers \Respect\Validation\Exceptions\SortedException
 */
class SortedTest extends TestCase
{
    public function testPasses()
    {
        $arr = [1, 2, 3];
        $rule = new Sorted();

        self::assertTrue($rule->validate($arr));
        self::assertTrue($rule->assert($arr));
        self::assertTrue($rule->check($arr));
    }

    public function testPassesWithEqualValues()
    {
        $arr = [1, 2, 2, 3];
        $rule = new Sorted();

        self::assertTrue($rule->validate($arr));
        self::assertTrue($rule->assert($arr));
        self::assertTrue($rule->check($arr));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\SortedException
     */
    public function testNotPasses()
    {
        $arr = [1, 2, 4, 3];
        $rule = new Sorted();

        self::assertFalse($rule->validate($arr));
        self::assertFalse($rule->check($arr));
    }

    public function testPassesDescending()
    {
        $arr = [10, 9, 8];
        $rule = new Sorted(null, false);

        self::assertTrue($rule->validate($arr));
        self::assertTrue($rule->assert($arr));
        self::assertTrue($rule->check($arr));
    }

    public function testPassesDescendingWithEqualValues()
    {
        $arr = [10, 9, 9, 8];
        $rule = new Sorted(null, false);

        self::assertTrue($rule->validate($arr));
        self::assertTrue($rule->assert($arr));
        self::assertTrue($rule->check($arr));
    }

    public function testPassesByFunction()
    {
        $arr = [
            [
                'key' => 1,
            ],
            [
                'key' => 2,
            ],
            [
                'key' => 5,
            ],
        ];
        $rule = new Sorted(function ($x) {
            return $x['key'];
        });

        self::assertTrue($rule->validate($arr));
        self::assertTrue($rule->assert($arr));
        self::assertTrue($rule->check($arr));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\SortedException
     */
    public function testNotPassesByFunction()
    {
        $arr = [
            [
                'key' => 1,
            ],
            [
                'key' => 8,
            ],
            [
                'key' => 5,
            ],
        ];
        $rule = new Sorted(function ($x) {
            return $x['key'];
        });

        self::assertFalse($rule->validate($arr));
        self::assertFalse($rule->check($arr));
    }
}
