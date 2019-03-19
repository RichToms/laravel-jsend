<?php

namespace RichToms\LaravelJSend\Tests\Responses;

use PHPUnit\Framework\TestCase;
use RichToms\LaravelJsend\JSend;
use RichToms\LaravelJsend\Responses\FailResponse;

class FailResponseTest extends TestCase
{
    /** @test */
    public function a_fail_response_can_be_built()
    {
        $response = (new JSend)->fail(['errors' => []]);

        $this->assertTrue($response instanceof FailResponse);
    }
    
    /** @test */
    public function a_fail_response_always_has_the_required_keys()
    {
        $required = ['status', 'data'];

        $response = (new JSend)->fail(['errors' => []])->toArray();

        foreach ($required as $key) {
            $this->assertTrue(array_key_exists($key, $response));
        }
    }

    /** @test */
    public function a_fail_response_has_the_fail_status()
    {
        $response = (new JSend)->fail(['errors' => []])->toArray();

        $this->assertEquals('fail', $response['status']);
    }

    /** @test */
    public function a_fail_response_given_an_array_returns_the_same_array()
    {
        $response = (new JSend)->fail($data = ['errors' => []])->toArray();

        $this->assertEquals($response['data'], $data);
    }
}