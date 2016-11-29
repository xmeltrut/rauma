<?php

namespace Rauma\Test\Bootstrap;

/**
 * This queues up calls to render() so we can examine them later.
 */
class TemplatingQueue
{
    private $queue;

    /**
     * Mocked out method.
     *
     * @param string $template Template file.
     * @param array  $data     Template data.
     * @return string
     */
    public function render($template, array $data = [])
    {
        $this->queue[] = [$template, $data];
        return 'html-content';
    }

    /**
     * Shift a saved call from the array.
     *
     * @return array
     */
    public function shift()
    {
        return array_shift($this->queue);
    }
}
