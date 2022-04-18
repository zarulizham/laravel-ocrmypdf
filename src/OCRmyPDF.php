<?php

namespace ZarulIzham\OCRmyPDF;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class OCRmyPDF
{
    protected $source;
    protected $isBinary;
    protected $destination;
    protected $processOutput;
    protected $options = [];

    public function echo()
    {
        return "OK";
    }

    public function input($source)
    {
        if (! file_exists($source)) {
            throw new \Exception("Source PDF not found.");
        } else {
            $this->source = $source;

            return $this;
        }
    }

    public function binary($binary, $disk = 'local')
    {
        $this->isBinary = true;
        $path = Str::uuid() . '.pdf';
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
        try {
            $options = join(' ', $this->options);
            $cmd = config('ocrmypdf.path') . " $options {$this->source} {$this->destination}";
            $process = Process::fromShellCommandline($cmd);
            // $process = \Symfony\Component\Process\Process::fromShellCommandline('cd /Users/zarul.zubir/Documents/laravel/prodoc/ && /usr/local/bin/ocrmypdf "/Users/zarul.zubir/Documents/laravel/prodoc/storage/app/temp/05ea9f57-a51d-4c0f-bbf1-4911d7cbcc81.pdf" "/Users/zarul.zubir/Documents/laravel/prodoc/storage/app/temp/ocrmypdf/3bc67439-e23d-4315-9880-182fa1087b13.pdf"');
            // $process = new Process(['ocrmypdf', "/Users/zarul.zubir/Documents/laravel/prodoc/storage/app/temp/05ea9f57-a51d-4c0f-bbf1-4911d7cbcc81.pdf", "Users/zarul.zubir/Documents/laravel/prodoc/storage/app/temp/ocrmypdf/3bc67439-e23d-4315-9880-182fa1087b13.pdf"]);
            $process->mustRun();

            if (! $process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            if ($this->isBinary) {
                unlink($this->source);
            }
            $this->processOutput = $process->getOutput();
            // dd($process->getOutput());
            return true;
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());

            return false;
        }
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
