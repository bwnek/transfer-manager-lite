<?php

declare(strict_types=1);

namespace BWnek\TransferManagerLite\Clients\Curl;

use BWnek\TransferManagerLite\BaseException;


/**
 * An exception thrown when the curl_init() function
 * could not create a \CurlHandle object.
 *
 * @package BWnek\TransferManagerLite\Exceptions
 */
class CouldNotCreateCurlHandle extends BaseException
{
}