<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use src\User;

/**
 * @covers User
 */
final class UserTest extends TestCase
{
    public function testCanBeCreatedFromArray()
    {
        $this->assertInstanceOf(
            User::class,
            User::newFromArray([])
        );
    }
//
//    public function testCannotBeCreatedFromInvalidEmailAddress()
//    {
//        $this->expectException(InvalidArgumentException::class);
//
//        Email::fromString('invalid');
//    }
//
//    public function testCanBeUsedAsString()
//    {
//        $this->assertEquals(
//            'user@example.com',
//            Email::fromString('user@example.com')
//        );
//    }
}
