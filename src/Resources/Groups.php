<?php

namespace WebTranslator\Resources;

use WebTranslator\Interfaces\ResourceInterface;
use WebTranslator\Resource;
use WebTranslator\Collection;

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
     * @inheritdoc
     */
    public function create(Collection $groups): Collection
    {
        $params = [];

        foreach ($groups as $group) {
            $params[] = [
                'name' => $group
            ];
        }

        $data = $this->request->send('groups/create', 'POST', [
            'form_params' => ['data' => $params]
        ]);

        return $this->transformResponse($data);
    }

    /**
     * @inheritdoc
     */
    protected function transformResponse($data): Collection
    {
        $collection = new Collection();

        foreach ($data as $group) {
            $collection->add($group->name);
        }

        return $collection;
    }
}
