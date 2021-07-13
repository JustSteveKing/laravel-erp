<?php

declare(strict_types=1);

namespace JustSteveKing\Laravel\ERP\Tests;

use JustSteveKing\Laravel\ERP\ERPServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app): array
    {
        return [
            ERPServiceProvider::class,
        ];
    }
}
