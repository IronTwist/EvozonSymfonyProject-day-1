<?php


namespace App\Exceptions;


class GetWordException extends \Exception
{

    /**
     * GetWordException constructor.
     */
    public function __construct(string $message, $code)
    {
        parent::__construct($message, $code);
    }
}