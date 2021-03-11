<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
       $this->params['pagination']['totalInPage'] = 3;
    }

    public function index(Request $request)
    {
        //get param
        $this->params['filter']['status'] = $request -> input('filter','all');
        $this->params['search']['field'] = $request -> input('search_field','id');
        $this->params['search']['value'] = $request -> input('search_value','');
        $items = $this->model->listItems($this->params,["task" => "admin-list-items"]);
        $coutByStatus = $this->model->coutByStatus($this->params,["task" => "admin-count-status"]);
        return view($this->pathViewController. '.index', [
            "params"=> $this -> params,
            "items" => $items,
            "coutByStatus" => $coutByStatus
            ]);
    }
}