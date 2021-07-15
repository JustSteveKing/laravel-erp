<?php

declare(strict_types=1);

namespace JustSteveKing\Laravel\ERP\Actions;

use Symfony\Component\Process\ExecutableFinder;
use Symfony\Component\Process\Process;

class InstallComposerPackage
{
    public static function handle(string $module): void
    {
        $process = new Process(
            command: [
                (new ExecutableFinder)->find(
                    name: 'composer',
                    default: 'composer',
                ),
                'require',
                $module,
                '--no-interaction',
             ],
        );

        $process->mustRun();

        // module should trigger post install....
    }
}
