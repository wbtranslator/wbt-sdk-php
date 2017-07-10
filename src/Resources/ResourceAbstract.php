<?php

namespace WebTranslator\Resources;

use WebTranslator\Interfaces\RequestInterface;

/**
 * Class ResourceAbstract
 *
 * @package WebTranslator
 */
abstract class ResourceAbstract
{
    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * Translations constructor.
     *
     * @param RequestInterface $request
     */
    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }
}