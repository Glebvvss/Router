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
  <b>-></b> - separator, which whire between class name and method name
</p>

<h5>Example</h5>

Router::regRoute($routeTpl, $classAndMEthodOfcontroller);
