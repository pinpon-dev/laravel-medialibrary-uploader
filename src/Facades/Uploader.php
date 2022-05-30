<?php

namespace PinPon\Uploader\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \PinPon\Uploader\Uploader
 */
class Uploader extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'simple-uploader';
    }
}
