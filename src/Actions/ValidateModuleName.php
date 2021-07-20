<?php

declare(strict_types=1);

namespace JustSteveKing\Laravel\ERP\Actions;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use InvalidArgumentException;
use JustSteveKing\Laravel\ERP\DataTransferObjects\Package;

class ValidateModuleName
{
    /**
     * @throws RequestException|ValidationException
     */
    public static function handle(string $module): void
    {
        Validator::make(['name' => $module], [
            'name' => [
                'string',
                'regex:/^[-\w]+\/[-\w]+$/'
            ]
        ])->validate();


        $response = Http::acceptJson()->get(
            url: "https://repo.packagist.org/p2/{$module}.json"
        );

        if ($response->failed()) {
            throw $response->toException();
        }

        $package = $response->collect(
            key: "packages.{$module}",
        )->first();

        if (! isset($package['extra']['laravel-erp'])) {
            throw new InvalidArgumentException(
                message: "Module [$module] is not a supported laravel-erp package."
            );
        }
    }
}
