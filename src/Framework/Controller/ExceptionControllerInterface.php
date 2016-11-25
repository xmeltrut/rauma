<?php

namespace Rauma\Framework\Controller;

use Exception;

interface ExceptionControllerInterface
{
    public function error(Exception $exception);
    public function forbidden();
    public function notFound();
    public function unauthorised();
}
