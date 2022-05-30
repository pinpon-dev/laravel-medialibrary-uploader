<?php

namespace PinPon\Uploader\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \PinPon\Uploader\Uploader
 */
class Uploader extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'simple-uploader';
    }
}
