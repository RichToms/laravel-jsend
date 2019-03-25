<?php

namespace RichToms\LaravelJSend\Tests;

use PHPUnit\Framework\TestCase;
use RichToms\LaravelJsend\JSend;

class DataTest extends TestCase
{
    /** @test */
    public function it_returns_the_associative_array_that_it_is_given()
    {
        $response = (new JSend)->build($baseData = [
            'hello' => ['world'],
        ])->toArray()['data'];

        $this->assertEquals($baseData, $response);
    }

    /** @test */
    public function it_determines_a_slug_from_many_of_the_same_objects_in_the_array()
    {
        $response = (new JSend)->build($baseData = [
            new Test, new Test, new Test,
        ])->toArray()['data'];

        $this->assertEquals(['tests'], array_keys($response));
    }

    /** @test */
    public function it_determines_slugs_from_multiple_objects_in_the_array()
    {
        $response = (new JSend)->build($baseData = [
            new Test, new AnotherTest, new Test,
        ])->toArray()['data'];

        $this->assertEquals(['tests', 'another_tests'], array_keys($response));
    }

    /** @test */
    public function it_extracts_a_slug_from_a_resource()
    {
        $response = (new JSend)->build(new TestResource)
            ->toArray()['data'];

        $this->assertEquals(['test'], array_keys($response));
    }

    /** @test */
    public function it_extracts_a_slug_from_a_resource_collection()
    {
        $response = (new JSend)->build(new TestResourceCollection)
            ->toArray()['data'];

        $this->assertEquals(['tests'], array_keys($response));
    }

    /** @test */
    public function it_provides_a_default_slug_if_one_is_not_found()
    {
        $response = (new JSend)->build([0, 1, 2])
            ->toArray()['data'];

        $this->assertEquals(['objects'], array_keys($response));
    }

    /** @test */
    public function it_finds_a_slug_from_a_type_if_one_is_provided()
    {
        $response = (new JSend)->build([['type' => 'key']])
            ->toArray()['data'];

        $this->assertEquals(['keys'], array_keys($response));
    }
}

// Test classes
class Test
{
}
class AnotherTest
{
}

// Resource classes
class TestResource
{
    public function toArray()
    {
        return [];
    }
}

class TestResourceCollection
{
    public function toArray()
    {
        return [];
    }
}
