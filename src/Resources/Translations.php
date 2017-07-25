<?php

namespace WebTranslator\Resources;

use WebTranslator\{
    Collection, Translation
};
use WebTranslator\Interfaces\ResourceInterface;
use WebTranslator\Resource;

/**
 * Class Translations
 *
 * @package WebTranslator
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
     * @param $group
     * @return Collection
     */
    public function byGroup($group): Collection
    {
        return $this->byCriteria($this->endpoint, ['group_name' => $group]);
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
            $params[] = [
                'name' => $translation->getAbstractName(),
                'value' => $translation->getOriginalValue(),
                'comment' => $translation->getComment(),
                'group_name' => $translation->getGroup(),
            ];
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
            if (!empty($abstraction->translations)) {
                foreach ($abstraction->translations as $translate) {
                    $translation = new Translation();
                    $translation->setAbstractName($abstraction->abstract_name)
                        ->setOriginalValue($abstraction->original_value)
                        ->setLanguage($translate->language)
                        ->setTranslation($translate->value);

                    if (isset($abstraction->group)) {
                        $translation->addGroup($abstraction->group);
                    }
    
                    if (isset($abstraction->comment)) {
                        $translation->setComment($abstraction->comment);
                    }
                    
                    $collection->add($translation);
                }
            }
        }

        return $collection;
    }
}
