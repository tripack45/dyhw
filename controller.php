<?php
/**
 * Created by PhpStorm.
 * User: patri
 * Date: 2016/5/11
 * Time: 14:32
 */
require_once('TodoList.php');
require_once('utils.php');

class controller
{
    protected $ci;

    public function __construct($ci) {
        $this->ci = $ci;
    }

    public function getAllTasks($request, $response, $args) {
        $todoList = $this->ci->todoList;
        $data = $todoList->getAllTasks();

        $response = $response->withStatus(200); //OK
        $response = $response->write(jsonFormater($data));
        return $response;
    }

    public function getTaskByID($request, $response, $args) {
        $id = $args['id'];
        $todoList = $this->ci->todoList;
        $data = $todoList->getTaskByID($id);

        $response = $response->withStatus(200); //OK
        $response = $response->write(jsonFormater($data));
        return $response;
    }

    public function createTask($request, $response, $args) {
        $body = $request->getParsedBody();
        $content = $body['content'];
        $todoList = $this->ci->todoList;

        $id = $todoList->createTask($content);
        $entry = $todoList->getTaskByID($id);

        $response = $response->withStatus(201); //Created
        $response = $response->write(jsonFormater($entry));
        return $response;
    }

    public function updateTask($request, $response, $args){
        $body = $request->getParsedBody();
        $content = $body['content'];
        $todoList = $this->ci->todoList;
        $id = $args['id'];

        $todoList->updateTask($id,$content);
        $entry = $todoList->getTaskByID($id);

        $response=$response->withStatus(201); //Content Created
        $response=$response->write(jsonFormater($entry));
        return $response;
    }

    public function deleteTask($request, $response, $args){
        $id = $args['id'];
        $todoList = $this->ci->todoList;
        $todoList->deleteTask($id);

        $response = $response->withStatus(204); //No content
        return $response;
    }

    public function noContent($response){
        return $response;
    }
}