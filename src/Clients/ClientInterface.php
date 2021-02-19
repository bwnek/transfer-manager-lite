<?php

declare(strict_types=1);

namespace BWnek\TransferManagerLite\Clients;

use Psr\Http\Message\{RequestInterface, ResponseInterface};


/**
 * @package BWnek\TransferManagerLite
 */
interface ClientInterface
{
    /**
     * @param RequestInterface $request
     * @param array $options
     * @return ResponseInterface
     */
    public function executeRequest(RequestInterface $request, array $options = []): ResponseInterface;
}