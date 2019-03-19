<?php

namespace RichToms\LaravelJSend\Tests\Responses;

use PHPUnit\Framework\TestCase;
use RichToms\LaravelJsend\JSend;
use RichToms\LaravelJsend\Responses\SuccessResponse;

class SuccessResponseTest extends TestCase
{
    /** @test */
    public function a_success_response_can_be_built()
    {
        $response = (new JSend)->build(['errors' => []]);

        $this->assertTrue($response instanceof SuccessResponse);
    }

    /** @test */
    public function a_success_response_always_has_the_required_keys()
    {
        $required = ['status', 'data'];

        $response = (new JSend)->build(['errors' => []])->toArray();

        foreach ($required as $key) {
            $this->assertTrue(array_key_exists($key, $response));
        }
    }

    /** @test */
    public function a_success_response_has_the_success_status()
    {
        $response = (new JSend)->build(['errors' => []])->toArray();

        $this->assertEquals('success', $response['status']);
    }

    /** @test */
    public function a_success_response_given_an_array_returns_the_same_array()
    {
        $response = (new JSend)->build($data = ['errors' => []])->toArray();

        $this->assertEquals($response['data'], $data);
    }
}
