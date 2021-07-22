<?php

use Illuminate\Http\Client\RequestException;
use Illuminate\Validation\ValidationException;
use JustSteveKing\Laravel\ERP\Actions\ValidateModuleName;
use Symfony\Component\HttpFoundation\Response;

it('throws an InvalidArgumentException if the module name is found to be invalid locally', function(string $moduleName) {
    ValidateModuleName::handle(module: $moduleName);
})
    ->throws(ValidationException::class)
    ->with('failable-modules');

it('throws a RequestException if module not found on packagist.', function ($moduleName) {
    packagistFake(
        status: Response::HTTP_NOT_FOUND,
    );
    ValidateModuleName::handle(module: $moduleName);

})->throws(RequestException::class)->with([
    ['juststeveking/i-didnt-write-this']
]);

it('throws an InvalidArgumentException if the package exists but it isnt an ERP package')
    ->packagistFake(
        body: getFixture(
            name: 'laravel',
        ),
    )->tap(
        fn() => ValidateModuleName::handle(module: 'laravel/laravel')
    )->throws(
        InvalidArgumentException::class,
        'Module [laravel/laravel] is not a supported laravel-erp package.'
    );
