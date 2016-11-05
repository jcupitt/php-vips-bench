#!/usr/bin/env php
<?php

require __DIR__ . '/vendor/autoload.php';

use Jcupitt\Vips;

$im = Vips\Image::newFromFile($argv[1], ["access" => Vips\Access::SEQUENTIAL]);

$im = $im->crop(100, 100, $im->width - 200, $im->height - 200);

$im = $im->reduce(1.0 / 0.9, 1.0 / 0.9, ["kernel" => Vips\Kernel::LINEAR]);

$mask = Vips\Image::newFromArray(
          [[-1,  -1, -1], 
           [-1,  16, -1], 
           [-1,  -1, -1]], 8);
$im = $im->conv($mask);

$im->writeToFile($argv[2]);

/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * End:
 * vim600: expandtab sw=4 ts=4 fdm=marker
 * vim<600: expandtab sw=4 ts=4
 */
