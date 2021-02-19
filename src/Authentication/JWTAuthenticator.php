<?php

declare(strict_types=1);

namespace BWnek\TransferManagerLite\Authentication;

use BWnek\TransferManagerLite\Clients\Curl\CurlLibraryFacadeInterface;


/**
 * @package BWnek\TransferManagerLite\Authorization
 */
final class JWTAuthenticator implements AuthenticatorInterface
{
    /**
     * @param string $token
     */
    public function __construct(public string $token)
    {}


    /**
     * @param CurlLibraryFacadeInterface|null $curl
     * @param array $headers
     */
    public function authenticate(?CurlLibraryFacadeInterface $curl, array &$headers = []): void
    {
        $headers[] = 'Authorization: Bearer ' . $this->token;
    }
}