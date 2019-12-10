# Array from object

[![Build Status](https://travis-ci.com/TomHart/array-from-object.svg?branch=master)](https://travis-ci.com/TomHart/array-from-object)
[![codecov](https://codecov.io/gh/TomHart/array-from-object/branch/master/graph/badge.svg)](https://codecov.io/gh/TomHart/array-from-object)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/TomHart/array-from-object/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/TomHart/array-from-object/?branch=master)
![GitHub release (latest by date)](https://img.shields.io/github/v/release/TomHart/array-from-object?color=green)
![GitHub](https://img.shields.io/github/license/TomHart/array-from-object?color=green)

This library allows you to populate an array, pulling properties and nested properties from an object.

### Usage

Simple example:
```php
$params = ['name', 'id'];

$class = new \stdClass();
$class->name = 'name';
$class->id = 1;

$data = ArrayUtil::populateArrayFromObject($params, $class); 
// ['name' => 'name', 'id' => 1]
```

Nested example:
```php
$params = ['name', 'id', 'extra->name'];

$class = new \stdClass();
$class->name = 'name';
$class->id = 1;

$class2 = new \stdClass();
$class2->name = 'name-2';
$class->extra = $class2;

$data = ArrayUtil::populateArrayFromObject($params, $class); 
// ['name' => 'name', 'id' => 1, 'extra->name' => 'name-2']
```

Providing missing data example:
```php
$params = ['name', 'id', 'extra'];

$class = new \stdClass();
$class->name = 'name';
$class->id = 1;

$data = ArrayUtil::populateArrayFromObject($params, $class, [
    'extra' => 'static'
]); 
// ['name' => 'name', 'id' => 1, 'extra' => 'static']
```