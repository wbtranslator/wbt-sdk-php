<?php
declare(strict_types=1);

namespace WBTranslator\Resources;

use WBTranslator\Interfaces\ResourceInterface;
use WBTranslator\Resource;
use WBTranslator\Collection;

/**
 * Class Languages
 *
 * @package WBTranslator
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
        
        if (!empty($data['languages'])) {
            foreach ($data['languages'] as $value) {
                $collection->add($value['code']);
            }
        }

        return $collection;
    }
}
