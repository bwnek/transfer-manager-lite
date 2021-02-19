<?php

declare(strict_types=1);

namespace BWnek\TransferManagerLite;

use BWnek\TransferManagerLite\Clients\ClientInterface;
use Psr\Http\Message\{RequestFactoryInterface, ResponseInterface};
use Stringable;


/**
 * @package BWnek\TransferManagerLite
 */
class TransferManager implements TransferManagerInterface
{
    /**
     * @param RequestFactoryInterface $psr17RequestFactory
     * @param ClientInterface $transferClient
     */
    public function __construct(
        protected RequestFactoryInterface $psr17RequestFactory,
        protected ClientInterface $transferClient
    )
    {}


    /**
     * @param string $method
     * @param string $uri
     * @param array $payload
     * @return ResponseInterface
     */
    private function executeRequest(
        string $method, string $uri, array $payload = []
    ): ResponseInterface
    {
        $psr17request = $this->psr17RequestFactory->createRequest($method, $uri);

        if ($payload) {
            $psr17request->getBody()->write(json_encode($payload));
        }

        return $this->transferClient->executeRequest($psr17request);
    }


    /**
     * @param string|Stringable $uri
     * @return ResponseInterface
     */
    public function get(string|Stringable $uri): ResponseInterface
    {
        return $this->executeRequest(HTTP::METHOD_GET, (string)$uri);
    }


    /**
     * @param string|Stringable $uri
     * @param array $payload
     * @return ResponseInterface
     */
    public function post(string|Stringable $uri, array $payload = []): ResponseInterface
    {
        return $this->executeRequest(HTTP::METHOD_POST, (string)$uri, $payload);
    }


    /**
     * @param string|Stringable $uri
     * @param array $payload
     * @return ResponseInterface
     */
    public function put(string|Stringable $uri, array $payload = []): ResponseInterface
    {
        return $this->executeRequest(HTTP::METHOD_PUT, (string)$uri, $payload);
    }


    /**
     * @param string|Stringable $uri
     * @param array $payload
     * @return ResponseInterface
     */
    public function patch(string|Stringable $uri, array $payload = []): ResponseInterface
    {
        return $this->executeRequest(HTTP::METHOD_PATCH, (string)$uri, $payload);
    }


    /**
     * @param string|Stringable $uri
     * @return ResponseInterface
     */
    public function delete(string|Stringable $uri): ResponseInterface
    {
        return $this->executeRequest(HTTP::METHOD_DELETE, (string)$uri);
    }
}
