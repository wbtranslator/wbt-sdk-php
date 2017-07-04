<?php

namespace Translator;

use Translator\Group\GroupInterface;
use Translator\Translator\TranslatorInterface;

class Translator extends BaseAbstract implements TranslatorInterface
{
    public function one($abstractName, $language, GroupInterface $group = null): string
    {
        $response = $this->getClient()->get('translations', ['query' => [
            'abstract_name' => $abstractName,
            'language_code' => $language,
            'group_name' => empty($group) ? null : $group->getName(),
        ]]);

        if ($response) {
            $data = json_decode($response->getBody(), true);
        }

        return !empty($data['data'][0]['translations'][0]['value']) ?
            $data['data'][0]['translations'][0]['value'] : '';
    }

    public function byLanguage($language): Collection
    {
        $response = $this->getClient()->get('translations', ['query' => [
            'language_code' => $language,
        ]]);

        if ($response) {
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
        }

        return new Collection(empty($collections) ? [] : $collections);
    }

    public function byGroup(GroupInterface $group): Collection
    {
        $response = $this->getClient()->get('translations', ['query' => [
            'group_name' => $group->getName(),
        ]]);

        if ($response) {
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
        }

        return new Collection(empty($collections) ? [] : $collections);
    }

    public function all(): Collection
    {
        $response = $this->getClient()->get('translations');

        if ($response) {
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
        }

        return new Collection(empty($collections) ? [] : $collections);
    }

    public function send(Collection $translations): bool
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

        $response = $this->getClient()->post('abstractions/create', [
            'form_params' => ['data' => $params]
        ]);

        if ($response) {
            $data = json_decode($response->getBody());
            return empty($data->data->count) ? false : true;
        }

        return false;
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