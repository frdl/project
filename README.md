# project 
[![Latest Stable Version](https://poser.pugx.org/frdl/project/version)](https://packagist.org/packages/frdl/project)[![Total Downloads](https://poser.pugx.org/frdl/project/downloads)](https://packagist.org/packages/frdl/project)[![License](https://poser.pugx.org/frdl/project/license)](https://packagist.org/packages/frdl/project)

Kickstarter boilerplate to be used by `composer create-project` command. Demo/Test Application.


## Installation
### Installation (via UI) - Recommended way
https://frdl.webfan.de/install/php/ provides an UI you can download and use to create projects by an [web-interface-UI](#webadmin).


### Configuration and Usage
* Create boilerplate (optional) `not yet supported`
````
composer create-project frdl/project <dir>
````
<a name="webadmin"></a>
* Make directory `./web` public, e.g. by creating a vhost with this dir as DOCUMENT_ROOT.
* Login to `./web/admin.php` with the username of the process the current (web-)script is running on and the default-password "admin" and CHANGE THE PASSWORD!
* Setup:
  * Visit the `System` Menu to setup and configure the requirements:
        * Setup `Composer` in the `System`-Page       
        * Setup `Workspace Directory` in the `System`-Page       
        * Setup `Node.js`and `npm` in the `System`-Page       
        * Setup `git` in the `System`-Page       
        * Setup `frdl.js` in the `System`-Page       
        * Finalize the installation, klick `Install Webfan PHP-Installer` in the `System`-Page
   * Manage your Projects:   
         * Create your first project in the `Project`-Page via the `Create Project`-Button
         * Add the dependencies and `frdl-module` packages by visiting the `Project`->`Composer` Menu
         * Install the dependencies
         * Setup and configure your `frdl-module`s via visiting the `Project`->`Configuration`-Menu
         * Click `Compile Project` in the `Endpoint`-Page to compile the application using `frdl` and `frdl.js`    
    
 * `Tip: rename the admin.php file to a new name harder to guess!`
 * `Tip: enable the autoupdate and adminalert features and options if present!`
 

## Screenshots
![Create Project](https://cdn.webfan.de/screenshots/frdlweb_new_project.jpg)
![Add dependencies](https://cdn.webfan.de/screenshots/frdlweb_composer_ui.jpg)
![Compile your project](https://cdn.webfan.de/screenshots/frdlweb_compile.jpg)

## Modules/Extensions
To develop a Module for this framework, you have to publish a package of type "frdl-module" or "frdl-extension".
Following the directory-structure and naming conventions of the framework it will be [compiled](https://frdl.webfan.de/install/?salt=&source=Webfan/App/AppBuilderServiceProvider) by frdl.
Documentation follows/to do...

### Example Modules
 * [Official Frdlweb/Webfan Packages Repository...](https://packages.frdl.de/)
 * [Domain Whois Module](https://github.com/frdl/whois)
 * [Web Assets Extension Module](https://github.com/frdl/web-assets)
 * [Contact Form Module](https://frdl.webfan.de/cdn/0.0.10.1/packages/frdl/contact-form/)

## Homepage
 * [Getting started](https://frdl.webfan.de/install/)
 * [Forum](https://frdl.webfan.de/forum/)
