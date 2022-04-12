<?php

namespace Pfinalclub\PfinalPkgTools\Tests;

class ExampleTest extends TestCase
{
    /**
     * testBasicExample
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->assertInstanceOf(\Pfinalclub\PfinalPkgTools\PfinalPkgTools::class, app('pfinal-pkg-tools'));
        $this->assertInstanceOf(\Pfinalclub\PfinalPkgTools\PfinalPkgTools::class, \Pfinalclub\PfinalPkgTools\PfinalPkgToolsFacade::getFacadeRoot());
    }
}
