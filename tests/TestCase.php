<?php

namespace Pfinalclub\PfinalPkgTools\Tests;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            'Pfinalclub\PfinalPkgTools\PfinalPkgToolsServiceProvider',
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'PfinalPkgTools' => 'Pfinalclub\PfinalPkgTools\PfinalPkgToolsFacade',
        ];
    }

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Your code here
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        // $app['config']->set('database.default', 'testbench');
        // $app['config']->set('database.connections.testbench', [
        //     'driver'   => 'sqlite',
        //     'database' => ':memory:',
        //     'prefix'   => '',
        // ]);
    }
}
