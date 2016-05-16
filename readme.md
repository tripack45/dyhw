# On RESTful API. HW2 for DyWeb Spring
An Todo List API.

Testing Server Address: [http://59.78.36.78:8080/hw2/api/v1/tasks](http://59.78.36.78:8080/hw2/api/v1/tasks)

Built upon [Slim](http://www.slimframework.com/) framework. The app is roughly MVC structured.

Data are stored using MySQL. Did some protection :-);

Future Work: Factor out "View" class. Add support for authentication.

Don't know if the API is correctly "RESTed". Any help will be appreciated!

## Supported methods:

* Get all list
    * Request:  `GET http://59.78.36.78:8080/hw2/api/v1/tasks` 
    * Response:
        * Success: HTTP 200, All entries in JSON: `{"ID":"CONTENT"}`
        * Failed: See error message for detailed
    * Notice the request adress has no trailing backlash


* Get an entry by ID
    * Request:  `GET http://59.78.36.78:8080/hw2/api/v1/tasks/:id` 
    * Response:
        * Success: HTTP 200, Specified entry in JSON: `{"ID":"CONTENT"}`
        * Failed: HTTP 404, Specified ID does not exist;


* Delete an entry by ID
    * Request:  `DELETE http://59.78.36.78:8080/hw2/api/v1/tasks/:id` 
    * Response:
        * Success: HTTP 204, Empty Page
        * Failed: HTTP 404, Specified ID does not exist;


* Updatae an entry by ID
    * Request:  `PUT http://59.78.36.78:8080/hw2/api/v1/tasks/:id`
        * Request body **MUST** include the `NEW_CONTENT`, encoded in JSON: `{"content","NEW_CONTENT"}` 
    * Response:
        * Success: HTTP 201, All entries in JSON: `{"id":"content"}`
        * Failed: HTTP 404, Specified ID does not exist;
        * Failed: HTTP 400, The `content` argument in the request body is either not 
            given or not specified in correct format.

* Create an entry by ID
    * Request:  `POST http://59.78.36.78:8080/hw2/api/v1/tasks` 
        * Request body **MUST** include the `NEW_CONTENT`, encoded in JSON: `{"content","NEW_CONTENT"}` 
    * Response:
        * Success: HTTP 201, The newly added entry in JSON: `{"NEW_ENTRY_ID":"NEW_CONTENT"}`
        * Failed: HTTP 400, The `content` argument in the request body is either not 
            given or not specified in correct format.
