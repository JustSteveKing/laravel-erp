<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
use JustSteveKing\Laravel\ERP\Commands\DiscoverModulesCommand;
use JustSteveKing\Laravel\ERP\Models\Module;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

uses(TestCase::class)->in('Unit');
uses(
    \JustSteveKing\Laravel\ERP\Tests\TestCase::class,
    RefreshDatabase::class,
)->in('Feature');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/


/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/
function createModuleWithName(string $name): Module
{
    return Module::create([
        'name' => $name
    ]);
}

function packagistFake(null|string $body = null, int $status = Response::HTTP_OK)
{
    Http::fake([
        'https://repo.packagist.org/*' => Http::response(
            body: $body,
            status: $status,
        ),
    ]);

    return test();
}

function getFixture(string $name): string
{
    return file_get_contents(
        __DIR__ . "/Fixtures/{$name}.json",
    );
}

function runDiscoverCommand()
{
    Artisan::call(
        command: DiscoverModulesCommand::class,
    );

    return test();
}
