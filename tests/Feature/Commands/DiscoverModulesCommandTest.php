<?php

use Orchestra\Testbench\TestCase;

uses(TestCase::class);

it('can discover installed modules using the package manifest', function () {
    $this->artisan('module:discover');
});
