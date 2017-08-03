<?php
declare(strict_types=1);

namespace WBTranslator\Resources;

use WBTranslator\Group;
use WBTranslator\Interfaces\ResourceInterface;
use WBTranslator\Resource;
use WBTranslator\Collection;

/**
 * Class Group
 *
 * @package WBTranslator
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
            $params[] = $group->toArray();
        }

        $data = $this->request->send('groups/create', 'POST', [
            'form_params' => ['data' => $params]
        ]);

        return $this->transformResponse((array) $data);
    }

    /**
     * @inheritdoc
     */
    protected function transformResponse($data): Collection
    {
        return $this->addGroups($data);
    }
    
    /**
     * @param array $data
     * @return Collection
     */
    protected function addGroups(array $data): Collection
    {
        $collection = new Collection();
    
        foreach ($data as $group) {
            $collection->add($this->addGroup((array) $group));
        }
    
        return $collection;
    }
    
    /**
     * @param array $data
     * @return Group
     */
    protected function addGroup(array $data)
    {
        $group = new Group();
        $group->setId($data['id']);
        $group->setName($data['name']);
        
        if (!empty($data['description'])) {
            $group->setDescription($data['description']);
        }
    
        if (!empty($data['children'])) {
            $children = $this->addGroups((array) $data['children']);
            $group->addChildren($children);
        }
        
        return $group;
    }
}
