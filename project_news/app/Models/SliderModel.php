<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class SliderModel extends Model
{
    use HasFactory;
    protected $table = 'slider';
    public $timestamps = false;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    private $field = [
        'name',
        'id',
        'link',
        'description'
    ];
    public function listItems($params, $options){
        $result = null;
        if($options['task'] == 'admin-list-items'){
            $query = $this->select('id','name','description','link','thumb','created','created_by','modified','modified_by','status');
            if($params['filter']['status']!='all'){
                $query->where('status','=',$params['filter']['status']);
            }
            if($params['search'] !== ""){
                if($params['search']['field'] == 'all'){
                    $query->where(function($query) use($params){
                        foreach ($this->field as $value) {
                            $query -> orwhere($value, "LIKE", "%{$params['search']['value']}%");
                        }
                    });
                }
                else if(in_array($params['search']['field'] , $this -> field)){
                    $query -> where($params['search']['field'], "LIKE", "%{$params['search']['value']}%");
                }
            }
            $result = $query->paginate($params['pagination']['totalInPage']);
        }
        return $result;
    }

    //count status
    public function coutByStatus($params, $options){
        $result = null;
        if($options['task'] == 'admin-count-status'){
            $result = $this->select(DB::raw('count(id) as count, status'))
                                    ->groupBy('status')
                                    ->get()->toArray();
        }
        return $result;
    }
}
