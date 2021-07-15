<?php

declare(strict_types=1);

namespace JustSteveKing\Laravel\ERP\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = [
        'name',
        'pretty_name',
        'description',
        'version',
        'author_name',
        'author_url',
        'module_url',
        'enabled',
    ];

    protected $casts = [
        'enabled' => 'boolean',
    ];

    protected $attributes = [
        'enabled' => true,
    ];

    public function enable(): void
    {
        $this->forceFill([
            'enabled' => true,
        ])->save();
    }

    public function disable(): void
    {
        $this->forceFill([
            'enabled' => false,
        ])->save();
    }
}
