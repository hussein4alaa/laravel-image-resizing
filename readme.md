# Laravel Image Resizing
### You can change the image size while uploading


This is where your description should go. Take a look at [contributing.md](contributing.md) to see a to do list.

## Installation

Via Composer

``` bash
$ composer require g4t/laravel-image-resizing
```

##### now publish `ImageResizing.php` using this command:

``` bash
$ php artisan vendor:publish --provider=g4t\ImageResizing\ImageResizingServiceProvider
```

## Usage

``` bash
in folder `config` You will find `ImageResizing.php`
you will find some examples there
you can define:
Image `height`
Image `width`
`path` to save images
`save_orginal` to save orginal image or not
`full_url` to return full url or not
`base_url` to use with `full_url`
```

## Use in Controller
``` bash
use g4t\ImageResizing\Upload;
.
.
.
return Upload::file($request->image, 'small');
```
#### `small` in our example can find it in ImageResizing.php


## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/g4t/imagesoptimizer.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/g4t/imagesoptimizer.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/g4t/imagesoptimizer/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/g4t/imagesoptimizer
[link-downloads]: https://packagist.org/packages/g4t/imagesoptimizer
[link-travis]: https://travis-ci.org/g4t/imagesoptimizer
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/g4t
[link-contributors]: ../../contributors
