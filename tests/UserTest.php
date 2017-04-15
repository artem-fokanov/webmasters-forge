<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use src\model\User;

/**
 * @covers User
 */
final class UserTest extends TestCase
{
    public function testCanBeCreatedFromArray()
    {
        $this->assertInstanceOf(
            User::class,
            User::newFromArray(['nickname' => 'web'])
        );
    }

    public function testNicknameCannotBeUnsafe()
    {
        $user = User::newFromArray([
            'nickname' => 'user<script>',
            'password' => '12'
        ]);

        $this->assertEquals(
            null,
            $user->nickname
        );
    }

    /**
     * @dataProvider sqlInjectionProvider
     */
    public function testSqlInjectionThroughNickname($query, $expect)
    {
        $user = User::newFromArray([
            'nickname' => $query
        ]);

        $result = $user->getByNickname();

        $this->assertEquals(
            $expect,
            $result
        );
    }

    public function sqlInjectionProvider()
    {
        return [
            'single quote hack' => ['user\' OR 1', false],
            'double quote hack' => ['user" OR 1', false],
            'information schema hack' => ['user UNION SELECT 0,concat_ws(0x3a,table_name,column_name) from information_schema.columns', false],
        ];
    }

    public function testExistingUser()
    {
        $user = User::newFromArray([
            'nickname' => 'web'
        ]);

        $result = $user->getByNickname();

        $this->assertEquals('array', gettype($result));
    }
}
