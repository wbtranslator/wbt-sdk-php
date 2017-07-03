<?php

namespace Translator;

use Translator\Group\GroupInterface;
use Translator\Translator\TranslatorInterface;

class Translator extends BaseAbstract implements TranslatorInterface
{
    public function one($abstractName, $language, GroupInterface $group = null): string
    {
    }

    public function byLanguage($language): Collection
    {
        $response = $this->getClient()->get('translations', ['query' => [
            'language_code' => $language,
        ]]);
        $data = json_decode($response->getBody());

        if (!empty($data->data)) {
            foreach ($data->data as $val) {
                if (!empty($val->translations)) {
                    foreach ($val->translations as $v) {
                        $collections[] = $this->transformTranslation($val, $v);
                    }
                }
            }
        }

        return new Collection(empty($collections) ? [] : $collections);
    }

    public function byGroup(GroupInterface $group): Collection
    {
        $response = $this->getClient()->get('translations', ['query' => [
            'group_name' => $group->getName(),
        ]]);
        $data = json_decode($response->getBody());

        if (!empty($data->data)) {
            foreach ($data->data as $val) {
                if (!empty($val->translations)) {
                    foreach ($val->translations as $v) {
                        $collections[] = $this->transformTranslation($val, $v);
                    }
                }
            }
        }

        return new Collection(empty($collections) ? [] : $collections);
    }

    public function all(): Collection
    {
        $response = $this->getClient()->get('translations');
        $data = json_decode($response->getBody());

        if (!empty($data->data)) {
            foreach ($data->data as $val) {
                if (!empty($val->translations)) {
                    foreach ($val->translations as $v) {
                        $collections[] = $this->transformTranslation($val, $v);
                    }
                }
            }
        }

        return new Collection(empty($collections) ? [] : $collections);
    }

    public function send(Collection $translations)
    {
        $params = [];

        foreach ($translations as $translation) {
            $params[] = [
                'name' => $translation->getAbstractName(),
                'value' => $translation->getOriginalValue(),
                'comment' => $translation->getComment(),
                'group_name' => $translation->getGroup() ? $translation->getGroup()->getName() : null,
            ];
        }

        $response = $this->getClient()->post('tasks/create', [
            'form_params' => ['data' => $params]
        ]);

        $data = json_decode($response->getBody());

        return !empty($data->data->count) ? (int) $data->data->count : 0;
    }

    protected function transformTranslation($abstract, $translation)
    {
        return (new Translation())
            ->setAbstractName($abstract->abstract_name)
            ->setOriginalValue($abstract->original_value)
            ->addGroup(new Group($abstract->group))
            ->setComment($translation->comment)
            ->setLanguage($translation->language)
            ->setTranslation($translation->value);
    }
}