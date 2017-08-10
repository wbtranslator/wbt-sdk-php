<?php
declare(strict_types=1);

namespace WBTranslator\Sdk;

use WBTranslator\Sdk\Interfaces\ConfigInterface;

/**
 * Class Locales
 *
 * @package WBTranslator
 */
class Locales
{
    /**
     * @var ConfigInterface
     */
    protected $config;
    
    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
    }
}
