# Txiki Events

Simple events for PHP

[![Author](http://img.shields.io/badge/author-@dieg0v-blue.svg?style=flat-square)](https://twitter.com/dieg0v)
[![Latest Version](https://img.shields.io/github/release/dieg0v/txiki-events.svg?style=flat-square)](https://github.com/dieg0v/txiki-events/releases)
[![Packagist Version](https://img.shields.io/packagist/v/txiki/events.svg?style=flat-square)](https://packagist.org/packages/txiki/events)

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/dieg0v/txiki-events/master.svg?style=flat-square)](https://travis-ci.org/dieg0v/txiki-events)


## Install

Via Composer

``` bash
$ composer require txiki/events
```

## Documentation

Simple examples:

``` php
require '../vendor/autoload.php';

use Txiki\Events\Event;

$e = new Event();

$e->on('eventName', function($id){
    return 'ok form '.$id;
});

$e->on('eventName1', function(){
    return 'ok form 1';
});

$e->on('eventName2', function(){
    return 'ok form 2';
});

// return 'ok form 999';
$result = $e->trigger('eventName', [999]);

// return 'ok form 1';
$result = $e->trigger('eventName1');

// return 'ok form 2';
$result = $e->trigger('eventName2');
```

Pass custom class to event:
```php
class DummyClass{
    public function myMethod($foo, $bar)
    {
        return 'Out '.$foo.' '.$bar;
    }
}

$e->on('myevent', 'DummyClass::myMethod');

// return 'Out foo bar';
$result = $e->trigger('myevent',['foo', 'bar']);
```

Remove event:
```php
$e->off('myevent');
```

Get all events array:
```php
$eventsTable = $e->table();
```

## Contributing

Please see [CONTRIBUTING](https://github.com/dieg0v/txiki-events/blob/master/CONTRIBUTING.md) for details.

## Credits

- [Diego Vilariño](https://github.com/dieg0v)
- [All Contributors](https://github.com/dieg0v/txiki-events/contributors)

## License

The MIT License (MIT). Please see [License File](https://github.com/dieg0v/txiki-events/blob/master/LICENSE.md) for more information.
