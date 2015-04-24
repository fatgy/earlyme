<?php namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App;

class Controller extends BaseController
{
    protected $app;

    public function __construct()
    {
        $this->app = App::getInstance();
    }
}
