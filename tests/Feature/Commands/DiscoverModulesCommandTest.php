<?php

use JustSteveKing\Laravel\ERP\Models\Module;

it('can discover installed modules using the installed composer packages.')
    ->tap(fn() => runDiscoverCommand())
    ->expect(fn() => Module::all())
    ->toHaveCount(1)
    ->first()->name
    ->toBe('juststeveking/laravel-erp-crm');
