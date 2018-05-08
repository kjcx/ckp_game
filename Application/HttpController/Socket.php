<?php

namespace App\HttpController;

use App\HttpController\ViewController;

/**
 * Class Index
 * @author  : evalor <master@evalor.cn>
 * @package App\HttpController
 */
class Socket extends ViewController
{
    function index()
    {
        // Blade View
        $this->render('index');     # 对应模板: Views/index.blade.php

    }
}