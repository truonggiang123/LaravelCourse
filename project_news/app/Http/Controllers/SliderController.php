<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SliderModel as MainModel;

class SliderController extends Controller
{
    // public function show($id)
    // {
    //     return view('user.profile', [
    //         'user' => User::findOrFail($id)
    //     ]);
    // }
    private $pathViewController = 'admin.slider';
    private $model;
    private $controllerName = 'slider';
    private $params = [];
    public  function __construct()
    {
       $this->model = new MainModel();
       view()->share('controllerName', $this -> controllerName);
       $this->params['pagination']['totalInPage'] = 1;
    }

    public function index()
    {
        $items = $this->model->listItems($this->params,["task" => "admin-list-items"]);
        return view($this->pathViewController. '.index', ["items" => $items]);
    }
}