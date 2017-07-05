<?php
/**
 * Created by PhpStorm.
 * User: future
 * Date: 05.07.17
 * Time: 22:04
 */

namespace Translator;

use Doctrine\Common\Collections\Collection;
use Translator\Interfaces\CriteriaInterface;
use Translator\Interfaces\HttpClientInterface;
use Translator\Interfaces\TranslationInterface;
use Translator\Interfaces\TranslatorInterface;

/**
 * Class WebTranslator
 * @package Translator
 */
class WebTranslator implements TranslatorInterface
{
    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    /**
     * TranslatorManager constructor.
     *
     * @param $httpClient
     */
    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param CriteriaInterface|null $criteria
     * @return Collection
     */
    public function byCriteria(CriteriaInterface $criteria = null)
    {
        // TODO: Implement byCriteria() method.
    }

    /**
     * @param string $language
     * @return Collection|TranslationInterface[]
     */
    public function byLanguage($language)
    {
        return $this->byCriteria(new Criteria($language));
    }

    /**
     * @param string $group
     * @return Collection|TranslationInterface[]
     */
    public function byGroup($group)
    {
        return $this->byCriteria(new Criteria(null, $group));
    }

    /**
     * @param string $abstractName
     * @param string $language
     * @param string $group
     * @return string|null
     */
    public function one($abstractName, $language, $group)
    {
        return $this->byCriteria(new Criteria($language, $group, $abstractName))->first();
    }

    /**
     * @return Collection|TranslationInterface[]
     */
    public function all()
    {
        return $this->byCriteria();
    }
}
