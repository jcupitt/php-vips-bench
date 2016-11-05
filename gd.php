#!/usr/bin/env php
<?php

$im = imagecreatefromjpeg($argv[1]);

$im = imagecrop(
    $im, [
	"x" => 100, "y" => 100, 
	"width" => imagesx($im) - 200, "height" => imagesy($im) - 200
    ]
);

$im = imagescale(
    $im, imagesx($im) * 0.9, imagesy($im) * 0.9, IMG_BILINEAR_FIXED
); 

imageconvolution(
    $im, 
    [[-1,  -1, -1], 
     [-1,  16, -1], 
     [-1,  -1, -1]
    ], 
    8, 0
);

imagejpeg($im, $argv[2]);

/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * End:
 * vim600: expandtab sw=4 ts=4 fdm=marker
 * vim<600: expandtab sw=4 ts=4
 */
