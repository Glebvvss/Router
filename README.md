# Router
This is my simple realization of routing system for websites.

### For initialization of routing in your project you should follow the next steps.

### Step 1: Clone this repository to your project
Clone this repository to your project for using routing system

<hr>

### Step 2: Routes registration

#### Syntax of registration

    use Service\Router\Router; //include Router class to your registration routes file or start point of project
    Router::regRoute($routeTemplate, $classAndMEthodOfcontroller); //write registration method of Router class 

#### Params of above method

    $routeTemplate - template of route;
  
    //syntax of GET params inside route template
    #~nameOfParam# - this is required GET param syntax;
    #~nameOfParam;opt# - this is optional GET param syntax;


    $classAndMEthodOfcontroller - full name of class with namespace and method of this class;
    -> - separator, which is written between the class name and the method name;

#### Examples

    //example of simple route
    Router::regRoute('/simple/route/without/GET/params', 'Namespace\Of\UsingClass\ClassName->classMethod');

    //example of route with the required GET param
    Router::regRoute('/route/with/#~requiredGetParam#', 'Namespace\Of\UsingClass\ClassName->classMethod');

    //example of route with the optional GET param
    Router::regRoute('/route/with/#~optionalGetParam;opt#', 'Namespace\Of\UsingClass\ClassName->classMethod');

<hr>

### Step 3: launching the router
You can launch Router with the help of class named Service\Router\Router or Service\Router\RouterFacade

#### Running via the Service\Router\Router

    //Base launch where routes ragistrated in the index file above runner<br>
    (new Router())->run();
  
  
    //If you need include external file of registration routing you can do this as follows:
    (new Router())
        ->addSourceRoutes('path/to/external/file/with/registration/routes/from/the/DOCUMENT_ROOT/directory')
        ->run();        
  
  
    //Also you can include more than one external files of registration routing if you can do this as follows:
    (new Router())
        ->addSourceRoutes('path/to/external/file/with/registration/routes/from/the/DOCUMENT_ROOT/directory')
        ->addSourceRoutes('path/to/another/external/file/with/registration/routes/from/the/DOCUMENT_ROOT/directory')
        ->run();


    //If you need change base directory for external files of registration routing you can do this as follows:
    (new Router())
        ->setRootDirectory('path/to/directory/of/external/files/of/routing')//by default equals $_SERVER['DOCUMENT_ROOT']
        ->addSourceRoutes('path/to/external/file/with/registration/routes/from/RootDir')
        ->run();

#### Running via the Service\Router\RouterFacade

Launching **Router** through **RouterFacade** class is very similar on standard launching through **Router**, but have some differences.

**RouterFacade::init()** return object of class **Router**. Also **RouterFacade::init()** contains **__callStatic** magic method, which allows use all public methods of **Router** object through static calls

#### Examples

    //Simple launch with registration of routes above Router initilalization in start point of project 
    RouterFacade::init()->run();
    //or
    RouterFacade::run();
   
   
    //Launch with external file of routes
    RouterFacade::init()
        ->addSourceRoutes('path/to/external/file/for/routes/registration')
        ->run();
    //or
    RouterFacade::addSourceRoutes('path/to/external/file/for/routes/registration')->run();
   
   
    //Launch with external file of routes and with changed root directory of rout files
    RouterFacade::init()
        ->setRootDirectory('path/to/directory/of/external/files/of/routing')
        ->addSourceRoutes('path/to/external/file/for/routes/registration')
        ->run();
    //or
    RouterFacade::setRootDirectory('path/to/directory/of/external/files/of/routing')
        ->addSourceRoutes('path/to/external/file/for/routes/registration')
        ->run();
