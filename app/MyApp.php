<?php namespace App;

use Illuminate\Foundation\Application;

class MyApp extends Application
{
    public function publicPath()
    {
        return $this->basePath.DIRECTORY_SEPARATOR.'www';
    }
}