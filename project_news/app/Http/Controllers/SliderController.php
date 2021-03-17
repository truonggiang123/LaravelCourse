<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SliderModel as MainModel;
use App\Http\Requests\SliderRequest as MainRequest;

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
    public function status(Request $request)
    {
        $this->params['currentStatus'] = $request->status;
        $this->params['id'] = $request->id;
        $this->model->saveItems($this->params, ['task'=>'change-status']);
        return redirect()->route($this -> controllerName)->with('status', 'Status updated!');;
    }
    public function delete(Request $request)
    {
        $this->params['id'] = $request->id;
        $this->params['thumbName'] = $request->thumbName;
        $this->model->deleteSlider($this->params, ['task'=>'delete-slider']);
        return redirect()->route($this -> controllerName)->with('status', 'Delete successful!');;
    }
    public function form(Request $request)
    {
        $items = null;
        if($request->id != null){
            $this->params['id'] = $request->id;
           $items =  $this->model->getItem($this->params,['task'=>'get-item']);
        }
        return view($this->pathViewController. '.form',[
            "items" => $items
        ]);
    }
    public function save(MainRequest $request)
    {
        $params = $request->all();
        $task = "add-item";
        $notify = "Add Susseccfully!";
        if($request->id!=null){
            $notify = "Edit Susseccfully!";
            $task = "edit-item";
        }
        $this->model->saveItems($params,['task'=>$task]);
        return redirect()->route($this -> controllerName)->with('status', $notify);
    }
    
    
}