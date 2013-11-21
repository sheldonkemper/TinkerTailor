Tinker Taylor
======

Random work which is building up towards a fully fledged project.
Not currently sure where this is going, but have at least decided to create a namespaced php framework to be able to then create modules to plug in.
Most of this code has been ported from a preious project I was working on, named Tinker.

===
A recommended order to view project files(currently) to get an understanding is:  
  *  From `index.php` in root, which initializes the Router class,  
  *  The router class is found in `Router.php` in `\Sheldon\Router`. This class does some work with the url, then loades the Controller.  
  *  Controller is found in `Controller.php` in `\Sheldon\Controller`. Currently does not do much, basically loads the Module file.  
  *  Default Module file is found in `Module\index`. This loads if a specific url parameter has not been passed, which is ?m={MOULENAME}. The module files will be what has been modelled for the application. So we will have a User module. a Admin module and other yet to be defined.

===
####TODO
  *  Would like to work out how to load a number of modules as  blocks in any give url. 

 
===

Author: sheldonkemper  
Copyright 2013-2014 Sheldon Kemper  
License http://opensource.org/licenses/GPL-3.0



