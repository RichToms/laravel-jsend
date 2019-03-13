<?php

namespace RichToms\LaravelJsend;

class JSend
{
    /**
     * @param  mixed  $data
     * @param  integer  $statusCode
     * @param  array  $headers
     */
    public function build($data, $statusCode = 200, $headers = [])
    {
        return $this->getResponseHandler($statusCode)
            ->setData($data)
            ->withHeaders($headers)
            ->withStatusCode($statusCode);
    }

    /**
     * @param  string  $message
     * @param  integer  $statusCode
     * @param  array  $headers
     */
    public function error($message, $statusCode = 500, $headers = [])
    {
        return $this->getResponseHandler($statusCode)
            ->withMessage($message)
            ->withHeaders($headers)
            ->withStatusCode($statusCode);
    }

    /**
     * @param  array  $data
     * @param  integer  $statusCode
     * @param  array  $headers
     */
    public function fail($data, $statusCode = 400, $headers = [])
    {
        return $this->getResponseHandler($statusCode)
            ->setData($data)
            ->withHeaders($headers)
            ->withStatusCode($statusCode);
    }

    /**
     * @param  integer  $statusCode
     */
    protected function getResponseHandler($statusCode)
    {
        if ($statusCode >= 500) {
            return $this->getErrorResponseHandler();
        }

        if ($statusCode >= 400) {
            return $this->getFailResponseHandler();
        }

        return $this->getSuccessResponseHandler();
    }

    protected function getErrorResponseHandler()
    {
        return (new Responses\ErrorResponse);
    }

    protected function getFailResponseHandler()
    {
        return (new Responses\FailResponse);
    }

    protected function getSuccessResponseHandler()
    {
        return (new Responses\SuccessResponse);
    }
}
