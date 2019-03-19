<?php

namespace RichToms\LaravelJsend\Tests;

use PHPUnit\Framework\TestCase;
use RichToms\LaravelJsend\JSend;
use RichToms\LaravelJsend\Responses\FailResponse;
use RichToms\LaravelJsend\Responses\ErrorResponse;
use RichToms\LaravelJsend\Responses\SuccessResponse;

class JSendTest extends TestCase
{
    /** @test */
    public function a_success_status_code_gives_a_successful_response()
    {
        $response = (new JSend)->build([], 200);

        $this->assertTrue($response instanceof SuccessResponse);
    }

    /** @test */
    public function a_redirection_status_code_gives_a_successful_response()
    {
        $response = (new JSend)->build([], 301);

        $this->assertTrue($response instanceof SuccessResponse);
    }

    /** @test */
    public function a_client_error_status_code_gives_a_fail_response()
    {
        $response = (new JSend)->build([], 400);

        $this->assertTrue($response instanceof FailResponse);
    }

    /** @test */
    public function a_server_error_status_code_gives_an_error_response()
    {
        $response = (new JSend)->build([], 500);

        $this->assertTrue($response instanceof ErrorResponse);
    }
}
