<?php
namespace WoohooLabs\Yin\Tests\JsonApi\Schema;

use PHPUnit\Framework\TestCase;
use WoohooLabs\Yin\JsonApi\Schema\Data\SingleResourceData;

class DataTest extends TestCase
{
    /**
     * @test
     */
    public function getNonExistentResource()
    {
        $resources = [
            [
                "type" => "resource",
                "id" => "1"
            ]
        ];

        $data = $this->createData()->setIncludedResources($resources);
        $this->assertNull($data->getResource("resource", "2"));
        $this->assertNull($data->getResource("resources", "1"));
    }

    /**
     * @test
     */
    public function getResource()
    {
        $resource = [
            "type" => "resource",
            "id" => "1"
        ];

        $data = $this->createData()->addIncludedResource($resource);
        $this->assertEquals($resource, $data->getResource("resource", "1"));
    }

    /**
     * @test
     */
    public function isEmptyByDefault()
    {
        $included = $this->createData();
        $this->assertFalse($included->hasIncludedResources());
    }

    /**
     * @test
     */
    public function isEmptyWhenIncludingNoResource()
    {
        $resources = [
            [
                "type" => "resource",
                "id" => "1"
            ]
        ];

        $data = $this->createData()->setIncludedResources($resources);
        $this->assertTrue($data->hasIncludedResources());
    }

    /**
     * @test
     */
    public function isEmptyWhenIncludingResources()
    {
        $resources = [];

        $data = $this->createData()->setIncludedResources($resources);
        $this->assertFalse($data->hasIncludedResources());
    }

    /**
     * @test
     */
    public function addResource()
    {
        $resource = [
            "type" => "resource",
            "id" => "1"
        ];

        $data = $this->createData()->addIncludedResource($resource);
        $this->assertEquals($resource, $data->getResource("resource", "1"));
    }

    /**
     * @test
     */
    public function transformEmpty()
    {
        $data = $this->createData();

        $this->assertEquals([], $data->transformIncludedResources());
    }

    /**
     * @test
     */
    public function transform()
    {
        $resource1 = ["type" => "resource", "id" => "1"];
        $resource2 = ["type" => "resource", "id" => "2"];
        $item1 = ["type" => "item", "id" => "1"];
        $item2 = ["type" => "item", "id" => "2"];

        $resources = [$item1, $resource2, $resource1, $item2, $item1, $resource1];

        $data = $this->createData()->setIncludedResources($resources);

        $transformedIncluded = [$item1, $item2, $resource1, $resource2];
        $this->assertEquals($transformedIncluded, $data->transformIncludedResources());
    }

    private function createData()
    {
        return new SingleResourceData();
    }
}
