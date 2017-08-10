<?php
declare(strict_types=1);

namespace WBTranslator\Sdk\Interfaces;

use WBTranslator\Sdk\Collection;

/**
 * Interface ResourceInterface
 *
 * @package WBTranslator
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
     * @param Collection $resources Create resource
     * @return Collection
     */
    public function create(Collection $resources): Collection;
}
