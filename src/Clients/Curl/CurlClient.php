<?php

declare(strict_types=1);

namespace BWnek\TransferManagerLite\Clients\Curl;

use Closure;
use BWnek\TransferManagerLite\Clients\ClientInterface;
use BWnek\TransferManagerLite\Authentication\AuthenticatorInterface;
use Psr\Http\Message\{ResponseFactoryInterface, ResponseInterface, RequestInterface, StreamFactoryInterface};
use BWnek\TransferManagerLite\HTTP;


/**
 * @package BWnek\TransferManagerLite
 */
final class CurlClient implements ClientInterface
{
    /**
     * @param CurlLibraryFacadeInterface $curlFacade
     * @param ResponseFactoryInterface $psr17ResponseFactory
     * @param StreamFactoryInterface $psr17StreamFactory
     * @param AuthenticatorInterface|null $authenticator
     */
    public function __construct(
        public CurlLibraryFacadeInterface $curlFacade,
        public ResponseFactoryInterface $psr17ResponseFactory,
        public StreamFactoryInterface $psr17StreamFactory,
        private ?AuthenticatorInterface $authenticator = null
    )
    {}


    /**
     * @param RequestInterface $request
     * @param array $options
     * @return ResponseInterface
     * @throws EndpointCouldNotBeReached
     * @throws InvalidServerResponseContentType
     */
    public function executeRequest(RequestInterface $request, array $options = []): ResponseInterface
    {
        $responseHeaders = [];
        $requestHeaders = [
            'Content-Type: application/json'
        ];

        if ($this->authenticator) {
            $this->authenticator->authenticate($this->curlFacade, $requestHeaders);
        }


        $this->curlFacade->setOptions([
            [CURLOPT_HTTPHEADER, $requestHeaders],
            [CURLOPT_URL, (string)$request->getUri()],
            [CURLOPT_RETURNTRANSFER, true],
            [CURLOPT_CUSTOMREQUEST, $request->getMethod()],
            [CURLOPT_HEADERFUNCTION, $this->getHeaderExtractingFunction($responseHeaders)]
        ]);

        $this->setCurlPayloadIfRequired($request);


        try {
            $serverResponse = $this->curlFacade->execute();
            $httpCode = $this->curlFacade->getInfo(CURLINFO_HTTP_CODE);
        } finally {
            $this->curlFacade->close();
        }


        if ($this->curlFacade->hasError()) {
            throw new EndpointCouldNotBeReached();
        }


        // prevent reading anything other than json
        if ($this->isJsonResponse($responseHeaders)) {
            throw new InvalidServerResponseContentType();
        }


        $responseStream = $this->psr17StreamFactory->createStream($serverResponse);
        return $this->psr17ResponseFactory->createResponse($httpCode)->withBody($responseStream);
    }


    /**
     * @param RequestInterface $request
     */
    private function setCurlPayloadIfRequired(RequestInterface $request): void
    {
        if (in_array($request->getMethod(), HTTP::HTTP_METHODS_WITH_BODY)) {
            $postfields = json_decode((string)$request->getBody(), true);

            $this->curlFacade->setOption(CURLOPT_POST, true);
            $this->curlFacade->setOption(CURLOPT_POSTFIELDS, $postfields);
        }
    }


    /**
     * @param array $responseHeaders
     * @return bool
     */
    private function isJsonResponse(array $responseHeaders): bool
    {
        return
            !isset($responseHeaders['content-type'][0])
            || !str_contains(strtolower($responseHeaders['content-type'][0]), 'application/json');
    }


    /**
     * @param array $responseHeaders
     * @return Closure
     */
    private function getHeaderExtractingFunction(array &$responseHeaders): Closure
    {
        return function($curl, $header) use (&$responseHeaders)
        {
            $len = strlen($header);
            $header = explode(':', $header, 2);
            if (count($header) < 2) // ignore invalid headers
                return $len;

            $responseHeaders[strtolower(trim($header[0]))][] = trim($header[1]);

            return $len;
        };
    }
}