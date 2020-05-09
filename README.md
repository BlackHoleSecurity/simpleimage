# SimpleImage
> Auto generate images for fanspage
![result images](assets/result.jpg)
[![CodeFactor](https://www.codefactor.io/repository/github/BlackHoleSecurity/simpleimage/badge)](https://www.codefactor.io/repository/github/BlackHoleSecurity/simpleimage)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)

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

$draw = Bhsec\SimpleImage\Gambar('Hello world', 'Dark', 'FSXE300.ttf'); // text, unsplash query, font
$draw->getResult('result.png', image/png', 100); // outname, mime, quality
```
