<?php

namespace Translator\Exceptions;

use Throwable;

/**
 * Class TranslatorException
 *
 * @package Translator
 */
class TranslatorException extends \Exception
{
    /**
     * TranslatorException constructor.
     * @param string|array $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = is_array($message) ? !empty($message[key($message)][0])
            ? $message[key($message)][0] : '' : $message;

        parent::__construct($message, $code, $previous);
    }
}
