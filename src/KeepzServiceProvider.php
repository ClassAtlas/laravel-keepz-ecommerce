<?php

namespace ClassAtlas\KeepzEcommerce;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class KeepzServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('KeepzEcommerce')
            ->hasConfigFile('keepz-ecommerce');
    }
}
