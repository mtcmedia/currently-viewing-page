<?php

namespace Mtc\CurrentlyViewing\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mtc\CurrentlyViewing\ViewerManager
 * @method static addUser($user, $path)
 * @method static currentlyViewing($path);
 */
class ViewLog extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'currently_viewing';
    }
}
