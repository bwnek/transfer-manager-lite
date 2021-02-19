<?php

declare(strict_types=1);

namespace BWnek\TransferManagerLite\Clients\Curl;

use BWnek\TransferManagerLite\BaseException;


/**
 * An exception thrown when the curl_exec() function
 * could not execute request.
 *
 * @package BWnek\TransferManagerLite\Exceptions
 */
class CouldNotExecuteRequest extends BaseException
{
}