<?php

use JustSteveKing\Laravel\ERP\Actions\CheckModuleIsInstalled;
use JustSteveKing\Laravel\ERP\Models\Module;

it('returns a module if one is available with the given name')
    ->createModuleWithName('juststeveking/laravel-erp-crm')
    ->expect(fn() => CheckModuleIsInstalled::handle(
        module: 'juststeveking/laravel-erp-crm',
    ))
    ->toBeInstanceOf(Module::class);

it('returns null if no module is available with the given name')
    ->expect(fn() => CheckModuleIsInstalled::handle(
        module: 'juststeveking/laravel-erp-crm',
    ))
    ->toBeNull();
