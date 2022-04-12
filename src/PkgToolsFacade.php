<?php

namespace Pfinalclub\PfinalPkgTools;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Pfinalclub\PfinalPkgTools\PkgTools
 */
class PkgToolsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'pkg-tools';
    }
}
