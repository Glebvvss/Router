# Router
This is my realization of routing system for websites. The system is similar to Laravel`s routing and RubyOnRails, but if you write your own framework or  project without frameworks with native routing , then this system can help you!

<h2>For initialization of routing in your project you should follow the next steps.</h2>

<h3><b>Step 1: Clone this repository to your project</b></h3>
<p>Clone this repository to your project for using routing system</p>

<hr>

<h3><b>Step 2: Registrate routes</b></h3>
<h5>Syntax of registration</h5>

<p>
  use Service\Router\Router; //include router class to your registration routes file <br>
  Router::regRoute($routeTemplate, $classAndMEthodOfcontroller); //registration method of Router class <br>
<p>

<h6>params of above method</h6>
<p>
  <b>$routeTemplate</b> - template of route for registration. <br>
  
  syntax of GET params inside route template <br>
  <b>#~nameOfParam#</b> - this is required GET param syntax; <br>
  <b>#~nameOfParam;opt#</b> - this is optional GET param syntax; <br>
</p>

<p>
  <b>$classAndMEthodOfcontroller</b> - full name of class with namespace and method of this class. <br>
  <b>-></b> - separator, which white between class name and method name
</p>

<h5>Example</h5>
<p>
  //example of simple route <br>
  Router::regRoute('/simple/route/without/GET/params', 'Namespace\Of\UsingClass\ClassName->classMethod');
</p>

<p>
  //example of route with required GET params <br>
  Router::regRoute('/route/with/#~requiredGetParam#', 'Namespace\Of\UsingClass\ClassName->classMethod');
</p>

<p>
  //example of route with optional GET params <br>
  Router::regRoute('/route/with/#~optionalGetParam;opt#', 'Namespace\Of\UsingClass\ClassName->classMethod');
</p>
<hr>

<h3><b>Step 3: launching the router</b></h3>
<p><b>You can launch Router with the help of class named Service\Router\Router or Service\Router\RouterFacade</b></p>

<h5>The syntax for running via the Service\Router\Router</h5>
<p>
  <b>use Service\Router\Router;<br></b>
  <b>(new Router())->run();</b>
</p>
<p>
  If you need include external file of registration routing you can do this as follows: <br>
    <b>use Service\Router\Router;<br></b>
    <b>(new Router())<br>
        ->addSourceRoutes('path/to/external/file/with/registration/routes/from/the/DOCUMENT_ROOT/directory')<br>
        ->run();</b>
</p>

<p>
  If you need change base directory for external file of registration routing you can do this as follows: <br>
    <b>use Service\Router\Router;<br></b>
    <b>(new Router())<br>
        ->setRootDirectory('path/to/directory/of/external/files/of/routing')
        ->addSourceRoutes('path/to/external/file/with/registration/routes/from/RootDirectory')<br>
        ->run();</b>
</p>
