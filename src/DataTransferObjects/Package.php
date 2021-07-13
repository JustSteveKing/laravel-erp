<?php

declare(strict_types=1);

namespace JustSteveKing\Laravel\ERP\DataTransferObjects;

class Package
{
    public function __construct(
        public string $name,
        public string $version,
    ) {}
}
