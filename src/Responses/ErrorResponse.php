<?php

namespace RichToms\LaravelJsend\Responses;

class ErrorResponse extends Response
{
    /**
     * @var string
     */
    protected $statusText = 'error';

    /**
     * @var int|null
     */
    protected $code = null;

    /**
     * @var string|null
     */
    protected $message = null;

    /**
     * @param  int  $code
     * @return $this
     */
    public function withCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasMessage()
    {
        return ! is_null($this->message);
    }

    /**
     * @return bool
     */
    public function hasCode()
    {
        return ! is_null($this->code);
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
     * @return array
     */
    public function toArray()
    {
        $response = parent::toArray();

        if ($this->hasMessage()) {
            $response['message'] = $this->message;
        }

        if ($this->hasCode()) {
            $response['code'] = $this->code;
        }

        return $response;
    }
}
