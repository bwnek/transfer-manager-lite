<?php

declare(strict_types=1);

namespace BWnek\TransferManagerLite\Clients\Curl;


/**
 * @package BWnek\TransferManagerLite\Clients\Curl
 */
interface CurlLibraryFacadeInterface
{
    /**
     * @return string
     */
    public function execute(): string;

    /**
     * @param int $name
     * @param mixed $value
     */
    public function setOption(int $name, mixed $value): void;

    /**
     * @param array $options
     */
    public function setOptions(array $options): void;

    /**
     * @param int $name
     * @return mixed
     */
    public function getInfo(int $name): mixed;

    /**
     * @return bool
     */
    public function hasError(): bool;

    public function close(): void;
}