# php-team | H3 - Symfony project 

Project : STUDENT CHECK
Help students find good deals near their school's geographical area (restaurants, flats, objects, ...)

URL :
http://188.166.147.133:8000/

Complete API documentation : 
http://lucasmartin.fr/StudentCheckDocumentation/namespaces/AppBundle.html

Team members:

- Lionel Quellery (CEO)
- Thomas Victoria (CTO)
- Clovis Maniguet (Back-end Developer)
- Lucas Martin (Back-end Developer)
- Inès Suijlen (Developer)

### Environnement

This app runs on:

- PHP 5.6.17

### Installation

- Run `composer selfupdate`
- Run `composer install`

# Utilisation

You must pass a key parameter containing your api token for each of your requests

### Postman Script
To test the API you can use [Postman](https://www.getpostman.com) and load the script below:
- [Script Postman](https://infinit.io/_/WiTRrJ2)

### /school/

Returns all schools in Paris

##### Parameters : 
- location : the distict's number in which the school is located. Retrieves all schools if empty

### /school/{uai}/

Returns the school's infos

### /school/{uai}/restaurant/

Return all resturant around the school in a given radius. Default 100 meters.

##### Parameters :
- radius : the radius in which restaurants must be to be returned. In meters. Default 100m. 

### /school/{uai}/restaurant/{id}/

Returns infos about the selected restaurant

### /school/{uai}/object/

Returns all objects that belong to this school

### /school/{uai}/object/{id}/

Returns infos of the selected object

### /school/{uai}/object/new/

Creates a new object

##### Parameters (all required):
- name (string)
- price (int)
- description (string)
- type (int)
- thumbnail (string)
- album (string)

### /school/{uai}/object/edit/

Updates a existent object

##### Parameters :
- name (string)
- price (int)
- description (string)
- type (int)
- thumbnail (string)
- album (string)

### /school/{uai}/object/{id}/delete/

Deletes an object

### /school/{uai}/flat/

Returns all flat that belong to this school

### /school/{uai}/flat/{id}/

Returns infos of the selected flat

### /school/{uai}/flat/new/

Creates a new flat

##### Parameters (all required):
- name (string)
- price (int)
- description (string)
- type (int)
- thumbnail (string)
- album (string)
- date (int)
- longitude (int)
- latitude (int)

### /school/{uai}/flat/edit/

Updates an existent flat

##### Parameters :
- name (string)
- price (int)
- description (string)
- type (int)
- thumbnail (string)
- album (string)
- date (int)
- longitude (int)
- latitude (int)

### /school/{uai}/flat/{id}/delete/

Deletes a flat

### /user/new/

Creates new user account 

##### Parameters :
- mail (REQUIRED) : your mail
- pass (REQUIRED) : your account password

### /user/token/

Returns your account's token

##### Parameters : 
- mail (REQUIRED) : your mail's account
- pass (REQUIRED) : your password's account



### The MIT License (MIT)

Copyright (c) 2016 Lionel Quellery

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.


<!-- Symfony Standard Edition
========================

Welcome to the Symfony Standard Edition - a fully-functional Symfony
application that you can use as the skeleton for your new applications.

For details on how to download and get started with Symfony, see the
[Installation][1] chapter of the Symfony Documentation.

What's inside?
--------------

The Symfony Standard Edition is configured with the following defaults:

* An AppBundle you can use to start coding;

* Twig as the only configured template engine;

* Doctrine ORM/DBAL;

* Swiftmailer;

* Annotations enabled for everything.

It comes pre-configured with the following bundles:

* **FrameworkBundle** - The core Symfony framework bundle

* [**SensioFrameworkExtraBundle**][6] - Adds several enhancements, including
template and routing annotation capability

* [**DoctrineBundle**][7] - Adds support for the Doctrine ORM

* [**TwigBundle**][8] - Adds support for the Twig templating engine

* [**SecurityBundle**][9] - Adds security by integrating Symfony's security
component

* [**SwiftmailerBundle**][10] - Adds support for Swiftmailer, a library for
sending emails

* [**MonologBundle**][11] - Adds support for Monolog, a logging library

* **WebProfilerBundle** (in dev/test env) - Adds profiling functionality and
the web debug toolbar

* **SensioDistributionBundle** (in dev/test env) - Adds functionality for
configuring and working with Symfony distributions

* [**SensioGeneratorBundle**][13] (in dev/test env) - Adds code generation
capabilities

* **DebugBundle** (in dev/test env) - Adds Debug and VarDumper component
integration

All libraries and bundles included in the Symfony Standard Edition are
released under the MIT or BSD license.

Enjoy!

[1]:  https://symfony.com/doc/2.8/book/installation.html
[6]:  https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/index.html
[7]:  https://symfony.com/doc/2.8/book/doctrine.html
[8]:  https://symfony.com/doc/2.8/book/templating.html
[9]:  https://symfony.com/doc/2.8/book/security.html
[10]: https://symfony.com/doc/2.8/cookbook/email.html
[11]: https://symfony.com/doc/2.8/cookbook/logging/monolog.html
[13]: https://symfony.com/doc/2.8/bundles/SensioGeneratorBundle/index.html
-->
