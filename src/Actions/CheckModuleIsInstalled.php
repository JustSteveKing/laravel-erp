<?php

declare(strict_types=1);

namespace JustSteveKing\Laravel\ERP\Actions;

use Illuminate\Database\Eloquent\Model;
use JustSteveKing\Laravel\ERP\Models\Module;

class CheckModuleIsInstalled
{
    public static function handle(string $module): null|Model
    {
        return Module::where('name', $module)->first();
    }
}
