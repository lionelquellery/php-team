# php-team | H3 - Symfony project 

Team members:

- Lionel Quellery (CEO)
- Thomas Victoria (CTO)
- Clovis Maniguet (Back-end Developer)
- Lucas Martin (Back-end Developer)
- Inès Sujilens (Designer)

### Environnement

This app runs on:

- PHP 5.6.17

### Installation

- Run `composer selfupdate`
- Run `composer install`

# Utilisation

### /school/

Return all schools in Paris

##### Parameters : 
- location : the distict's number in which the school is. Retrieve all schools if empty

### /school/{uai}/

Return the school's infos and all restaurants in a given radius

##### Parameters :
- radius : the radius in which restaurants must be to be returned. In meters. Default 100m. 

### /school/{uai}/restaurant/{id}/

Return infos about the selected restaurant

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
