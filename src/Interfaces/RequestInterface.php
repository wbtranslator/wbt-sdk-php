<?php
declare(strict_types=1);

namespace WBTranslator\Sdk\Interfaces;

/**
 * Interface RequestInterface
 *
 * @package WBTranslator
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
