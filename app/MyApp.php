<?php

namespace App;

use Illuminate\Foundation\Application;

class MyApp extends Application {

    public function publicPath() {
        if (file_exists($this->basePath . DIRECTORY_SEPARATOR . 'www')) {
            return $this->basePath . DIRECTORY_SEPARATOR . 'www';
        }

        return $this->basePath . DIRECTORY_SEPARATOR . 'public';
    }
}
