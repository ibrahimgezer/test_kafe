<?php

namespace App\Controllers;

class HomeController  extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Ana Sayfa';
        return view('pages/home/index', $data);
    }
    
}
