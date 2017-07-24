<?php

namespace WebTranslator\Resources;

use WebTranslator\Interfaces\ResourceInterface;
use WebTranslator\Resource;
use WebTranslator\Collection;

/**
 * Class Languages
 *
 * @package WebTranslator
 */
class Languages extends Resource implements ResourceInterface
{
    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->byCriteria('/');
    }
    
    /**
     * @inheritdoc
     */
    protected function transformResponse($data): Collection
    {
        $collection = new Collection();
        
        if (!empty($data->languages)) {
            foreach ($data->languages as $value) {
                $collection->add($value->code);
            }
        }

        return $collection;
    }
}
