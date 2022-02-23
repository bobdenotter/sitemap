# Bolt Sitemap Extension

Author: Bob den Otter

This Bolt extension can be used to add a `sitemap.xml` to your site..

Installation:

```bash
composer require bobdenotter/sitemap
```

.. and, you're good to go! Visit `/sitemap.xml` on your site, and you should 
see the result!

**Warning:** To generate the correct new links to contenttypes using overrides in `routes.yaml`, update your ContentType definition by setting e.g. `record_route: pagebinding`. Otherwise, the sitemap will still show Bolt's default routes.


-------

The part below is only for _developing_ the extension. Not required for general
usage of the extension in your Bolt Project.

## Running PHPStan and Easy Codings Standard

First, make sure dependencies are installed:

```bash
COMPOSER_MEMORY_LIMIT=-1 composer update
```

And then run ECS:

```bash
vendor/bin/ecs check src --fix
```
