<?php

class FileValidationError extends Exception
{
    public function __construct($errorMessage)
    {
        $this->message = $errorMessage;
    }
}