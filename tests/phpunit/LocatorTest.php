<?php

namespace WBTranslator\Sdk\Tests\PhpUnit;

use PHPUnit\Framework\TestCase;
use WBTranslator\Sdk\Collection;
use WBTranslator\Sdk\Config;
use WBTranslator\Sdk\Group;
use WBTranslator\Sdk\Locator;
use WBTranslator\Sdk\Tests\Helpers\TestHelpers;
use WBTranslator\Sdk\Translation;

class LocatorTest extends TestCase
{
    protected $group;
    protected $locator;
    protected $config;
    protected $translation;
    protected $collection;
    protected $helper;

    protected function setUp()
    {
        $config = new Config();
        $config->setDelimiter('::');
        $config->setBasePath(__DIR__);
        $config->setLocale('delete');
        $config->setLangPaths([DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'lang']);
        $this->config = $config;

        $this->locator = $locator = new Locator($config);

        $group = new Group();
        $group->setName('awesome::group::file');
        $this->group = $group;

        $translation = new Translation();
        $translation->setAbstractName('super.puper.name');
        $translation->setOriginalValue('original value');
        $translation->setTranslation('translate');
        $translation->setLanguage('delete');
        $translation->addGroup($group);
        $this->translation = $translation;

        $collection = new Collection();
        $collection->add($this->translation);
        $this->collection = $collection;

        $this->helper = new TestHelpers;
    }

    /*
    * Scan
    *
    * ==============================================================================================================
    */

    public function testCreateTranslation()
    {
        $translation = TestHelpers::invokeMethod($this->locator, 'createTranslation', [
            'super.puper.name', 'original value', $this->group
        ]);

        $this->assertEquals('super.puper.name', $translation->getAbstractName());
        $this->assertEquals('original value', $translation->getOriginalValue());
        $this->assertEquals('awesome::group::file', $translation->getGroup()->getName());
    }

    public function testCreateGroup()
    {
        $group = TestHelpers::invokeMethod($this->locator, 'createGroup', [
            $this->config->getLangPaths()[0]
        ]);

        $this->assertEquals('files::lang', $group->getName());
    }

    public function testGetLocalePath()
    {
        $basePath = TestHelpers::invokeMethod($this->locator, 'getLocalePath', [
            $this->config->getLangPaths()[0]
        ]);

        $this->assertEquals(__DIR__ . DIRECTORY_SEPARATOR . "files" . DIRECTORY_SEPARATOR . "lang" .
            DIRECTORY_SEPARATOR . "delete" . DIRECTORY_SEPARATOR,
            $basePath
        );
    }

    /*
     * Put
     *
     * ==============================================================================================================
    */

    public function testGetFile()
    {
        $response = TestHelpers::invokeMethod($this->locator, 'getFile', [$this->group]);

        $this->assertEquals('file.php', $response);

        return $response;
    }

    public function testGroupToPath()
    {
        $response = TestHelpers::invokeMethod($this->locator, 'groupToPath', [$this->group]);

        $this->assertEquals(['awesome', 'group', 'file'], $response);
    }

    public function testGetPath()
    {
        $response = TestHelpers::invokeMethod($this->locator, 'getPath', ['delete', $this->group]);

        $this->assertEquals(__DIR__ .
            DIRECTORY_SEPARATOR . 'delete' . DIRECTORY_SEPARATOR . 'awesome' . DIRECTORY_SEPARATOR .
            'group' . DIRECTORY_SEPARATOR, $response
        );

        return $response;
    }

    public function testToArray()
    {
        $response = TestHelpers::invokeMethod($this->locator, 'toArray', [$this->collection]);

        $this->assertEquals([
            __DIR__ . DIRECTORY_SEPARATOR . "delete" . DIRECTORY_SEPARATOR . "awesome" . DIRECTORY_SEPARATOR .
            "group" . DIRECTORY_SEPARATOR => ["file.php" => ["super" => ["puper" => ["name" => "translate"]]]]],
            $response
        );
    }

    /**
     * @depends testGetPath
     * @depends testGetFile
     *
     * @param $path
     * @param $file
     */
    public function testPut($path, $file)
    {
        TestHelpers::invokeMethod($this->locator, 'put', [$this->collection]);

        $this->assertFileExists($path . $file);

        $this->helper->deleteDirectory(rtrim($this->config->getBasePath() . $this->translation->getLanguage(),
            DIRECTORY_SEPARATOR));
    }
}
