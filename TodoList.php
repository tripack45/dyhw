<?php

/**
 * Created by PhpStorm.
 * User: patri
 * Date: 2016/5/12
 * Time: 21:59
 */
class TodoList
{
    private $sql;

    function __construct($sqlConfig) {
        $sql = new mysqli($sqlConfig['host'],
            $sqlConfig['username'],
            $sqlConfig['password'],
            $sqlConfig['database']);
        if ($sql->connect_errno) {
            die("SQL connection failed: ".$sql->connect_error);
        }
        $this->sql = $sql;
    }

    function __destruct() {
        $this->sql->close();
        // TODO: Implement __destruct() method.
    }

    function checkSQLError() {
        if ($this->sql->errno) {
            die('SQL error: ' . $this->sql->error);
        }
    }

    function getTaskByID($id) {
        $query = $this->sql->prepare('SELECT * FROM todolist WHERE itemid=?');
        $query->bind_param('d', $id);
        $query->execute();
        $result = $query->get_result();
        $this->checkSQLError();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    function getAllTasks() {
        $query = $this->sql->prepare('SELECT * FROM todolist');
        $query->execute();
        $this->checkSQLError();
        $result = $query->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    function deleteTask($id) {
        $query = $this->sql->prepare('DELETE FROM todolist WHERE itemid=?');
        $query->bind_param('d', $id);
        $query->execute();
        $this->checkSQLError();
    }

    function updateTask($id,$content) {
        $query = $this->sql->prepare('UPDATE todolist SET content=? WHERE itemid=?');
        $query->bind_param('sd', $content, $id);
        $query->execute();
        $this->checkSQLError();
    }
    
    function createTask($content) {
        $query = $this->sql->prepare('INSERT INTO todolist(content) VALUES (?)');
        $query->bind_param('s', $content);
        $query->execute();
        $this->checkSQLError();
        return $this->sql->insert_id;
    }

    function isTaskIDExist($id) {
        $data = $this->getTaskByID($id);
        return empty($data) ? false : true;
    }
}