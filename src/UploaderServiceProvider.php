<?php

namespace PinPon\Uploader;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use PinPon\Uploader\Commands\UploaderCommand;

class UploaderServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('simple-uploader')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_simple-uploader_table')
            ->hasCommand(UploaderCommand::class);
    }
}
