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
            $query = self::select('id','name','description','link','thumb','created','created_by','modified','modified_by','status');
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
    //change status
    public function saveItems($params = null, $options = null)
    {
        if($options['task'] == 'change-status'){
            $status = ($params['currentStatus'] == 'active') ? 'inactive': 'active';
            self::where('id', $params['id'])
                    ->update(['status' => $status]);
        }
    }
    public function deleteSlider($params = null, $options = null)
    {
        if($options['task'] == 'delete-slider'){
            self::where('id', $params['id'])->delete();
        }
    }
    public function getItem($params = null, $options = null)
    {
        $result = null;
        if($options['task'] == 'get-item'){
            $result = self::select('id','name','description','link','thumb','status')
                ->where('id',$params['id'])->first();
        }
        return $result;
        
    }
}
