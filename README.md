NzoLeftSidebarBundle
====================

The **NzoLeftSidebarBundle** is a Symfony Bundle used to handle Left SideBare Menu.

###### This Bundle is compatible with **Symfony >= 4.4**

#### Installation

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
    app_environment_name: '%env(APP_ENV)%'  # optional, it used when "accepted_environment_names" parameter is set.
    menu:
        user:
            label: Admin Users
            href: /user                               # href
            icon: users
            class: bn-danger                          # CSS class
            role: ROLE_ADMIN
            accepted_environment_names: [prod, dev]   # optional
        article:
            label: Articles
            href: article_index                       # route name
            icon: feather
            role: ROLE_USER
        children:
            article_foo:
                label:Foo
                href: /foo
                icon: fa fa-play-circle
                role: ROLE_USER
                children:
                    article_foo_bar:
                        label: bar
                        href: foo/bar
                        icon: fa fa-video-camera
                        role: ROLE_USER
```

##### Override the default template:
I's possible de override the default template:

templates/  
&nbsp;&nbsp;&nbsp;└─ bundles/  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└─ NzoLeftSidebarBundle/  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└─ left-sidebar.html.twig  

#### License

This bundle is under the MIT license. See the complete license in the bundle:

See [LICENSE](https://github.com/nayzo/NzoLeftSidebarBundle/tree/master/LICENSE)
