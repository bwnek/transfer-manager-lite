<?php

declare(strict_types=1);

namespace BWnek\TransferManagerLite;

use Psr\Http\Message\ResponseInterface;
use Stringable;


/**
 * @package BWnek\TransferManagerLite
 */
interface TransferManagerInterface
{
    public function get(string|Stringable $uri): ResponseInterface;
    public function post(string|Stringable $uri, array $payload = []): ResponseInterface;
    public function put(string|Stringable $uri, array $payload = []): ResponseInterface;
    public function patch(string|Stringable $uri, array $payload = []): ResponseInterface;
    public function delete(string|Stringable $uri): ResponseInterface;
}