<?php

namespace app\controller;

class BaseController
{

    const PATH_VIEW = 'app/view/';
    protected function loadHeader($data = [])
    {
        $this->loadView('partials/header_view',$data);
    }
    protected function loadFooter($data = [])
    {
        $this->loadView('partials/footer_view',$data);
    }
    
    protected function loadView($path,$data = array())
    {
        extract($data);//chuyen key cua 1 mang thanh 1 bien
        require self::PATH_VIEW.$path.".php";
    }
    public function __call($method, $parameters)
    {
        exit("{$method} not found");
    }
}