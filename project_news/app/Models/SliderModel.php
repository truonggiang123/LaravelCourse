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

    public function listItems($params, $options){
        $result = null;
        if($options['task'] == 'admin-list-items'){
            $query = $this->select('id','name','description','link','thumb','created','created_by','modified','modified_by','status');
            if($params['filter']['status']!='all'){
                $query->where('status','=',$params['filter']['status']);
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
