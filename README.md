# project 
[![Latest Stable Version](https://poser.pugx.org/frdl/project/version)](https://packagist.org/packages/frdl/project)[![Total Downloads](https://poser.pugx.org/frdl/project/downloads)](https://packagist.org/packages/frdl/project)[![License](https://poser.pugx.org/frdl/project/license)](https://packagist.org/packages/frdl/project)
Kickstarter boilerplate to be used by `composer create-project` command. Demo/Test Application.

## Installation
* Create boilerplate (optional)
````
composer create-project frdl/project <dir>
````
* Make directory `web` public, e.g. by creating a vhost with this dir as DOCUMENT_ROOT.
* Login to `web/admin.php` with the default-password "admin" and CHANGE THE PASSWORD!
* Visit `System`, configure the requirements and Install the Installer.

## Installer UI Download
https://webfan.de/install/php/ provides an UI you can download and use to create projects by web-interface.

## Usage
![Create Project](https://cdn.webfan.de/screenshots/frdlweb_new_project.jpg)
![Add dependencies](https://cdn.webfan.de/screenshots/frdlweb_composer_ui.jpg)
![Compile your project](https://cdn.webfan.de/screenshots/frdlweb_compile.jpg)

## Modules
To develop a Module for this framework, you have to publish a package of type "frdl-module".
Following the directory-structure and naming conventions of the framework it will be [compiled](https://webfan.de/install/?salt=&source=Webfan/App/AppBuilderServiceProvider) by frdl.
Documentation follows/to do...

### Example Modules
 * https://packages.frdl.de/
 * https://github.com/frdl/whois

## Homepage
https://frdl.de
