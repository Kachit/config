Simple config management library
========
[![License](https://poser.pugx.org/leaphly/cart-bundle/license.svg)](https://packagist.org/packages/leaphly/cart-bundle)
[![Build Status](https://travis-ci.org/Kachit/config.svg?branch=master)](https://travis-ci.org/Kachit/config)
[![Latest Stable Version](https://poser.pugx.org/kachit/config/v/stable)](https://packagist.org/packages/kachit/config)
[![Total Downloads](https://poser.pugx.org/kachit/config/downloads)](https://packagist.org/packages/kachit/config)

```php
<?php

$reader = new Kachit\Config\Reader\Php();
$manager = new Kachit\Config\Manager($reader);

$config = $manager->read('/path/to/config/file');

$bar = $config->foo->bar;
```