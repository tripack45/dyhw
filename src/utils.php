<?php
/**
 * Created by PhpStorm.
 * User: patri
 * Date: 2016/5/12
 * Time: 23:30
 */
function jsonFormater($sqlResult) {
    $data = array();
    foreach($sqlResult as $row){
        $key = $row['itemid'];
        $val = $row['content'];
        $data[$key] = $val;
    }
    if (empty($data)) {
        return '{}';
    }else{
        return json_encode($data);
    }
}