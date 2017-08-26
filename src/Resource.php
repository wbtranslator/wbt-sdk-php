<?php
declare(strict_types=1);

namespace WBTranslator\Sdk;

use WBTranslator\Sdk\Interfaces\RequestInterface;
use WBTranslator\Sdk\Interfaces\ResourceInterface;

/**
 * Class Resource
 *
 * @package WBTranslator
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
     * @return Collection
     */
    public function create(Collection $resources): Collection
    {
        return new Collection($resources);
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
        return new Collection([$data]);
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public static function normalizeMultipartParams(array $data): array
    {
        $output = [];

        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $output[] = ['name' => $key, 'contents' => $value];
                continue;
            }

            foreach($value as $multiKey => $multiValue) {
                $multiName = $key . '[' .$multiKey . ']' . (is_array($multiValue) ? '[' . key($multiValue) . ']' : '' ) . '';
                $output[] = ['name' => $multiName, 'contents' => (is_array($multiValue) ? reset($multiValue) : $multiValue)];
            }
        }

        return $output;
    }
}
