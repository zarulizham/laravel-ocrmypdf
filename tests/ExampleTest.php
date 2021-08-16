<?php

namespace ZarulIzham\OcrMyPdf\Tests;

use ZarulIzham\OcrMyPdf\Facade\OcrMyPdf;

class ExampleTest extends TestCase
{
    /** @test */
    public function convert_pdf()
    {
        try {
            OcrMyPdf::input(__DIR__.'/storage/panic.pdf')
                ->output(__DIR__.'/storage/converted/panic.pdf')
                ->redoOcr()
                ->begin();
            $this->assertTrue(true);
        } catch (\Throwable $th) {
            $this->assertTrue(false);
        }
    }
}
