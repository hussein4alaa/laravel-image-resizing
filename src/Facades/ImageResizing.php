<?php

namespace g4t\ImageResizing\Facades;

use Illuminate\Support\Facades\Facade;

class ImageResizing extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'ImageResizing';
    }
}
