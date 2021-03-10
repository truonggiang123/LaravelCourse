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
        
        // <a
        //                     href="?filter_status=all" type="button"
        //                     class="btn btn-primary">
        //                 All <span class="badge bg-white">4</span>
        //             </a><a href="?filter_status=active"
        //                    type="button" class="btn btn-success">
        //                 Active <span class="badge bg-white">2</span>
        //             </a><a href="?filter_status=inactive"
        //                    type="button" class="btn btn-success">
        //                 Inactive <span class="badge bg-white">2</span>
        //             </a>
        return $xhtml;
    }
}