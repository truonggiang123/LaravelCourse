<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
            $result = SliderModel::select('id','name','description','link','thumb','created','created_by','modified','modified_by','status')
                                    ->paginate(1);
        }
        return $result;
    }
}
