<?php

namespace ZarulIzham\OCRmyPDF;

use Spatie\LaravelPackageTools\Package;
use ZarulIzham\OCRmyPDF\Commands\OCRmyPDFCommand;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class OCRmyPDFServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-ocrmypdf')
            ->hasConfigFile()
            ->hasCommand(OCRmyPDFCommand::class);
    }
}
