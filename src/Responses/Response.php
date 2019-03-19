<?php

namespace RichToms\LaravelJsend\Responses;

use JsonSerializable;

class Response implements JsonSerializable
{
    /**
     * @var int
     */
    protected $statusCode = 200;

    /**
     * @var array|null
     */
    protected $data = false;

    /**
     * @var string
     */
    protected $statusText = 'success';

    /**
     * @param  int  $statusCode
     * @return $this
     */
    public function withStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @param  mixed  $data
     * @return $this
     */
    public function withData($data)
    {
        $this->data = $this->toJSendData($data);

        return $this;
    }

    /**
     * @return bool
     */
    public function hasData()
    {
        return $this->data !== false;
    }

    /**
     * @return int
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
    public function toArray()
    {
        $response = [
            'status' => $this->getStatusText(),
        ];

        if ($this->hasData()) {
            $response['data'] = $this->data;
        }

        return $response;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
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
