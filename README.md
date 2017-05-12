[![Latest Stable Version](https://img.shields.io/packagist/v/gpslab/shmop.svg?maxAge=&label=stable)](https://packagist.org/packages/gpslab/shmop)
[![Total Downloads](https://img.shields.io/packagist/dt/gpslab/shmop.svg?maxAge=)](https://packagist.org/packages/gpslab/shmop)
[![Build Status](https://img.shields.io/travis/gpslab/shmop.svg?maxAge=)](https://travis-ci.org/gpslab/shmop)
[![Coverage Status](https://img.shields.io/coveralls/gpslab/shmop.svg?maxAge=)](https://coveralls.io/github/gpslab/shmop?branch=master)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/gpslab/shmop.svg?maxAge=)](https://scrutinizer-ci.com/g/gpslab/shmop/?branch=master)
[![SensioLabs Insight](https://img.shields.io/sensiolabs/i/9b72d25e-8dca-4b71-a8a5-a1ec92050982.svg?maxAge=&label=SLInsight)](https://insight.sensiolabs.com/projects/9b72d25e-8dca-4b71-a8a5-a1ec92050982)
[![StyleCI](https://styleci.io/repos/91094997/shield?branch=master)](https://styleci.io/repos/91094997)
[![License](https://img.shields.io/packagist/l/gpslab/shmop.svg?maxAge=)](https://github.com/gpslab/shmop)

# Shmop

Shmop is a simple and small abstraction layer for shared memory manipulation using PHP

## Installation

Pretty simple with [Composer](http://packagist.org), run:

```sh
composer require gpslab/shmop
```

## Usage

Creating new block

```php
use GpsLab\Component\Shmop\Block;

$sh = new Block(
    0xFF, // id for memory block
    3 // memory block size
);
$sh->write('foo');
echo $sh->read(); // print 'foo'
$sh->delete();
```

Reading an existing block

```php
use GpsLab\Component\Shmop\Block;

$sh = new Block(0xFF, 3);
// print contents of memory block. if block is not exists prints a blank line
echo $sh->read();
```

## License

This bundle is under the [MIT license](http://opensource.org/licenses/MIT). See the complete license in the file: LICENSE
