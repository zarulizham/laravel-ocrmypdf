<?php

namespace ZarulIzham\OCRmyPDF;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use ZarulIzham\OCRmyPDF\Commands\OcrMyPdfCommand;

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
            ->hasViews()
            ->hasMigration('create_laravel-ocrmypdf_table')
            ->hasCommand(OcrMyPdfCommand::class);
    }
}
