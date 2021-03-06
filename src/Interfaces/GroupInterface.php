<?php
declare(strict_types=1);

namespace WBTranslator\Sdk\Interfaces;

use WBTranslator\Sdk\Collection;

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
     * @return bool
     */
    public function hasParent(): bool;
    
    /**
     * @param GroupInterface|null $group
     *
     * @return array
     */
    public function toArray(GroupInterface $group = null): array;
}
