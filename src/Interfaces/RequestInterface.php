<?php

namespace WebTranslator\Interfaces;

/**
 * Interface RequestInterface
 *
 * @package WebTranslator
 */
interface RequestInterface
{
    /**
     * @param $endpoint
     * @param string $method
     * @param array $options
     * @return mixed
     */
    public function send($endpoint, $method = 'GET', array $options = []);
}