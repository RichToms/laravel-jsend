<?php

namespace RichToms\LaravelJsend\Responses;

use JsonSerializable;

class Response implements JsonSerializable
{
    /**
     * @var integer
     */
    protected $statusCode = 200;

    /**
     * @var array
     */
    protected $headers = [];

    /**
     * @var array|null
     */
    protected $data = false;

    /**
     * @var string|null
     */
    protected $message = null;

    /**
     * @var string
     */
    protected $statusText = 'success';

    /**
     * @param  integer  $statusCode
     * @return $this
     */
    public function withStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @param  array  $headers
     * @return $this
     */
    public function withHeaders(array $headers)
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * @param  mixed  $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $this->toJSendData($data);
        return $this;
    }

    /**
     * @param  string  $message
     * @return $this
     */
    public function withMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return boolean
     */
    public function hasData()
    {
        return $this->data !== false;
    }

    /**
     * @return boolean
     */
    public function hasMessage()
    {
        return !is_null($this->message);
    }

    /**
     * @return integer
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @return string
     */
    public function getStatusText()
    {
        return $this->statusText;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $response = [
            'status' => $this->getStatusText(),
        ];

        if ($this->hasData()) {
            $response['data'] = $this->data;
        }
        if ($this->hasMessage()) {
            $response['message'] = $this->message;
        }

        return $response;
    }

    /**
     * @param  mixed  $data
     * @return mixed
     */
    public function toJSendData($data)
    {
        return $data;
    }
}