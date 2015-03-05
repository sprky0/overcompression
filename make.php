<?php

$now = time();
$tardir = "/tmp/processframes/$now";

`mkdir -p $tardir`;
`ffmpeg -i test.mov $tardir/%6d.jpg`;

$files = scandir($tardir, SCANDIR_SORT_ASCENDING);

for($l = 0; $l < 10; $l++) {

	foreach($files as $file) {

		if (substr($file,-3) == "jpg") {

			$loops = 10;

			for($i = 0; $i < $loops; $i++) {

				$quality = rand(1,100);

				echo "Processing $tardir/$file to $quality\n";
				$im = imagecreatefromjpeg("$tardir/$file");
				imagejpeg($im, "$tardir/$file", $quality);

			}

		}

	}

}

`ffmpeg -i $tardir/%6d.jpg -vf fps=24 $tardir/out.mp4`;

`open $tardir/out.mp4`;
