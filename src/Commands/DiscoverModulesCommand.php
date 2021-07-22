<?php

declare(strict_types=1);

namespace JustSteveKing\Laravel\ERP\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\PackageManifest;

class DiscoverModules extends Command
{
    public $signature = 'module:discover';

    public $description = 'Discover any installed modules.';

    public function handle(PackageManifest $manifest): int
    {
        dd($manifest);

        return Command::SUCCESS;
    }
}
