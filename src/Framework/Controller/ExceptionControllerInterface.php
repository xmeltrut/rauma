<?php

namespace Rauma\Framework\Controller;

class ExceptionControllerInterface
{
    public function error(Exception $exception);
    public function forbidden();
    public function notFound();
    public function unauthorised();
}
