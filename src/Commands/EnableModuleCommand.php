<?php

declare(strict_types=1);

namespace JustSteveKing\Laravel\ERP\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use JustSteveKing\Laravel\ERP\Actions\CheckModuleIsInstalled;
use JustSteveKing\Laravel\ERP\Events\ModuleEnabled;
use Throwable;

class EnableModuleCommand extends Command
{
    public $signature = 'module:enable {module : The name of the module you want to enable.}';

    public $description = 'Enable an installed ERP module.';

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
            $install = $this->confirm(
                question: "You haven't installed [$module], would you like to install it?",
            );

            if ($install) {
                try {
                    Artisan::call(
                        command: 'module:install',
                        parameters: ['module' => $module],
                    );

                    $this->info(
                        string: "Module [$module] has been installed by composer, now attempting to sync with ERP system.",
                    );

                    $installedModule = CheckModuleIsInstalled::handle(
                        module: $module,
                    );
                } catch (Throwable $exception) {
                    throw $exception;
                }
            }
        }

        $installedModule->enable();

        ModuleEnabled::dispatch($module);

        $this->info(
            string: "Module [$module] installed and enabled.",
        );

        return Command::SUCCESS;
    }
}
