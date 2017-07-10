<?php
/**
 * Created by PhpStorm.
 * User: future
 * Date: 05.07.17
 * Time: 21:53
 */

namespace Translator\Interfaces;

use Psr\Http\Message\ResponseInterface;

/**
 * Interface HttpClientInterface
 * @package Translator\Interfaces
 */
interface HttpClientInterface
{
    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return ResponseInterface
     */
    public function request($method, $uri = '', array $options = []);
}
