<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 17.04.2017
 * Time: 11:56
 */

use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase {

    public function testCorrectUser()
    {
        $response = $this->request('web', '123');

        $this->assertEquals(200, $response);
    }

    public function testIncorrectUser()
    {
        $response = $this->request('web', 'wrongPassword');

        $this->assertEquals(401, $response);
    }

    public function request($login, $pass)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,"https://zvu.in.ua");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "nickname=$login&password=$pass");
        @curl_setopt($ch, CURLOPT_HEADER  , true);
        @curl_setopt($ch, CURLOPT_NOBODY  , true);

        // receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec ($ch);

        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close ($ch);

        return $httpcode;
    }
}
