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
        $this->line(
            string: 'Fetching all installed packages.',
        );

        $installed = json_decode(
            json: file_get_contents(
                filename: base_path() . '/vendor/composer/installed.json',
            ),
            associative: true,
        );

        $this->info(
            string: 'Retrieved packages, checking for erp modules that need enabling.',
        );

        collect(
            value: $installed['packages'],
        )->filter(
            fn($package) => data_get($package, 'extra.laravel-erp')
        )->each(
            fn($module) => SyncModuleWithStorage::handle(module: $module['name'])
        );

        $this->info(
            string: 'All erp modules have been discovered.',
        );

        return Command::SUCCESS;
    }
}
