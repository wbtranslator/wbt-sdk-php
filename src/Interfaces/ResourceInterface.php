<?php

namespace WebTranslator\Interfaces;

use WebTranslator\Collection;

/**
 * Interface ResourceInterface
 *
 * @package WebTranslator
 */
interface ResourceInterface
{
    /**
     * @param string $endpoint
     * @param array $args
     * @return Collection
     */
    public function byCriteria($endpoint, array $args = []): Collection;

    /**
     * @param Collection $translations Create resource
     * @return bool
     */
    public function create(Collection $translations): bool;
}