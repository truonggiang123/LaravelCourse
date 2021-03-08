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
    public  function __construct()
    {
       $this->model = new MainModel();
    }

    public function index()
    {
        $items = $this->model->listItems(null,["task" => "admin-list-items"]);
        foreach ($items as $item) {
            echo $item->name;
        }
        return view($this->pathViewController. '.index');
    }
}