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
                $translation = new Translation();
                $translation->setAbstractName($val->abstract_name);
                $translation->setOriginalValue($val->original_value);
                $translation->setComment($val->comment);
                $translation->addGroup(new Group($val->group));

                $collections[] = $translation;
            }
        }

        return new Collection(empty($collections) ? [] : $collections);
    }

    public function byGroup(GroupInterface $group): Collection
    {
    }

    public function all(): Collection
    {
        $collection = new Collection();

        $response = $this->getClient()->get('translations');
        $data = json_decode($response->getBody());

        if (!empty($data->data)) {
            foreach ($data->data as $val) {
                if (!empty($val->translations)) {
                    foreach ($val->translations as $v) {
                        $translation = new Translation();
                        $translation->setAbstractName($val->abstract_name);
                        $translation->setOriginalValue($val->original_value);
                        $translation->addGroup(new Group($val->group));
                        $translation->setComment($v->comment);
                        $translation->setLanguage($v->language);
                        $translation->setTranslation($v->value);

                        $collection->add($translation);
                    }
                }
            }
        }

        return $collection;
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
}