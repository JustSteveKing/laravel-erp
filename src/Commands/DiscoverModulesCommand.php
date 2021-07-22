<?php

declare(strict_types=1);

namespace JustSteveKing\Laravel\ERP\Commands;

use Composer\InstalledVersions;
use Illuminate\Console\Command;
use JustSteveKing\Laravel\ERP\Actions\SyncModuleWithStorage;

class DiscoverModulesCommand extends Command
{
    public $signature = 'module:discover';

    public $description = 'Discover any installed modules.';

    public function handle(): int
    {
        // Get all installed packages from composer.
        $installed = json_decode(
            json: file_get_contents(
                filename: base_path() . '/vendor/composer/installed.json',
            ),
            associative: true,
        );

        collect(
            value: $installed['packages'],
        )->filter(
            fn($package) => data_get($package, 'extra.laravel-erp')
        )->each(
            fn($module) => SyncModuleWithStorage::handle(module: $module['name'])
        );

        return Command::SUCCESS;
    }
}
