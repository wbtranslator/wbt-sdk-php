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
        $config->setGroupDelimiter('::');
        $config->setBasePath(__DIR__);
        $config->setLangResourcePaths([DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'lang']);

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
        $response = TestHelpers::invokeMethod($this->locator, 'getPath', ['ua', $this->group]);

        $this->assertEquals(__DIR__.
            DIRECTORY_SEPARATOR . 'ua' . DIRECTORY_SEPARATOR . 'awesome' . DIRECTORY_SEPARATOR .
            'group' . DIRECTORY_SEPARATOR, $response
        );

        return $response;
    }

    public function testToArray()
    {

        $response = TestHelpers::invokeMethod($this->locator, 'toArray', [$this->collection]);

        $this->assertEquals(
            ["C:\Work\OpenServer\domains\www\wbt-sdk-php\\tests\phpunit\ua\awesome\group\\" => [
                "file.php" => ["super" => ["puper" => ["name" => "translate"]]]]],
            $response
        );
    }

    /**
     * @depends testGetPath
     * @depends testGetFile
     */
    public function testPut($path, $file)
    {
//        var_dump($this->config->getBasePath(). $this->translation->getLanguage());die;
//        $this->helper->delete($this->config->getBasePath(). $this->translation->getLanguage());
//        rmdir('C:\Work\OpenServer\domains\www\wbt-sdk-php\tests\phpunit\ua');
//        $response = TestHelpers::invokeMethod($this->locator, 'put', [$this->collection]);
    }
}
