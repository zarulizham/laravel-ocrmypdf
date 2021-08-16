<?php

namespace ZarulIzham\OCRmyPDF;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class OCRmyPDF
{
    protected $source;
    protected $destination;
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

    public function output($destination)
    {
        $this->destination = $destination;

        return $this;
    }

    public function begin()
    {
        try {
            $options = join(' ', $this->options);
            $cmd = config('ocrmypdf.path') . " $options {$this->source} {$this->destination}";
            $process = Process::fromShellCommandline($cmd);
            $process->run();

            if (! $process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            return $process->getOutput();
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
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
