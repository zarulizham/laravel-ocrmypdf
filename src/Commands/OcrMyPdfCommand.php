<?php

namespace ZarulIzham\OcrMyPdf\Commands;

use Illuminate\Console\Command;

class OcrMyPdfCommand extends Command
{
    public $signature = 'laravel-ocrmypdf';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
