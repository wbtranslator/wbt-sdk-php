<?php
declare(strict_types=1);

namespace WBTranslator\Sdk\Resources;

use WBTranslator\Sdk\{
    Collection, Request, Resource,
    Interfaces\GroupInterface,
    Interfaces\ResourceInterface
};

/**
 * Class Abstractions
 *
 * @package WBTranslator
 */
class Abstractions extends Resource implements ResourceInterface
{
    /**
     * @var string
     */
    protected $endpoint = 'abstractions';

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

        $data = $this->request->send($this->endpoint . '/create', 'POST', [
            'form_params' => ['data' => $params]
        ]);

        return new Collection($data);
    }

    /**
     * Upload Project abstractions from lang files
     *
     * @param Collection $files
     *
     * @return Collection
     */
    public function upload(Collection $files): Collection
    {
        $collection = new Collection();

        foreach ($files as $row) {
            $params = [
                'file' => fopen($row['filename'], 'r'),
                'format' => $row['format'],
            ];

            if (!empty($row['group']) && $row['group'] instanceof GroupInterface) {
                $params['group'] = $row['group']->toArray();
            }

            $result = $this->request->send($this->endpoint . '/upload', 'POST', [
                'multipart' => Request::normalizeMultipartParams($params)
            ]);

            $collection->add($result);
        }

        return $collection;
    }
}
