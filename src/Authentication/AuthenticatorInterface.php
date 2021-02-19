<?php

declare(strict_types=1);

namespace BWnek\TransferManagerLite\Authentication;

use BWnek\TransferManagerLite\Clients\Curl\CurlLibraryFacadeInterface;


/**
 * @package BWnek\TransferManagerLite\Authentication
 */
interface AuthenticatorInterface
{
    public function authenticate(?CurlLibraryFacadeInterface $curl, array &$headers = []): void;
}