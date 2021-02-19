<?php

declare(strict_types=1);

namespace BWnek\TransferManagerLite\Clients\Curl;

use BWnek\TransferManagerLite\BaseException;


/**
 * An exception thrown when the server has sent a response to client but
 * the client can not undestand the content.
 *
 * @package BWnek\TransferManagerLite\Exceptions
 */
class InvalidServerResponseContentType extends BaseException
{
}