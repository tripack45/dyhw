<?php

/**
 * Created by PhpStorm.
 * User: patri
 * Date: 2016/5/11
 * Time: 14:32
 */
class controller
{
    protected $ci;

    public function __construct($ci) {
        $this->ci = $ci;
    }

    public function getAllTasks($request, $response, $args) {
        $response->write('getAllTask');
        return $response;
    }

    public function getTaskByID($request, $response, $args) {
        $response->write('geTaskByID:'.$args['id']);
        return $response;
    }

    public function createTask($request, $response, $args) {
        $response->write('createTask');
        return $response;
    }

    public function updateTask($request, $response, $args){
        $response->write('updateTask:'.$args['id']);
        return $response;
    }

    public function deleteTask($request, $response, $args){
        $response->write('deleteTask:'.$args['id']);
        return $response;
    }
}