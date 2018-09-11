<?php

namespace Rauma\Framework\Controller;

interface ExceptionControllerInterface
{
    public function error($exception);
    public function forbidden();
    public function notFound();
    public function unauthorised();
}
