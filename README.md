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

https://github.com/libvips/libvips/wiki/Speed-and-memory-use

### Results

Run on 17/8/23 with libvips 8.14, libgd 2.3.3, imagick 3.7 on Ubuntu 23.04
with a 3955WX.

```
$ VIPS_CONCURRENCY=4 ./runner 
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
benchmark	jpeg
vips.php	0.28	
imagick.php	1.58	
gd.php	1.68	

peak memory use in KB
benchmark	peak RSS
vips.php	80384
gd.php	220928
imagick.php	521128
```

