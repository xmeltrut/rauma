<?php

namespace Rauma\Framework\Config;

use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;

class ConfigFactory
{
    public static function load($configFile)
    {
        if (!file_exists($configFile)) {
            throw new \Exception(sprintf("Unable to load config file '%s'", $configFile));
        }

        try {
            $yaml = new Parser();
            $value = $yaml->parse(file_get_contents($configFile));
            return $value;
        } catch (ParseException $e) {
            throw new Exception\ParseException($e->getMessage());
        }
    }
}
