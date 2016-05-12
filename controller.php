<?php
/**
 * Created by PhpStorm.
 * User: patri
 * Date: 2016/5/11
 * Time: 14:32
 */
require_once('TodoList.php');
require_once('utils.php');

class controller {
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

        if (!$todoList->isTaskIDExist($id))
            return $this->IDNotFound($request, $response, $id);

        $data = $todoList->getTaskByID($id);

        $response = $response->withStatus(200); //OK
        $response = $response->write(jsonFormater($data));
        return $response;
    }

    public function createTask($request, $response, $args) {
        $content = $this->requireBodyContent($request, 'content');
        $todoList = $this->ci->todoList;

        if ($content === false)
            return $this->illegleArgument($request, $response, $args);

        $id = $todoList->createTask($content);
        $entry = $todoList->getTaskByID($id);

        $response = $response->withStatus(201); //Created
        $response = $response->write(jsonFormater($entry));
        return $response;
    }

    public function updateTask($request, $response, $args) {
        $content = $this->requireBodyContent($request, 'content');
        $todoList = $this->ci->todoList;
        $id = $args['id'];

        if (!$todoList->isTaskIDExist($id))
            return $this->IDNotFound($request, $response, $id);
        if ($content === false)
            return $this->illegleArgument($request, $response, $args);

        $todoList->updateTask($id, $content);
        $data = $todoList->getAllTasks($id);

        $response = $response->withStatus(201); //Content Created
        $response = $response->write(jsonFormater($data));
        return $response;
    }

    public function deleteTask($request, $response, $args) {
        $id = $args['id'];
        $todoList = $this->ci->todoList;

        if (!$todoList->isTaskIDExist($id))
            return $this->IDNotFound($request, $response, $id);

        $todoList->deleteTask($id);

        $response = $response->withStatus(204); //No content
        return $response;
    }

    public function IDNotFound($request, $response, $args) {
        $payload = json_encode(["error" => "No entry by this ID: " . $args]);

        $response = $response->withStatus(404);//Not Found
        $response = $response->write($payload);
        return $response;
    }

    public function illegleArgument($request, $response, $args) {
        $payload = json_encode(["error" => "Illegle Argument"]);

        $response = $response->withStatus(400); //Invalid Request
        $response = $response->write($payload);
        return $response;
    }

    private function requireBodyContent($request, $content) {
        $body = $request->getParsedBody();
        if (empty($body)) return false;
        if (!array_key_exists($content, $body)) return false;
        return $body[$content];
    }
}