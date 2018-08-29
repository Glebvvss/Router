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
<p>You can launch Router with the help of class named Service\Router\Router or Service\Router\RouterFacade</p>

<h4>Running via the Service\Router\Router</h4
<p>
  Base launch where routes ragistrated in the index file above runner<br>
  <b>(new Router())->run();</b>
</p>
<p>
  If you need include external file of registration routing you can do this as follows: <br>
    <b>(new Router())<br>
        &nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp->addSourceRoutes('path/to/external/file/with/registration/routes/from/the/DOCUMENT_ROOT/directory')<br>
        &nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp->run();</b>
</p>

<p>
  Also you can include more than one external files of registration routing if you can do this as follows: <br>
    <b>(new Router())<br>
        &nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp->addSourceRoutes('path/to/external/file/with/registration/routes/from/the/DOCUMENT_ROOT/directory')<br>
        &nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp->addSourceRoutes('path/to/another/external/file/with/registration/routes/from/the/DOCUMENT_ROOT/directory')<br>
        &nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp->run();</b>
</p>

<p>
  If you need change base directory for external files of registration routing you can do this as follows: <br>
    <b>(new Router())<br>
        &nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp->setRootDirectory('path/to/directory/of/external/files/of/routing')<br>
        &nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp->addSourceRoutes('path/to/external/file/with/registration/routes/from/RootDirectory')<br>
        &nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp->run();</b>
</p>


<h4>Running via the Service\Router\RouterFacade</h4>

<p>Launching Router through RouterFacade class is very similar on standard launching through Router, bot have some differences</p>

<p>
  <b>RouterFacade::init()</b> return object of class <b>Router</b>;
</p>
<p>
  Also <b>RouterFacade::init()</b> contain __callStatic magic method, which allows use all public methods of <b>Router</b> object through static calls
</p>

<h4>Example</h4>
<p>
  Simple lauch<br>
  <b>RouterFacade::init()->run();</b><br>
  or<br>
  RouterFacade::run();
</p>

<p>
  Lauch with external file of route registration<br>
  <b>
    RouterFacade::init()
    &nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp->addSourceRoutes('path/to/external/file/for/routes/registration')
    &nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp->run();
  </b><br>
  or<br>
  RouterFacade::addSourceRoutes('path/to/external/file/for/routes/registration')->run();
  </b><br>
</p>
