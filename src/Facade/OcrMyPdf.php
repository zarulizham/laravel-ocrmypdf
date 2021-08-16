<?php

namespace ZarulIzham\OcrMyPdf\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ZarulIzham\OcrMyPdf\OcrMyPdf
 */
class OcrMyPdf extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-ocrmypdf';
    }
}
