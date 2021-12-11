<?php
function html($arr){
    foreach ($arr as $key => $value){
        if(is_array($arr[$key])){
            html($arr[$key]);
        }else{
            $arr[$key] = htmlspecialchars($arr[$key],ENT_QUOTES);
        }
    }
    return $arr;
}