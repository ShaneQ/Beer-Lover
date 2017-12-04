BreweryCI
By Shane Quaid
Setup information:
Hosted address:
##your localhost address##/webapp/index.php/- Use this directory on top of you localhost directory
e.g. Mine is http://localhost/~shanequaid / webapp/index.php/

Points to note:
Class autoloaders:
•	This project is using a LAMP stack
•	M ysql Files are stored in
•	WebApp/SQL setup/
•	You will have to input your db configuration data into /Users/shanequaid/Sites/WebApp/application/config/database.php

This project uses the Rest API from
•	http://www.brewerydb.com/developers/apps
•	Brewery DB provides an PHP integration class which is stored in /Users/shanequaid/Sites/WebApp/application/services/external/Pintlabs/Service

Framework:
Codeignighter.
I used this for its implementation of the MVC framework and for its error display methods
I had one issue I choose to leave which was that I had a difficulty with the Frameworks

Composer Packages:
PHPUnit
Respect Validator – I used this for validating form inputs in my controllers once or twice when I could not use the Codignigter form helper.

Areas inside the framework where my files are saved:
WebApp/application/controllers/
WebApp /application/views/
WebApp /application/services /
WebApp /application/assets/

Javascript Libraries:
Jquery
Bootstrap
Sweet Alert
Datatables

Style libraries
Boostrap
