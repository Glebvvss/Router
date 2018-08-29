# Router
This is my realization of routing system for websites. The system is similar to Laravel`s routing and RubyOnRails, but if you write your own framework or  project without frameworks with native routing , then this system can help you!

<h2>For initialization of routing in your project you should follow the next steps.</h2>

<h3><b>Step 1</b></h3>
<p>Clone this repository to your project</p>
<hr>
<h3><b>Step 2</b></h3>
<p>Registrate routes</p>
<h5>Syntax of registration</h5>

use Service\Router\Router; //include router class to your registration routes file <br>
Router::regRoute($routeTpl, $classAndMEthodOfcontroller); //registration method of Router class <br>

<h6>params of above method</h6>
<b>$routeTpl</b> - template of route for registration. <br>
