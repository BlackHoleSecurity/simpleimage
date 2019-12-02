# SimpleImage
> Auto generate images for fanspage

![result images](result.png)

## Installation

### OS X & Linux:

```sh
git clone https://github.com/BlackHoleSecurity/simpleimage.git
cd simpleimage
composer install
```

### Windows:

```sh
git clone https://github.com/BlackHoleSecurity/simpleimage.git
cd simpleimage
composer install
```

## Setup

Edit and config your api key at src/Unsplash.php
or use default background instead src/assets

## Use SimpleImage on your project

```php
require __DIR__.'/vendor/autoload.php';
use Bhsec\SimpleImage\Gambar;
use Bhsec\SimpleImage\Unsplash;
$draw = Gambar('Hello world', 'Dark', 'FSXE300.ttf'); // text, unsplash, font
$draw->getResult('result.png', image/png', 100); // outname, mime, quality
```

## Meta

Cvar1984 – [@E13371984](https://t.me/E13371984) – gedzsarjuncomuniti@gmail.com

Distributed under the MIT license. See ``LICENSE`` for more information.

[SimpleImage](https://github.com/BlackHoleSecurity/simpleimage)

## Contributing

1. Fork it (<https://github.com/BlackHoleSecurity/simpleimage/>)
2. Add your changes (`git add foo/bar`)
3. Commit your changes (`git commit -m 'Add some fooBar'`)
4. Push to the branch (`git push comunity master`)
5. Create a new Pull Request

