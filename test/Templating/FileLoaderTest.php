<?php

namespace Rauma\Test\Templating;

use Rauma\Templating\FileLoader;
use org\bovigo\vfs\vfsStream;

class FileLoaderTest extends \PHPUnit_Framework_TestCase
{
    public function testLoading()
    {
        $fileSystem = vfsStream::setup();

        $directory1 = vfsStrsm::newDirectory('dir1')->at($fileSystem);
        $template1 = vfsStream::newFile('a.html')->at($directory1);
        $template1->setContent('b-html');

        $directory2 = vfsStrsm::newDirectory('dir2')->at($fileSystem);
        $template2 = vfsStream::newFile('a.html')->at($directory2);
        $template2->setContent('b-html');

        $loader = new FileLoader($directory1->url());
        $loader->addDirectory($directory2);

        $templateContents = $loader->load('a.html');

        $this->assertEquals('b-html', $templateContents);
    }

    /**
     * @expectedException Rauma\Templating\TemplateNotFoundException
     */
    public function testTemplateNotFound()
    {
        $loader = new FileLoader(__DIR__);
        $loader->load('not-there.html');
    }

    /**
     * @expectedException Rauma\Templating\Exception\RuntimeException
     */
    public function testInvalidDirectory()
    {
        $loader = new FileLoader(__DIR__ . '/not-there');
    }
}
