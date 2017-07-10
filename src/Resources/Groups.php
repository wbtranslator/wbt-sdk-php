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
     * @param Collection $groups
     * @return bool
     */
    public function create(Collection $groups): bool
    {
        $params = [];

        foreach ($groups as $group) {
            $params[] = [
                'name' => $group->getName()
            ];
        }

        $data = $this->request->send('groups/create', 'POST', [
            'form_params' => ['data' => $params]
        ]);

        return empty($data->count) ? false : true;
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
