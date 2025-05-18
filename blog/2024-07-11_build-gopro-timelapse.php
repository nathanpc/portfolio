<?php
$post = array(
	'title' => 'Create timelapse videos with a GoPro, ffmpeg and bash'
);
?>

<p>GoPro cameras are great to have around. I have several very old models and a
couple of knockoffs as well. They capture great footage and have a plethora of
accessories to mount them to nearly everything you can imagine. Because of this
they are great for documenting moments and specially documenting projects or
work you are performing.</p>

<p>They come specially useful for timelapses and the camera has a special mode
just for these. In timelapse mode the camera will take a picture every X number
of seconds (set in the camera settings). The camera stores these timelapse
images in the same place, and in the same way, as if they were manually taken by
you, which means that if you took pictures before and after the timelapse you'll
have to separate them manually.</p>

<p>The real problem comes when you get to the computer and you want to combine
these images into a video, which is always the ultimate goal of a timelapse.
Bacause the camera stores the timelapse photos in the same manner as regular
photos, this means it'll create a new folder each time the file index overflows.
For example: Pictures start at <code>G0020001.JPG</code> and when they reach
<code>G0020999.JPG</code> a new folder will be created and the process will
start over, just like every digital camera you ever had.</p>

<?= compat_image('./gopro-folder.png',
	'The folder structure created by the GoPro for timelapses') ?>

<p>That wouldn't be such a big deal, you could always copy the contents of each
folder into another one and simply point a timelapse program at this new folder
and you would be done. The issue is that because of the way the camera indexing
works, and the fact that, if you are running a timelapse for many hours, the
counter will eventually wrap around itself and you'll end up with pictures taken
hours apart that have the same filename, making it impossible to dump them all
in the same folder without having them overwritten or getting them mixed
together.</p>

<p>The only solution to this is to create individual timelapse videos of each
folder and then combine these videos into a single timelapse. Since this is
quite a time consuming task, I've decided to write a simple bash script to make
the whole proccess fully automated:</p>

<?php compat_code_begin('bash'); ?>#!/bin/bash

# Go through directories building videos from them.
echo "Generating a timelapse for each folder created by the camera..."
index=0
for dir in *; do
	if [ -d "$dir" ]; then
		pushd "$dir"
		fname=`printf "../%03d.mp4" $index`
		ffmpeg -framerate 30 -pattern_type glob -i "*.JPG" -c:v libx264 \
			-crf 18 "$fname"
		popd

		((index++))
	fi
done

# Concatenate the videos into a single one.
echo "Concatenating videos into a continuous timelapse..."
printf "file '%s'\n" *.mp4 > videolist.txt
ffmpeg -f concat -i videolist.txt -c copy timelapse.mp4
rm videolist.txt

# Make a 1080p version for ease of sharing.
echo "Creating a 1080p version of the timelapse..."
ffmpeg -i timelapse.mp4 -vf 'scale=-2:1080' -c:v libx264 -crf 18 \
	timelapse-1080p.mp4

echo "Done"<?php compat_code_end(); ?>

<p>Simply place this script in the folder with the timelapse footage from the
camera and the script will create the individual videos of each folder at the
original resolution of the pictures, ensuring you have a high resolution
archival copy of the timelapse, leaving you the option of deleting the original
pictures, and it'll also create a 1080p (respecting the original aspect ratio)
version of the video for sharing purposes.</p>
