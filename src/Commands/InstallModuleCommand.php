<?php

declare(strict_types=1);

namespace JustSteveKing\Laravel\ERP\Commands;

use Illuminate\Console\Command;
use JustSteveKing\Laravel\ERP\Actions\InstallComposerPackage;
use JustSteveKing\Laravel\ERP\Actions\SyncModuleWithStorage;
use JustSteveKing\Laravel\ERP\Actions\ValidateModuleName;

class InstallModuleCommand extends Command
{
    public $signature = 'module:install {module : The name of the module you want to install.}';

    public $description = 'Install a new ERP module.';

    public function handle(): int
    {
        ValidateModuleName::handle(
            module: $this->argument('module'),
        );

        /** @var InstallComposerPackage $action */
        $action = resolve(InstallComposerPackage::class);

        $action->handle(
            module: $this->argument('module'),
        );

        SyncModuleWithStorage::handle(
            module: $this->argument('module'),
        );

        return Command::SUCCESS;
    }
}
