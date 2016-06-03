[![Latest Stable Version](https://poser.pugx.org/anime-db/shmop/v/stable.png)](https://packagist.org/packages/anime-db/shmop)
[![Latest Unstable Version](https://poser.pugx.org/anime-db/shmop/v/unstable.png)](https://packagist.org/packages/anime-db/shmop)
[![Total Downloads](https://poser.pugx.org/anime-db/shmop/downloads)](https://packagist.org/packages/anime-db/shmop)
[![Build Status](https://travis-ci.org/anime-db/shmop.svg?branch=master)](https://travis-ci.org/anime-db/shmop)
[![Code Coverage](https://scrutinizer-ci.com/g/anime-db/shmop/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/anime-db/shmop/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/anime-db/shmop/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/anime-db/shmop/?branch=master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/62ad77e3-fb3b-42d7-93e7-2e3b296a5a8b/mini.png)](https://insight.sensiolabs.com/projects/62ad77e3-fb3b-42d7-93e7-2e3b296a5a8b)
[![StyleCI](https://styleci.io/repos/21424974/shield)](https://styleci.io/repos/21424974)
[![Dependency Status](https://www.versioneye.com/user/projects/5746f69ace8d0e004505f4f5/badge.svg?style=flat)](https://www.versioneye.com/user/projects/5746f69ace8d0e004505f4f5)
[![License](https://poser.pugx.org/anime-db/shmop/license.png)](https://packagist.org/packages/anime-db/shmop)

# Shmop

Shmop is a simple and small abstraction layer for shared memory manipulation using PHP

## Installation

Pretty simple with [Composer](http://packagist.org), run:

```sh
composer require anime-db/shmop
```

## Usage

Creating new block

```php
use AnimeDb\Shmop\FixedBlock;

$sh = new FixedBlock(0xFF /* id for memory block */, 3 /* memory block size */);
$sh->write('foo');
echo $sh->read(); // print 'foo'
$sh->delete();
```

Reading an existing block

```php
use AnimeDb\Shmop\FixedBlock;

$sh = new FixedBlock(0xFF, 3);
// print contents of memory block. if block is not exists prints a blank line
echo $sh->read();
```

## License

This bundle is under the [MIT license](http://opensource.org/licenses/MIT). See the complete license in the file: LICENSE
