<?php

declare(strict_types=1);

namespace JustSteveKing\Laravel\ERP\Actions;

use Composer\InstalledVersions;
use InvalidArgumentException;
use JustSteveKing\Laravel\ERP\Models\Module;
use JustSteveKing\Laravel\ERPContracts\Module\InstallerContract;
use Throwable;

class SyncModuleWithStorage
{
    public static function handle(string $module): void
    {
        $module = Module::firstOrCreate([
            'name' => $module,
        ]);

        $json = json_decode(file_get_contents(base_path(
            "vendor/{$module->name}/composer.json",
        )), true);

        $author = collect($json['authors'])->first();

        $module->description = data_get($json, 'description');
        $module->author_name = data_get($author, 'name');
        $module->author_url = data_get($author, 'homepage');
        $module->module_url = data_get($json, 'homepage', "https://packagist.org/packages/{$module}");
        $module->version = InstalledVersions::getVersion(
            packageName: $module->name,
        );
        $module->save();

        $installClass = $json['extra']['laravel-erp']['installer'] ?? null;

        if (empty($installClass)) {
            return;
        }

        if (! class_exists($installClass)) {
            static::failed(
                message: "Class [$installClass] does not exist, so cannot be installed.",
                module: $module,
            );
        }

        $interfaces = class_implements($installClass);

        if (! in_array(InstallerContract::class, $interfaces)) {
            static::failed(
                message: "The module [$module->name] does not implement [\JustSteveKing\Laravel\ERPContracts\Module\InstallerContract] so cannot be installed.",
                module: $module,
            );
        }

        try {
            $installer = app()->make(
                abstract: $installClass,
            );

            $installer->install();
        } catch (Throwable) {
            static::failed(
                message: "Failed to install [$module->name].",
                module: $module
            );
        }
    }

    private static function failed(string $message, Module $module)
    {
        try {
            $module->forceFill([
                'enabled' => false,
            ])->save();
        } catch (Throwable) {
            //
        }

        throw new InvalidArgumentException(
            message: $message,
        );
    }
}
