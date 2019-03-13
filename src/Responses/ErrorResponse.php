<?php

namespace RichToms\LaravelJsend\Responses;

class ErrorResponse extends Response
{
    /**
     * @var string
     */
    protected $statusText = 'error';
}