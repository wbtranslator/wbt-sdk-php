<?php

namespace Translator\Resources;

use Translator\Collection;
use Translator\Translation;
use Translator\Group;

/**
 * Class Translations
 *
 * @package Translator
 */
class Translations extends ResourceAbstract
{
    /**
     * @return Collection
     */
    public function all(): Collection
    {
        $data = $this->request->send('translations');

        return $this->transformTranslationResponse($data);
    }

    /**
     * @param $language
     * @return Collection
     */
    public function byLanguage($language): Collection
    {
        $data = $this->request->send('translations', 'GET', ['query' => [
            'language_code' => $language,
        ]]);

        return $this->transformTranslationResponse($data);
    }

    /**
     * @param $abstractName
     * @param $language
     * @param Group|null  $group
     * @return string
     */
    public function one($abstractName, $language, Group $group = null): string
    {
        $data = $this->request->send('translations', 'GET', ['query' => [
            'abstract_name' => $abstractName,
            'language_code' => $language,
            'group_name' => $group ? $group->getName() : null,
        ]]);

        $data = $this->transformTranslationResponse($data);

        return !empty($data->first()) ? $data->first()->getTranslation() : '';
    }

    /**
     * @param Group $group
     * @return Collection
     */
    public function byGroup(Group $group): Collection
    {
        $data = $this->request->send('translations', 'GET', ['query' => [
            'group_name' => $group->getName(),
        ]]);

        return $this->transformTranslationResponse($data);
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
    protected function transformTranslationResponse($data): Collection
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
