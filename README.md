# dyhw
Homework for Dongyue Web Spring.

## The General Information
Each individual branch is an homework.
My testing Sever: 59.78.36.78:8080.
This server runs on an raspberry pi 3, just enough to cope with small trafic.

## Homework1:
An loggined required ToDo-list, basically combines the requiremnts of AssignmentI and AssignmentIII :)
The system utilizes php-Sessions an MySQL. The basic functions include:

* Login-Log In;
* Login-Register;
* ToDoList - Inspect The list
* ToDoList - Add/Delete/Edit an Entry

This system provides *Minimum* protection, ~~basically open to SQL Injections~~
With help of prepared statements, Now it is officially bulletproof! :) 
Except for the fact it is built on rpi3 so that a manual DOS could crash it(perhaps).

*DO NOT USE ANY USUAL PASSWORD IN TYRING OUT THIS PROJECT!!*

Username and password are transmitted in plain-text!

Testing Address: http://59.78.36.78:8080/hw1/

## Homework2:
An Todo List RESTful API, built upon Slim.
Testing Server Address: [http://59.78.36.78:8080/hw2/api/v1/tasks](http://59.78.36.78:8080/hw2/api/v1/tasks)
Built upon [Slim](http://www.slimframework.com/) framework. The app is roughly MVC structured.
Data are stored using MySQL. Did some protection :-);
Future Work: Factor out "View" class. Add support for authentication.
