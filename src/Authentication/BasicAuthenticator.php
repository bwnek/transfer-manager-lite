<?php

declare(strict_types=1);

namespace BWnek\TransferManagerLite\Authentication;

use BWnek\TransferManagerLite\Clients\Curl\CurlLibraryFacadeInterface;


/**
 * @package BWnek\TransferManagerLite\Authentication
 */
final class BasicAuthenticator implements AuthenticatorInterface
{
    /**
     * @param string $username
     * @param string $password
     */
    public function __construct(public string $username, public string $password)
    {}


    /**
     * @param CurlLibraryFacadeInterface|null $curl
     * @param array $headers
     */
    public function authenticate(?CurlLibraryFacadeInterface $curl, array &$headers = []): void
    {
        $curl->setOption(CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        $curl->setOption(CURLOPT_USERPWD, $this->username . ':' . $this->password);
    }
}