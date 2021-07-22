<?php

use JustSteveKing\Laravel\ERP\Actions\InstallComposerPackage;
use Symfony\Component\Process\Process;
use Mockery as m;

it('actually calls composer', function() {
    $mock = m::mock(Process::class);
    $mock->shouldReceive('mustRun')->once();

    (new InstallComposerPackage(
        process: $mock,
    ))->handle(
        module: 'foobar',
    );
});
