# (un)serialize decorator for react/cache

[![Build Status](https://travis-ci.org/WyriHaximus/reactphp-cache-serialize.svg?branch=master)](https://travis-ci.org/WyriHaximus/reactphp-cache-serialize)
[![Latest Stable Version](https://poser.pugx.org/WyriHaximus/react-cache-serialize/v/stable.png)](https://packagist.org/packages/WyriHaximus/react-cache-serialize)
[![Total Downloads](https://poser.pugx.org/WyriHaximus/react-cache-serialize/downloads.png)](https://packagist.org/packages/WyriHaximus/react-cache-serialize)
[![Code Coverage](https://scrutinizer-ci.com/g/WyriHaximus/reactphp-cache-serialize/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/WyriHaximus/reactphp-cache-serialize/?branch=master)
[![License](https://poser.pugx.org/WyriHaximus/react-cache-serialize/license.png)](https://packagist.org/packages/WyriHaximus/react-cache-serialize)

# Installation

To install via [Composer](http://getcomposer.org/), use the command below, it will automatically detect the latest version and bind it with `^`.

```
composer require wyrihaximus/react-cache-serialize
```

# Usage

Wrap any class implementing `React\Cache\CacheInterface` and it will encode any value you give it to JSON when saving, and decode it back to an array or scalar when fetching:

```php
<?php

$cache = new ArrayCache();
$jsonCache = new Serialize($cache);

$jsonCache->set('key', ['value']); // Store
$jsonCache->get('key')->then(function ($value) {
    var_export($value);
    /**
     * a:1:{i:0;s:5:"value";}
     */
});

```

# License

The MIT License (MIT)

Copyright (c) 2019 Cees-Jan Kiewiet

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
