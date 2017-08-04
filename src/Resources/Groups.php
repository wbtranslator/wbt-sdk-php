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

        return $this->transformResponse($data);
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
    
        foreach ($data as $value) {
            $group = new Group();
            $group->setFromArray($value);
            
            $collection->add($group);
        }
    
        return $collection;
    }
}
