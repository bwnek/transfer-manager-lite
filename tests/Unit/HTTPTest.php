<?php

declare(strict_types=1);

namespace BWnek\TransferManagerLite\Tests\Unit;

use BWnek\TransferManagerLite\HTTP;
use PHPUnit\Framework\TestCase;


final class HTTPTest extends TestCase
{
    public function testHTTPMethods_MethodNamesAreSet_MethodNamesAreValid()
    {
        // assert
        $this->assertSame('GET', HTTP::METHOD_GET);
        $this->assertSame('POST', HTTP::METHOD_POST);
        $this->assertSame('PUT', HTTP::METHOD_PUT);
        $this->assertSame('PATCH', HTTP::METHOD_PATCH);
        $this->assertSame('DELETE', HTTP::METHOD_DELETE);
    }


    public function testHTTPMethodsWithBody_MethodListIsSet_MethodListIsValid()
    {
        // act
        $httpMethods = HTTP::HTTP_METHODS_WITH_BODY;

        // assert
        $this->assertSame(['POST', 'PUT', 'PATCH'], $httpMethods);
    }
}