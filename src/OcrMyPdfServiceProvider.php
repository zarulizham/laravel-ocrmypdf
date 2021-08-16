<?php

namespace ZarulIzham\OcrMyPdf;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use ZarulIzham\OcrMyPdf\Commands\OcrMyPdfCommand;

class OcrMyPdfServiceProvider extends PackageServiceProvider
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
            ->hasConfigFile();
    }
}
