<?php

namespace ZarulIzham\OCRmyPDF;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Storage;
use ZarulIzham\OCRmyPDF\Exceptions\TaggedPDFException;

class OCRmyPDF
{
    protected $source;

    protected $isBinary;

    protected $destination;

    protected $processOutput;

    protected $options = [];

    public function echo()
    {
        return 'OK';
    }

    public function input($source)
    {
        if (! file_exists($source)) {
            throw new \Exception('Source PDF not found.');
        } else {
            $this->source = $source;

            return $this;
        }
    }

    public function binary($binary, $disk = 'local')
    {
        $this->isBinary = true;
        $path = Str::uuid().'.pdf';
        Storage::disk($disk)->put($path, $binary);
        $this->source = Storage::disk($disk)->path($path);

        return $this;
    }

    public function output($destination)
    {
        $this->destination = $destination;

        try {
            File::makeDirectory(pathinfo($this->destination, PATHINFO_DIRNAME), 0755, true);
        } catch (\Throwable $th) {
        }

        return $this;
    }

    public function processOutput()
    {
        return $this->processOutput;
    }

    public function begin()
    {
        $options = implode(' ', $this->options);

        $cmd = config('ocrmypdf.path')." $options {$this->source} {$this->destination}";

        $process = Process::forever()->run($cmd);

        if (! $process->successful()) {
            $errorOutput = trim(preg_replace('/\s+/', ' ', $process->errorOutput()));
            if (Str::contains($errorOutput, 'TaggedPDFError', true)) {
                throw new TaggedPDFException($errorOutput);
            }
            throw new \Exception($errorOutput);
        }

        return $process->output();
    }

    public function setOptions(string $options)
    {
        $this->options = [$options];

        return $this;
    }

    public function addOption(string $options)
    {
        $this->options[] = $options;

        return $this;
    }

    public function redoOcr()
    {
        $this->addOption('--redo-ocr');

        return $this;
    }
}
