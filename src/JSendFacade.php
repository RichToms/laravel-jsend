<?php

namespace RichToms\LaravelJsend;

use Illuminate\Support\Facades\Facade;

/**
 * @see \RichToms\LaravelJsend\Skeleton\SkeletonClass
 */
class JSendFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-jsend';
    }
}
