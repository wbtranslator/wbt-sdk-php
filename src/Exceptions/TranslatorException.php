<?php

namespace Translator\Exceptions;

use Throwable;

/**
 * Class TranslatorException
 * @package Translator
 */
class TranslatorException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = is_array($message) ? $message[key($message)][0] : $message;

        parent::__construct($message, $code, $previous);
    }
}