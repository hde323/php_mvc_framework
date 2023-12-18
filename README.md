
# php mvc framework

this is a simple mvc php framework following the mvc architecture.


## Authors

- [@Hadi Seh](https://github.com/hde323)


## Run Locally

Clone the project

```bash
  git clone https://github.com/hde323/php_mvc_framework
```

Go to the project directory

```bash
  cd php_mvc_framework
```


Start the server

```bash
  php -S localhost:8080 public/index.php
```


## Images

![App Screenshot](https://iwms.uits.uconn.edu/wp-content/uploads/sites/2146/2017/07/codeigniter-mvc-components.png)


## Documentation
  
  * Project entry file:
   
    the project starts at ***public/index.php*** where every request is prosseced and handeled according to pre declared routes.

* Project routes:

  routes are declared in ***app/config/routes.php*** using the Router object and it functions:


### Router Overview

The `Router` class allows declaring and matching routes for a PHP application. Routes can be declared for specific HTTP methods like GET, POST, etc. Routes can also match multiple HTTP methods.

The routes are stored in a private `$routes` property on the `Router` class.

### Route Declaration Methods

The `Router` class provides methods for declaring routes for each HTTP method:

- `get()` - Declare a route that matches only GET requests
- `post()` - Declare a route that matches only POST requests
- `patch()` - Declare a route that matches only PATCH requests
- `delete()` - Declare a route that matches only DELETE requests
- `head()` - Declare a route that matches only HEAD requests
- `put()` - Declare a route that matches only PUT requests

Each method accepts the route path as the first parameter and an array of the route action as the second parameter.

### Multi-Method Route Declaration

The `match()` method can be used to declare a route that matches multiple HTTP methods. It accepts the route path, an array of HTTP methods, and the route action.

### Route Matching

The `resolve()` method is used to match an incoming request to a declared route. It accepts the request path and will match it to a route based on the request HTTP method.

If a matching route is found, the associated action will be executed.

The `resolve()` method handles errors and method mismatches and will call the `abort()` method to generate the appropriate error response.

### Aborting with Errors

The `abort()` method is used to abort request handling and return an error response. It accepts an error code and message. In production, it will set the response code and generate an error page. In debug mode, it will throw an Exception with the message.

### Route Definition

Each route is defined as an array within the `$routes` property. The array contains the HTTP methods and the action to execute when the route is matched.

The action can be any callable PHP callable like an anonymous function or class method.

### Example Usage

```php
$router = new Router();

$router->get('/hello', function() {
  // Show hello world page
});

$router->post('/contact', [ new ContactController, 'send']); 

$router->match('/blog', ['GET', 'POST'], function() {
  // Show blog 
});
$URI = $_SERVER['REQUEST_URI'];
$PARSED_URI = parse_url($URI);
$PATH = $PARSED_URI['path'];
$router->resolve($PATH);
```
### Controllers

controller is one of the three key components of the mvc architecture. in my framework each controller **extends** the `Controller` class wich contains two main properties:

`Request $Request:` wich is responsible for handiling incoming requests.
`Response $Response:` wich is responsible for sending back responses to the client.

### Example Usage

```php
<?php
namespace app\controllers;
use src\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return $this->Response->View('home');
    }
}

```

### Request object

the `Request` class handles ongoing requests to the website like: request method, submited form data and url query parameters. the request class validates the variables that come throught the url and forms inputs to prevent any possible **XSS** attacks to the website.

### Example Usage
 ```php
    <?php
namespace app\controllers;
use src\Controller;

class AuthController extends Controller
{
    public function index()
    {
        //the form array handles the variables sent through post method
        $form = $this->Request->getForm();     
        if(isset($form["submit"]))
        {
            $username = $form["username"];
            //rest of the code........

            
        }
        return $this->Response->View('login');
    }
}
//the code for the $form array works as well for the $params, the 
//key defferance is the request method GET/POST.
 ```

# Response Class Documentation

The `Response` class in the `src` namespace provides methods for handling and sending HTTP responses.

## View Method

### `view(string $view, array $data = null)`

Render a view by including the corresponding file.

**Example: Render a view with data**

```php
Response::view('home', ['name' => 'John']);
```

This example renders the "home" view, passing an associative array `$data` with the key "name" set to "John". If the view file is not found, an `InvalidArgumentException` is thrown.

## Json Method

### `Json(array $data)`

Return a JSON response.

**Example: Send a JSON response**

```php
$response = new Response();
$response->Json(['status' => 'success', 'data' => ['id' => 1, 'name' => 'John']]);
```

This example sets the response header to indicate JSON content and echoes a JSON-encoded array as the response. The script exits immediately after sending the JSON response.

## Redirect Method

### `Redirect(string $url)`

Redirect to a specified URL.

**Example: Redirect to the dashboard**

```php
$response = new Response();
$response->Redirect('/dashboard');
```

This example redirects the user to the "/dashboard" URL. The script exits immediately after sending the redirect header.

## StatusCode Method

### `StatusCode(int $code)`

Set the HTTP response status code.

**Example: Set a custom status code**

```php
$response = new Response();
$response->StatusCode(404);
```

This example sets the HTTP response status code to 404. The script exits immediately after setting the status code.

**Note:** The `view` method is static, while the other methods are non-static, requiring an instance of the `Response` class.
```

### Database Class Documentation

The `Database` class provides a basic interface for executing SQL queries and interacting with a database using PDO.

### Constructor

### `__construct()`

Initialize the database.

```php
$db = new Database();
```

The constructor establishes a PDO connection using the configuration values defined in the environment variables (`$_ENV`). It sets up the necessary options for error handling and result fetching.

### Query Method

### `Query(string $sql, array $params = null, bool $fetchAll = true)`

Execute an SQL query.

**Example: Execute a SELECT query and fetch all results**

```php
$db = new Database();
$results = $db->Query("SELECT * FROM users");
```

This example executes a SELECT query to fetch all records from the "users" table. The result is an associative array containing all rows.

**Example: Execute an INSERT query**

```php
$db = new Database();
$inserted = $db->Query("INSERT INTO products (name, price) VALUES (:name, :price)", ['name' => 'Product A', 'price' => 19.99], false);
```

This example executes an INSERT query to add a new product to the "products" table. The `false` parameter indicates that we don't want to fetch results. The method returns `true` on success.

**Example: Execute an UPDATE query**

```php
$db = new Database();
$updated = $db->Query("UPDATE orders SET status = :status WHERE id = :id", ['status' => 'shipped', 'id' => 123], false);
```

This example executes an UPDATE query to change the status of an order in the "orders" table. The `false` parameter indicates that we don't want to fetch results. The method returns `true` on success.

**Example: Execute a DELETE query**

```php
$db = new Database();
$deleted = $db->Query("DELETE FROM customers WHERE id = :id", ['id' => 456], false);
```

This example executes a DELETE query to remove a customer from the "customers" table. The `false` parameter indicates that we don't want to fetch results. The method returns `true` on success.

**Note:** It's essential to use parameterized queries to prevent SQL injection. In the examples above, parameters are passed in an array to ensure safe query execution.
