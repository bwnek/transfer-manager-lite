<?php

declare(strict_types=1);

namespace BWnek\TransferManagerLite\Clients\Curl;

use BWnek\TransferManagerLite\CouldNotCreateCurlHandle;
use BWnek\TransferManagerLite\CouldNotExecuteRequest;
use CurlHandle;


/**
 * @package BWnek\TransferManagerLite\Clients\Curl
 */
class CurlLibraryFacade implements CurlLibraryFacadeInterface
{
    /**
     * @var CurlHandle
     */
    private CurlHandle $handle;


    /**
     * @throws CouldNotCreateCurlHandle
     */
    public function __construct()
    {
        $handle = curl_init();

        if (!($handle instanceof CurlHandle)) {
            throw new CouldNotCreateCurlHandle();
        }

        $this->handle = $handle;
    }


    /**
     * @return string
     * @throws CouldNotExecuteRequest
     */
    public function execute(): string
    {
        $response = curl_exec($this->handle);

        if ($response === false) {
            throw new CouldNotExecuteRequest();
        }

        return $response;
    }


    /**
     * @param int $name
     * @param mixed $value
     */
    public function setOption(int $name, mixed $value): void
    {
        curl_setopt($this->handle, $name, $value);
    }


    /**
     * @param array $options
     * @throws InvalidOptionException
     */
    public function setOptions(array $options): void
    {
        foreach ($options as $option) {
            if (count($option) != 2) {
                throw new InvalidOptionException();
            }

            $this->setOption($option[0], $option[1]);
        }
    }


    /**
     * @param int $name
     * @return mixed
     */
    public function getInfo(int $name): mixed
    {
        return curl_getinfo($this->handle, $name);
    }


    /**
     * @return bool
     */
    public function hasError(): bool
    {
        return (bool)curl_errno($this->handle);
    }


    public function close(): void
    {
        curl_close($this->handle);
    }
}