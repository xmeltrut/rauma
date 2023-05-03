<?php

namespace Rauma\Messaging;

use Laminas\Diactoros\ServerRequestFilter\FilterServerRequestInterface;
use Laminas\Diactoros\ServerRequestFactory as LaminasServerRequestFactory;

/**
 * Easily create server request objects.
 */
class ServerRequestFactory extends LaminasServerRequestFactory
{
}
