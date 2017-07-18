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
     * @param $data
     * @return Collection
     */
    protected function transformResponse($data): Collection
    {
        $languages = [];
        
        if (!empty($data->languages)) {
            foreach ($data->languages as $value) {
                $languages[] = $value->code;
            }
        }

        return new Collection(array_unique($languages));
    }
}
