# project 
[![Latest Stable Version](https://poser.pugx.org/frdl/project/version)](https://packagist.org/packages/frdl/project)[![Total Downloads](https://poser.pugx.org/frdl/project/downloads)](https://packagist.org/packages/frdl/project)[![License](https://poser.pugx.org/frdl/project/license)](https://packagist.org/packages/frdl/project)

Kickstarter boilerplate to be used by `composer create-project` command. Demo/Test Application.


## Installation
### Installation (via UI) - Recommended way
https://webfan.de/install/php/ provides an UI you can download and use to create projects by web-interface.


### Installation (via Composer) - Optional way
* Create boilerplate (optional)
````
composer create-project frdl/project <dir>
````
* Make directory `./web` public, e.g. by creating a vhost with this dir as DOCUMENT_ROOT.
* Login to `./web/admin.php` with the default-password "admin" and CHANGE THE PASSWORD!
* Visit `System`, configure the requirements, install the Installer, create a project...


## Usage
![Create Project](https://cdn.webfan.de/screenshots/frdlweb_new_project.jpg)
![Add dependencies](https://cdn.webfan.de/screenshots/frdlweb_composer_ui.jpg)
![Compile your project](https://cdn.webfan.de/screenshots/frdlweb_compile.jpg)

## Modules/Extensions
To develop a Module for this framework, you have to publish a package of type "frdl-module" or "frdl-extension".
Following the directory-structure and naming conventions of the framework it will be [compiled](https://webfan.de/install/?salt=&source=Webfan/App/AppBuilderServiceProvider) by frdl.
Documentation follows/to do...

### Example Modules
 * [Official Frdlweb/Webfan Packages Repository...](https://packages.frdl.de/)
 * [Domain Whois Module](https://github.com/frdl/whois)
 * [Web Assets Extension Module](https://github.com/frdl/web-assets)
 * [Contact Form Module](https://frdl.webfan.de/cdn/0.0.10.1/packages/frdl/contact-form/)

## Homepage
 * [Getting started](https://webfan.de/install/)
 * [Forum](https://frdl.webfan.de/forum/)
