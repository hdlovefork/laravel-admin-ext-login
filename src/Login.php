<?php

namespace Dean\Login;

use Encore\Admin\Extension;

class Login extends Extension
{
    public $name = 'login';

    public $views = __DIR__.'/../resources/views';

    public $assets = __DIR__.'/../resources/assets';

    public $menu = [
        'title' => 'Login',
        'path'  => 'login',
        'icon'  => 'fa-gears',
    ];
}