<?php
/**
 * Author: PFinal南丞
 * Date: 2022/4/12
 * Email: <lampxiezi@163.com>
 */
namespace Pfinalclub\PkgTools;

class Pkg
{
    /**
     * The Laravel pkg tools version.
     *
     * @var string
     */
    const VERSION = '0.0.1';

    public static function getLongVersion(): string
    {
        return self::VERSION;
    }
}
