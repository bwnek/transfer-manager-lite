<?php

declare(strict_types=1);

namespace BWnek\TransferManagerLite\Tests\Unit;

use BWnek\TransferManagerLite\Authentication\JWTAuthenticator;
use PHPUnit\Framework\TestCase;


final class JWTAuthenticatorTest extends TestCase
{
    public $token = 'test-token-123';


    public function testAuthentication_ValidTokenProvided_AuthenticationHeaderIsBeingSet()
    {
        // arrange
        $authenticator = new JWTAuthenticator($this->token);
        $headers = [];


        // act
        $authenticator->authenticate(null, $headers);
        $authorizationHeader = end($headers);


        // assert
        $this->assertSame('Authorization: Bearer ' . $this->token, $authorizationHeader);
    }
}