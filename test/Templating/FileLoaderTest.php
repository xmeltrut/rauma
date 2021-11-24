<?php

namespace Rauma\Test\Templating;

use Rauma\Templating\FileLoader;
use Rauma\Templating\Exception\RuntimeException;
use Rauma\Templating\Exception\TemplateNotFoundException;
use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;

class FileLoaderTest extends TestCase
{
    public function testLoading()
    {
        $fileSystem = vfsStream::setup();

        $directory1 = vfsStream::newDirectory('dir1')->at($fileSystem);
        $template1 = vfsStream::newFile('a.html')->at($directory1);
        $template1->setContent('b-html');

        $directory2 = vfsStream::newDirectory('dir2')->at($fileSystem);
        $template2 = vfsStream::newFile('a.html')->at($directory2);
        $template2->setContent('b-html');

        $loader = new FileLoader($directory1->url());
        $loader->addDirectory($directory2->url());

        $templateContents = $loader->load('a.html');

        $this->assertEquals('b-html', $templateContents);

        // test exists function
        $this->assertEquals(true, $loader->exists('a.html'));
        $this->assertEquals(false, $loader->exists('c.html'));
    }

    public function testTemplateNotFound()
    {
        $this->expectException(TemplateNotFoundException::class);

        $loader = new FileLoader(__DIR__);
        $loader->load('not-there.html');
    }

    public function testInvalidDirectory()
    {
        $this->expectException(RuntimeException::class);

        $loader = new FileLoader(__DIR__ . '/not-there');
    }
}
