<?php

namespace WebTranslator\Resources;

use WebTranslator\{
    Collection,
    Translation,
    Group
};

/**
 * Class Translations
 *
 * @package WebTranslator
 */
class Translations extends ResourceAbstract
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
     * @param Group $group
     * @return Collection
     */
    public function byGroup(Group $group): Collection
    {
        return $this->byCriteria($this->endpoint, ['group_name' => $group->getName()]);
    }

    /**
     * @param $abstractName
     * @param $language
     * @param Group|null  $group
     * @return string
     */
    public function one($abstractName, $language, Group $group = null): string
    {
        $data = $this->byCriteria($this->endpoint, [
            'abstract_name' => $abstractName,
            'language_code' => $language,
            'group_name' => $group ? $group->getName() : null,
        ]);

        return !empty($data->first()) ? $data->first()->getTranslation() : '';
    }

    /**
     * @param Collection $translations
     * @return bool
     */
    public function send(Collection $translations): bool
    {
        return true;
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
                        ->addGroup(new Group($abstraction->group))
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
