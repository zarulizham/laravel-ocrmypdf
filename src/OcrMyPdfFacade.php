<?php

namespace ZarulIzham\OcrMyPdf;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ZarulIzham\OcrMyPdf\OcrMyPdf
 */
class OcrMyPdfFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-ocrmypdf';
    }
}
