<?php

namespace WBTranslator\Exceptions;

use Throwable;

/**
 * Class TranslatorException
 *
 * @package WBTranslator
 */
class WBTranslatorException extends \Exception
{
    /**
     * TranslatorException constructor.
     *
     * @param string|array $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = is_object($message) ? (array) $message : $message;

        $message = is_array($message) ? !empty($message[key($message)][0])
            ? $message[key($message)][0] : '' : $message;

        parent::__construct($message, $code, $previous);
    }
}
