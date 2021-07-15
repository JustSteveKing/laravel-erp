<?php

declare(strict_types=1);

namespace JustSteveKing\Laravel\ERP;

use JustSteveKing\Laravel\ERP\Commands\DisableModuleCommand;
use JustSteveKing\Laravel\ERP\Commands\EnableModuleCommand;
use JustSteveKing\Laravel\ERP\Commands\InstallModuleCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ERPServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name(
            name: 'erp',
        )->hasConfigFile()->hasMigration(
            migrationFileName: 'create_erp_module_table',
        )->hasCommands(
            InstallModuleCommand::class,
            EnableModuleCommand::class,
            DisableModuleCommand::class,
        );
    }
}
