<?php

declare(strict_types=1);

namespace BWnek\TransferManagerLite\Clients\Curl;

use BWnek\TransferManagerLite\BaseException;


/**
 * An exception thrown when the destination endpoint could not be reached.
 * E. g.: network error, invalid port, server is down etc.
 *
 * @package BWnek\TransferManagerLite\Exceptions
 */
class EndpointCouldNotBeReached extends BaseException
{
}