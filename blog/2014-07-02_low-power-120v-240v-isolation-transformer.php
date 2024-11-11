<?php
$post = array(
	'title' => 'Low Power 120V+240V Isolation Transformer'
);
?>

<p>Since I was tired of using the <a href="http://thesignalpath.com/blogs/2011/06/12/camera-flash-circuit-and-nixie-tube-tutorial/">flash circuit hack</a> (<a href="https://plus.google.com/+NathanCampos/posts/f2zAfrbQJmw">my version</a>) to power my tube experiments I finally decided to build a isolation transformer using two identical step-down transformers as suggested by Mike in his <a href="http://www.electricstuff.co.uk/nixclock.html">nixie clock documentation</a>. Here are some photos of it:</p>

<?= $this->image_gallery(array(
	array('loc' => "inside.jpg", 'alt' => "View of the inside with the transformers back-to-back"),
	array('loc' => "case.jpg", 'alt' => "Outside of the case with banana jacks and labels")
)); ?>

<p>I'm planing to build a adjustable HV lab power supply in the future (which I may sell as a kit), so stay tuned. </p>

<p style="font-size: 0.8em">
	This article was imported from <a href="http://currentflow.net/">my old blog
	</a>. Some things may be broken.
</p>
