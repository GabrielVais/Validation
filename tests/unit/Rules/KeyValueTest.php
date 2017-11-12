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
 * @covers \Respect\Validation\Rules\KeyValue
 * @covers \Respect\Validation\Exceptions\KeyValueException
 */
class KeyValueTest extends TestCase
{
    public function testShouldDefineValuesOnConstructor()
    {
        $comparedKey = 'foo';
        $ruleName = 'equals';
        $baseKey = 'bar';

        $rule = new KeyValue($comparedKey, $ruleName, $baseKey);

        self::assertSame($comparedKey, $rule->comparedKey);
        self::assertSame($ruleName, $rule->ruleName);
        self::assertSame($baseKey, $rule->baseKey);
    }

    public function testShouldNotValidateWhenComparedKeyDoesNotExist()
    {
        $rule = new KeyValue('foo', 'equals', 'bar');

        self::assertFalse($rule->validate(['bar' => 42]));
    }

    public function testShouldNotValidateWhenBaseKeyDoesNotExist()
    {
        $rule = new KeyValue('foo', 'equals', 'bar');

        self::assertFalse($rule->validate(['foo' => true]));
    }

    public function testShouldNotValidateRuleIsNotValid()
    {
        $rule = new KeyValue('foo', 'probably_not_a_rule', 'bar');

        self::assertFalse($rule->validate(['foo' => true, 'bar' => false]));
    }

    public function testShouldValidateWhenDefinedValuesMatch()
    {
        $rule = new KeyValue('foo', 'equals', 'bar');

        self::assertTrue($rule->validate(['foo' => 42, 'bar' => 42]));
    }

    public function testShouldValidateWhenDefinedValuesDoesNotMatch()
    {
        $rule = new KeyValue('foo', 'equals', 'bar');

        self::assertFalse($rule->validate(['foo' => 43, 'bar' => 42]));
    }

    public function testShouldAssertWhenDefinedValuesMatch()
    {
        $rule = new KeyValue('foo', 'equals', 'bar');

        self::assertTrue($rule->assert(['foo' => 42, 'bar' => 42]));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\AllOfException
     * @expectedExceptionMessage All of the required rules must pass for foo
     */
    public function testShouldAssertWhenDefinedValuesDoesNotMatch()
    {
        $rule = new KeyValue('foo', 'equals', 'bar');
        $rule->assert(['foo' => 43, 'bar' => 42]);
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\KeyValueException
     * @expectedExceptionMessage "bar" must be valid to validate "foo"
     */
    public function testShouldNotAssertWhenRuleIsNotValid()
    {
        $rule = new KeyValue('foo', 'probably_not_a_rule', 'bar');
        $rule->assert(['foo' => 43, 'bar' => 42]);
    }

    public function testShouldCheckWhenDefinedValuesMatch()
    {
        $rule = new KeyValue('foo', 'equals', 'bar');

        self::assertTrue($rule->check(['foo' => 42, 'bar' => 42]));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\EqualsException
     * @expectedExceptionMessage foo must equal "bar"
     */
    public function testShouldCheckWhenDefinedValuesDoesNotMatch()
    {
        $rule = new KeyValue('foo', 'equals', 'bar');
        $rule->check(['foo' => 43, 'bar' => 42]);
    }
}
