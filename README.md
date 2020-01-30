# project
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

## Homepage
https://frdl.de

## Usage
![Create Project](https://cdn.webfan.de/screenshots/frdlweb_new_project.jpg)
![Add dependencies](https://cdn.webfan.de/screenshots/frdlweb_composer_ui.jpg)
![Compile your project](https://cdn.webfan.de/screenshots/frdlweb_compile.jpg)

## Modules
To develop a Module for this framework, you have to publish a package of type "frdl-module".
Following the directory-structure and naming conventions of the framework it will be compiled by frdl.
Documentation follows/to do...

### Example Modules
https://packages.frdl.de/
https://github.com/frdl/whois
