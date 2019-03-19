<?php

namespace RichToms\LaravelJSend\Tests\Responses;

use PHPUnit\Framework\TestCase;
use RichToms\LaravelJsend\JSend;
use RichToms\LaravelJsend\Responses\ErrorResponse;

class ErrorResponseTest extends TestCase
{
    /** @test */
    public function an_error_response_can_be_built()
    {
        $response = (new JSend)->error('Testing error');

        $this->assertTrue($response instanceof ErrorResponse);
    }

    /** @test */
    public function an_error_can_have_a_message()
    {
        $response = (new JSend)->error('Testing error')->toArray();

        $this->assertEquals("Testing error", $response['message']);
    }

    /** @test */
    public function an_error_response_has_the_error_status()
    {
        $response = (new JSend)->error('Testing error')->toArray();

        $this->assertEquals("error", $response['status']);
    }

    /** @test */
    public function an_error_response_can_have_a_code()
    {
        $response = (new JSend)->error('Testing error')
            ->withCode(1)
            ->toArray();

        $this->assertTrue(array_key_exists('code', $response));
        $this->assertEquals($response['code'], 1);
    }

    /** @test */
    public function an_error_response_can_have_data()
    {
        $data = ['results' => [true, false, true]];
        $response = (new JSend)->error('Testing error')
            ->withData($data)
            ->toArray();

        $this->assertTrue(array_key_exists('data', $response));
        $this->assertEquals($response['data'], $data);
    }

    /** @test */
    public function an_error_response_always_has_the_required_keys()
    {
        $required = ['status', 'message'];

        $response = (new JSend)->error('Testing error')->toArray();

        foreach ($required as $key) {
            $this->assertTrue(array_key_exists($key, $response));
        }
    }
}