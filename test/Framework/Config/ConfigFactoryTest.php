<?php

namespace Rauma\Test\Framework\Config;

use Rauma\Framework\Config\ConfigFactory;
use Rauma\Framework\Config\Exception\ParseException;
use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;
use Exception;

class ConfigFactoryTest extends TestCase
{
    public function testLoad()
    {
        $fileSystem = vfsStream::setup();
        $configFile = vfsStream::newFile('config.yml')->at($fileSystem);
        $configFile->setContent('a: b');

        $config = ConfigFactory::load($configFile->url());

        $this->assertEquals(['a' => 'b'], $config);
    }

    public function testInvalidYaml()
    {
        $this->expectException(ParseException::class);

        $fileSystem = vfsStream::setup();
        $configFile = vfsStream::newFile('config.yml')->at($fileSystem);
        $configFile->setContent('test: "!%');

        $x = $config = ConfigFactory::load($configFile->url());
    }

    public function testMissingFile()
    {
        $this->expectException(Exception::class);

        $fileSystem = vfsStream::setup();
        $config = ConfigFactory::load(sprintf('%s/not-there.yml', $fileSystem->url()));
    }
}
