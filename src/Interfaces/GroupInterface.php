<?php
declare(strict_types=1);

namespace WBTranslator\Interfaces;

use WBTranslator\Collection;

/**
 * Interface GroupInterface
 *
 * @package WBTranslator
 */
interface GroupInterface
{
    /**
     * @return int
     */
    public function getId(): int;
    
    /**
     * @return string
     */
    public function getName(): string;
    
    /**
     * @return string
     */
    public function getDescription(): string;
    
    /**
     * @return GroupInterface
     */
    public function getParent(): GroupInterface;
    
    /**
     * @return Collection
     */
    public function getChildren(): Collection;
}
