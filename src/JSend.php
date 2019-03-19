<?php

namespace RichToms\LaravelJsend;

class JSend
{
    /**
     * @param  mixed  $data
     * @param  integer  $statusCode
     */
    public function build($data, $statusCode = 200)
    {
        return $this->getResponseHandler($statusCode)
            ->withData($data)
            ->withStatusCode($statusCode);
    }

    /**
     * @param  string  $message
     * @param  integer  $statusCode
     */
    public function error($message, $statusCode = 500, $code = null, $data = null)
    {
        return $this->getResponseHandler($statusCode)
            ->withMessage($message)
            ->withStatusCode($statusCode);
    }

    /**
     * @param  array  $data
     * @param  integer  $statusCode
     */
    public function fail($data, $statusCode = 400)
    {
        return $this->getResponseHandler($statusCode)
            ->withData($data)
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
