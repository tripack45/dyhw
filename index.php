<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require './config.php';

$app = new \Slim\App(["settings" => $config]);
spl_autoload_register(function ($classname) {
    require ("./" . $classname . ".php");
});

$container = $app->getContainer();

$container['view'] = new \Slim\Views\PhpRenderer("./templates/");

/*  GET    /api/v1/tasks        // Get all tasks
    GET    /api/v1/tasks/:id    // Get a task by id
    POST   /api/v1/tasks       // Create a new task
    PUT    /api/v1/tasks/:id    // Update a given task
    DELETE /api/v1/tasks/:id // Delete a task
 */

$app->get   ("/api/$version/tasks"              ,'\controller:getAllTasks');
$app->get   ("/api/$version/tasks/{id:[0-9]+}"  ,'\controller:getTaskByID');
$app->post  ("/api/$version/tasks"              ,'\controller:createTask');
$app->put   ("/api/$version/tasks/{id:[0-9]+}"  ,'\controller:updateTask');
$app->delete("/api/$version/tasks/{id:[0-9]+}"  ,'\controller:deleteTask');

$app->run();