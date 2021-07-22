<?php

declare(strict_types=1);

namespace JustSteveKing\Laravel\ERP\Commands;

use App\Events\ModuleInstalled;
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
        $module = $this->argument('module');

        $this->line(
            string: "Trying to install: [$module]",
        );

        ValidateModuleName::handle(
            module: $module,
        );

        $this->info(
            string: "Module [$module] has passed validation, attempting to install now...",
        );

        /** @var InstallComposerPackage $action */
        $action = resolve(InstallComposerPackage::class);

        $action->handle(
            module: $module,
        );

        $this->info(
            string: "Module [$module] has been installed by composer, now attempting to sync with ERP system.",
        );

        SyncModuleWithStorage::handle(
            module: $module,
        );

        ModuleInstalled::dispatch($module);

        $this->info(
            string: "Module [$module] installed and enabled.",
        );

        return Command::SUCCESS;
    }
}
