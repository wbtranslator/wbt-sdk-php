<?php
declare(strict_types=1);

namespace WBTranslator\Resources;

use WBTranslator\{
    Collection, Exceptions\WBTranslatorException, Group, Interfaces\GroupInterface, Translation
};
use WBTranslator\Interfaces\ResourceInterface;
use WBTranslator\Resource;

/**
 * Class Translations
 *
 * @package WBTranslator
 */
class Translations extends Resource implements ResourceInterface
{
    /**
     * @var string
     */
    protected $endpoint = 'translations';

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->byCriteria($this->endpoint);
    }

    /**
     * @param $language
     * @return Collection
     */
    public function byLanguage($language): Collection
    {
        return $this->byCriteria($this->endpoint, ['language_code' => $language]);
    }
    
    /**
     * @param GroupInterface $group
     *
     * @return Collection
     * @throws WBTranslatorException
     */
    public function byGroup(GroupInterface $group): Collection
    {
        if ($group->getId()) {
            $where['group_id'] = $group->getId();
        } elseif ($group->getName()) {
            $where['group_name'] = $group->getName();
        } else {
            throw new WBTranslatorException('The group may not be empty!');
        }
        
        return $this->byCriteria($this->endpoint, $where);
    }

    /**
     * @param $abstractName
     * @param $language
     * @param $group
     * @return string
     */
    public function one($abstractName, $language, $group = null): string
    {
        $data = $this->byCriteria($this->endpoint, [
            'abstract_name' => $abstractName,
            'language_code' => $language,
            'group_name' => $group,
        ]);

        return !empty($data->first()) ? $data->first()->getTranslation() : '';
    }

    /**
     * Create Project abstractions
     *
     * @inheritdoc
     */
    public function create(Collection $translations): Collection
    {
        $params = [];

        foreach ($translations as $translation) {
            
            $row = [
                'name' => $translation->getAbstractName(),
                'value' => $translation->getOriginalValue(),
                'comment' => $translation->getComment(),
            ];
            
            if ($translation->hasGroup()) {
                $row['group'] = $translation->getGroup()->toArray();
            }
    
            $params[] = $row;
        }

        $data = $this->request->send('abstractions/create', 'POST', [
            'form_params' => ['data' => $params]
        ]);

        return new Collection($data);
    }

    /**
     * @inheritdoc
     */
    protected function transformResponse($data): Collection
    {
        $collection = new Collection();

        foreach ($data as $abstraction) {
            if (!empty($abstraction['translations'])) {
                foreach ($abstraction['translations'] as $translate) {
                    $translation = new Translation();
                    $translation->setAbstractName($abstraction['abstract_name'])
                        ->setOriginalValue($abstraction['original_value'])
                        ->setLanguage($translate['language'])
                        ->setTranslation($translate['value']);

                    if (isset($abstraction['group'])) {
                        $group = new Group();
                        $group->setFromArray((array) $abstraction['group']);
                        $translation->addGroup($group);
                    }
    
                    if (isset($abstraction['comment'])) {
                        $translation->setComment($abstraction['comment']);
                    }
                    
                    $collection->add($translation);
                }
            }
        }

        return $collection;
    }
}
