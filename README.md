# PASSIONATE PHP MVC Framework

Welcome to the PASSIONATE PHP MVC Framework repository!. This framework is designed to provide a simple implementation for building web applications using the Model-View-Controller (MVC) architectural pattern. It allowing developers to create simple and maintainable applications.

## Features

- **Routing and URL Handling:** The framework provides a powerful routing system that allows developers to define custom routes and map them to specific controllers, views and actions.
- **Template Engine:** The framework comes with a built-in template engine that enables developers to separate the presentation logic from the business logic, improving code readability and maintainability.

- **Controller:** The framework includes a controller component that allows developers to organize and handle the logic for different parts of the application.

- **Cookie Handling:** The framework provides functionality for handling cookies, allowing developers to easily set, get, and delete cookies.

- **Session Management:** The framework includes functionality for managing sessions, making it easy to store and retrieve data across multiple requests. And additionally it has session flash feature that holds session for some more time or temporarily.   

- **Database Interaction:** The framework includes a database component that provides an abstraction layer for interacting with the database, simplifying common database operations for querying.

- **Model:** The framework includes a model component that allows developers to define and interact with database tables using object-oriented programming principles.

- **Request Handling:** The framework includes functionality for handling HTTP requests, allowing developers to easily access and manipulate data from the request, such as request parameters, headers, and files.

- **Response Handling:** The framework includes functionality for handling HTTP responses, allowing developers to set response headers, send JSON or HTML responses, and redirect to other URLs.

- **Middleware Support:** The framework supports middlewares, which are components that can intercept and modify the incoming request or outgoing response. This allows developers to add custom logic, such as authentication or caching, at different stages of the request-response cycle.

## Installation

To install the PHP MVC Framework, follow these steps:

1. Clone the repository: `git clone https://github.com/ag-sanjjeev/passionate-php-mvc-framework.git`.
2. Navigate to the project directory: `cd repo`.
3. Install dependencies using Composer: `composer install`.
4. Configure the database connection in the `Configuration.php` file inside the core directory.
5. Setup the database as per the configuration given.
6. Start the development server: `php -S localhost:8000 -t public`.

## Usage

After installing the framework, you can start building your web application by following these guidelines:

1. Define your routes in the `main.php` file inside routes directory or by create your own route file inside that directory. This will be taking care by the Application, And each route must caries specific controllers or Callback or View as an action.
2. Create your controllers in the `controllers` directory, implementing the necessary logic for each action.
3. Design your views in the `public/views` directory, using the template or without using template and HTML/CSS.
4. Use the provided models or create your own models in the `models` directory to interact with the database table.
5. Implement authentication and authorization and/or if you can implement any middleware logic as per your application and to meet your needs.

For more usage find out in the [documentation](docs/documentation.md)

## Contributing

Contributions are welcome! If you have any suggestions, bug reports, or feature requests, please open an issue or submit a pull request. Make sure to follow the existing coding style and provide clear documentation for your changes.

## License

This PHP MVC Framework is open-source software licensed under the [MIT license](LICENSE). Feel free to use, modify, and distribute it as per the terms of the license.

## Acknowledgments

We would like to express our gratitude to the open-source community for their contributions and support in building this framework. Thank you to all the developers who will've going to made this project possible in future.

## Contact

If you have any questions or need further assistance, please feel free to reach me by referring [My Github Profile](https://github.com/ag-sanjjeev/)

Thanks for reviewing this project!