# PHP PASSWORD HASH MANAGER

Password Hash Manager provides secure Bcrypt, Argon2i (PHP>=7.2) or Argon2id (PHP>=7.3) hashing for storing user passwords or etc.

[![contributions welcome](https://img.shields.io/badge/contributions-welcome-brightgreen.svg?style=flat)](https://github.com/bariseser/php-password-hash/issues)
[![Latest Stable Version](https://poser.pugx.org/bariseser/hashmanager/v/stable)](https://packagist.org/packages/bariseser/hashmanager)
[![Total Downloads](https://poser.pugx.org/bariseser/hashmanager/downloads)](https://packagist.org/packages/bariseser/hashmanager)
[![License](https://poser.pugx.org/bariseser/hashmanager/license)](https://packagist.org/packages/bariseser/hashmanager)
[![Build Status](https://travis-ci.org/bariseser/php-password-hash.svg?branch=master)](https://travis-ci.org/bariseser/php-password-hash)

## Requirement

  - PHP 7
    - Bcrypt (>= 5.5.0)
    - Argon2i (>=7.2.0))
    - Argon2id (>=7.3.0))
  - [Composer](https://getcomposer.org/)
  
## Installation

Password Hash Manager installation is very simple. Open the terminal and run this command

`composer require bariseser/hashmanager`

## Usage

You can creates a new password hash using a strong one-way hashing algorithm

```php
<?php
require '../vendor/autoload.php';
use Bariseser\hashmanager;

$hashManager = HashManager::getInstance()->initialize(HashManager::BCRYPT);
$hash = $driver->hash("Your Password");
echo $hash.PHP_EOL;
```

Verifies that a password matches a hash

```php
<?php
require '../vendor/autoload.php';
use Bariseser\hashmanager;

$hashManager = HashManager::getInstance()->initialize(HashManager::ARGON2I);
if ($driver->validate("Your Password", $hash)) {
    echo "Valid Password" . PHP_EOL;
} else {
    echo "Invalid Password" . PHP_EOL;
}
```

Get hash info

```php
<?php
require '../vendor/autoload.php';
use Bariseser\hashmanager;

$hashManager = HashManager::getInstance()->initialize(HashManager::ARGON2I);
$hash = $driver->hash("Your Password");
$info = $driver->getInfo($hash);
echo $hash.PHP_EOL;
print_r($info);
```

Switch Algorithm

````php
<?php 

$driver->setAlgorithm(HashManager::BCRYPT);
$driver->setAlgorithm(HashManager::ARGON2I);
$driver->setAlgorithm(HashManager::ARGON2ID);

````

## Supported algorithm

- Bcrypt (>=5.5.0)
- Argon2I (>=7.2.0)
- Argon2ID (>=7.3.0)

Getting help / Contact
---
* bariseser@gmail.com
* [Issue](https://github.com/bariseser/php-password-hash/issues)

Contributing
---
1 - Fork the Project

2 - Ensure you have Composer installed (see Composer Download Instructions)

3 - Install Development Dependencies

```bash
composer install
```

4 - Run the Test Suite
```bash
vendor/bin/phpunit
```

5 - Send us a Pull Request
