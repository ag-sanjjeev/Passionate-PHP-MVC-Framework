# PASSIONATE PHP MVC Framework Documentation

## Introduction

Welcome to the documentation for the PASSIONATE PHP MVC Framework!. This documentation provides a comprehensive guide on how to use and extend the framework to build web applications using the Model-View-Controller (MVC) architectural pattern.

## Table of Contents

1. [Getting Started](#getting-started)
2. [Directory Structure](#directory-structure)
3. [Routing](#routing)
4. [Controllers](#controllers)
5. [Views](#views)
6. [Models](#models)
7. [Authentication and Authorization](#authentication-and-authorization)
11. [Contributing](#contributing)
12. [License](#license)
13. [Acknowledgements](#acknowledgements)
14. [Contact](#contact)

## Getting Started

To get started with the PASSIONATE PHP MVC Framework, follow the installation instructions provided in the [README.md](README.md) file of the repository. Once installed, you can begin building your web application using this framework.

## Directory Structure

This PHP MVC Framework follows a structured directory layout to organize your application's code. Here is an overview of the key directories and their purposes:

- `controller`: This directory typically contains the controller files of your MVC framework. Controllers handle user requests, process data, and interact with models and views.

- `core`: The `core` directory is a crucial part of your MVC framework. It usually consists of essential components like the application configuration, base controller, database connection, routing system, session handling, and other core functionalities.

- `helpers`: The `helpers` directory contains helper classes or functions that provide reusable code snippets or utility functions to assist in various tasks throughout your application.

- `middlewares`: Middleware classes in the `middlewares` directory allow you to intercept and process requests before they reach the controller. Middleware can be used for tasks like authentication, authorization, input validation, and more.

- `models`: The `models` directory typically contains classes that represent the data structures and business logic of your application. Models interact with the database, retrieve and manipulate data, and provide an interface for the controllers to work with.

- `public`: The `public` directory is the web-accessible root of your application. It usually contains the entry point file (e.g., `index.php`), as well as static assets like CSS, JavaScript, and images. And also it has layouts for the application

- `routes`: The `routes` directory holds the route configuration files of your application. These files define the URL patterns and their corresponding controller methods for handling specific requests.
    
- `vendor`: Contains third-party dependencies installed via Composer.


## Routing

To define routes in your application, you can use the `Route` class provided by the `app\core\Route` namespace. This class allows you to define various types of routes and associate them with appropriate callbacks or controller actions.

1. Basic Route Example:
   - Define a GET route for the root URL (`/`) that returns an array `[1, 2, 3]`:
     
```php
 Route::get('/', function() {
     return [1, 2, 3];
 });
 ```
     
2. Route with Custom URL:
   - Define a GET route for the `/home` URL that returns the string "Welcome":
     
```php
 Route::get('/home', function() {
     return 'Welcome';
 });
 ```
     
3. Route with Any HTTP Method:
   - Define a route that accepts any HTTP method and points to a `test` view file:
     
```php
 Route::any('/test', 'test');
```
     
4. Route with Controller Action:
   - Define a GET route for the `/demo` URL that calls the `index` method of the `Democontroller` class:
     
```php
 Route::get('/demo', [Democontroller::class, 'index'])->middleware('auth');
```
     
5. Route with Parameters:
   - Define a route with any number of parameters such as (`$username` and `$id`) that calls the `postPage` method of the `Democontroller` class:
     
```php
 Route::any('/user/{$username}/posts/{$id}', [Democontroller::class, 'postPage']);
```
     
6. Route with Specific HTTP Method:
   - Define a GET route with two parameters (`$username` and `$id`) that calls the `postPage` method of the `Democontroller` class:
     
```php
 Route::get('/user/{$username}/posts/{$id}', [Democontroller::class, 'postPage']);
```
     
7. Route with Dynamic Variable:
   - Define a GET route with a dynamic variable `$var` and returns the value of the variable:
     
```php
 Route::get('/another/{$var}', function($var) {
     return $var;
 });
```
     
Please note that the above examples are just for illustration purposes. You should modify the routes and callbacks/controllers according to your specific application requirements.

Additionally, you can also apply middleware to routes using the `middleware` method in the route definition. This allows you to add authentication or other checks before executing the route callback or controller action.

Make sure to import the necessary classes and namespaces (`app\core\Route` and `app\controllers\Democontroller`) before using them in your code.

## Controllers

Controllers are responsible for handling user requests and generating appropriate responses. In the PHP MVC Framework, controllers are located in the `controllers` directory. Each controller class should extend the base `Controller` class provided by the framework.

Controllers contain methods (actions) that can handle application logic for routes defined in the `routes.php` file. These methods should return a response to be sent back to the user.

Refer sample controller implementation in `controllers` directory 

## Views

Views are responsible for rendering the presentation layer of your application. In the PHP MVC Framework, views are located in the `public/views` directory. Views typically contain a mixture of HTML and PHP code, and they can utilize the provided template engine to separate presentation logic from business logic.

For more information on views, refer to the [Views](docs/views.md) documentation.

## Models

Models represent the data and business logic of your application. In the PHP MVC Framework, models are located in the `models` directory. Models interact with the database and provide an abstraction layer for data manipulation.

For more information on models, refer to the [Models](docs/models.md) documentation.

## Authentication and Authorization

The current version of PHP MVC Framework does not include built-in authentication and authorization middleware features. However, you can implement these functionalities by creating custom middleware according to your specific requirements. Authentication middleware can be used to verify user credentials, while authorization middleware can determine user access and permissions within the application.

## Validation and Form Handling

The current version of PHP MVC Framework does not include built-in validation and form handling helpers features. However, you can implement these helpers functionalities according to your specific requirements. Validation helps ensure data accuracy and completeness, while form handling involves processing and managing user form submissions.

## Error Handling and Logging

The current version of PHP MVC Framework does not include built-in error handling and logging features. However, you can implement these functionalities according to your specific requirements. Error handling helps manage and display errors gracefully, while logging allows you to track and record application events for debugging and analysis purposes.

## Unit Testing

The PHP MVC Framework does not include built-in unit testing features. However, you can implement your own unit tests for your specific requirements. Unit testing helps ensure the correctness and reliability of your code by testing individual units or components in isolation

## Contributing

Contributions to the PHP MVC Framework are welcome! If you have any suggestions, bug reports, or feature requests, please open an issue or submit a pull request. Make sure to follow the existing coding style and provide clear documentation for your changes.

## License

This PHP MVC Framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT). You are free to use, modify, and distribute it as per the terms of the license.

## Acknowledgements

We would like to express our gratitude to the open-source community for their contributions and support in building this framework. Thank you to all the developers who have made this project possible.

## Contact

If you have any questions or need further assistance, please feel free to contact us at [email](resulttext)

***The end is not the end; it's a doorway to infinite possibilities.***

Thank you for reading our documentation. We appreciate your time and hope you find it helpful!