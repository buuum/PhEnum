PhEnum
================================

[![Packagist](https://img.shields.io/packagist/v/buuum/phenum.svg)](https://packagist.org/packages/buuum/phenum)
[![license](https://img.shields.io/github/license/mashape/apistatus.svg?maxAge=2592000)](#license)

## Install

### System Requirements

You need PHP >= 7.0.0 to use Buuum\PhEnum but the latest stable version of PHP is recommended.

### Composer

Buuum\PhEnum is available on Packagist and can be installed using Composer:

```
composer require buuum/phenum
```

### Manually

You may use your own autoloader as long as it follows PSR-0 or PSR-4 standards. Just put src directory contents in your vendor directory.


### Define

```php
final class UserEnum extends \PhEnum\PhEnum
{
    const SEX_MALE = 1;
    const SEX_FEMALE = 2;

}
```

### Methods

```php
$enum = new UserEnum(UserEnum::SEX_MALE);
$enum_female = new UserEnum(UserEnum::SEX_FEMALE);

$enum->equals($enum_female); // (false)
$enum->getValue(); // (1)
$enum->getKey(); // (SEX_MALE)
```

### Static Methods 

```php
UserEnum::SEX_MALE(); // instance of PhEnum

UserEnum::isValidKey('SEX_MALE'); // (true)
UserEnum::isValid(5); // (false)
UserEnum::search(UserEnum::SEX_FEMALE); // (SEX_FEMALE)
UserEnum::toArray(); // (array(2) { ["SEX_MALE"]=> int(1) ["SEX_FEMALE"]=> int(2) })
UserEnum::keys(); // (array(2) {
                        [0]=>
                        string(8) "SEX_MALE"
                        [1]=>
                        string(10) "SEX_FEMALE"
                      })
UserEnum::values(); // array(2) {
                         [0]=>
                         int(1)
                         [1]=>
                         int(2)
                       }
```

### Examples
#### case 1
```php
function demo(UserEnum $enum)
{
    return $enum->getValue();
}
demo(new UserEnum(UserEnum::SEX_MALE));
// or
demo(UserEnum::SEX_MALE());
```
#### case 2
```php
function demo($enum)
{
    if(!UserEnum::isValid($enum)){
        throw new Exception("Value not valid");
    }
    return false;
}
demo(UserEnum::SEX_FEMALE);
```
 
## LICENSE

The MIT License (MIT)

Copyright (c) 2017

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.