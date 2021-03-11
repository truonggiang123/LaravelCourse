<?php
namespace App\Helpers;


class Template{
    public static function showItemStatus($controllerName,$status,$id){
        $tmpStatus = [
            "active"    =>  ['name'=>'Ative', 'class'=> 'btn-success'],
            "inactive"  =>  ['name'=>'Inactive', 'class' => 'btn-danger']
        ];
        $currenStatus = $tmpStatus[$status];
        $link = route($controllerName.'/status',['status'=>$status, 'id'=>$id]);

        $xhtml = sprintf('<a href="%s"
        type="button" class="btn btn-round %s">%s</a>', $link, $currenStatus['class'], $currenStatus['name']);
        return $xhtml;
    }

    public static function showItemThumb($controllerName,$itemThumbSrc,$itemThumbName){
        $xhtml = sprintf('<img src="%s" alt="%s" class="zvn-thumb">', asset("images/$controllerName/$itemThumbSrc"), $itemThumbName);
        return $xhtml;
    }

    public static function showButtonFilter($controllerName,$countByStatus,$currenStatus){
        $xhtml = '';
        if($countByStatus>0){
            array_unshift($countByStatus,[
                'count'=> array_sum(array_column($countByStatus,'count')),
                'status' => 'all'
            ]);
            foreach ($countByStatus as $value) {
                $class = ($currenStatus == $value['status']) ? 'btn-danger' : 'btn-primary';
                $link = route($controllerName) .'?filter=' . $value['status'];
                $xhtml .= sprintf('<a
                             href="%s" type="button"
                             class="btn %s">
                                %s <span class="badge bg-white">%s</span>
                        </a>',$link,$class,$value['status'], $value['count']);
            }
        }
        return $xhtml;
    }

    public static function showAreaSearch($controllerName,$search){
        $xhtml = null;
        $tmpField = config('exam.search');
        $fieldInController = [
            'default' => ['all','id'],
            'slider'  => ['all','id','link','description','name']
        ];
        $searchField = (in_array($search['field'],$fieldInController[$controllerName])) ? $search['field']: 'all';

        $controllerName = (array_key_exists($controllerName,$fieldInController)) ? $controllerName : 'default';
        $xhtmlField = null;
        foreach ($fieldInController[$controllerName] as $value) {
            $xhtmlField .= sprintf('<li><a href="#" class="select-field" data-field="%s">%s</a></li>',$value,$tmpField[$value]['name']);
        }
        $xhtml = sprintf('
        <div class="input-group">
            <div class="input-group-btn">
                <button type="button"
                        class="btn btn-default dropdown-toggle btn-active-field"
                        data-toggle="dropdown" aria-expanded="false">
                    %s <span class="caret"></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                   %s
                </ul>
            </div>
                <input type="text" class="form-control" name="search_value" value="%s">
            <span class="input-group-btn">
                <button id="btn-clear" type="button" class="btn btn-success" style="margin-right: 0px">Xóa tìm kiếm</button>
                <button id="btn-search" type="button" class="btn btn-primary">Tìm kiếm</button>
            </span>
                <input type="hidden" name="search_field" value="all">
        </div>
        ',$tmpField[$searchField]['name'],$xhtmlField,$search['value'],$search['field']);
        return $xhtml;
    }
}