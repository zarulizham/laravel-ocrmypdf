<?php

namespace ZarulIzham\OCRmyPDF\Tests;

use ZarulIzham\OCRmyPDF\Facade\OCRmyPDF;

class ExampleTest extends TestCase
{
    /** @test */
    public function convert_pdf()
    {
        try {
            OCRmyPDF::input(__DIR__.'/storage/panic.pdf')
                ->output(__DIR__.'/storage/converted/panic.pdf')
                ->redoOcr()
                ->begin();
            $this->assertTrue(true);
        } catch (\Throwable $th) {
            $this->assertTrue(false);
        }
    }
}
