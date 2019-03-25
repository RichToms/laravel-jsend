<?php

namespace RichToms\LaravelJsend;

class JSend
{
    /**
     * @param  mixed  $data
     * @param  int  $statusCode
     * @return $this
     */
    public function build($data, $statusCode = 200)
    {
        return $this->getResponseHandler($statusCode)
            ->withData($data)
            ->withStatusCode($statusCode);
    }

    /**
     * @param  string  $message
     * @param  int  $statusCode
     * @return $this
     */
    public function error($message, $statusCode = 500, $code = null, $data = null)
    {
        return $this->getResponseHandler($statusCode)
            ->withMessage($message)
            ->withStatusCode($statusCode);
    }

    /**
     * @param  array  $data
     * @param  int  $statusCode
     * @return $this
     */
    public function fail($data, $statusCode = 400)
    {
        return $this->getResponseHandler($statusCode)
            ->withData($data)
            ->withStatusCode($statusCode);
    }

    /**
     * @param  int  $statusCode
     * @return $this
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

    /**
     * @return \RichToms\LaravelJSend\Responses\Response
     */
    protected function getErrorResponseHandler()
    {
        return new Responses\ErrorResponse;
    }

    /**
     * @return \RichToms\LaravelJSend\Responses\Response
     */
    protected function getFailResponseHandler()
    {
        return new Responses\FailResponse;
    }

    /**
     * @return \RichToms\LaravelJSend\Responses\Response
     */
    protected function getSuccessResponseHandler()
    {
        return new Responses\SuccessResponse;
    }
}
