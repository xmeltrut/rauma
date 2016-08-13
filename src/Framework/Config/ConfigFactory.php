<?php

namespace Rauma\Framework\Config;

use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;

class ConfigFactory
{
    public static function load($configFile)
    {
        try {
            $yaml = new Parser();
            $value = $yaml->parse(file_get_contents($configFile));
            return $value;
        } catch (ParseException $e) {
            throw new Exception\ParseException($e->getMessage());
        }
    }
}
