Drupal.org API Component
==============

Drupal.org provides a public API for retrieving common data includes all node types, users, comments and more. You can find documentation on that here: https://www.drupal.org/api

Using this SDK:
==============

This SDK provides a simple PHP layer for interacting with Drupal.org's API. Currently it supports Users and Nodes with special handling for Project Issue & Page Nodes.

Getting a new DrupalClient class is typically done through the static DrupalClient::create() method.

```php
<?php

use EclipseGc\DrupalOrg\Api\DrupalClient;

$client = DrupalClient::create();

?>
```

This will provide you a fully instantiated DrupalClient that will return data objects specific to your requests. As of right now, only individual Users and Nodes are supported. Retrieving a user can be done via the DrupalClient::getUser() method.

```php
<?php

use EclipseGc\DrupalOrg\Api\DrupalClient;

$client = DrupalClient::create();

$user = $client->getUser(1);

?>
```

This would return Dries' user information.

Retrieving Nodes is equally straight-forward:

```php
<?php

use EclipseGc\DrupalOrg\Api\DrupalClient;

$client = DrupalClient::create();

$node = $client->getNode(4);

?>
```

What's nice about this though is that the returns are all object which can be chained when appropriate. As such, if we wanted the author of node 4, we need only:

```php
<?php

use EclipseGc\DrupalOrg\Api\DrupalClient;

$client = DrupalClient::create();

$user = $client->getNode(4)->getAuthor();

?>
```

This will return us a user object the same as the DrupalClient::getUser() method does. Many methods on the available objects have resources to which they could navigate.

Filling in the Blanks
===================

Much of what's here currently is cursory. Something I threw together to get people started. Nodes will all work, but custom classes can and should be built for specific node types. Currently only ProjectIssues and Pages are supported. I extracted essentially a base class Node from their overlap, and tried to create traits that made sense accordingly. Adding new NodeInterface implementing classes to \EclipseGc\DrupalOrg\Api\Resources\Node that are Pascal cased of the node bundle's name. For example a project_distribution node type class would be ProjectDistribution. The existing NodeInterface::getClass() method will return the appropriate class once it is available.

Adding new entity type base classes should be fairly straight forward. The system leverages Reflection for class instantiation. This is because the data objects are treated very rudimentarily in order to keep them as simple as possible. Constructors with many parameters (one for each top level json key in the response) are the order of the day. This is a bit tiresome but results in clean class properties and getter methods that we can document properly. Comments, Taxonomy Terms and Field Collects will all certainly need doing. Other entity types may become obvious as we continue. Look at Node::getClass() if you need references to how to do bundle-specific classes for your return objects.

Writing a Caching Layer
==================

Caching the results in something like Redis or similar should be fairly easy with a decorator pattern on the FactoryInterface. There's a static method on the DrupalClient class specific to this purpose which you can get, decorate and then manually inject into the DrupalClient during instantiation instead of relying on the DrupalClient::create() method.

This can be simply through:

```php
<?php

use EclipseGc\DrupalOrg\Api\DrupalClient;

$factory = DrupalClient::createFactory();
$decoratedFactory = new MyExampleCachedFactory($factory);
$client = new DrupalClient($decoratedFactory);

?>
```

With something this simple, we should be able to provide some measure of caching support to the use case with a simple pattern.
