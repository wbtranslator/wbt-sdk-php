<?php

namespace WebTranslator\Resources;

use WebTranslator\Interfaces\RequestInterface;
use WebTranslator\Collection;

/**
 * Class ResourceAbstract
 *
 * @package WebTranslator
 */
abstract class ResourceAbstract
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
     * @param string $endpoint
     * @param array $args
     * @return Collection
     */
    public function byCriteria($endpoint, array $args = [])
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