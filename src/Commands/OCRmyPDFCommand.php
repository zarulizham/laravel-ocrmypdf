<?php

namespace ZarulIzham\OCRmyPDF\Commands;

use Illuminate\Console\Command;

class OCRmyPDFCommand extends Command
{
    public $signature = 'laravel-ocrmypdf';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
