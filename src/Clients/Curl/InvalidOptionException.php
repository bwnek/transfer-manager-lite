<?php

declare(strict_types=1);

namespace BWnek\TransferManagerLite\Clients\Curl;

use BWnek\TransferManagerLite\BaseException;


/**
 * An exception thrown when the option array given to setOptions is not valid
 *
 * @package BWnek\TransferManagerLite\Clients\Curl
 */
class InvalidOptionException extends BaseException
{
}