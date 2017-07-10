<?php

namespace Translator\Resources;

use Translator\Collection;
use Translator\Group;

/**
 * Class Group
 *
 * @package Translator
 */
class Groups extends ResourceAbstract
{
    /**
     * @return Collection
     */
    public function all(): Collection
    {
        $data = $this->request->send('groups');

        return $this->transformGroupResponse($data);
    }

    /**
     * @param $data
     * @return Collection
     */
    protected function transformGroupResponse($data): Collection
    {
        $collection = new Collection();

        foreach ($data as $group) {
            $collection->add(new Group($group->name));
        }

        return $collection;
    }
}
