# SimpleImage
> Auto generate images for fanspage

![result images](assets/result.jpg)

## Installation

### Nix

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

Edit and config your api key at `src/Unsplash.php`

## Use SimpleImage on your project

```php
require __DIR__.'/vendor/autoload.php';

use Bhsec\SimpleImage\Gambar;
use Bhsec\SimpleImage\Unsplash;

$draw = Gambar('Hello world', 'Dark', 'FSXE300.ttf'); // text, unsplash query, font
$draw->getResult('result.png', image/png', 100); // outname, mime, quality
```
