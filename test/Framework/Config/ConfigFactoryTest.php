<?php

namespace Rauma\Test\Framework\Config;

use Rauma\Framework\Config\ConfigFactory;
use org\bovigo\vfs\vfsStream;

class ConfigFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testLoad()
    {
        $fileSystem = vfsStream::setup();
        $configFile = vfsStream::newFile('config.yml')->at($fileSystem);
        $configFile->setContent('a: b');

        $config = ConfigFactory::load($configFile->url());

        $this->assertEquals(['a' => 'b'], $config);
    }

    /**
     * @expectedException \Rauma\Framework\Config\Exception\ParseException
     */
    public function testInvalidYaml()
    {
        $fileSystem = vfsStream::setup();
        $configFile = vfsStream::newFile('config.yml')->at($fileSystem);
        $configFile->setContent('test: "!%');

        $x = $config = ConfigFactory::load($configFile->url());
    }

    /**
     * @expectedException \Exception
     */
    public function testMissingFile()
    {
        $fileSystem = vfsStream::setup();
        $config = ConfigFactory::load(sprintf('%s/not-there.yml', $fileSystem->url()));
    }
}
