<?php

declare(strict_types=1);

namespace BWnek\TransferManagerLite\Tests\Unit;

use BWnek\TransferManagerLite\Authentication\BasicAuthenticator;
use BWnek\TransferManagerLite\Clients\Curl\CurlLibraryFacadeInterface;
use PHPUnit\Framework\TestCase;


final class BasicAuthenticatorTest extends TestCase
{
    public string $username = 'apiUsername';

    public string $password = 'apiPassword';


    public function testAuthentication_ValidCredentialsProvided_AuthenticationHeadersAreBeingSet()
    {
        // arrange
        $authenticator = new BasicAuthenticator($this->username, $this->password);

        $curlLibraryFacadeInterfaceMock = $this->createMock(CurlLibraryFacadeInterface::class);
        $curlLibraryFacadeInterfaceMock
            ->expects($this->exactly(2))
            ->method('setOption')
            ->withConsecutive(
                [CURLOPT_HTTPAUTH, CURLAUTH_BASIC],
                [CURLOPT_USERPWD, $this->username . ':' . $this->password]
            );


        // act
        $authenticator->authenticate($curlLibraryFacadeInterfaceMock);
    }
}