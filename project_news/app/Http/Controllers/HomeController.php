<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SliderModel as MainModel;
use App\Http\Requests\SliderRequest as MainRequest;

class HomeController extends Controller
{
    // public function show($id)
    // {
    //     return view('user.profile', [
    //         'user' => User::findOrFail($id)
    //     ]);
    // }
    private $pathViewController = 'news.home';
    private $model;
    private $controllerName = 'home';
    private $params = [];
    public  function __construct()
    {
       view()->share('controllerName', $this -> controllerName);
    }

    public function index(Request $request)
    {
        $sliderModel = new MainModel();
        $items = $sliderModel -> listItems($this->params,['task'=>'news-list-items']);
        return view($this->pathViewController. '.index', [
            "params" => $this ->params,
            "items"  => $items
            ]);
    }
    
    
}