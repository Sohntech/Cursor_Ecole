<?php
namespace Apps\App\Controller;
use Apps\App\App;


class ErrorController
{
    public function Error_404()
    {
        App::getInstance()->notFound();
    }
}



