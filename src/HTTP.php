<?php

declare(strict_types=1);

namespace BWnek\TransferManagerLite;

/**
 * @package BWnek\TransferManagerLite
 */
class HTTP
{
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_PUT = 'PUT';
    const METHOD_PATCH = 'PATCH';
    const METHOD_DELETE = 'DELETE';


    const HTTP_METHODS_WITH_BODY = [
        self::METHOD_POST,
        self::METHOD_PUT,
        self::METHOD_PATCH,
    ];
}