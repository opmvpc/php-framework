<?php

namespace App;

use PhpFramework\Framework;

class App {
    public static function run() {
        echo(Framework::hello());
    }
}