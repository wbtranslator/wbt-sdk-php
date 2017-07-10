<?php

namespace WebTranslator\Resources;

use WebTranslator\Collection;
use WebTranslator\Group;

/**
 * Class Group
 *
 * @package WebTranslator
 */
class Groups extends ResourceAbstract
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
