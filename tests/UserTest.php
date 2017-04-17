<?php

namespace tests;

use src\model\User;
use PHPUnit\Framework\TestCase;

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

    /**
     * @dataProvider xssInjectionProvider
     */
    public function testXssInjectionThroughtNickname($nickname, $expect)
    {
        $user = User::newFromArray([
            'nickname' => $nickname
        ]);

        $result = $user->getByNickname();

        $this->assertEquals(
            $expect,
            $result
        );
    }

    public function xssInjectionProvider()
    {
        return [
            ['user<script>', false],
            ['<script>alert(document.cookie)</script>', false],
            ['<img src="http://www.want2vote.com/uploads/minecraft/walls/mini/GN5PQeDKREIysU5IQ.jpg"/>', false],
            ['<sc<script>ript>alert()</sc</script>ript>', false],
            ['";!--"<tag>=&{()}', false],
        ];
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
