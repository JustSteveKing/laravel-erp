<?php

declare(strict_types=1);

namespace JustSteveKing\Laravel\ERP;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ERPServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name(
            name: 'erp',
        )->hasConfigFile();
    }
}
