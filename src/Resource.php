<?php

namespace WebTranslator;

use WebTranslator\Interfaces\RequestInterface;
use WebTranslator\Interfaces\ResourceInterface;

/**
 * Class Resource
 *
 * @package WebTranslator
 */
class Resource implements ResourceInterface
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

    /**
     * @param Collection $resources
     * @return bool
     */
    public function create(Collection $resources): bool
    {
        return true;
    }

    /**
     * @param string $endpoint
     * @param array $args
     * @return Collection
     */
    public function byCriteria($endpoint, array $args = []): Collection
    {
        $data = $this->request->send($endpoint, 'GET', ['query' => $args]);

        return $this->transformResponse($data);
    }

    /**
     * @param $data
     * @return Collection
     */
    protected function transformResponse($data): Collection
    {
        $collection = new Collection();
        $collection->add($data);

        return $collection;
    }
}
