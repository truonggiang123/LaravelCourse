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
}