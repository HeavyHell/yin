<?php
namespace WoohooLabsTest\Yin\JsonApi\Exception;

use PHPUnit_Framework_TestCase;
use WoohooLabs\Yin\JsonApi\Exception\SortingNotSupported;

class SortingNotSupportedTest extends PHPUnit_Framework_TestCase
{
    public function testGetMessage()
    {
        $exception = $this->createException();

        $this->assertEquals("Sorting is not supported!", $exception->getMessage());
    }

    private function createException()
    {
        return new SortingNotSupported();
    }
}
