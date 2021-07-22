<?php

declare(strict_types=1);

namespace JustSteveKing\Laravel\ERP\Commands;

use Illuminate\Console\Command;
use JustSteveKing\Laravel\ERP\Actions\CheckModuleIsInstalled;
use JustSteveKing\Laravel\ERP\Events\ModuleDisabled;

class DisableModuleCommand extends Command
{
    public $signature = 'module:disable {module : The name of the module you want to disable.}';

    public $description = 'Disable an installed ERP module.';

    public function handle(): int
    {
        $module = $this->argument('module');

        $this->line(
            string: "Checking that module [$module] has been installed...",
        );

        $installedModule = CheckModuleIsInstalled::handle(
            module: $module,
        );

        if (is_null($installedModule)) {
            $this->warn(
                string: "Module [$module] has not been installed.",
            );

            return Command::FAILURE;
        }

        $installedModule->disable();

        ModuleDisabled::dispatch($module);

        $this->info(
            string: "Module [$module] has been disabled.",
        );

        return Command::SUCCESS;
    }
}
