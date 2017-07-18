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
     * @param Collection $translations Create Project abstractions
     * @return Collection
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
     * @param $data
     * @return Collection
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
                        ->addGroup($abstraction->group)
                        ->setComment($translate->comment)
                        ->setLanguage($translate->language)
                        ->setTranslation($translate->value);

                    $collection->add($translation);
                }
            }
        }

        return $collection;
    }
}
