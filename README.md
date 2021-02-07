NzoLeftSidebarBundle
====================

[![Build Status](https://travis-ci.org/nayzo/NzoLeftSidebarBundle.svg?branch=master)](https://travis-ci.org/nayzo/NzoLeftSidebarBundle)
[![Latest Stable Version](https://poser.pugx.org/nzo/left-sidebar-bundle/v/stable)](https://packagist.org/packages/nzo/left-sidebar-bundle)


The **NzoLeftSidebarBundle** is a Symfony Bundle used to handle Left SideBare Menu.

###### This Bundle is compatible with **Symfony >= 4.4**

Installation
------------

### Through Composer:

```
$ composer require nzo/left-sidebar-bundle
```

#### Register the bundle in config/bundles.php (without Flex)

``` php
// config/bundles.php

return [
    // ...
    Nzo\LeftSidebarBundle\NzoLeftSidebarBundle::class => ['all' => true],
];
```

#### Configure the bundle:

``` yml
# config/packages/nzo_left_sidebar.yaml

nzo_left_sidebar:
    menu:
        user:
            label: Admin Users
            route_or_uri: /user                               # uri href
            icon: users
            cssClass: bn-danger
            role: ROLE_ADMIN
            accepted_environment_names: [prod, dev]   # optional
        article:
            label: Articles
            route_or_uri: article_index                       # route name
            icon: feather
            role: ROLE_USER
            children:
                article_foo:
                    label: Foo
                    route_or_uri: /foo
                    icon: fa fa-play-circle
                    role: ROLE_USER
                    children:
                        article_foo_bar:
                            label: bar
                            route_or_uri: foo/bar
                            icon: fa fa-video-camera
                            role: ROLE_USER
```

##### Override the default template:
It is possible de override the default template:

templates/  
&nbsp;&nbsp;&nbsp;└─ bundles/  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└─ NzoLeftSidebarBundle/  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└─ left-sidebar.html.twig  

License
-------

This bundle is under the MIT license. See the complete license in the bundle:

See [LICENSE](https://github.com/nayzo/NzoLeftSidebarBundle/tree/master/LICENSE)
