<?php

namespace ZarulIzham\OCRmyPDF\Exceptions;

use Exception;
use Illuminate\Support\Str;

class TaggedPDFException extends Exception {

    public $message;

    public function __construct($message, $code = 0, Exception $previous = null) {
        $this->message = Str::replace('TaggedPDFError:', '', $message);
    }

    public function report()
    {
        return false;
    }
}
