<?php

namespace Translator;

use Translator\Collection\CollectionInterface;
use Translator\Group\GroupInterface;
use Translator\Translator\TranslatorInterface;

class Translator extends BaseAbstract implements TranslatorInterface
{
    public function one($abstractName, $language, GroupInterface $group = null): string
    {
    }

    public function byLanguage($language): CollectionInterface
    {
        $collection = new Collection();

        $response = $this->getClient()->get('translations/87', ['query' => [
            'api_key' => $this->getApiKey(),
            'language_code' => $language,
        ]]);
        $data = json_decode($response->getBody());

        if (!empty($data->data->data)) {
            foreach ($data->data->data as $val) {
                $translation = new Translation();
                $translation->setAbstractName($val->name);
                $translation->setOriginalValue($val->value);

                $collection->add($translation);
            }
        }

        return $collection;
    }

    public function byGroup(GroupInterface $group): CollectionInterface
    {
    }

    public function all(): CollectionInterface
    {
    }

    public function send(CollectionInterface $translations)
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
            'query' => ['api_key' => $this->getApiKey()],
            'form_params' => ['data' => $params]
        ]);

        $data = json_decode($response->getBody());

        return !empty($data->data->count) ? (int) $data->data->count : 0;
    }
}