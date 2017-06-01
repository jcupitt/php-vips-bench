# php-vips-bench

This benchmarks the `php-vips` image processing module against `imagick` and
`gd`. 

The test is a very simple one: 

* Load a 5,000 x 5,000 pixel JPEG image.
* Crop 100 pixels from every edge.
* Shrink by 10% using a bilinear interpolator.
* Sharpen with a 3x3 convolution
* Save back as a new JPEG image. 

This is not a complex test, but it is easy to implement and does exercise image
load, save, resample and filter.

The vips website has this same test performed in many different image
processing systems, with some discussion:

https://github.com/jcupitt/libvips/wiki/Speed-and-memory-use

### Results

Run on 21/9/16 with vips8.4, libgd2.1.1, imagemagick6.8.9 on a laptop.

```
$ ./runner 
building test image ...
tile=10
test image is 5000 by 5000 pixels
make jpeg derivatives ...
timing ./vips.php ... done
timing ./imagick.php ... done
timing ./gd.php ... done
measuring memuse for ./vips.php ... done
measuring memuse for ./imagick.php ... done
measuring memuse for ./gd.php ... done

real time in seconds, fastest of three runs
benchmark   jpeg
vips.php    0.53    
imagick.php 1.96    
gd.php      6.86    

peak memory use in KB
benchmark   peak RSS
vips.php    67024
gd.php      305620
imagick.php 519860
```

The convolution in gd is rather slow. If you comment that part out of the three
tests, the differences come down a lot:

```
real time in seconds, fastest of three runs
benchmark   jpeg
vips.php    0.41    
imagick.php 1.20    
gd.php      1.85    
```

### Preparation

You need the libvips library, plus all the development files. You can probably
install via your package manager on linux or macOS. For Windows, you can
download a pre-compiled binary from the vips website:

https://github.com/jcupitt/libvips/releases

You can also compile libvips from source:

https://github.com/jcupitt/libvips

You need to install the `vips` extension for PHP:

```
$ pecl install vips
```

`gd` is probably built into your php already. `imagick` is easy to install:

```
$ pecl install imagick
```

You need to pull in the php packages that this benchmark needs.

```
$ php ~/packages/php/composer.phar install
```
