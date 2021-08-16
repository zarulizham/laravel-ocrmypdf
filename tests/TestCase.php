<?php

namespace ZarulIzham\OCRmyPDF\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use ZarulIzham\OCRmyPDF\OCRmyPDF;
use ZarulIzham\OCRmyPDF\OCRmyPDFServiceProvider;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        // Factory::guessFactoryNamesUsing(
        //     fn (string $modelName) => 'ZarulIzham\\OCRmyPDF\\Database\\Factories\\'.class_basename($modelName).'Factory'
        // );
    }

    protected function getPackageProviders($app)
    {
        app()->bind('laravel-ocrmypdf', function () { // not a service provider but the target of service provider
            return new OCRmyPDF();
        });

        return [
            OCRmyPDFServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        include_once __DIR__.'/../database/migrations/create_laravel-ocrmypdf_table.php.stub';
        (new \CreatePackageTable())->up();
        */
    }
}
