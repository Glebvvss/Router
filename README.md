# Router
This is my realization of routing system for websites. The system is similar to Laravel`s routing and RubyOnRails, but if you write your own framework or  project without frameworks with native routing , then this system can help you!

For initialization of routing in your project you should follow the next steps.
================================================================================

### Step 1: Clone this repository to your project
Clone this repository to your project for using routing system

<hr>

### Step 2: Registrate routes

#### Syntax of registration

    use Service\Router\Router; //include router class to your registration routes file 
    Router::regRoute($routeTemplate, $classAndMEthodOfcontroller); //registration method of Router class 

#### Params of above method

    $routeTemplate - template of route for registration.
  
    syntax of GET params inside route template
    #~nameOfParam# - this is required GET param syntax;
    #~nameOfParam;opt# - this is optional GET param syntax;


    $classAndMEthodOfcontroller - full name of class with namespace and method of this class.
    -> - separator, which white between class name and method name

#### Examples

    //example of simple route
    Router::regRoute('/simple/route/without/GET/params', 'Namespace\Of\UsingClass\ClassName->classMethod');

    //example of route with required GET params
    Router::regRoute('/route/with/#~requiredGetParam#', 'Namespace\Of\UsingClass\ClassName->classMethod');

    //example of route with optional GET params
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
        ->setRootDirectory('path/to/directory/of/external/files/of/routing')
        ->addSourceRoutes('path/to/external/file/with/registration/routes/from/RootDir')
        ->run();

#### Running via the Service\Router\RouterFacade

**Launching Router through RouterFacade class is very similar on standard launching through Router, bot have some differences**

    RouterFacade::init() return object of class Router
  
Also **RouterFacade::init()** contains **__callStatic** magic method, which allows use all public methods of **Router** object through static calls

#### Examples

    //Simple lauch
    RouterFacade::init()->run();
    //or
    RouterFacade::run();
   
   
    //Lauch with external file of route registration
    RouterFacade::init()
        ->addSourceRoutes('path/to/external/file/for/routes/registration')
        ->run();
    //or
    RouterFacade::addSourceRoutes('path/to/external/file/for/routes/registration')->run();
   
   
    //Lauch with external file of route registration and rebase of route registration files
    RouterFacade::init()
        ->setRootDirectory('path/to/directory/of/external/files/of/routing')
        ->addSourceRoutes('path/to/external/file/for/routes/registration')
        ->run();
    //or
    RouterFacade::setRootDirectory('path/to/directory/of/external/files/of/routing')
        ->addSourceRoutes('path/to/external/file/for/routes/registration')
        ->run();
