<?php
declare(strict_types=1);

namespace WBTranslator;

use WBTranslator\Interfaces\ConfigInterface;

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
