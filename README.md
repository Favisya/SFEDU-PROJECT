Vikulin Dmitrii KTbo3-1
==========
Webservice with MVC pattern
----------------------------------
### OS and version
- linux mint 20.01
- PHP 7.3.3
- mysql 5.7.37
### Setup
There is few step:
- Go to the .env.sample and fill empty fields
- rename to .env
- run `composer install`
- run `php -S localhost:3000`

### What the task?

- connect DB to project
- make forms for DB. Edit, add and delete.
- make webservice for DB
- Write normal README

### Directory architecture
- App the main dir with code
- AppFacade       - facade for run app
- Block           - here blocks for views
- Controllers     - here controllers
- Database        - here database connection
- Exceptions      - here exceptions
- Models          - here models and resource
- Models/Resource - here resources for models
- Router          - here is router for switching pages
- Styles          - here is all styles
- templates       - here templates for all pages
- View            - here all phtml pages

### Classes
#### AppFacade
Facade for run app

fields:
- `private static $instance`

Methods:
- `public static function getInstance(): self`
- `public function runApp(): void`

#### Block

Fields: 

- `protected $template`
- `protected $model = []`

Methods:

- `public function render()`
- `public function setModel(ModelAbstract $model)`
- `public function setTemplate(string $template)`

### AbstractController
Class for all controllers

Methods:
- `public function execute()` here is connection for models, resources and etc. 
- `public function commonExecute(string $template, ModelAbstract $model = null, string $blockName = 'Block')`
- `public function getPostParam(string $key)`
- `public function redirect(string $path)`

### Database
Class for connection to DB

Fields:

- `private static $instance`

Methods: 

- `public static function getInstance(): self`
- `public function getConnection(): \PDO`

### MvcException
Extend to \Exception

### AbstractModel
Class for models

Methods:

- `public function getData(): ?array`
- `public function setData(array $data)`
- `public function __toString()`

### AuthorsResource for example of Resources
Class for get data from DB and set to Model

- `public function executeQuery(): AbstractModel`

### Environment 
Class for local configuration

Fields:

- `protected $settings`

Methods: 

- `public function __construct()`
- `public function getDatabase()`
- `public function getUri()`

### Router
Class for switch controllers to render pages and etc.

Methods: 

- `public function parseControllers(string $path): ?Controllers\AbstractController`

