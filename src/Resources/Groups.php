<?php

namespace WebTranslator\Resources;

use WebTranslator\Interfaces\ResourceInterface;
use WebTranslator\Resource;
use WebTranslator\Collection;
use WebTranslator\Group;

/**
 * Class Group
 *
 * @package WebTranslator
 */
class Groups extends Resource implements ResourceInterface
{
    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->byCriteria('groups');
    }

    /**
     * @param $data
     * @return Collection
     */
    protected function transformResponse($data): Collection
    {
        $collection = new Collection();

        foreach ($data as $group) {
            $collection->add(new Group($group->name));
        }

        return $collection;
    }
}
